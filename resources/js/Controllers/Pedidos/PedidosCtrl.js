app.controller('PedidosCtrl', PedidosCtrl);
PedidosCtrl.$inject = ['$scope', '$http','Helper', 'Ventana_modal', 'codigosError'];

function PedidosCtrl($scope, $http, Helper, Ventana_modal,codigosError){

   $scope.Parametros = function(){
      $http.get('api/parametros').success(function(response){
         $scope.Estados = response.datos.estados;
         //Agrega un elemento a la lista de estados
         var element = {};
         element.nombre = 'Todos';
         element.codigo = 0;
         $scope.Estados.unshift(element);

         //Agrega la fecha en el filtro de busqueda
         var date = new Date();
         date.setDate(date.getDate() - 10);
         $scope.filtro.fechaInicio = date;
         $scope.filtro.fechaFinal = new Date();

         $scope.filtro.estado = 0;

         $scope.getPedidos(1);
      });
   }

   $scope.getPedidos = function (skip) {

      Ventana_modal.loader('Cargando . . .');

      $scope.filtro.skip = skip;

      $http.post('api/pedidos/getPedidos', $scope.filtro).success(function(response){
         Ventana_modal.loader();
         $scope.pedidos = response.pedidos;
         $scope.paginacion = response.paginacion;
         $scope.filtro_obj = false; //!important
      });
   }


   $scope.abrirFiltro = function(){
      $scope.filtro_obj = true;
   }

   $scope.cerrarFiltro = function(){
      $scope.filtro_obj = false;
      $scope.pfecha     = false;
      $scope.pempresa   = false;
      $scope.p_zona      = false;
   }

   $scope.actiFi = function(filtro){

      if(filtro==1){
         $scope.pfecha=true;
      }else if(filtro==2){
         $scope.pempresa = true;
         $scope.getCommerce();
      }
   }

   $scope.canFiltro = function(filtro){

      if(filtro==1){
         $scope.pfecha=false;
         $scope.filtro.fecha_inicio=null;
         $scope.filtro.fecha_fin=null;
      }else if(filtro==2){
         $scope.pempresa=false;
         $scope.filtro.empresa=null;
      }
   }

   $scope.showPedido = function (id_pedido){

      var scrollShow = angular.element(document.querySelector('body'));
          scrollShow.toggleClass('hide_scroll');

      $scope.fondodetalle = !$scope.fondodetalle;
      $scope.verdetalle = !$scope.verdetalle;

      Ventana_modal.loader('Cargando . . .');

      $http.get('api/pedidos/getPedido/'+id_pedido).success(function(response){
         Ventana_modal.loader();
         $scope.selectPedido = response.pedido; console.log($scope.selectPedido);
         $scope.verifyStatus($scope.selectPedido.estado.codigo)
      });
   }

   $scope.showObsers = function () {
      $scope.modalObser = !$scope.modalObser;
   }

   $scope.verifyStatus = function(estado){

      $scope.nuevo_pedido   = false;
      $scope.bodega         = false;
      $scope.facturacion    = false;
      $scope.ruta_pedido    = false;
      $scope.estado_pedido  = false;
      $scope.entregado      = false;
      $scope.incompleto     = false;
      $scope.cancelado      = false;
      $scope.devolucion     = false;

      if(estado==1){
         $scope.nuevo_pedido = true;
      }else if(estado==2){
         $scope.bodega = true;
      }else if(estado==3){
         $scope.facturacion = true;
      }else if(estado==4){
         $scope.ruta_pedido = true;
      }else if(estado==5){
         $scope.entregado = true;
      }else if(estado==6){
         $scope.incompleto = true;
      }else if(estado==7){
         $scope.cancelado = true;
      }else if(estado==8){
         $scope.devolucion = true;
      }

   }

   $scope.hiddeDetalle = function (){
      var scrollShow = angular.element(document.querySelector('body'));
          scrollShow.toggleClass('hide_scroll');

      $scope.fondodetalle = !$scope.fondodetalle;
      $scope.verdetalle = !$scope.verdetalle;
   }

   // LIBRARY FileSaver
   $scope.exportExcel = function () {

      Ventana_modal.loader('Cargando pedidos . . .');

      $scope.filtro.descarga = true;

      $http({
         method: 'POST',
         url: 'api/pedidos/getPedidos/exportExcel',
         data: $scope.filtro,
         responseType: 'arraybuffer',
      }).success(function (data) {

         Ventana_modal.loader();

         var blob = new Blob([data], {type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"});
         saveAs(blob, "reporte.xls");

      }).error(function (data) {
         Ventana_modal.loader();
      });
   };


   $scope.initializer = function(){
      $scope.filtro = {};
      $scope.Parametros();
   }

   $scope.initializer();
};
