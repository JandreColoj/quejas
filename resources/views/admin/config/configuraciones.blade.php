@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRIPT --}}
{{-- Controller/Ajustes/ConfiguracionCtrl.js --}}

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="ConfiguracionCtrl" ng-cloak>

   {{-- LOADDING --}}
   @include('fragment.loading')

   <div class="head_content">
      <h1>Ajustes</h1>
   </div>

   <div class="col-sm-12 spd spi areablan">

      <div class="submenu">
         <ul>
            <li><a ng-click="activarSeccion('paises')">Paises</a></li>
            <li><a ng-click="activarSeccion('monedas')">Monedas</a></li>
         </ul>
      </div>

      <div class="col-sm-12 cssperfil" ng-if="seccion_paises">
         <div class="col-sm-12 spd spi">
            <h3>Paises</h3>
         </div>

         <div class="col-sm-12 spd spi conte_empre ">
            <table class="table">
               <thead>
                  <tr class="tit_head">
                     <th class="maxt">Nombre</th>
                     <th>Codigo</th>
                     <th>Moneda</th>
                     <th>Estado</th>
                     <th>Opciones</th>
                  </tr>
               </thead>

               <tbody>
                  <tr ng-repeat="pais in paises"  ng-class="{'alert-warning': pais.estado==0 , 'alert-success': pais.estado==1}">
                     <td> <strong> @{{pais.nombre}}</strong> </td>
                     <td> @{{pais.codigo}}</td>
                     <td> @{{pais.moneda}} </td>

                     <td>
                        <ul class="opciones">
                           <li ng-if="pais.estado==0">
                              <a ng-click="cambioEstadoPais(true,pais.id)" class="icoeditar">Activar</a>
                           </li>
                           <li ng-if="pais.estado==1">
                              <a ng-click="cambioEstadoPais(false,pais.id)" class="icodeshabilitar">Desactivar</a>
                           </li>
                        </ul>
                     </td>
                     <td ng-click="nueva_ventana('EDITAR_MONEDA_PAIS',pais)"> Editar </td>
                  </tr>
               </tbody>
            </table>
         </div>

         {{-- MODIFICAR MONEDA  EN PAIS--}}
         <div class="caja_modal" ng-show="modal_pais_moneda">
            <div id="modal_nuevo" style="height:250px; width:300px">
               <div class="header_area">
                  <h1>Monedas</h1>
                  <div class="areacerrar">
                     <a ng-click="nueva_ventana('CERRAR')" class="icocerrar">X</a>
                  </div>
               </div>

               <div class="contenido_area coloblan">
                  <div class="col-sm-12 fleft_phonecp mtop">
                     <form class="form-horizontal" name="frmEliminar" ng-submit="addMonedaPais()">

                        <div class="ed-container full pass_piloto">
                           <div class="ed-item s-100 spi">
                              <label for="moneda">Monedas:</label>

                              <ol class="nya-bs-select mol relcont" ng-model="pais.moneda"
                                 data-live-search="true" data-size="5" title="Selecciona..." required>
                                 <li nya-bs-option="moneda in monedas" data-value="moneda.codigo">
                                    <a>
                                       @{{ moneda.nombre }}
                                       <span class="glyphicon glyphicon-ok check-mark"></span>
                                    </a>
                                 </li>
                              </ol>
                           </div>
                        </div>

                        <div class="ed-container full">
                           <div class="ed-item s-100 main-center cross-center">
                              <button type="submit" class="btn btn_save"> Guardar Moneda</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>

      </div>

      <div class="col-sm-12 cssperfil" ng-if="seccion_monedas">
         <div class="col-sm-12 spd spi">
            <h3>Monedas</h3>

            <div class="btn_nuevoUser">
               <a ng-click="nueva_ventana('MONEDA')">Nueva moneda</a>
            </div>
         </div>

         <div class="col-sm-12 spd spi conte_empre ">
            <table class="table">
               <thead>
                  <tr class="tit_head">
                     <th class="maxt">Nombre</th>
                     <th>Codigo</th>
                     <th>simbolo</th>
                     <th>Opciones</th>
                  </tr>
               </thead>

               <tbody>
                  <tr ng-repeat="moneda in monedas">
                     <td> @{{moneda.nombre}} </td>
                     <td> @{{moneda.codigo}} </td>
                     <td> @{{moneda.simbolo}} </td>

                     <td>
                        <ul class="opciones">
                           <li>
                              <a ng-click="nueva_ventana('MONEDA',moneda)" class="icoeditar">Editar</a>
                           </li>
                           <li>
                              <a ng-click="nueva_ventana('ELIMINAR_MONEDA', moneda)" class="icodeshabilitar">Eliminar</a>
                           </li>
                        </ul>
                     </td>

                  </tr>
               </tbody>
            </table>
         </div>

         {{-- CREAR OR EDITAR MONEDA --}}
         <div class="caja_modal" ng-show="modal_moneda">
            <div id="modal_nuevo" style="height:350px;">
               <div class="header_area">
                  <h1>@{{titulo_moneda}}</h1>
                  <div class="areacerrar">
                     <a ng-click="nueva_ventana('CERRAR')" class="icocerrar">X</a>
                  </div>
               </div>

               <div class="contenido_area coloblan">
                  <div class="col-sm-12 fleft_phonecp mtop">
                     <form class="form-horizontal" name="frmnew" ng-submit="crearOrEditarMoneda()">

                        <div class="ed-container full pass_piloto">

                           <div class="ed-item s-100 spi">
                              <label for="nombre">Nombres</label>
                              <input id="nombre" type="text" class="form-control sinp" ng-model="moneda.nombre" required>
                           </div>

                           <div class="ed-item s-100 spi">
                              <label for="codigo">Código internacional: </label>
                              <input id="codigo" type="text" class="form-control sinp" ng-model="moneda.codigo" required>
                           </div>

                           <div class="ed-item s-100 spi spd">
                              <label for="simbolo">Simbolo: </label>
                              <input type="simbolo" class="form-control" ng-model="moneda.simbolo">
                           </div>

                        </div>

                        <div class="ed-container full">
                           <div class="ed-item s-100 main-center cross-center">
                              <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                                 @{{btn_moneda}}
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>

         {{-- ELIMINAR MONEDA --}}
         <div class="caja_modal" ng-show="modal_eliminar_moneda">
            <div id="modal_nuevo" style="height:250px; width:300px">
               <div class="header_area">
                  <h1>Eliminar moneda</h1>
                  <div class="areacerrar">
                     <a ng-click="modal_eliminar_moneda=false" class="icocerrar">X</a>
                  </div>
               </div>

               <div class="contenido_area coloblan">
                  <div class="col-sm-12 fleft_phonecp mtop">
                     <form class="form-horizontal" name="frmEliminar" ng-submit="eliminarMoneda()">

                        <div class="ed-container full pass_piloto">
                           <div class="ed-item s-100 spi">
                              <p>Desea eliminar la moneda?</p>
                           </div>
                        </div>

                        {{-- ERRORES DE VALIDACION --}}
                        @include('fragment.error')

                        <div class="ed-container full">
                           <div class="ed-item s-100 main-center cross-center">
                              <button type="submit" class="btn btn_save"> Eliminar Moneda</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>



   </div>

</div>
@endsection
