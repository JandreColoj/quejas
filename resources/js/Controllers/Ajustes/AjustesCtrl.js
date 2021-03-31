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
