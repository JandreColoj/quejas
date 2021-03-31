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
