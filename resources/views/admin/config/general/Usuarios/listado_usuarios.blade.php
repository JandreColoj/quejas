<div class="container_pedidos">

   <div class="head_content">
      <div class="container_filtro">
         <div class="ed-container full">

            <div class="cont_btns_head ed-item s-80">
               <a ng-click="nueva_ventana('NUEVO_USUARIO')" class="btn btn_opcion" >Nuevo usuario</a>
            </div>

         </div>
      </div>
   </div>

   <table class="table table-borderless table_separate">
      <thead class="table_head_pedido">
         <tr>
            <th>No. </th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Opciones</th>
         </tr>
      </thead>

      <tbody class="table_body_pedido">
         <tr ng-repeat="usuario in usuarios">
            <td class="radius_left">@{{$index+1}}</td>
            <td>@{{usuario.name}}</td>
            <td>@{{usuario.rol_usuario.rol.name}}</td>
            <td>@{{usuario.email}}</td>
            <td>@{{usuario.telefono}}</td>

            <td class="radius_right">
               <span class="icoeditar icotfaq" ng-click="nueva_ventana('EDITAR_USUARIO', usuario)" data-tippy-content="Editar"></span>
               {{-- <span class="icoeliminar icotfaq"  ng-class="{'icoeliminarConfirmar': trans.eliminar==1 }"  uib-tooltip="Eliminar" ng-click="eliminarTransporte(trans)"></span> --}}
            </td>
         </tr>
      </tbody>
   </table>

   {{-- NUEVO Y EDITAR USUARIO --}}
   @include('admin.config.general.Usuarios.usuario')
   {{-- NUEVO Y EDITAR USUARIO --}}

</div>
