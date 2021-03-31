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
