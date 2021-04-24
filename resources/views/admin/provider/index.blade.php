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


   <!-- FILTROS -->
   @include('admin.provider.layouts.filtros')


   <!-- LISTADO DE REGISTROS -->
   <div class="container">
      <div class="col-sm-100 spd spi mtop">
            {{-- Contenido --}}
            <div class="contepa">

               <div class="col-sm-12 spd spi nuTable fleft_phone dnone_phone">
                    <table class="table table-striped mtop_table">
                        <thead>
                           <th></th>
                           <th class="title_table">Fecha</th>
                           <th class="title_table">NIT</th>
                           <th class="title_table">Comercio</th>
                           <th class="title_table">Region</th>
                           <th class="title_table">Departamento</th>
                           <th class="title_table">Municipio</th>
                           <th class="title_table">Detalle</th>
                        </thead>

                        <tbody infinite-scroll="masregistros()">
                           <tr ng-repeat="registro in registros"  >
                              <td class="tdac"></td>
                              <td class="body_table">@{{registro.fecha | date:'MM/dd/yyyy'}}</td>
                              <td class="body_table"> @{{registro.comercio.nit}}</td>
                              <td class="body_table conbo"> @{{registro.comercio.nombre | limitTo:30}}  </td>

                              <td class="body_table conbo" >@{{registro.sucursal.ubicacion.departamento.region}} </td>
                              <td class="body_table conbo" >@{{registro.sucursal.ubicacion.departamento.nombre}} </td>
                              <td class="body_table conbo" >@{{registro.sucursal.ubicacion.nombre}} </td>
                              <td class="radius_right">
                                 <span class="ico_visto icotfaq" uib-tooltip="Ver" ng-click="verQUeja(registro)"></span>
                              </td>

                           </tr>
                        </tbody>
                    </table>
               </div>

            </div>
      </div>
   </div>

   <div class="modal fade" id="modal_confirm_deshabilitar" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deshabilitar el proveedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Nombre:  <b> @{{provider.nombre_proveedor}} </b></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary back_morado" ng-click="deshabilitar()">Confirmar</button>
          </div>
        </div>
      </div>
   </div>


   <div class="modal fade" id="modal_confirm_habilitar" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Habilitar el proveedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Nombre:  <b> @{{provider.nombre_proveedor}} </b></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary back_morado" ng-click="habilitar()">Confirmar</button>
          </div>
        </div>
      </div>
   </div>


   <div class="modal fade" id="modal_detalle" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Queja: @{{registro.codigo}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

            <div class="contenido_area coloblan">
               <div class="col-sm-12 fleft_phonecp mtop">
                  <form class="form-horizontal container_statuspedido" name="frmVenta">

                     <div class="ed-container full pass_piloto datos_pedido" style="margin-top:0px">
                        <div class="ed-item s-50 spi">
                           <div class="content_info">
                              <p><b>Fecha:</b> </p>
                              <p><b>Comercio:</b> </p>
                              <p><b>Dirección:</b> </p>
                              <p><b>NIT:</b> </p>
                              <p><b>consumidor:</b> </p>
                              <p><b>Queja:</b></p>
                           </div>
                        </div>

                        <div class="ed-item s-50 spd">
                           <div class="content_info">
                              <p> @{{ registro.fecha | date:'MM/dd/yyyy'}}</p>
                              <p> @{{ registro.comercio.nombre }}</p>
                              <p> @{{ registro.sucursal.direccion  }}</p>
                              <p> @{{ registro.comercio.nit }}</p>
                              <p> @{{ registro.consumidor.nombre }}</p>
                              <p> @{{ registro.motivo }}
                           </div>
                        </div>

                     </div>

                  </form>
               </div>
            </div>

            <div class="modal-footer">
               <button type="button" class="btn btn-primary" data-dismiss="modal">Acetpar</button>
               {{-- <button type="submit" class="btn btn-primary back_morado">Confirmar</button> --}}
            </div>

        </div>
      </div>
   </div>



</div>

@endsection

@push('scripts')
   <script src="/js/Controller/Registro/registroEmpresaCtrl.js"></script>

@endpush

