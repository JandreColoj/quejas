var app = angular.module('app', [
   'infinite-scroll',
   'ngMask',
   'nya.bootstrap.select',
   'ngAnimate',
   'angular-js-xlsx',
   'LocalStorageModule',
   'ngRoute',
   'ngCookies',
   'ngResource',
   'ngSanitize',
   // 'xlsx',
]);


app.config(['localStorageServiceProvider', function(localStorageServiceProvider) {
   localStorageServiceProvider.setPrefix('ls');
}]);

app.directive('appFilereader', appFilereader);
appFilereader.$inject = ['$q'];
function appFilereader($q){

   var slice = Array.prototype.slice;
   return {
      restrict: 'A',
      require: '?ngModel',
      link: function (scope, element, attrs, ngModel) {
         if (!ngModel) return;

         ngModel.$render = function () { };

         element.bind('change', function (e) {
            var element = e.target;

            $q.all(slice.call(element.files, 0).map(readFile))
               .then(function (values) {
                  if (element.multiple) ngModel.$setViewValue(values);
                  else ngModel.$setViewValue(values.length ? values[0] : null);
               });

            function readFile(file) {
               var deferred = $q.defer();

               var reader = new FileReader();
               reader.onload = function (e) {
                  deferred.resolve(e.target.result);
               };
               reader.onerror = function (e) {
                  deferred.reject(e);
               };
               reader.readAsDataURL(file);

               return deferred.promise;
            }

         }); //change

      } //link
   }; //return
}


//Funcion que recibe como parametro un codigo de error y devuelve el motivo de error.
app.factory('codigosError', function() {

   return {
      msj: function(code) {

         if (code==101) {
            $mensaje = "Transacción rechazada. No se recibio nombre, numero codigo de seguridad o fecha de vencimiento de la tarjeta.";
         }else if(code==102){
            $mensaje = "Asegurarse que los datos ingresados sean los correctos y que no se hayan colocado letras en lugar de numeros o viceversa.";
         }else if(code==202){
            $mensaje = "Se ha ingresado un tarjeta vencida y no es posible transaccionar.";
         }else if(code==203){
            $mensaje = "Transacción rechazada. Intentar de nuevo, validar que la tarjeta cuente con los permisos para transaccionar.";
         }else if(code==204){
            $mensaje = "Fondos insuficientes para realizar la transaccion.";
         }else if(code==205){
            $mensaje = "Cuidado, esta tarjeta esta reportada robada o perdida.";
         }else if(code==208){
            $mensaje = "Esta tarjeta no cuenta con los permisos para transaccionar en linea.";
         }else if(code==209){
            $mensaje = "Codigo de seguridad ingresado incorrectamente.";
         }else if(code==210){
            $mensaje = "Fondos insuficientes para realizar la transaccion. ";
         }else if(code==211){
            $mensaje = "Codigo de seguridad ingresado incorrectamente.";
         }else if(code==230){
            $mensaje = "Codigo de seguridad ingresado incorrectamente.";
         }else if(code==231){
            $mensaje = "Numero de tarjeta ingresado incorrectamente.";
         }else if(code==232){
            $mensaje = "Tarjeta no fue aceptada, por favor intentar de nuevo.";
         }else if(code==233){
            $mensaje = "Transacción rechazada. Intentar de nuevo, validar que la tarjeta cuente con los permisos para transaccionar.";
         }else if(code==234){
            $mensaje = "Error del sistema de antifraude";
         }else if(code==236){
            $mensaje = "Transacción rechazada. Intentar de nuevo, validar que la tarjeta cuente con los permisos para transaccionar.";
         }else if(code==481){
            $mensaje = "Transacción rechazada posiblemente por varios intentos, contacte a soporte para mas detalles";
         }else if(code==01){
            $mensaje = "Transacción rechazada. Intentar de nuevo, validar que la tarjeta cuente con los permisos para transaccionar.";
         }else if(code==02){
            $mensaje = "Transacción rechazada. Intentar de nuevo, validar que la tarjeta cuente con los permisos para transaccionar.";
         }else if(code==02){
            $mensaje = "Transacción rechazada. Intentar de nuevo, validar que la tarjeta cuente con los permisos para transaccionar.";
         }else if(code==05){
            $mensaje = "Transacción no aceptada";
         }else if(code==13){
            $mensaje = "FONDOS INSUFICIENTES";
         }else if(code==14){
            $mensaje = "TARJETA INVALIDA";
         }else if(code==15){
            $mensaje = "EMISOR INVALIDO (Merchant Invalid)";
         }else if(code==19){
            $mensaje = "Transacción no realizada, intente de nuevo";
         }else if(code==31){
            $mensaje = "Tarjeta no soportada por SWITCH";
         }else if(code==41){
            $mensaje = "Tarjeta Extraviada";
         }else if(code==43){
            $mensaje = "Tarjeta Robada";
         }else if(code==51){
            $mensaje = "No tiene fondos disponibles";
         }else if(code==54){
            $mensaje = "Fecha de expiración invalida";
         }else if(code==57){
            $mensaje = "TRANSACCIÓN NO PERMITIDA ";
         }else if(code==58){
            $mensaje = "TRANSACCION INVALIDA ";
         }else if(code==61){
            $mensaje = "MONTO EXCEDIDO ";
         }else if(code==62){
            $mensaje = "TARJETA RESTRINGIDA";
         }else if(code==65){
            $mensaje = "TRANSACCIONES EXCEDIDAS";
         }else if(code==78){
            $mensaje = "CUENTA INVALIDA ";
         }else if(code==85){
            $mensaje = "TRANSACCION INVALIDA ";
         }else if(code==89){
            $mensaje = "TERMINAL INVÁLIDA ";
         }else if(code==91){
            $mensaje = "Emisor NO Disponible - TIME OUT ";
         }else if(code==94){
            $mensaje = "Transacción duplicada";
         }else if(code==96){
            $mensaje = "Ocurrio un error en la transacción";
         }else if(code=='PS01'){
            $mensaje = "Token requerido";
         }else if(code==35){
            $mensaje = "La transacción no existe, probablemente ya ha sido liquidada y no se puede anular.";
         }else if(code==36){
            $mensaje = "Transacción a ANULAR no EXISTE";
         }else if(code==37){
            $mensaje = "Transacción de ANULACION REVERSADA";
         }else if(code==38){
            $mensaje = "Transacción a ANULAR con Error";
         }else if(code==38){
            $mensaje = "Transacción a ANULAR con Error";
         }else if(code==408){
            $mensaje = "Servicio temporalmente no disponible, intente más tarde";
         }else if(code==233){
            $mensaje = "Transacción invalida. Intente nuevamente";
         }else if(code=='one_card'){
            $mensaje = "Debe tener al menos una tarjeta registrada";
         }else{
            $mensaje ="";
         }

         return $mensaje;
      }
   };
});


