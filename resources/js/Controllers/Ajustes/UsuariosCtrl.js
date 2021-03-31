app.controller('UsuariosCtrl', UsuariosCtrl);
UsuariosCtrl.$inject = ['$scope', '$http','Helper', 'Ventana_modal'];

function UsuariosCtrl($scope, $http, Helper, Ventana_modal){

   $scope.nueva_ventana = function(tipo, usuario = false){

      $scope.errors  = [];
      $scope.usuario = {};

      if(tipo=='NUEVO'){

         $scope.modal_nuevo = true;

      }else if(tipo=='EDITAR'){

         console.log(usuario.agencia);
         $scope.usuario = usuario;
         $scope.usuario.telefono    = parseInt(usuario.telefono);
         $scope.usuario.codigo_user = parseInt(usuario.codigo_user);
         $scope.usuario.rol         = usuario.rol_usuario.rol;
         $scope.usuario.slug_rol    = usuario.rol_usuario.rol.slug;
         $scope.usuario.codigo_zona = usuario.zona==null ? '' : usuario.zona.codigo;
         $scope.usuario.id_agencia  = usuario.agencia==null ? '' : usuario.agencia.id;
         $scope.modal_editar = true;

         if(usuario.agencia!=null){
            $scope.getAgencia($scope.usuario.codigo_zona);
         }

      }else if(tipo=='ELIMINAR'){
         $scope.usuario.id = usuario.id;
         $scope.modal_eliminar = true;
      }

   }

   $scope.getUsuarios = function(){

      $http.get('api/config/usuario/getUsuarios').success(function(response){

         if(response.codigo==200) {
            $scope.usuarios = response.usuarios;
         }else if(response.codigo==400){
            Ventana_modal.modalResponse(response.errors, 'error');
         }
      });

   }

   $scope.getEmpresas = function(){

      $http.get('api/config/empresa/getEmpresas').success(function(response){

         if(response.codigo==200) {
            $scope.empresas = response.empresas;
         }else if(response.codigo==400){
            Ventana_modal.modalResponse(response.errors, 'error');
         }
      });

   }

   $scope.crearUsuario = function(){

      Ventana_modal.loader('Creando usuario . . .')

      $http.post('api/config/usuario/nuevoUsuario',$scope.usuario).success(function(response){

         Ventana_modal.loader();

         if(response.codigo==200){

            Ventana_modal.modalResponse(response.mensaje, 'success');
            $scope.modal_nuevo = false;
            $scope.getUsuarios();

         }else if(response.codigo==403){ //error de validaciones array
            $scope.errors = Helper.array_errors(response.errors);
         }else{
            $scope.errors = Helper.array_error(response.errors);
         }
      });

   }

   $scope.updateUser = function(){

      Ventana_modal.loader('Editando usuario . . .');

      $http.put('api/config/usuario/editarUsuario', $scope.usuario).success(function(response){

         Ventana_modal.loader();

         if(response.codigo=='200') {
            $scope.getUsuarios();
            $scope.modal_editar = false;
         }else if(response.codigo==403){ //error de validaciones array
            $scope.errors = Helper.array_errors(response.errors);
         }else{
            $scope.errors = Helper.array_error(response.errors);
         }

      })

   }

   $scope.eliminarUsuario = function(){

      Ventana_modal.loader('Eliminando usuario . . .');

      $http.put('api/config/usuario/eliminarUsuario', $scope.usuario).success(function(response){

         Ventana_modal.loader();

         if(response.codigo=='200') {
            $scope.getUsuarios();
            $scope.modal_eliminar = false;
         }else{
            $scope.errors = Helper.array_error(response.errors);
         }

      })
   }

   $scope.getAgencia = function(zona){

      Ventana_modal.loader('Cargando . . .');

      $http.get('api/config/usuario/getAgencia/'+zona).success(function(response){
         Ventana_modal.loader();
         $scope.agencias = response.agencias;
      });
   }


   $scope.construct = function(){
      $scope.getUsuarios();


   }
   $scope.construct();

   alert('ASDF');
   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }

};
