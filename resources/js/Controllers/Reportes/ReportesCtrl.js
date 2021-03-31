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
