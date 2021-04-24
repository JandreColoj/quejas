@section('menulateral')

<div ng-controller="MenuCtrl" ng-cloak>

   <div class="ed-container s-100 m-15 container_menu" id="container_menu">
      <div class="container_menutop">


         <div class="logo_menupos" ng-if="!minizarmenuLateral"></div>

         <!-- <div class="logopagalo2018" ng-if="minizarmenuLateral"></div> -->
         <div class="ico_exit" ng-click="closeMenu()"></div>

         <div class="container_menulist">

            <a>
               <b style="color:black ">{{ isset($datos['nombre']) ? $datos['nombre'] : '' }}</b>
            </a>


               <a  href="{{ url('/home') }}"  class="menulist_item ico_escritorio {{ request()->is('home') ? 'active_menu' : '' }}">
                  <p>Listado de quejas</p>
               </a>

               {{-- <a href="{{ url('/providers') }}" class="menulist_item ico_clientes {{ request()->is('providers') ? 'active_menu' : '' }}">
                  <p>Proveedores</p>
               </a>

               <a href="{{ url('/clientes') }}" class="menulist_item ico_usuarios {{ request()->is('clientes') ? 'active_menu' : '' }}">
                  <p>Clientes</p>
               </a>

               <a href="{{ url('/pedidos') }}" class="menulist_item ico_orders {{ request()->is('pedidos') ? 'active_menu' : '' }}">
                  <p>Pedidos</p>
               </a> --}}

               <a href="{{ url('/reportes') }}" class="menulist_item ico_reportes {{ request()->is('reportes') ? 'active_menu' : '' }}">
                  <p>Reportes</p>
               </a>


               {{-- <a href="#" class="menulist_item ico_ajustes" ng-click="showAjustes()">
                  <p>Ajustes</p>
               </a>

               <ul class="list_toggle__menu" ng-if="list_ajustes">

                  <li class="toggle_item">
                     <a href="{{ url('/ajustesGenerales') }}" class="menulist_item ico_usuarios" {{ request()->is('ajustesGenerales') ? 'active_menu' : '' }}>
                        <p>Generales</p>
                     </a>
                  </li>
               </ul> --}}



         </div>
      </div>

      <div class="container_menubottom">

         <div class="container_menulist">

            <a href="{{route('logout')}}" class="menulist_item ico_salir">
               <p>Salir</p>
            </a>

            <a href="#" class="menulist_item ico_minimizar" ng-click="minizarMenu()" ng-if="!minizarmenuLateral">
               <p>Minimizar menú</p>
            </a>

            <a href="#" class="menulist_item ico_minimizar__rotate" ng-click="minizarMenu()" ng-if="minizarmenuLateral"></a>
         </div>

      </div>
   </div>

   <div class="munu_banner">
      <div class="logo_posphone"></div>
      <div class="ico_menu" ng-click="showMenu()"></div>
   </div>

</div>

@show
