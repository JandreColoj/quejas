app.controller('VentaCtrl', VentaCtrl);
VentaCtrl.$inject = ['$scope', '$http','Helper', 'Ventana_modal', 'codigosError'];

function VentaCtrl($scope, $http, Helper, Ventana_modal,codigosError){

   $scope.nueva_ventana = function(tipo, data = false){
      
      $scope.modal_option = false;

      if(tipo=='VENTA'){ 
         $scope.modal_venta = true;
      }else if(tipo=='ENTRADA'){
       
      } 

   }
 
  

   $scope.salePOS = function(){

      Ventana_modal.loader('Registrando . . .');

      $http.post('api/venta/POS', $scope.venta).success(function(response){
         Ventana_modal.loader();
         $scope.modal_venta = false;

         if(response.codigo==400){
            Ventana_modal.modalResponse(response.error_message, 'error');
         }else{
            $scope.venta = {};
            Ventana_modal.modalResponse(response.message, 'success');
            $scope.getVentas();
         }

      });
 
   }

   $scope.getVentas = function(){

      $http.post('api/venta/getVentas',$scope.filtro).success(function(response){       
         $scope.ventas = response.ventas;
         
         $scope.filtro_obj = false;
      });
 
   }

   $scope.getAgencia = function () {
      Ventana_modal.loader('Cargando . . .');
      $http.get('api/transactions/getAgencia').success(function(response){ 
         Ventana_modal.loader();
         $scope.agencias = response.agencias;

      });
   }

   $scope.abrirFiltro = function(){
      $scope.filtro_obj = true;
   }
   
   $scope.cerrarFiltro = function(){ 
      $scope.pfecha = false;
      $scope.p_agencia = false; 
      $scope.filtro_obj = false;
   }
   

   $scope.actiFi = function(filtro){

      if(filtro==1){
         $scope.pfecha=true;
      }else if(filtro==4){
         $scope.p_agencia=true;
         $scope.getAgencia();
      }
   }

   $scope.canFiltro = function(filtro){

      if(filtro==1){
         $scope.pfecha=false;
         $scope.filtro.fecha_inicio=null;
         $scope.filtro.fecha_fin=null;
      }else if(filtro==4){
         $scope.p_agencia=false;
         $scope.filtro.agencia=null;
      } 
   }


   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }
 
   $scope.initializer = function(){ 
      $scope.venta = {};
      $scope.filtro = {};
      $scope.getVentas();
   } 
   
   $scope.initializer();
};
