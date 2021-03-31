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
