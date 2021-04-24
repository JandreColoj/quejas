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
