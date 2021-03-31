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
