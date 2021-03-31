app.controller('MenuCtrl', MenuCtrl);

MenuCtrl.$inject = ['$scope', '$http', '$timeout','localStorageService'];

function MenuCtrl($scope, $http, $timeout,localStorageService){

   var menu = angular.element(document.getElementById('container_menu'));
   var scrollBody = angular.element(document.querySelector('body'));

   $scope.showMenu = function (){
      menu.addClass('active_menu');
   }

   $scope.closeMenu = function () {
      menu.addClass('close_menus');

      $timeout(function () {
         menu.removeClass('active_menu');
         $timeout(function () {
            menu.removeClass('close_menus');
         }, 10);
      }, 300);
   }

   $scope.list_ajustes = false;
   $scope.showAjustes = function () {
      $scope.list_ajustes = !$scope.list_ajustes;
   }

   // Menú plegable
   $scope.minizarmenuLateral = false;
   $scope.minizarMenu = function() {
      $scope.minizarmenuLateral = !$scope.minizarmenuLateral;

      if ($scope.minizarmenuLateral == true) {

         localStorageService.add('estadoMenu', 'activo');

         var miniMenu = angular.element(document.getElementsByClassName('container_menu'));
         miniMenu.addClass('active_wmenul');

         var dashExpand = angular.element(document.getElementsByClassName('container_dash'));
         dashExpand.addClass('active_wdashboard');

         var ico_minimizar = angular.element(document.getElementsByClassName('ico_minimizar'));
         ico_minimizar.addClass('dnone');

      } else {

         localStorageService.remove('estadoMenu')

         var miniMenu = angular.element(document.getElementsByClassName('container_menu'));
         miniMenu.removeClass('active_wmenul');

         var dashExpand = angular.element(document.getElementsByClassName('container_dash'));
         dashExpand.removeClass('active_wdashboard');

         var ico_minimizar = angular.element(document.getElementsByClassName('ico_minimizar'));
         ico_minimizar.removeClass('dnone');
      }
   }

   $scope.minizadoMenu = function () {
      localStorageService.add('estadoMenu', 'activo');

      var miniMenu = angular.element(document.getElementsByClassName('container_menu'));
      miniMenu.addClass('active_wmenul');

      var dashExpand = angular.element(document.getElementsByClassName('container_dash'));
      dashExpand.addClass('active_wdashboard');

      var ico_minimizar = angular.element(document.getElementsByClassName('ico_minimizar'));
      ico_minimizar.addClass('ico_minimizarrotate');
   }

   $scope.estadoMenu = function () {
      if (localStorageService.get("estadoMenu")) {
         $scope.minizarmenuLateral = true;
         $scope.minizadoMenu();
      }
   }

  $scope.estadoMenu();
}

app.controller('ReportesCtrl', ReportesCtrl);
ReportesCtrl.$inject = ['$scope', '$http', '$location','$window','Helper', 'Ventana_modal','$timeout', 'styleMap', 'GlobalChart'];

function ReportesCtrl($scope, $http, $location, $window ,Helper,Ventana_modal,$timeout, styleMap, GlobalChart){

   Highcharts  = GlobalChart.charts();

   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }

   $scope.graphicsOrders= function(data){

      Highcharts.chart('container_orders', {
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: ''
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
          },
          accessibility: {
              point: {
                  valueSuffix: '%'
              }
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.0f} %',
                      connectorColor: 'silver'
                  }
              }
          },
          series: [{
              name: 'Pedidos',
              data: data
          }]
      });

   }


   $scope.graphicsCategory= function(data){

     // Build the chart
     Highcharts.chart('container_category', {
         chart: {
             plotBackgroundColor: null,
             plotBorderWidth: null,
             plotShadow: false,
             type: 'pie'
         },
         title: {
             text: ''
         },
         tooltip: {
             pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
         },
         accessibility: {
             point: {
                 valueSuffix: '%'
             }
         },
         plotOptions: {
             pie: {
                 allowPointSelect: true,
                 cursor: 'pointer',
                 dataLabels: {
                     enabled: true,
                     format: '<b>{point.name}</b>: {point.percentage:.0f} %',
                     connectorColor: 'silver'
                 }
             }
         },
         series: [{
             name: 'Pedidos',
             data: data
         }]
     });

   }


   $scope.graphicsTopProviders = function(data){

      Highcharts.chart('container_top_providers', {
         chart: {
             type: 'bar'
         },
         title: {
             text: ''
         },
         subtitle: {
             text: ''
         },
         xAxis: {
             categories: data.providers,
             allowDecimals: true,
             title: {
                 text: null
             }
         },
         yAxis: {
             min: 0,
             title: {
                 text: 'Valor en pesos MXN',
                 align: 'high'
             },
             labels: {
                 overflow: 'justify'
             }
         },
         tooltip: {
             valueSuffix: ''
         },
         plotOptions: {
            series: {
               colorByPoint: false
            },
            bar: {
               dataLabels: {
                  enabled: false
               }
            }
         },
         legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
               Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
         },
         credits: {
             enabled: false
         },
         series: [{
            name: '',
            data: data.orders
         }]
      });
   }


   $scope.graphicsTopClients = function(data){

      Highcharts.chart('container_top_clients', {
         chart: {
             type: 'bar'
         },
         title: {
             text: ''
         },
         subtitle: {
             text: ''
         },
         xAxis: {
            allowDecimals: false,
            categories: data.clients,
            title: {
               text: null
            }
         },
         yAxis: {
             min: 0,
             title: {
                 text: 'Valor en pesos MXN',
                 align: 'high'
             },
             labels: {
                 overflow: 'justify'
             }
         },
         tooltip: {
            pointFormat: '<span>Total '+$scope.dataReport.currency +'</span>: <b>{point.y:.2f}</b><br/>',
            shared: true
         },
         tooltip: {
             valueSuffix: ''
         },
         plotOptions: {
            series: {
               colorByPoint: false
            },
             bar: {
                 dataLabels: {
                     enabled: false
                 }
             }
         },
         legend: {
             layout: 'vertical',
             align: 'right',
             verticalAlign: 'top',
             x: -40,
             y: 80,
             floating: true,
             borderWidth: 1,
             backgroundColor:
                 Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
             shadow: true
         },
         credits: {
             enabled: false
         },
         series: [{
            name: '',
            data: data.orders
         }]
      });
   }


   $scope.graphicsDaysOrder = function(data){

      Highcharts.chart('container_daysOrder', {
         chart: {
             type: 'column'
         },
         title: {
             text: ''
         },
         xAxis: {
            allowDecimals: false,
            categories: data.name
         },
         yAxis: [{
             min: 0,
             title: {
                 text: ''
             }
         }, {
             title: {
                 text: ''
             },
             opposite: true
         }],
         legend: {
             shadow: false
         },
         tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.2f}</b><br/>',
            // pointFormat: '<span>Total '+$scope.dataReport.currency +'</span>: <b>{point.y:.2f}</b><br/>',
            shared: true
         },
         plotOptions: {
             column: {
                 grouping: false,
                 shadow: false,
                 borderWidth: 0
             }
         },
         series: [{
               name: 'Total '+$scope.dataReport.currency,
               color: 'rgb(114, 0, 198, 0.5)',
               data: data.total,
               tooltip: {
                  valuePrefix: '$',
                  valueSuffix: ''
               },
               pointPadding: 0.3,
               pointPlacement: -0.2
            },{
               name: 'Cantidad',
               color: '#ff5c8d',
               data: data.cantidad,
               pointPadding: 0.3,
               pointPlacement: 0.2,
               yAxis: 1
            }
         ]
      });

   }


   $scope.graphicsHoursOrder = function(data){

      Highcharts.chart('container_hoursOrder', {
         chart: {
            type: 'areaspline',
         },
         title: {
            text: ''
         },
         xAxis: {
            allowDecimals: false,
            categories:  data.name
         },
         yAxis: {
            title: {
               text: '(MXN)'
            }
         },
         tooltip: {
            pointFormat: '<span>Total '+$scope.dataReport.currency +'</span>: <b>{point.y:.2f}</b><br/>',
            shared: true
         },
         plotOptions: {
            areaspline: {
               lineColor: '#ff5c8d'
            },
            line: {
               dataLabels: {
               enabled: true
               },
               enableMouseTracking: false
            }
         },
         series: [{

               color: {
                  linearGradient: {
                     x1: 0,
                     x2: 0,
                     y1: 0,
                     y2: 1
                  },
                  stops: [
                     [0, '#ff6090'],
                     [1, '#ffc1e3']
                  ]
               },

               name: 'Total',
               data: data.total
            }
         ],
      });

   }


   $scope.graphicsOrderRange = function(data){

      Highcharts.chart('container_orderRangeDate', {
         chart: {
            type: 'areaspline',
         },
         title: {
            text: ''
         },
         xAxis: {
            allowDecimals: false,
            categories:  data.name
         },
         yAxis: {
            title: {
               text: '(MXN)'
            }
         },
         tooltip: {
            pointFormat: '<span>Total '+$scope.dataReport.currency +'</span>: <b>{point.y:.2f}</b><br/>',
            shared: true
         },
         plotOptions: {
            areaspline: {
               lineColor: '#9c4dcc'
            },
            line: {
               dataLabels: {
                  enabled: true
               },
               enableMouseTracking: false
            }
         },
         series: [{
               color: {
                  linearGradient: {
                     x1: 1,
                     x2: 0,
                     y1: 0,
                     y2: 1
                  },
                  stops: [
                     [0, '#9162e4'],
                     [1, '#fff1ff']
                  ]
               },
               name: 'Total',
               data: data.total
            }
         ],
      });

   }


   $scope.generateReportGeneral = function(){

      Ventana_modal.loader('Generando . . . ');

      $http.post('api/reports/generateReportGeneral', $scope.filtro).success(function(response){

         Ventana_modal.loader();

         if(response.codigo==200){

            $scope.dataReport = response;
            $scope.graphicsTopProviders($scope.dataReport.top_proviers);
            $scope.graphicsTopClients($scope.dataReport.top_clients);
            $scope.graphicsCategory($scope.dataReport.top_category.data);
            $scope.graphicsOrders($scope.dataReport.status_orders.data);
            $scope.graphicsDaysOrder($scope.dataReport.orders_day_week);
            $scope.graphicsHoursOrder($scope.dataReport.orders_hours);
            $scope.graphicsOrderRange($scope.dataReport.orders_day);

            if($scope.dataReport.status_orders.data.length>0){
               $scope.mapCalorOrders($scope.dataReport.coordenada_orders.data);
            }

         }else{
            Ventana_modal.modalResponse(response.message_error, 'error');
         }

      });

   }


   $scope.getResumen = function(){

      $http.get('api/reports/getResumen').success(function(response){

         if(response.codigo==200){
            $scope.resumen = response.resumen;
         }else{
            Ventana_modal.modalResponse(response.message_error, 'error');
         }

      });
   }


   $scope.getProviders = function(){

      $http.get('api/reports/getProviders').success(function(response){

         if(response.codigo==200){
            $scope.providers = response.provides;
            $scope.clients   = response.clients;
            $scope.filtro.id_provider = 0;
            $scope.filtro.id_client   = 0;
         }else{
            Ventana_modal.modalResponse(response.message_error, 'error');
         }

      });

   }

   // LIBRARY FileSaver
   $scope.exportExcel = function (tipo) {

      Ventana_modal.loader('Descargando reportes. . .');

      $scope.filtro.tipo = tipo;

      $http({
         method: 'POST',
         url: 'api/reports/exportExcel',
         data: $scope.filtro,
         responseType: 'arraybuffer',
      }).success(function (data) {

         Ventana_modal.loader();

         var blob = new Blob([data], {type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"});
         saveAs(blob, "report.xls");

      }).error(function (data, status, headers, config) {
         Ventana_modal.loader();

         $timeout(function () {
            Ventana_modal.modalResponse('Ocurrio un error al descargar el reporte', 'error');
         }, 2000);
      });
   };


   /********************************  mapa de calor ********************************/
      $scope.mapCalorOrders = function(data) {

         map = new google.maps.Map(document.getElementById('map_calor'), {
            zoom: 7,
            center: {lat: data[0].latitud, lng: data[0].longitud},
            mapTypeId: google.maps.MapTypeId.MAPA
         });

         var styles = styleMap.style();
         map.setOptions({ styles: styles['silver'] });


         var points =[];

         for(let index = 0; index < data.length; index++){
            points.push(new google.maps.LatLng(data[index].latitud, data[index].longitud))
         }

         heatmap = new google.maps.visualization.HeatmapLayer({
            data: points, //data: getPoints()
            map: map
         });

         changeGradient();
         changeRadius();
         changeOpacity();
      }

      function toggleHeatmap() {
         heatmap.setMap(heatmap.getMap() ? null : map);
      }

      function changeGradient() {
         var gradient = [
            'rgba(0, 255, 255, 0)',
            'rgba(0, 255, 255, 1)',
            'rgba(0, 191, 255, 1)',
            'rgba(0, 127, 255, 1)',
            'rgba(0, 63, 255, 1)',
            'rgba(0, 0, 255, 1)',
            'rgba(0, 0, 223, 1)',
            'rgba(0, 0, 191, 1)',
            'rgba(0, 0, 159, 1)',
            'rgba(0, 0, 127, 1)',
            'rgba(63, 0, 91, 1)',
            'rgba(127, 0, 63, 1)',
            'rgba(191, 0, 31, 1)',
            'rgba(255, 0, 0, 1)'
         ]
         heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }

      function changeRadius() {
         heatmap.set('radius', heatmap.get('radius') ? null : 20);
      }

      function changeOpacity() {
         heatmap.set('opacity', heatmap.get('opacity') ? null : 0.5);
      }

      // Heatmap data: 500 Points
      function getPoints() {

         var points =[];

         for(let index = 0; index <= 1000; index++){

            var long = (14.6229+(Math.sqrt(Math.random())));
            var lat = (-90.5315+(Math.sqrt(Math.random())-1));

            points.push(new google.maps.LatLng(long, lat))
            console.log(long);
         }
         return points;
      }
   /********************************  mapa de calor ********************************/

   $scope.inicialize = function(){

      $scope.estados = [
         { nombre : 'Todos',       codigo : 0},
         { nombre : 'Nuevo',       codigo : 1},
         { nombre : 'Bodega',      codigo : 2},
         { nombre : 'Facturación', codigo : 3},
         { nombre : 'Ruta',        codigo : 4},
         { nombre : 'Entregado',   codigo : 5},
         { nombre : 'Incompleto',  codigo : 6},
         { nombre : 'Cancelado',   codigo : 7},
         { nombre : 'Devolucion',  codigo : 8},
      ];

      $scope.filtro = {};
      $scope.filtro.estado = 0;
      $scope.filtro.id_provider = 0;
      $scope.filtro.id_client   = 0;

      var date = new Date();
      date.setDate(date.getDate() - 30);
      $scope.filtro.fecha_inicio = date;
      $scope.filtro.fecha_fin    = new Date();

      $scope.getProviders();
      $scope.getResumen();
      $scope.generateReportGeneral();
   }

   $scope.inicialize();
};

app.controller('UsuariosCtrl', UsuariosCtrl);
UsuariosCtrl.$inject = ['$scope', '$http','Helper', 'Ventana_modal'];

function UsuariosCtrl($scope, $http, Helper, Ventana_modal){

   $scope.nueva_ventana = function(tipo, usuario = false){

      $scope.errors  = [];
      $scope.usuario = {};

      if(tipo=='NUEVO'){

         $scope.modal_nuevo = true;

      }else if(tipo=='EDITAR'){

         console.log(usuario.agencia);
         $scope.usuario = usuario;
         $scope.usuario.telefono    = parseInt(usuario.telefono);
         $scope.usuario.codigo_user = parseInt(usuario.codigo_user);
         $scope.usuario.rol         = usuario.rol_usuario.rol;
         $scope.usuario.slug_rol    = usuario.rol_usuario.rol.slug;
         $scope.usuario.codigo_zona = usuario.zona==null ? '' : usuario.zona.codigo;
         $scope.usuario.id_agencia  = usuario.agencia==null ? '' : usuario.agencia.id;
         $scope.modal_editar = true;

         if(usuario.agencia!=null){
            $scope.getAgencia($scope.usuario.codigo_zona);
         }

      }else if(tipo=='ELIMINAR'){
         $scope.usuario.id = usuario.id;
         $scope.modal_eliminar = true;
      }

   }

   $scope.getUsuarios = function(){

      $http.get('api/config/usuario/getUsuarios').success(function(response){

         if(response.codigo==200) {
            $scope.usuarios = response.usuarios;
         }else if(response.codigo==400){
            Ventana_modal.modalResponse(response.errors, 'error');
         }
      });

   }

   $scope.getEmpresas = function(){

      $http.get('api/config/empresa/getEmpresas').success(function(response){

         if(response.codigo==200) {
            $scope.empresas = response.empresas;
         }else if(response.codigo==400){
            Ventana_modal.modalResponse(response.errors, 'error');
         }
      });

   }

   $scope.crearUsuario = function(){

      Ventana_modal.loader('Creando usuario . . .')

      $http.post('api/config/usuario/nuevoUsuario',$scope.usuario).success(function(response){

         Ventana_modal.loader();

         if(response.codigo==200){

            Ventana_modal.modalResponse(response.mensaje, 'success');
            $scope.modal_nuevo = false;
            $scope.getUsuarios();

         }else if(response.codigo==403){ //error de validaciones array
            $scope.errors = Helper.array_errors(response.errors);
         }else{
            $scope.errors = Helper.array_error(response.errors);
         }
      });

   }

   $scope.updateUser = function(){

      Ventana_modal.loader('Editando usuario . . .');

      $http.put('api/config/usuario/editarUsuario', $scope.usuario).success(function(response){

         Ventana_modal.loader();

         if(response.codigo=='200') {
            $scope.getUsuarios();
            $scope.modal_editar = false;
         }else if(response.codigo==403){ //error de validaciones array
            $scope.errors = Helper.array_errors(response.errors);
         }else{
            $scope.errors = Helper.array_error(response.errors);
         }

      })

   }

   $scope.eliminarUsuario = function(){

      Ventana_modal.loader('Eliminando usuario . . .');

      $http.put('api/config/usuario/eliminarUsuario', $scope.usuario).success(function(response){

         Ventana_modal.loader();

         if(response.codigo=='200') {
            $scope.getUsuarios();
            $scope.modal_eliminar = false;
         }else{
            $scope.errors = Helper.array_error(response.errors);
         }

      })
   }

   $scope.getAgencia = function(zona){

      Ventana_modal.loader('Cargando . . .');

      $http.get('api/config/usuario/getAgencia/'+zona).success(function(response){
         Ventana_modal.loader();
         $scope.agencias = response.agencias;
      });
   }


   $scope.construct = function(){
      $scope.getUsuarios();


   }
   $scope.construct();

   alert('ASDF');
   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }

};

app.controller('AjustesCtrl', AjustesCtrl);
AjustesCtrl.$inject = ['$scope', '$http','Helper', 'Ventana_modal'];

function AjustesCtrl($scope, $http, Helper, Ventana_modal){

   $scope.nueva_ventana = function(tipo = false, data = false){

      switch (tipo) {
         case 'SECCION_USUARIOS':
            $scope.cerrar_secciones();
            $scope.seccion_usuario = true;
            $scope.getUsuarios();
            break;

         case 'NUEVO_USUARIO':
            $scope.usuario = {};
            $scope.usuario.rol = 'admin.admin';
            $scope.nuevo_usuario = true;
            break;

         case 'EDITAR_USUARIO':
            $scope.editar_usuario = true;
            $scope.usuario        = data;
            $scope.usuario.rol    = data.rol_usuario.rol.slug;
            $scope.usuario.pass   = 'false';
            $scope.usuario.pass2  = 'false';
            break;


         case false:
            $scope.nuevo_usuario = false;
            $scope.editar_usuario = false;
            break;

         default:
            break;
      }

   }

   $scope.getUsuarios = function(){
      $http.post('api/config/usuario/getUsuarios', $scope.filtro).success(function(response){
         $scope.usuarios = response.usuarios;
      });
   };

   $scope.saveUser = function(){

      if($scope.usuario.pass != $scope.usuario.pass2){
         Ventana_modal.modalResponse('Las contraseñas ingresadas no son iguales', 'error');
         return 0;
      }

      Ventana_modal.loader('Guardando usuario . . . ');

      $http.post('api/config/usuario/saveUser', $scope.usuario).success(function(response){

         Ventana_modal.loader();

         if(response.codigo==200){
            $scope.nuevo_usuario = false;
            $scope.usuarios = response.usuarios;
         }else{
            Ventana_modal.modalResponse(response.mensaje, 'error');
         }

      });

   }

   $scope.updateUser = function(){

      if($scope.usuario.pass != $scope.usuario.pass2){
         Ventana_modal.modalResponse('Las contraseñas ingresadas no son iguales', 'error');
         return 0;
      }

      Ventana_modal.loader('Actualizando usuario . . . ');

      $http.post('api/config/usuario/updateUser', $scope.usuario).success(function(response){

         Ventana_modal.loader();

         if(response.codigo==200){
            $scope.editar_usuario = false;
            $scope.usuarios = response.usuarios;
         }else{
            Ventana_modal.modalResponse(response.mensaje, 'error');
         }

      });

   }

   $scope.cerrar_secciones = function(){
      $scope.seccion_usuario     = false;
   }

   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }

   $scope.init = function(){
      $scope.filtro = {};
      $scope.nueva_ventana('SECCION_USUARIOS');

      $scope.roles = [
         {'name' : 'Administrador', 'slug' : 'admin.admin'},
         {'name' : 'Operativo',     'slug' : 'admin.operativo'},
      ];
   }
   $scope.init();

};

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


app.controller('RegistroCtrl', RegistroCtrl);
RegistroCtrl.$inject = ['$scope', '$http', '$location','$window','Helper', 'Ventana_modal'];

function RegistroCtrl($scope, $http, $location, $window ,Helper,Ventana_modal){


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

   $scope.motrarHerramientas2 = true;
   $scope.motrarHerramientas3 = true;
   $scope.motrarHerramientas  = true;

   $scope.habiHerramientas = function(tipo){

      if(tipo=='basico') {
         $scope.regresarHerramientas = true;
         $scope.verHerramienta1      = true;
      }else if(tipo=='premium'){
         $scope.regresarHerramientas2 = true;
         $scope.verHerramienta2       = true;
      }else if(tipo=='enterprice'){
         $scope.regresarHerramientas3 = true;
         $scope.verHerramienta3       = true;
      }
   }


   $scope.habibtnHerramientas = function(tipo){

      $scope.cerrarbtnHerramientas();

      if(tipo=='basico') {
         $scope.motrarHerramientas = true;
      }else if(tipo=='premium'){
         $scope.motrarHerramientas2 = true;
      }else if(tipo=='enterprice'){
         $scope.motrarHerramientas3 = true;
      }
   }

   $scope.cerrarbtnHerramientas = function(){
      $scope.regresarHerramientas = false;
      $scope.verHerramienta1      = false;

      $scope.verHerramienta2       = false;
      $scope.regresarHerramientas2 = false;

      $scope.verHerramienta3       = false;
      $scope.regresarHerramientas3 = false;
   }

   $scope.configuration_plan = function(){

      $http.get('api/planConfiguracion').success(function (planConfig){

         $scope.planBasico = planConfig.datos.find(function(element) {
            return element.plan.codigo == 'PB' ;
         });

         $scope.planPremium =  planConfig.datos.find(function(element) {
            return element.plan.codigo == 'PRE' ;
         });

         $scope.planEnterprice =  planConfig.datos.find(function(element) {
            return element.plan.codigo == 'EN' ;
         });


      });


      $http.get('api/categoriasEmpresa').success(function (categorias){
         $scope.categorias = categorias.datos;
      });

      $http.get('api/tiposempresa').success(function (tiposempresa){
         $scope.tiposempresa = tiposempresa.datos;
      });

   }

   $scope.mostrarTerminos = function () {
      $scope.modal_terminos = !$scope.modal_terminos;
   }

   $scope.selectPlan = function (params) {

      $scope.basico     = false;
      $scope.premium    = false;
      $scope.enterprise = false;

      if (params == 'free'){
         $scope.basico = true;
         $scope.usuario.plan = "PB";
         $scope.usuario.nombrePlan = "Basico";
         $scope.usuario.tarifa = $scope.planBasico.plan.tarifaUSD;
      }else if (params == 'premium'){
         $scope.premium = true;
         $scope.usuario.plan = "PRE";
         $scope.usuario.nombrePlan = "Premium";
         $scope.usuario.tarifa = $scope.planPremium.plan.tarifaUSD;
      }else if (params == 'enter'){
         $scope.enterprise = true;
         $scope.usuario.plan = "EN";
         $scope.usuario.nombrePlan = "Enterprice";
         $scope.usuario.tarifa = $scope.planEnterprice.plan.tarifaUSD;
      }
   }

   $scope.CrearEmpresa = function (tarjeta = false){

      // if($scope.loadding){ return 0; }

      $scope.errors = [];

      if (tarjeta){

         $scope.usuario.tarjeta = true;

         if($scope.tarjeta.expiration == undefined){
            Ventana_modal.modalResponse('Ingrese los datos de la tarjeta  ', 'error');
         }

         $dataexpiration = $scope.tarjeta.expiration.split('/');
         /* enviar info */
         $scope.usuario.nameCard        = $scope.tarjeta.nameCard;
         $scope.usuario.expirationMonth = $dataexpiration[0].trim();
         $scope.usuario.expirationYear  = '20'+$dataexpiration[1].trim();
         $scope.usuario.cvv             = $scope.tarjeta.Cvv;
         $scope.usuario.accountNumber   = $scope.tarjeta.accountNumber.split('-').join('');
         $scope.tarjeta.tipo_tarjeta    = tipoTarjeta($scope.tarjeta.accountNumber);

      }else{
         $scope.usuario.tarjeta = false;
      }

      Ventana_modal.loader('Registrando . . .');

      $scope.modalTarjeta = false;

      $http.post('creacionEmpresa/', $scope.usuario).success(function (response){

         Ventana_modal.loader();

         if(response.codigo==200) {

            Ventana_modal.modalResponse('Registrado correctamente, se envió un correo al cliente con su contraseña - '+response.password, 'success');
            $scope.usuario = {};
            $scope.modal_informacion = false;
            $scope.modal_select_plan = true;

         }else if(response.codigo==403){
            $scope.errors = Helper.array_errors(response.errors);
         }else if(response.codigo==400){
            $scope.errors = Helper.array_error(response.errors);
         }

      });

   }

   $scope.solicitarTarjeta = function(){

      $scope.modalTarjeta = true;
   }

   $scope.goToLogin = function () {
      $window.location.href = '/login';
   }

   $scope.init = function(){
      $scope.date  = new Date();
      $scope.usuario = {};
      $scope.registro = {};
      $scope.usuario.cod_referido = $location.search().codigo;

      $scope.configuration_plan();
      $scope.nueva_ventana('SELECCION_PLAN');
   }
   $scope.init();

   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }

   function tipoTarjeta(ccnumber){

      if (!ccnumber) { return ''; }
      var len = ccnumber.length;
      var cardType, valid;
      mul = 0,
      prodArr = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9], [0, 2, 4, 6, 8, 1, 3, 5, 7, 9]],
      sum = 0;

      while (len--) {
         sum += prodArr[mul][parseInt(ccnumber.charAt(len), 10)];
         mul ^= 1;
      }

      if (sum % 10 === 0 && sum > 0) {
         valid = "valid"
      } else {
         valid = "not valid"
      }
      ccnumber = ccnumber.toString().replace(/\s+/g, '');

      if (/^(34)|^(37)/.test(ccnumber)) {
         cardType = "amer";
      }

      if (/^5[1-5]/.test(ccnumber)) {
         cardType = "master";
      }
      if (/^4/.test(ccnumber)) {
         cardType = "visa"
      }

      return cardType;

   }

};


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


app.controller('ProviderCtrl', ProviderCtrl);
ProviderCtrl.$inject = ['$scope', '$http', 'Helper', 'Ventana_modal', '$timeout'];

function ProviderCtrl($scope, $http, Helper,Ventana_modal, $timeout){

   $scope.icono_image = "https://jupi-bot.s3.amazonaws.com/Dashboard/uploadimagecamara.svg";

   $scope.tipomoneda = [
      {id:'1',nombre:'Guatemala GTQ',value:'GTQ'},
      {id:'2',nombre:'Dolar USD',value:'USD'},
   ];

   $scope.estados = [
      {nombre:'Activos', value: 1 },
      {nombre:'Desactivados', value: 0 },
   ];

   $scope.estados_promo = [
      {'nombre' : 'Activo' , 'codigo' : 1},
      {'nombre' : 'Inactivo' , 'codigo' : 0},
      {'nombre' : 'Finalizado' , 'codigo' : 2},
      {'nombre' : 'Futuras' , 'codigo' : 3},
   ];

   $scope.meses = [
      {value:1,  nombre:'Enero'},
      {value:2,  nombre:'Febrero',},
      {value:3,  nombre:'Marzo',},
      {value:4,  nombre:'Abril',},
      {value:5,  nombre:'Mayo',},
      {value:6,  nombre:'Junio',},
      {value:7,  nombre:'Julio',},
      {value:8,  nombre:'Agosto',},
      {value:9,  nombre:'Septiembre',},
      {value:10, nombre:'Octubre',},
      {value:11, nombre:'Noviembre',},
      {value:12, nombre:'Diciembre',},
   ];

   $scope.anio_inicial = 2020; //INICIO DE OPERACIONES
   $scope.anio_actual  = new Date().getFullYear();
   $scope.years = [];

   for(let a = 0; a < 5; a++){
      if(($scope.anio_actual-a) >= $scope.anio_inicial){
         $scope.years.push($scope.anio_actual-a);
      }
   }

   $scope.nueva_ventana = function(tipo = false, data = false){

      $scope.errors = [];

      switch (tipo) {

         case 'MODAL_COMISION':
            $scope.nueva_ventana();
            $scope.modal_comision = true;
            $scope.provider = data;
            $scope.detailComision();
            $scope.getTiposComision();
            break;

         case 'MODAL_CONFIR_DELETE':
            $scope.nueva_ventana();
            $scope.provider = data;
            $("#modal_confirm_deshabilitar").modal()
            break;

         case 'MODAL_CONFIRM_HABILITAR':
            $scope.nueva_ventana();
            $scope.provider = data;
            $("#modal_confirm_habilitar").modal()
            break;

         case 'MODAL_CONFIRM_HABILITAR':
            $scope.nueva_ventana();
            $scope.provider = data;
            $("#modal_confirm_habilitar").modal()
            break;

         case 'MODAL_EDITAR_PRODUCTO':
            $scope.nueva_ventana();
            $scope.producto = data;
            $("#modal_editar_producto").modal()
            break;

         // CIERRA MODALS
         case false:
            $scope.modal_comision = false;
         default:
            break;
      }

   }

   $scope.getRegistros = function(estado){

      $scope.estado_docu = estado;
      $scope.filtro.estado = estado;

      Ventana_modal.loader('Cargando . . .');

      $http.post('api/registros/getProviders', $scope.filtro).success(function(registros){

         $scope.filtro_obj     = false;
         $scope.registros      = registros.datos;
         $scope.TotalEmpresas  = registros.estado_registro;

         Ventana_modal.loader();
      });

   }

   $scope.cerrar_ID= function(){
      $scope.mas_obj = !$scope.mas_obj;
      $scope.areaEmpresa = 1;
   }

   $scope.detailProvider = function(id_provider){

      Ventana_modal.loader('Cargando . . .');

      $scope.mas_obj = true;

      $http.get('api/registros/getProvider/'+id_provider).success(function(response){
         $scope.provider = response.datos;
         Ventana_modal.loader();
      });

   };

   $scope.getTiposComision = function(){

      Ventana_modal.loader('Cargando . . .');

      $scope.datos.id_provider = $scope.provider.id;

      $http.post('api/registros/getTipoComision', $scope.datos).success(function(response){

         Ventana_modal.loader();

         $scope.tipos_comision = response.tipos;

         if (response.tipoComision!=null) {
            $scope.provider.tipoComision = response.tipoComision;
            $scope.datos.tipo_comision =  $scope.provider.tipoComision.id;
         }

      });
   };

   $scope.getProducts = function(id_provider){

      Ventana_modal.loader('Cargando . . .');

      $http.get('api/registros/getProducts/'+id_provider).success(function(response){

         Ventana_modal.loader();
         if(response.codigo==200){
            $scope.productos = response.datos;
         }

      });

   };

   $scope.getPromotions = function(id_provider){

      Ventana_modal.loader('Cargando . . .');

      $http.post('api/registros/getPromotions/'+id_provider, $scope.filtro).success(function(response){

         Ventana_modal.loader();
         if(response.codigo==200){
            $scope.promotions = response.data;
         }else{
            Ventana_modal.modalResponse(response.error_message, 'error');
         }

      });

   };

   $scope.setTipoComision = function(){

      Ventana_modal.loader('Actualizando . . .');

      $scope.datos.id_provider = $scope.provider.id;

      $http.post('api/registros/setTipoComision', $scope.datos).success(function(response){

         Ventana_modal.loader();

         if (response.codigo==200) {
            $scope.tiposComision = response.tipos;
            $scope.provider.tipoComision = response.tipoComision;
            Ventana_modal.modalResponse('Actualizado correctamente', 'success');
         }else{
            Ventana_modal.modalResponse(response.error_message, 'error');
         }

      });

   };

   $scope.detailComision = function(){

      Ventana_modal.loader('Calculando . . .');

      $scope.datos.id_provider = $scope.provider.id;

      $http.post('api/registros/detailComision', $scope.datos).success(function(response){

         Ventana_modal.loader();
         $scope.responseComision = [];

         if (response.codigo==200) {
            $scope.responseComision = response.result;
         }else{
            Ventana_modal.modalResponse(response.error_message, 'error');
         }

      });

   };

   $scope.setCommissionProduct = function(){

      $http.post('api/registros/setCommissionProduct/',$scope.producto).success(function(response){

         if(response.codigo==200){
            $('#modal_editar_producto').modal('hide');
         }else{
            Ventana_modal.modalResponse(response.message_error, 'error');
         }

      });
   }

   $scope.verificarCheckDocumentos = function (documentos) {

      $scope.documentos  = documentos;
      $scope.check_dpi_delante = false;
      $scope.check_rtu         = false;
      $scope.check_cheque      = false;

      if($scope.documentos.documento_identificacion){

         var check = $scope.existeRegistro.check.find(function(element) {
            return (element.documento == 'documento_identificacion' && element.check == 1);
         });

         if (check==undefined) {
            $scope.check_dpi_delante = false;
         }else{
            $scope.check_dpi_delante = true;
         }
      }

   }


   $scope.areaEmpresa = 1;
   $scope.habiEmpresa= function(area){

      $scope.areaEmpresa = area;

      if($scope.areaEmpresa==3) {
         $scope.areaMap();
      }else if($scope.areaEmpresa==4){
         $scope.getTiposComision();
      }else if($scope.areaEmpresa==5){
         $scope.getProducts($scope.provider.id);
      }else if($scope.areaEmpresa==6){
         $scope.getPromotions($scope.provider.id);
      }
   }

   $scope.nuevoBanco = function(registro){

      $scope.cargarnBanco = true;
      $scope.miregistro = registro;

      $scope.cancelarBanco= function(){
         $scope.cargarnBanco=false;
      }
      $scope.elbanco={};

      $scope.bancoEmpresa = function(empresa){

         Ventana_modal.loader('Registrando . . .');

         var databan = {
            banco:$scope.elbanco.banco,
            pais:$scope.elbanco.pais,
            cuenta:$scope.elbanco.cuenta,
            numero:$scope.elbanco.numero,
            tipo_cuenta:$scope.elbanco.tipo,
            moneda:$scope.elbanco.moneda,
            id_empresa:empresa,
         };

         $http.post('api/registros/newbank', databan).success(function (response){

            Ventana_modal.loader();
            $scope.existeRegistro.banco = response.banco;
            $scope.cargarnBanco = false;

         });

      }

   }

   $scope.existeBanco={};
   $scope.editarBanco= function(banco){

      $scope.cargareBanco = true;
      $scope.existeBanco  = banco;

      $scope.cancelarEBanco= function(){
         $scope.cargareBanco=false;
      }

      $scope.bancoedEmpresa=function(empresa){

         Ventana_modal.loader('Actualizando . . .');


         var databan = {
            banco:$scope.existeBanco.banco,
            pais:$scope.existeBanco.pais,
            cuenta:$scope.existeBanco.cuenta,
            numero:$scope.existeBanco.numero,
            tipo_cuenta:$scope.existeBanco.tipo_cuenta,
            moneda:$scope.existeBanco.moneda,
            id_empresa:empresa,
         };

         $http.put('api/registros/updateBank/'+$scope.existeBanco.id, databan).success(function (data, status, headers) {

            Ventana_modal.loader();

            $scope.cargareBanco=false;
            $scope.existeRegistro.banco = response.banco;
         });


      }

   }

   $scope.editarEmpresa = function(existeRegistro){

      $scope.vereditEmpresa = true;
      $scope.laempresa = existeRegistro;

      $scope.canceleditEmpresa= function(){
         $scope.vereditEmpresa = false;
         $scope.laempresa = {};
      }

      $scope.guardarEmpresa = function(){

         var dataempresa = {
            nombre_empresa:     $scope.laempresa.nombre,
            nit:                $scope.laempresa.nit,
            tipo_empresa:       $scope.laempresa.id_tipo,
            direccion:          $scope.laempresa.ubicacion,
            direccion_fiscal:   $scope.laempresa.direccionValida,
            categoria_empresa:  $scope.laempresa.id_categoria,
            plataforma_empresa: $scope.laempresa.id_plataforma,
            nombre_fiscal:      $scope.laempresa.nombreValido,
            id:                 $scope.laempresa.id
         };

         $http.put('api/registros/update',dataempresa).success(function (){

            $scope.getRegistros($scope.estado_docu);
            $scope.vereditEmpresa = false;
         });
      }

   }

   $scope.abrirFiltro= function(){
      $scope.filtro_obj=true;
   }

   $scope.cerrarFiltro= function(){
      $scope.filtro_obj=false;
   }

   $scope.activar_filtro= function(filtro){

      if(filtro=='fecha'){
         $scope.por_fecha = true;
      }else if(filtro=='estado'){
         $scope.por_estado = true;
      }
   }

   $scope.cancelar_filtro = function(filtro){

      if(filtro=='fecha'){
         $scope.por_fecha=false;
         $scope.filtro.finicio=null;
         $scope.filtro.ffin=null;
      }else if(filtro=='estado'){
         $scope.por_estado = false;
      }
   }

   $scope.areaMap = function(){

      Ventana_modal.loader('Cargando . . .');

      $scope.array = [
         [19.4069,-99.10779],//principal
         [19.33986,-99.10504],
         [19.46176,-99.0642],
         [19.47438,-99.1644],
         [19.37134,-99.22055],
      ];

      if($scope.provider.perimetro.length>3){

         $scope.array = [];

         $scope.provider.perimetro.forEach(element => {
            $coordenada = element.coordenadas.split(',');
            $scope.array.push([parseFloat($coordenada[0]),parseFloat($coordenada[1])]);
         });

      }else if($scope.provider.adicional_empresa.colonia!='' && $scope.provider.adicional_empresa.municipio!='' && $scope.provider.adicional_empresa.estado_!=''){

         var myAddressQuery = $scope.provider.adicional_empresa.estado_+', '+$scope.provider.adicional_empresa.municipio+', '+$scope.provider.adicional_empresa.colonia;
         console.log(myAddressQuery);

         var geocoder = new google.maps.Geocoder();

         geocoder.geocode({'address': myAddressQuery}, function(results, status){

            if(status === 'OK'){

               let latitud = results[0].geometry.location.lat();
               let longitud = results[0].geometry.location.lng();

               $scope.array = [
                  [latitud,longitud],//principal
                  [(latitud + (0.07148)), (longitud + (0.03964))],
                  [(latitud + (0.07789)), (longitud + (-0.03588))],
                  [(latitud + (-0.00512)), (longitud + (-0.09902))],
                  [(latitud + (-0.08093)), (longitud + (-0.03035))],
                  [(latitud + (-0.06498)), (longitud + (0.04611))],
               ];
            }

         });

      }

      $timeout(function () {
         $scope.initialize($scope.array);
         Ventana_modal.loader();
      }, 4000);

   }

   var bermudaTriangle;
   $scope.initialize = function(coordenadas) {

      var myLatLng = new google.maps.LatLng(coordenadas[0][0],coordenadas[0][1]);
      var mapOptions = {
         zoom: 12,
         center: myLatLng,
         mapTypeId: google.maps.MapTypeId.RoadMap
      };

      var map = new google.maps.Map(document.getElementById('map'), mapOptions);

      var triangleCoords = [];
      coordenadas.forEach(element => {
         triangleCoords.push(new google.maps.LatLng(element[0],element[1]));
      });

      // Construct the polygon
      bermudaTriangle = new google.maps.Polygon({
         paths: triangleCoords,
         draggable: true,
         editable: true,
         strokeColor: '#7200c6',
         strokeOpacity: 0.8,
         strokeWeight: 2,
         fillColor: '#7200c6',
         fillOpacity: 0.35
      });

      var result = bermudaTriangle.setMap(map);

      // google.maps.event.addListener(bermudaTriangle, "dragend", getPolygonCoords);
      google.maps.event.addListener(bermudaTriangle.getPath(), "insert_at", getPolygonCoords);
      google.maps.event.addListener(bermudaTriangle.getPath(), "remove_at", getPolygonCoords);
      google.maps.event.addListener(bermudaTriangle.getPath(), "set_at", getPolygonCoords);

   }

   function getPolygonCoords() {
      var len = bermudaTriangle.getPath().getLength();

      var htmlStr = "";
      $scope.coordenadas = [];
      for (var i = 0; i < len; i++) {
         $scope.coordenadas.push(bermudaTriangle.getPath().getAt(i).toUrlValue(5));
         htmlStr += bermudaTriangle.getPath().getAt(i).toUrlValue(5) + "<br>";
      }

      document.getElementById('info').innerHTML = htmlStr;
   }

   $scope.deshabilitar = function(){

      $('#modal_confirm_deshabilitar').modal('hide');

      Ventana_modal.loader('Cargando imagen');

      $http.get('api/registros/deshabilitar/'+$scope.provider.id).success(function (response){

         Ventana_modal.loader();

         if(response.codigo==400){
            Ventana_modal.modalResponse(response.mensaje, 'error');
         }else{
            $scope.getRegistros($scope.estado_docu);
         }
      });

   }

   $scope.habilitar = function(){

      $('#modal_confirm_habilitar').modal('hide');

      Ventana_modal.loader('Cargando imagen');

      $http.get('api/registros/habilitar/'+$scope.provider.id).success(function (response){

         Ventana_modal.loader();

         if(response.codigo==400){
            Ventana_modal.modalResponse(response.mensaje, 'error');
         }else{
            $scope.getRegistros($scope.estado_docu);
         }
      });

   }


   $scope.generatePDF_detail = function(){

      Ventana_modal.loader('Generando pdf . . .');

      $scope.responseComision.provider = $scope.provider;
      $scope.responseComision.datos    = $scope.datos;

      $http({
         method: 'POST',
         url: 'api/registros/generatePDF_detail',
         data: $scope.responseComision,
         responseType: 'arraybuffer',
      }).success(function (data) {

         Ventana_modal.loader();

         var blob = new Blob([data], {type: "attachment/pdf"});
         saveAs(blob, "reporte.pdf");

      }).error(function (data) {
         Ventana_modal.loader();
      });

   }


   $scope.dowloadProducts = function(){

      Ventana_modal.loader('Descargando productos . . .');

      $http({
         method: 'POST',
         url: 'api/registros/product/exportExcel',
         data: $scope.productos,
         responseType: 'arraybuffer',
      }).success(function (data) {

         Ventana_modal.loader();

         var blob = new Blob([data], {type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"});
         saveAs(blob, "products.xls");

      }).error(function (data, status, headers, config) {
         Ventana_modal.loader();

         $timeout(function () {
            Ventana_modal.modalResponse('Ocurrio un error al descargar', 'error');
         }, 2000);
      });
   }

   /******************************** CARGA MASIVA DE PRODUCTOS ********************************/
      $scope.read = function (workbook){

         $scope.valido = $scope.validarArchivo();

         if(!$scope.valido){

            $timeout(function(){
               Ventana_modal.modalResponse($scope.mierror, 'error');
               $scope.datosExcel = [];
            },1000);

            return 0;
         }

         $scope.headerNames = XLSX.utils.sheet_to_json( workbook.Sheets[workbook.SheetNames[0]], { header: 1 })[0];
         $scope.dataExcel = XLSX.utils.sheet_to_json( workbook.Sheets[workbook.SheetNames[0]]);

         $scope.cargaExcel();
      }

      $scope.cargaExcel = function () {

         //validacion de encabezados del excel
         var titulos = new Array('sku','nombre','comision');
         var existe = true;

         for(var i = 0; i < $scope.headerNames.length; i++) {
            if (!titulos.includes($scope.headerNames[i])) {
               existe = false;
               break;
            }
         }

         if(!existe){

            $timeout(function(){
               $scope.mierror = "El archivo no tiene las columnas correctas, descargue la plantilla.";
               Ventana_modal.modalResponse($scope.mierror, 'error');
            },1000);

            return 0;
         }

         $timeout(function(){
            $scope.resultadoProductos = [];
            Ventana_modal.loader('Cargando datos . . .');
         },50);

         if($scope.dataExcel[0].sku=='sku'){
            $scope.dataExcel.shift();
         }

         $timeout(function(){
            Ventana_modal.loader();
            $scope.updateComision();
         },100);

      }

      $scope.validarArchivo = function(){

         $scope.nombreArchivo = document.getElementById("excel").value;
         var extensiones_permitidas = new Array(".xls", ".xlsx");

         $scope.mierror = "";
         extension = ($scope.nombreArchivo.substring($scope.nombreArchivo.lastIndexOf("."))).toLowerCase();

         permitida = false;

         for (var i = 0; i < extensiones_permitidas.length; i++) {
            if (extensiones_permitidas[i] == extension) {
               permitida = true;
               break;
            }
         }

         if(!permitida){
            $scope.mierror = "Sólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
            return false;
         }else{
            return true;
         }

      }

   /******************************** CARGA DE PRODUCTOS ********************************/

   $scope.updateComision = function(){

      Ventana_modal.loader('Actualizando . . .');

      $http.post('api/registros/product/updateComision/'+$scope.provider.id, $scope.dataExcel).success(function (response){

         Ventana_modal.loader();

         if(response.codigo==400){
            Ventana_modal.modalResponse(response.message_error, 'error');
         }else{
            Ventana_modal.modalResponse('Actualizado', 'success');
            $scope.nombreArchivo = "";
            $scope.productos = response.datos;
         }

      });

   }

   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }

   $scope.init = function(){

      var hoy = new Date();

      $scope.imagen        = {};
      $scope.filtro        = {};
      $scope.filtro.activo = 1;
      $scope.filtro.estado_promo = 'Activo';

      $scope.comision      = {};
      $scope.datos         = {};
      $scope.datos.mes     = hoy.getMonth()+1;
      $scope.datos.year    = hoy.getFullYear();
      $scope.estado_docu   = '10';
      $scope.getRegistros($scope.estado_docu);
      // $scope.mas_obj = true;
   }
   $scope.init();

};

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

app.factory('Ventana_modal', Ventana_modal);

Ventana_modal.$inject = ['$rootScope'];

function Ventana_modal($rootScope){

   return {

      modalResponse: function(mensaje, tipo){

         if(tipo == 'error') {
            $rootScope.modalError = true;
         }else if(tipo == 'success'){
            $rootScope.modalSuccess = true;
         }
         $rootScope.mensaje = mensaje;

      },

      loader:function (mensaje = false){
         if (mensaje!=false){

            //si ya esta activo el msj y vulven a enviar
            if($rootScope.loadding){
               return true;
            }

            $rootScope.loadding = true;
            $rootScope.mensaje = mensaje;
         }else{
            $rootScope.loadding = false;
         }
      },

      cerrar:function(){
         $rootScope.mensaje = '';
         $rootScope.modalError = false;
         $rootScope.modalSuccess = false;
      }

   }

};

app.factory("Helper",['$http','$rootScope', function($http,$rootScope){

   return {

      array_errors: function (data){

         var errors = [];

         for (var key in data) {
            errors.push(data[key]);
         }
         return errors;
      },

      array_error: function (data){

         var errors = [];

         errors.push([data]);

         return errors;
      },

      getMonedas : function (){

         $http.get('api/general/getMonedas').success(function(response){

            $rootScope.monedas = response.monedas;
         });
      },

      getPaises : function (){

         $http.get('api/general/getPaises').success(function(response){

            $rootScope.paises = response.paises;
         });
      },


   }

}]);

app.factory('styleMap', styleMap);

function styleMap(){

   return {

      style: function (){

         return {

               default: [],
               silver: [
               {
                  elementType: "geometry",
                  stylers: [{ color: "#f5f5f5" }],
               },
               {
                  elementType: "labels.icon",
                  stylers: [{ visibility: "off" }],
               },
               {
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#616161" }],
               },
               {
                  elementType: "labels.text.stroke",
                  stylers: [{ color: "#f5f5f5" }],
               },
               {
                  featureType: "administrative.land_parcel",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#bdbdbd" }],
               },
               {
                  featureType: "poi",
                  elementType: "geometry",
                  stylers: [{ color: "#eeeeee" }],
               },
               {
                  featureType: "poi",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#757575" }],
               },
               {
                  featureType: "poi.park",
                  elementType: "geometry",
                  stylers: [{ color: "#e5e5e5" }],
               },
               {
                  featureType: "poi.park",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#9e9e9e" }],
               },
               {
                  featureType: "road",
                  elementType: "geometry",
                  stylers: [{ color: "#ffffff" }],
               },
               {
                  featureType: "road.arterial",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#757575" }],
               },
               {
                  featureType: "road.highway",
                  elementType: "geometry",
                  stylers: [{ color: "#dadada" }],
               },
               {
                  featureType: "road.highway",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#616161" }],
               },
               {
                  featureType: "road.local",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#9e9e9e" }],
               },
               {
                  featureType: "transit.line",
                  elementType: "geometry",
                  stylers: [{ color: "#e5e5e5" }],
               },
               {
                  featureType: "transit.station",
                  elementType: "geometry",
                  stylers: [{ color: "#eeeeee" }],
               },
               {
                  featureType: "water",
                  elementType: "geometry",
                  stylers: [{ color: "#c9c9c9" }],
               },
               {
                  featureType: "water",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#9e9e9e" }],
               },
               ],
               night: [
               { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
               { elementType: "labels.text.stroke", stylers: [{ color: "#242f3e" }] },
               { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
               {
                  featureType: "administrative.locality",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#d59563" }],
               },
               {
                  featureType: "poi",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#d59563" }],
               },
               {
                  featureType: "poi.park",
                  elementType: "geometry",
                  stylers: [{ color: "#263c3f" }],
               },
               {
                  featureType: "poi.park",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#6b9a76" }],
               },
               {
                  featureType: "road",
                  elementType: "geometry",
                  stylers: [{ color: "#38414e" }],
               },
               {
                  featureType: "road",
                  elementType: "geometry.stroke",
                  stylers: [{ color: "#212a37" }],
               },
               {
                  featureType: "road",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#9ca5b3" }],
               },
               {
                  featureType: "road.highway",
                  elementType: "geometry",
                  stylers: [{ color: "#746855" }],
               },
               {
                  featureType: "road.highway",
                  elementType: "geometry.stroke",
                  stylers: [{ color: "#1f2835" }],
               },
               {
                  featureType: "road.highway",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#f3d19c" }],
               },
               {
                  featureType: "transit",
                  elementType: "geometry",
                  stylers: [{ color: "#2f3948" }],
               },
               {
                  featureType: "transit.station",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#d59563" }],
               },
               {
                  featureType: "water",
                  elementType: "geometry",
                  stylers: [{ color: "#17263c" }],
               },
               {
                  featureType: "water",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#515c6d" }],
               },
               {
                  featureType: "water",
                  elementType: "labels.text.stroke",
                  stylers: [{ color: "#17263c" }],
               },
               ],
               retro: [
               { elementType: "geometry", stylers: [{ color: "#ebe3cd" }] },
               { elementType: "labels.text.fill", stylers: [{ color: "#523735" }] },
               { elementType: "labels.text.stroke", stylers: [{ color: "#f5f1e6" }] },
               {
                  featureType: "administrative",
                  elementType: "geometry.stroke",
                  stylers: [{ color: "#c9b2a6" }],
               },
               {
                  featureType: "administrative.land_parcel",
                  elementType: "geometry.stroke",
                  stylers: [{ color: "#dcd2be" }],
               },
               {
                  featureType: "administrative.land_parcel",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#ae9e90" }],
               },
               {
                  featureType: "landscape.natural",
                  elementType: "geometry",
                  stylers: [{ color: "#dfd2ae" }],
               },
               {
                  featureType: "poi",
                  elementType: "geometry",
                  stylers: [{ color: "#dfd2ae" }],
               },
               {
                  featureType: "poi",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#93817c" }],
               },
               {
                  featureType: "poi.park",
                  elementType: "geometry.fill",
                  stylers: [{ color: "#a5b076" }],
               },
               {
                  featureType: "poi.park",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#447530" }],
               },
               {
                  featureType: "road",
                  elementType: "geometry",
                  stylers: [{ color: "#f5f1e6" }],
               },
               {
                  featureType: "road.arterial",
                  elementType: "geometry",
                  stylers: [{ color: "#fdfcf8" }],
               },
               {
                  featureType: "road.highway",
                  elementType: "geometry",
                  stylers: [{ color: "#f8c967" }],
               },
               {
                  featureType: "road.highway",
                  elementType: "geometry.stroke",
                  stylers: [{ color: "#e9bc62" }],
               },
               {
                  featureType: "road.highway.controlled_access",
                  elementType: "geometry",
                  stylers: [{ color: "#e98d58" }],
               },
               {
                  featureType: "road.highway.controlled_access",
                  elementType: "geometry.stroke",
                  stylers: [{ color: "#db8555" }],
               },
               {
                  featureType: "road.local",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#806b63" }],
               },
               {
                  featureType: "transit.line",
                  elementType: "geometry",
                  stylers: [{ color: "#dfd2ae" }],
               },
               {
                  featureType: "transit.line",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#8f7d77" }],
               },
               {
                  featureType: "transit.line",
                  elementType: "labels.text.stroke",
                  stylers: [{ color: "#ebe3cd" }],
               },
               {
                  featureType: "transit.station",
                  elementType: "geometry",
                  stylers: [{ color: "#dfd2ae" }],
               },
               {
                  featureType: "water",
                  elementType: "geometry.fill",
                  stylers: [{ color: "#b9d3c2" }],
               },
               {
                  featureType: "water",
                  elementType: "labels.text.fill",
                  stylers: [{ color: "#92998d" }],
               },
               ],
               hiding: [
               {
                  featureType: "poi.business",
                  stylers: [{ visibility: "off" }],
               },
               {
                  featureType: "transit",
                  elementType: "labels.icon",
                  stylers: [{ visibility: "off" }],
               },
               ],
            };


      }

   };

};

app.factory('GlobalChart', GlobalChart);

function GlobalChart(){

   return {

      charts: function (){

         Highcharts.setOptions({
            colors: ['#0582FD', '#2AA9E1', '#E3E4E5','#FFC400','#0582FD','#0747A6','#F96C55','#47bf7a','#4484D6'],
            chart: {
               style: {
                  fontFamily: '"Nunito", sans-serif'
               },
            },
            lang: {
               thousandsSep: ','
            }

         });

         return Highcharts;
      }

   };

};
