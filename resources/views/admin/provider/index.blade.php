@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRIPT --}}
{{-- Controller/Admin/ProviderCtrl.js --}}

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="ProviderCtrl" ng-cloak>

   <!-- looadding -->
   @include('fragment.loading')

   <!-- MODAL PRINCIPAL DE REGISTRO -->
   @include('admin.provider.layouts.detalleEmpresa')

   <!-- FILTROS -->
   @include('admin.provider.layouts.filtros')

   <!-- MODAL DETALLE DE COMISION -->
   @include('admin.provider.layouts.detalleComision')

   <!-- MODAL DETALLE DE COMISION -->
   @include('admin.provider.layouts.modal_confirm')

   <!-- LISTADO DE REGISTROS -->
   <div class="container">
      <div class="col-sm-100 spd spi mtop">
            {{-- Contenido --}}
            <div class="contepa">

               <div class="col-sm-12 spd spi fleft_phone">
                  <div class="ed-container full main-end">
                     <div class="ed-item s-100">
                        <h1>Proveedores</h1>
                     </div>
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="container_filtro cont_btnsfill">
                     <form ng-submit="generateReportGeneral()">
                        <div class="ed-item ed-container full main-center cross-center">

                           <div class="ed-item ed-container s-100 spi main-end cross-center">
                              <div class="ed-item s-100 m-40 spi">
                                 <input type="text" class="form-control" placeholder="Buscar..." ng-model="filtro.parametro">
                              </div>

                              <div class="ed-item s-100 m-5 spi">
                                 <button type="submit" class="btn btn-busfiltro btn-busqueda maba"></button>
                              </div>
                              <div class="ed-item s-100 m-5 spi">
                                 <input class="btn btn-primary  btn-filtro maba" ng-click="abrirFiltro()">
                              </div>
                           </div>

                        </div>
                     </form>
                  </div>
               </div>

               <div class="ed-container full  fleft_phone bus_estado">

                  <div class="ed-container ed-item s-100 m-20">
                     <div class="ed-item s-100">
                        <div class="caja" ng-click="getRegistros(10)" ng-class="{'back_azul': estado_docu==10}">
                           <p>Activos</p> <span>@{{TotalEmpresas.activos}} empresas</span>
                        </div>
                     </div>

                     <div class="ed-item s-100 m-100">
                        <div class="caja" ng-click="getRegistros('10_f')" ng-class="{'back_azul': estado_docu=='10_f'}">
                           <p> Facturando  @{{TotalEmpresas.activos_facturando}}</p>
                        </div>
                     </div>

                     <div class="ed-item s-100 m-100">
                        <div class="caja" ng-click="getRegistros('10_sf')" ng-class="{'back_azul': estado_docu=='10_sf'}">
                           <p> Sin facturar @{{TotalEmpresas.activos_sin_facturacion}}</p>
                        </div>
                     </div>
                  </div>

                  <div class="ed-item s-100 m-20">
                     <div class="caja" ng-click="getRegistros('8')" ng-class="{'back_azul': estado_docu=='8'}">
                        <p>Proceso 80%</p> <span>@{{TotalEmpresas.registro_8}} proveedores</span>
                     </div>
                  </div>

                  <div class="ed-item s-100 m-20">
                     <div class="caja" ng-click="getRegistros('5')" ng-class="{'back_azul': estado_docu=='5'}">
                        <p>Proceso 50% </p> <span>@{{TotalEmpresas.registro_5}} proveedores</span>
                     </div>
                  </div>

                  <div class="ed-item s-100 m-20">
                     <div class="caja" ng-click="getRegistros('3')" ng-class="{'back_azul': estado_docu=='3'}">
                        <p>Proceso 30% </p> <span>@{{TotalEmpresas.registro_3}} proveedores</span>
                     </div>
                  </div>

                  <div class="ed-item s-100 m-20">
                     <div class="caja" ng-click="getRegistros('0')" ng-class="{'back_azul': estado_docu=='0'}">
                        <p>Inicaron proceso</p> <span>@{{TotalEmpresas.registro_0}} proveedores</span>
                     </div>
                  </div>

               </div>

               <div class="col-sm-12 spd spi nuTable fleft_phone dnone_phone">
                    <table class="table table-striped mtop_table">
                        <thead>
                           <th></th>
                           <th class="title_table">Fecha ingreso</th>
                           <th class="title_table">Proveedor</th>
                           <th class="title_table">RFC</th>
                           <th class="title_table">Pedidos</th>
                           <th class="title_table">Facturación</th>
                           <th class="title_table">Comisión</th>
                           <th class="title_table">Opciones</th>
                        </thead>

                        <tbody infinite-scroll="masregistros()">
                           <tr ng-repeat="registro in registros" ng-class="{'danger': registro.solicitud==1}">
                              <td class="tdac"></td>
                              <td class="body_table">@{{registro.fecha_creacion | date:'MM/dd/yyyy'}}</td>
                              <td class="body_table conbo" ng-click="detailProvider(registro.id)">
                                 <span class="label_ca"> @{{registro.nombre_proveedor | limitTo:30}}</span>
                                 <span class="btnvisua">Ver</span>
                              </td>
                              <td class="body_table"> @{{registro.nit}}</td>
                              <td class="body_table"> @{{registro.facturacion==0 ? 0 : registro.pedidos}}</td>
                              <td class="body_table"> @{{registro.moneda}} @{{registro.facturacion==null ? 0 : registro.facturacion | number:2}}</td>

                              <td class="body_table conbo" ng-click="nueva_ventana('MODAL_COMISION', registro)">
                                 <span class="btn_comision">Comisión</span>
                              </td>
                              <td class="radius_right">
                                 <span class="icocheckr icotfaq" ng-click="nueva_ventana('MODAL_CONFIRM_HABILITAR', registro)" data-tippy-content="Editar" ng-if="registro.estado==0"></span>
                                 <span class="icoeliminar icotfaq"  uib-tooltip="Eliminar" ng-click="nueva_ventana('MODAL_CONFIR_DELETE', registro)" ng-if="registro.estado==1"></span>
                                 <span class="ico_visto icotfaq"  uib-tooltip="Ver" ng-click="detailProvider(registro.id)"></span>
                              </td>

                           </tr>
                        </tbody>
                    </table>

                  {{-- <nav class="center_pagination" aria-label="Page navigation example">
                     <ul class="pagination">

                     <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                           <span aria-hidden="true">&laquo;</span>
                           <span class="sr-only">Previous</span>
                        </a>
                     </li>
                     <li class="page-item"><a class="page-link" href="#">1</a></li>
                     <li class="page-item"><a class="page-link" href="#">2</a></li>
                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                     <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                           <span aria-hidden="true">&raquo;</span>
                           <span class="sr-only">Next</span>
                        </a>
                     </li>
                     </ul>
                  </nav> --}}
               </div>

            </div>
      </div>
   </div>


   {{-- Area de nuevo banco --}}
   <div class="caja_activar" ng-if="cargarnBanco">
      <div class="caja_nuevo">
         <div class="col-sm-12">
            <h3>Nuevo Banco para @{{existeRegistro.nombre}}</h3>
         </div>

         <div class="col-sm-12">
            <form class="form-horizontal mtop" name="frm" ng-submit="bancoEmpresa(existeRegistro.id)">
               <div class="form-group">
                  <ol class="nya-bs-select mol" ng-model="elbanco.banco"  title="Seleccionar Banco..." data-size="7">
                     <li nya-bs-option="banco in bancos" data-value="banco.nombre" required>
                        <a>
                        @{{ banco.nombre }}
                        <span class="glyphicon glyphicon-ok check-mark"></span>
                        </a>
                     </li>
                  </ol>
               </div>

               <div class="form-group">
                  <input class="form-control sinp" type="text" ng-model="elbanco.cuenta" placeholder="Nombre de la cuenta" required>
               </div>
               <div class="form-group">
                  <input class="form-control sinp" type="text" ng-model="elbanco.numero" placeholder="Número de la cuenta" required>
               </div>

               <div class="form-group">
                  <ol class="nya-bs-select mol" ng-model="elbanco.moneda"  title="Seleccionar Moneda..." data-size="7">
                        <li nya-bs-option="moneda in tipomoneda" data-value="moneda.value" required>
                           <a>
                           @{{ moneda.nombre }}
                           <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                  </ol>
               </div>
               <div class="col-sm-6 spi mtop">
                  <button type="submit" class="btn btn-primary  btn-login" ng-disabled="frm.$invalid"> Aplicar</button>
               </div>
               <div class="col-sm-6 spd mtop">
                  <a  class="btn btn-primary  btn-cancelar" ng-click="cancelarBanco()"> Cancelar</a>
               </div>
         </form>
         </div>
      </div>
   </div>

   {{-- Area de editar banco --}}
   <div class="caja_activar" ng-if="cargareBanco">
      <div class="caja_nuevo">
         <div class="col-sm-12">
               <h3>Editar Banco para @{{existeRegistro.nombre}}</h3>
         </div>

         <div class="col-sm-12">
            <form class="form-horizontal mtop" name="frm" ng-submit="bancoedEmpresa(existeRegistro.id)">
                  <div class="form-group">
                     <ol class="nya-bs-select mol" ng-model="existeBanco.banco"  title="Seleccionar Banco..." data-size="7">
                           <li nya-bs-option="banco in bancos" data-value="banco.nombre" required>
                              <a>
                              @{{ banco.nombre }}
                              <span ng-if="banco.nombre==existeBanco.banco" class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                     </ol>
                  </div>


                  <div class="form-group">
                     <input class="form-control sinp" type="text" ng-model="existeBanco.cuenta" placeholder="Nombre de la cuenta" required>
                  </div>
                  <div class="form-group">
                     <input class="form-control sinp" type="text" ng-model="existeBanco.numero" placeholder="Número de la cuenta" required>
                  </div>

                  <div class="form-group">
                     <ol class="nya-bs-select mol" ng-model="existeBanco.moneda"  title="Seleccionar Moneda..." data-size="7">
                           <li nya-bs-option="moneda in tipomoneda" data-value="moneda.value">
                              <a>
                              @{{ moneda.nombre }}
                              <span ng-if="moneda.value==existeBanco.moneda" class="glyphicon glyphicon-ok check-mark"></span>
                              </a>
                           </li>
                     </ol>
                  </div>
                  <div class="col-sm-6 spi mtop">
                     <button type="submit" class="btn btn-primary  btn-login" ng-disabled="frm.$invalid"> Aplicar</button>
                  </div>
                  <div class="col-sm-6 spd mtop">
                     <a  class="btn btn-primary  btn-cancelar" ng-click="cancelarEBanco()"> Cancelar</a>
                  </div>
         </form>
         </div>
      </div>
   </div>

   {{-- Area de editar empresa --}}
   <div class="caja_activar" ng-if="vereditEmpresa">
      <div class="caja_nuevo" style="max-height: 600px;">
         <div class="col-sm-12">
            <h3>Editar Datos de la Empresa</h3>
         </div>

         <div class="col-sm-12">
            <form class="form-horizontal mtop"  name="frm" ng-submit="guardarEmpresa()">

               <div class="form-group">
                  <input class="form-control sinp" type="text" ng-model="existeRegistro.nombre" placeholder="Nombre de la empresa" required>
               </div>

               <div class="form-group">
                  <input class="form-control sinp" type="text" ng-model="existeRegistro.nombreValido" placeholder="Nombre Fiscal de la empresa">
               </div>

               <div class="form-group">
                  <input class="form-control sinp" type="text" ng-model="existeRegistro.nit" placeholder="NIT de la empresa" required>
               </div>

               <div class="form-group">
                  <input class="form-control sinp" type="text" ng-model="existeRegistro.ubicacion" placeholder="Direccion empresa">
               </div>

               <div class="form-group">
                  <input class="form-control sinp" type="text" ng-model="existeRegistro.direccionValida" placeholder="Direccion fiscal">
               </div>

               <div class="form-group fleft_phone">
                  <ol class="nya-bs-select mol" ng-model="existeRegistro.id_tipo"  title="Seleccionar Tipo...">
                     <li nya-bs-option="tipoempresa in tiposempresa" data-value="tipoempresa.id">
                        <a>
                           @{{ tipoempresa.nombre   }}
                           <span class="glyphicon glyphicon-ok check-mark"></span>
                        </a>
                     </li>
                  </ol>
               </div>

               <div class="form-group fleft_phone">
                  <ol class="nya-bs-select mol" ng-model="existeRegistro.id_categoria"  title="Seleccionar Categoria...">
                     <li nya-bs-option="categoria in industrias" data-value="categoria.id">
                        <a>
                              @{{ categoria.nombre   }}
                        <span class="glyphicon glyphicon-ok check-mark"></span>
                        </a>
                     </li>
                  </ol>
               </div>

               <div class="col-sm-6 spi mtop">
                  <button type="submit" class="btn btn-primary  btn-login" ng-disabled="frm.$invalid"> Aplicar</button>
               </div>

               <div class="col-sm-6 spd mtop">
                  <a  class="btn btn-primary  btn-cancelar" ng-click="canceleditEmpresa()"> Cancelar</a>
               </div>
            </form>
         </div>
      </div>
   </div>

</div>

@endsection

@push('scripts')
   <script src="/js/Controller/Registro/registroEmpresaCtrl.js"></script>

@endpush

