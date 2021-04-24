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
