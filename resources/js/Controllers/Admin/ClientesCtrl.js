app.controller('ClientesCtrl', ClientesCtrl);
ClientesCtrl.$inject = ['$scope', '$http', '$location','$window','Helper', 'Ventana_modal'];

function ClientesCtrl($scope, $http, $location, $window ,Helper,Ventana_modal){


   $scope.nueva_ventana = function(tipo = false, data = false){

      $scope.errors = [];

      switch (tipo) {

         case 'SELECCION_PLAN':
            $scope.nueva_ventana();
            $scope.modal_select_plan = true;
            break;

         case 'SELECCION_INFORMACION':
            $scope.nueva_ventana();
            $scope.modal_informacion = true;
            break;

         // CIERRA MODALS
         case false:
            $scope.modal_select_plan = false;
            $scope.modal_informacion = false;
         default:
            break;
      }

   }


   $scope.getClientes = function(skip){

      $scope.filtro.skip = skip;

      Ventana_modal.loader('Cargando . . .');

      $http.post('api/clientes/getClientes', $scope.filtro).success(function(response){
         $scope.clientes = response.datos;
         $scope.paginacion = response.paginacion;
         Ventana_modal.loader();
      });

   }

   $scope.showClient = function(id){

      Ventana_modal.loader('Cargando . . .');

      $http.get('api/clientes/getClientes/'+id).success(function(response){
         $scope.detailClient = response.datos;
         Ventana_modal.loader();

         if (response.codigo==200) {
            $scope.modal_detail_client = true;
         }else{

            Ventana_modal.modalResponse(response.message_error, 'error');
         }

      });
   }

   $scope.area_detalle = 1;
   $scope.selectSection= function(area){
      $scope.area_detalle = area;
   }

   $scope.init = function(){

      $scope.filtro = {};

      $scope.getClientes(1);
      $scope.nueva_ventana('SELECCION_PLAN');
   }
   $scope.init();

   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }


};

