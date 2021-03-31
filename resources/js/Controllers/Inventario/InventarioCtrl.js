app.controller('InventarioCtrl', InventarioCtrl);
InventarioCtrl.$inject = ['$scope', '$http','Helper', 'Ventana_modal', 'codigosError'];

function InventarioCtrl($scope, $http, Helper, Ventana_modal,codigosError){

   $scope.nueva_ventana = function(tipo, data = false){
      
      $scope.modal_option = false;

      if(tipo=='NUEVO'){ 
         $scope.modal_option = true;
      }else if(tipo=='ENTRADA'){
         $scope.modal_entrada = true; 
      }else if(tipo=='SALIDA'){
         $scope.modal_salida = true; 
         $scope.getAgencia();
      }else if(tipo=='AGENCIA'){
         $scope.modal_agencia = true;  
         $scope.getAgencia();
      }else if(tipo=='NUEVO_INGRESO'){
         $scope.modal_aceptar_ingreso = true;   
      }else if(tipo=='DISPONIBLE'){
         $scope.modal_disponible = true;   
         $scope.getInventarioAll();
      }

   }

   $scope.setInventario = function(){

      Ventana_modal.loader('. . .');

      $http.post('api/inventario/setInventario', $scope.ingreso).success(function(response){
         Ventana_modal.loader();
         $scope.modal_entrada = false;
         $scope.getInventario();
      });
 
   }

   $scope.subInventario = function(){

      Ventana_modal.loader('. . .');

      $http.post('api/inventario/subInventario', $scope.salida).success(function(response){
         Ventana_modal.loader();
         $scope.modal_salida = false;
         $scope.getInventario();
      });

   }


   $scope.getInventario = function(){

      Ventana_modal.loader('Cargando . . .');

      $http.get('api/inventario/getInventario' ).success(function(response){

         Ventana_modal.loader();
         $scope.inventario = response.data; 
      });
   }
      
   $scope.getInventarioAll = function(){

      Ventana_modal.loader('Cargando . . .');

      $http.get('api/inventario/getInventarioAll' ).success(function(response){

         Ventana_modal.loader();
         $scope.inventarioAll = response.data; 
 
      });
      

   }

   $scope.getInventarioAgencia = function(id_agencia){

      Ventana_modal.loader('Cargando . . .');

      $http.get('api/inventario/getInventarioAgencia/'+id_agencia).success(function(response){
         Ventana_modal.loader();
         $scope.inventarioAgencia = response.data;
      });
 
   }

   $scope.getAgencia = function () {
      Ventana_modal.loader('Cargando . . .');
      $http.get('api/transactions/getAgencia').success(function(response){ 
         Ventana_modal.loader();
         $scope.agencias = response.agencias;
      });
   }

   $scope.initializer = function(){
      $scope.ingreso = {};
      $scope.salida = {};
      $scope.select = {};
      $scope.getInventario();
   } 
   
   $scope.initializer();
};
