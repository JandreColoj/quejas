app.controller('WelcomeCtrl', WelcomeCtrl);
WelcomeCtrl.$inject = ['$scope', '$http', '$location','$window','Helper', 'Ventana_modal'];

function WelcomeCtrl($scope, $http, $location, $window ,Helper,Ventana_modal){

   $scope.getDepartamentos = function(){
      $http.get('public/getDepartamentos/'+0).success(function(response){
         $scope.departamentos = response.datos;
      });
   };

   $scope.getMunicipio = function(){
      $http.get('public/getMunicipio/'+$scope.queja.departamento).success(function(response){
         $scope.municipios = response.datos;
      });
   };


   $scope.sendAnonima = function(){
      $scope.queja.anonima = !$scope.queja.anonima;
   }

   $scope.sendQueja = function(){

      Ventana_modal.loader('Enviando . . .');

      $http.post('public/sendqueja',$scope.queja).success(function(response){

         Ventana_modal.loader();

         if(response.codigo==200){
            $scope.queja ={};
            Ventana_modal.modalResponse(response.message, 'success');
         }else{
            Ventana_modal.modalResponse(response.error_message, 'error');
         }

      });
   }

   $scope.buscarQueja = function(){

      Ventana_modal.loader('buscando . . .');

      $http.post('public/buscarQueja',$scope.queja).success(function(response){

         Ventana_modal.loader();

         if(response.codigo==200){
           $scope.modal_queja = true;
           $scope.detail = response.queja;
         }else{
            Ventana_modal.modalResponse(response.error_message, 'error');
         }

      });
   }

   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }

   $scope.inicialize = function(){
      $scope.getDepartamentos();
      $scope.queja = {};
      $scope.queja.anonima = true;
   }

   $scope.inicialize();
};

