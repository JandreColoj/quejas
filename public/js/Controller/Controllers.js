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


   $scope.graphicsRegiones= function(data){

     // Build the chart
     Highcharts.chart('container_regiones', {
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

   $scope.graphicsDepartamentos= function(data){

      // Build the chart
      Highcharts.chart('container_departamentos', {
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
              name: ' ',
              data: data
          }]
      });

   }

   $scope.graphicsMunicipios = function(data){

      // Build the chart
      Highcharts.chart('container_municipios', {
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
              name: ' ',
              data: data
          }]
      });

   }

   $scope.graphicsTopComercios = function(data){

      console.log(data);
      Highcharts.chart('container_top_comercios', {
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
             categories: data.comercios,
             allowDecimals: true,
             title: {
                 text: null
             }
         },
         yAxis: {
             min: 0,
             title: {
                 text: 'Valor',
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
            data: data.quejas
         }]
      });
   }

   $scope.graphicsTopSucurrales = function(data){

      console.log(data);
      Highcharts.chart('container_top_sucursal', {
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
             categories: data.sucursales,
             allowDecimals: true,
             title: {
                 text: null
             }
         },
         yAxis: {
             min: 0,
             title: {
                 text: 'Valor',
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
            data: data.quejas
         }]
      });
   }



   $scope.graphicsOrderRange = function(data){

      Highcharts.chart('container_quejasRangeDate', {
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
               text: '( )'
            }
         },
         tooltip: {
            pointFormat: '<span>Total </span>: <b>{point.y:.2f}</b><br/>',
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
               data: data.cantidad
            }
         ],
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



   $scope.generateReportGeneral = function(){

      // Ventana_modal.loader('Generando . . . ');

      $http.post('api/generateReportGeneral', $scope.filtro).success(function(response){

         // Ventana_modal.loader();

            $scope.dataReport = response;
            $scope.graphicsTopComercios($scope.dataReport.top_comercios);
            $scope.graphicsTopSucurrales($scope.dataReport.top_sucursales);
            $scope.graphicsRegiones($scope.dataReport.regiones);
            $scope.graphicsDepartamentos($scope.dataReport.departamentos);
            $scope.graphicsMunicipios($scope.dataReport.municipios);
            $scope.graphicsOrderRange($scope.dataReport.quejas_day);

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


   $scope.getRegion = function(){
      $http.get('public/getRegion').success(function(response){
         $scope.regiones = response.datos;
      });
   };

   $scope.getDepartamentos = function(){
      $http.get('public/getDepartamentos/'+$scope.filtro.region).success(function(response){
         $scope.departamentos = response.datos;
      });
   };

   $scope.getMunicipio = function(){
      $http.get('public/getMunicipio/'+$scope.filtro.departamento).success(function(response){
         $scope.municipios = response.datos;
      });
   };


   $scope.inicialize = function(){

      $scope.filtro = {};
      $scope.queja = {};

      $scope.generateReportGeneral();
      $scope.getRegion();
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

   $scope.getRegistros = function(){

      Ventana_modal.loader('Cargando . . .');

      $http.post('api/getQuejas',$scope.filtro).success(function(response){

         $scope.registros = response.datos;

         Ventana_modal.loader();
      });

   }

   $scope.verQUeja = function(registro){

      $("#modal_detalle").modal()
      $scope.registro = registro;
   }

   $scope.cerrar_ID= function(){
      $scope.mas_obj = !$scope.mas_obj;
      $scope.areaEmpresa = 1;
   }



   $scope.getRegion = function(){
      $http.get('public/getRegion').success(function(response){
         $scope.regiones = response.datos;
      });
   };

   $scope.getDepartamentos = function(){
      $http.get('public/getDepartamentos/'+$scope.filtro.region).success(function(response){
         $scope.departamentos = response.datos;
      });
   };

   $scope.getMunicipio = function(){
      $http.get('public/getMunicipio/'+$scope.filtro.departamento).success(function(response){
         $scope.municipios = response.datos;
      });
   };


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


   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }

   $scope.init = function(){

      $scope.filtro = {};
      $scope.queja = {};
      $scope.getRegistros();
      $scope.getDepartamentos();
      $scope.getRegion();
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

