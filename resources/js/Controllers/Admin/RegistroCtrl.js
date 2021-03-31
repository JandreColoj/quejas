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

