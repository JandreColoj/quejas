@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRIPT --}}
{{-- Controller/Ajustes/EmpresasCtrl.js --}}

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="EmpresasCtrl" ng-cloak>

   {{-- LOADDING --}}
   @include('fragment.loading')

   <div class="head_content">
      <h1>Empresas</h1>
      <div class="cont_btns_head">
         <a ng-click="nueva_ventana('NUEVO')" class="btn btn_opcion">Nueva empresa</a>
      </div>
   </div>

   <div class="ed-container full">
      <div class="ed-item s-100 spi spd">
         <div class="container_pedidos">
            <table class="table table-borderless table_separate">
               <thead class="table_head_pedido">
                  <tr>
                     <th>No. </th>
                     <th>Nombre</th>
                     <th>NIT</th>
                     <th>Telefono</th>
                     <th>Pais</th>
                     <th>Dirección</th>
                     <th>Moneda</th>
                     <th>estado</th>
                     <th>Opciones</th>
                  </tr>
               </thead>

               <tbody class="table_body_pedido">
                  <tr ng-repeat="empresa in empresas">
                     <td class="radius_left">@{{$index+1}}</td>
                     <td>@{{empresa.nombre}}</td>
                     <td>@{{empresa.nit}}</td>
                     <td>@{{empresa.telefono}}</td>
                     <td>@{{empresa.pais.nombre}}</td>
                     <td>@{{empresa.direccion}}</td>
                     <td>@{{empresa.moneda.codigo}}</td>
                     <td>
                        <span ng-if="empresa.estado == 1" >Activo</span>
                        <span ng-if="empresa.estado == 0" >Desactivado</span>
                     </td>
                     <td class="radius_right">
                        <span class="icoeditar icotfaq" ng-click="nueva_ventana('EDITAR',empresa)" data-tippy-content="Editar">Editar</span>
                        <span class="icoeliminar icotfaq" uib-tooltip="Eliminar" ng-click="nueva_ventana('ELIMINAR',empresa)">Eliminar</span>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   {{-- NUEVA EMPRESA --}}
   <div class="caja_modal" ng-show="modal_nuevo">
      <div id="modal_nuevo" style="height:450px;">
         <div class="header_area">
            <h1>Nueva empresa</h1>
            <div class="areacerrar">
               <a ng-click="modal_nuevo=false" class="icocerrar">X</a>
            </div>
         </div>

         <div class="contenido_area coloblan">
            <div class="col-sm-12 fleft_phonecp mtop">
               <form class="form-horizontal" name="frmnew" ng-submit="crearEmpresa()">

                  <div class="ed-container full pass_piloto">

                     <div class="ed-container full">
                        <div class="ed-item s-50 spi">
                           <label for="nombre">Nombre: </label>
                           <input id="nombre" type="text" class="form-control sinp" name="nombre" ng-model="empresa.nombre" >
                        </div>
                        <div class="ed-item s-50 spi">
                           <label for="nit">NIT: </label>
                           <input id="nit" type="text" class="form-control sinp" name="nit" ng-model="empresa.nit" >
                        </div>
                     </div>

                     <div class="ed-item s-100 spi">
                        <label for="direccion">Dirección: </label>
                        <input id="direccion" type="text" class="form-control sinp" name="direccion" ng-model="empresa.direccion" >
                     </div>

                     <div class="ed-container full">
                        <div class="ed-item s-50 spd spi">
                           <label for="rol">Pais:</label>

                           <ol class="nya-bs-select mol relcont" ng-model="empresa.codigo_pais"
                               data-live-search="true" data-size="5" title="Selecciona..." ng-change="asignacion_moneda_pais(empresa.codigo_pais)" required>
                              <li nya-bs-option="pais in paises" data-value="pais.codigo">
                                 <a>
                                    @{{ pais.nombre }}
                                    <span class="glyphicon glyphicon-ok check-mark"></span>
                                 </a>
                              </li>
                           </ol>
                        </div>
                        <div class="ed-item s-50 spd spi">
                           <label for="rol">Moneda:</label>

                           <ol class="nya-bs-select mol relcont" ng-model="empresa.id_moneda" data-live-search="true" data-size="5" title="Selecciona..." required>
                              <li nya-bs-option="moneda in monedas" data-value="moneda.id">
                                 <a>
                                    @{{ moneda.nombre }}
                                    <span class="glyphicon glyphicon-ok check-mark"></span>
                                 </a>
                              </li>
                           </ol>
                        </div>
                     </div>

                     <div class="ed-item s-100 spi">
                        <label for="telefono">Telefono: </label>
                        <input id="telefono" type="text" class="form-control sinp" name="telefono" ng-model="empresa.telefono" >
                     </div>

                     <div class="ed-item s-100 spi spd">
                        <label for="correo">Correo: </label>
                        <input type="email" class="form-control" ng-model="empresa.correo" name="correo">

                        <div class="alert-danger" ng-show="frmnew.correo.$dirty && frmnew.correo.$error.email">
                           Ingresa un correo valido.
                        </div>
                     </div>

                     <div class="ed-item s-100 m-50 spi">
                        <label for="correo"> {{trans('form.password')}}: </label>
                        <input type="password" class="form-control sinp" ng-model="empresa.pass" required >
                     </div>

                     <div class="ed-item s-100 m-50 spi spd">
                           <label for="correo">Confirmar contraseña: </label>
                        <input type="password" class="form-control sinp" ng-model="empresa.pass2" required>
                     </div>
                  </div>

                  {{-- ERRORES DE VALIDACION --}}
                  @include('fragment.error')

                  <div class="ed-container full">
                     <div class="ed-item s-100 main-center cross-center">
                        <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                           Crear empresa
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>

      </div>
   </div>

   {{-- EDITAR EMPRESA --}}
   <div class="caja_modal" ng-show="modal_editar">
      <div id="modal_nuevo" style="height:400px;">
         <div class="header_area">
            <h1>Editar Empresa</h1>
            <div class="areacerrar">
               <a ng-click="modal_editar=false" class="icocerrar">X</a>
            </div>
         </div>

         <div class="contenido_area coloblan">
            <div class="col-sm-12 fleft_phonecp mtop">
               <form class="form-horizontal" name="frmEdit" ng-submit="editarEmpresa()">

                  <div class="ed-container full pass_piloto">

                     <div class="ed-container full">
                        <div class="ed-item s-50 spi">
                           <label for="e_nombre">Nombre: </label>
                           <input id="e_nombre" type="text" class="form-control sinp" ng-model="empresa.nombre" >
                        </div>
                        <div class="ed-item s-50 spi">
                           <label for="e_nit">NIT: </label>
                           <input id="e_nit" type="text" class="form-control sinp" ng-model="empresa.nit">
                        </div>
                     </div>

                     <div class="ed-item s-100 spi">
                        <label for="e_direccion">Dirección: </label>
                        <input id="e_direccion" type="text" class="form-control sinp" ng-model="empresa.direccion" >
                     </div>

                     <div class="ed-container full">
                        <div class="ed-item s-50 spd spi">
                           <label for="pais">Pais:</label>

                           <ol class="nya-bs-select mol relcont" ng-model="empresa.codigo_pais"
                               data-live-search="true" data-size="5" title="Selecciona..." ng-change="asignacion_moneda_pais(empresa.codigo_pais)" required>
                              <li nya-bs-option="pais in paises" data-value="pais.codigo">
                                 <a>
                                    @{{ pais.nombre }}
                                    <span class="glyphicon glyphicon-ok check-mark"></span>
                                 </a>
                              </li>
                           </ol>
                        </div>
                        <div class="ed-item s-50 spd spi">
                           <label for="moneda">Moneda:</label>

                           <ol class="nya-bs-select mol relcont" ng-model="empresa.id_moneda" data-live-search="true" data-size="5" title="Selecciona..." required>
                              <li nya-bs-option="moneda in monedas" data-value="moneda.id">
                                 <a>
                                     @{{ moneda.nombre }}
                                    <span class="glyphicon glyphicon-ok check-mark"></span>
                                 </a>
                              </li>
                           </ol>
                        </div>
                     </div>

                     <div class="ed-item s-100 spi">
                        <label for="e_telefono">Telefono: </label>
                        <input id="e_telefono" type="text" class="form-control sinp" ng-model="empresa.telefono" >
                     </div>

                  </div>

                  {{-- ERRORES DE VALIDACION --}}
                  @include('fragment.error')

                  <div class="ed-container full">
                     <div class="ed-item s-100 main-center cross-center">
                        <button type="submit" class="btn btn_save" ng-disabled="frmEdit.$invalid">
                           Editar empresa
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>

      </div>
   </div>

   {{-- ELIMINAR USUARIO --}}
   <div class="caja_modal" ng-show="modal_eliminar">
      <div id="modal_nuevo" style="height:250px; width:300px">
         <div class="header_area">
            <h1>Eliminar usuario</h1>
            <div class="areacerrar">
               <a ng-click="modal_eliminar=false" class="icocerrar">X</a>
            </div>
         </div>

         <div class="contenido_area coloblan">
            <div class="col-sm-12 fleft_phonecp mtop">
               <form class="form-horizontal" name="frmEliminar" ng-submit="eliminarEmpresa()">

                  <div class="ed-container full pass_piloto">
                     <div class="ed-item s-100 spi">
                        <p>Desea eliminar a la empresa?</p>
                     </div>
                  </div>

                  {{-- ERRORES DE VALIDACION --}}
                  @include('fragment.error')

                  <div class="ed-container full">
                     <div class="ed-item s-100 main-center cross-center">
                        <button type="submit" class="btn btn_save"> Eliminar Usuario</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

</div>
@endsection
