app.controller('EscritorioCtrl', EscritorioCtrl);
EscritorioCtrl.$inject = ['$scope', '$http', '$timeout','Helper', 'Ventana_modal'];

function EscritorioCtrl($scope, $http, $timeout, Helper,Ventana_modal){

   $scope.nueva_ventana = function(tipo, data = false){

      $scope.errors  = [];

      if(tipo=='DETALLE_TRANSACCION'){

         $scope.modal_detalle_transaccion = true;
         $scope.transaccion = data; console.log($scope.transaccion);

      }
   }

   $scope.pefilEmpresa = function(){
      $http.get('api/pefilEmpresa').success(function(response){
         $scope.registro = response.datos;

         if($scope.registro.dpi==null || $scope.registro.delivery==null || $scope.registro.direccion=='' || $scope.registro.telefono=='') {
            $scope.modal_info = true;
         }

      });
   }

   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }


   $scope.getDetail = function (filtro){

      $scope.filtro.filtro = filtro;

      Ventana_modal.loader('Cargando . . . .');

      $http.post('api/escritorio/getDetails', $scope.filtro).success(function(response){
         Ventana_modal.loader();
         $scope.resumen = response.datos;
         $scope.cerrarFiltro();

         $scope.getVentas($scope.filtro.filtro);
      });
   }


   $scope.getVentas = function(filtro = false){

      $scope.filtro.filtro = filtro;

      $http.post('api/escritorio/detalleVenta', $scope.filtro).success(function(response) {

         if (response.codigo==200) {

            var ventaAnterior = response.data.anterior.ventas;
            var anioAnterior = response.data.anterior.year;
            var ventaActual = response.data.presente.ventas;
            var anioActual = response.data.presente.year;

            $scope.graficaVentasBarra(ventaAnterior, anioAnterior, ventaActual, anioActual);
         }else{

            Ventana_modal.modalResponse(response.message_error, 'error');
         }

      });

   }

   $scope.graficaVentasBarra = function(ventaAnterior, anioAnterior, ventaActual, anioActual){

      Highcharts.chart('container', {
         chart: {
             type: 'column'
         },
         title: {
             text: 'Comparativo de facturación'
         },
         subtitle: {
            //  text: 'Source: Pagalo'
         },
         xAxis: {
             categories: [
                 'Enero',
                 'Febrero',
                 'Marzo',
                 'Abril',
                 'Mayo',
                 'Junio',
                 'Julio',
                 'Agosto',
                 'Septiembre',
                 'Octubre',
                 'Noviembre',
                 'Diciembre'
             ],
             crosshair: true
         },
         yAxis: {
             min: 0,
             title: {
                 text: 'Facturación (MXN)'
             }
         },
         tooltip: {
             headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
             pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                 '<td style="padding:0"><b>{point.y:.2f} MXN </b></td></tr>',
             footerFormat: '</table>',
             shared: true,
             useHTML: true
         },
         plotOptions: {
             column: {
                 pointPadding: 0.2,
                 borderWidth: 0
             }
         },
         series: [{
             name: anioAnterior,
             data: ventaAnterior

         },{
             name: anioActual,
             data: ventaActual

         }]
     });
   }

   $scope.graficaVentasBarra();

   $scope.getConsultor = function () {
      Ventana_modal.loader('Cargando . . .');
      $http.get('api/transactions/getConsultor').success(function(response){
         Ventana_modal.loader();
         $scope.consultores = response.consultores;
      });
   }

   $scope.getZona = function () {
      Ventana_modal.loader('Cargando . . .');
      $http.get('api/transactions/getZona').success(function(response){
         Ventana_modal.loader();
         $scope.zonas = response.zonas;
      });
   }

   $scope.getAgencia = function () {
      Ventana_modal.loader('Cargando . . .');
      $http.get('api/transactions/getAgencia').success(function(response){
         Ventana_modal.loader();
         $scope.agencias = response.agencias;
      });
   }

   $scope.getColaborador = function () {
      $http.get('api/transactions/getColaborador').success(function(response){
         $scope.colaboradores = response.colaboradores;
      });
   }


   $scope.abrirFiltro = function(){
      $scope.showFilter = true;
   }

   $scope.cerrarFiltro = function(){
      $scope.showFilter = false;
   }

   $scope.activarFiltro = function(filtro){

      if(filtro==1){
         $scope.filtro_fecha = true;
      }
   }

   $scope.cancelarFiltro = function(filtro){

      if(filtro==1){
         $scope.filtro_fecha=false;
         $scope.filtro.fecha_inicio = null;
         $scope.filtro.fecha_fin    = null;
      }
   }

   $scope.initializer = function(){

      $scope.filtro = {};
      $scope.anio_inicial = 2020 ; //INICIO DE OPERACIONES
      $scope.anio_actual  = new Date().getFullYear();
      $scope.years = [];

      for(let a = 0; a < 5; a++){
         if(($scope.anio_actual-a) >= $scope.anio_inicial){
            $scope.years.push($scope.anio_actual-a);
         }
      }
      console.log( $scope.anio_actual);
      $scope.getDetail($scope.anio_actual);
   }

   $scope.initializer();

};

