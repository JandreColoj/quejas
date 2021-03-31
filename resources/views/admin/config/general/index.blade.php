@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRITP --}}
{{-- Controller/Ajustes/AjustesCtrl.js --}}

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="AjustesCtrl" ng-cloak>

   {{-- LOADDING --}}
   @include('fragment.loading')

   <div class="head_content">
      <div class="contepa ed-container full">

         <div class="col-sm-12 spd spi areablan fleft_phone sinpt">

            <div class="submenu">
               <ul>
                  <li><a ng-click="nueva_ventana('SECCION_USUARIOS')" ng-class="{'select_menu' : seccion_usuario}">Usuarios</a></li>
                  {{-- <li><a ng-click="nueva_ventana('SECCION_DELIVERY')" ng-class="{'select_menu' : seccion_delivery}">Delivery</a></li> --}}
               </ul>
            </div>

            <div class="ed-container full cssperfil" ng-if="seccion_usuario">
               @include('admin.config.general.Usuarios.listado_usuarios')
            </div>

         </div>
      </div>
   </div>


</div>
@endsection
