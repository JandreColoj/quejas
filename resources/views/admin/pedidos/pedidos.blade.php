@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRIPT --}}
{{-- Controller/Transacciones/TransaccionesCtrl.js --}}

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>


<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="PedidosCtrl" ng-cloak>

   <!-- looadding -->
   @include('fragment.loading')

   <!-- MODAL PRINCIPAL -->
   @include('admin.pedidos.detailOrden')

   <!-- FILTROS -->
   @include('admin.pedidos.filtros')

   {{-- OBSERVACIONES --}}
   @include('admin.pedidos.observaciones')


   <div class="container">
      <div class="col-sm-12 spd spi mtop fleft_phone">

            <div class="contepa">

               <div class="head_content">
                  <h1>Pedidos</h1>
               </div>

               <div class="col-sm-12 spd spi fleft_phone">
                  <div class="col-sm-12 col-xs-12 spd spi opcidownload">

                  </div>

                  <div class="col-sm-12 spd fleft_phone">

                     <div class="col-sm-6 spi opcidownload">
                        <ul>
                           <li class="spd spi filtros">
                              <a  href=""# class="btn btn-primary icoexcel" ng-click="exportExcel()"></a>
                           </li>
                        </ul>
                     </div>


                     {{-- Filtro de busqueda --}}
                     <div class="ed-container full">
                        <div class="ed-item s-100 spi spd">
                           <div class="container_filtro">
                              <form ng-submit="getPedidos()">
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <label for="">Buscar por</label>
                                       <input class="form-control" type="text"  ng-model="filtro.busqueda" placeholder="No. Orden o Cliente">
                                    </div>

                                    <div class="col-sm-2 spi">
                                       <label for="estado">Estado</label>
                                       <ol class="nya-bs-select" ng-model="filtro.estado"  title="Selecciona...">
                                          <li nya-bs-option="estado in Estados" data-value="estado.codigo">
                                             <a>
                                                @{{ estado.nombre }}
                                                <span class="glyphicon glyphicon-ok check-mark"></span>
                                             </a>
                                          </li>
                                       </ol>
                                    </div>

                                    <div class="col-sm-2 spi">
                                       <label>Fecha inicio</label>
                                       <input class="form-control" type="date" placeholder="Fecha Inicio" ng-model="filtro.fechaInicio">
                                    </div>

                                    <div class="col-sm-2 spi">
                                       <label>Fecha final</label>
                                       <input class="form-control" type="date" placeholder="Fecha Final" ng-model="filtro.fechaFinal">
                                    </div>

                                    <div class="col-sm-2 spi">
                                       <input class="btn-busfiltro" type="submit">
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>

                     {{-- <div class="col-sm-12 spd">
                        <form class="form fleft_phone formbus" ng-submit="buscarCliente()">
                           <div class="form-group">
                              <div class="col-xs-10"></div>
                              <div class="col-xs-2 spd">
                                 <a class="btn btn-primary  btn-filtro maba" ng-click="abrirFiltro()"></a>
                              </div>
                           </div>
                        </form>
                     </div> --}}

                  </div>

               </div>

               <div class="col-sm-12 spd spi nuTable fleft_phone dnone_phone" id="exportable">
                  <table class="table mtop_table table_phone">
                        <thead>
                              <th></th>
                              <th class="title_table">Estado</th>
                              <th class="title_table">Fecha creación</th>
                              <th class="title_table">Proveedor</th>
                              <th class="title_table">Pedido</th>
                              <th class="title_table">Total</th>
                        </thead>
                        <tbody>

                           <tr ng-repeat="pedido in pedidos">
                              <td class="tdac"><span></span></td>
                              <td class="body_table conbo">
                                 <div ng-switch="pedido.estado.codigo">
                                    <span class="icon_status ico_norden"       ng-switch-when="1" data-tippy-content = "Nuevo Pedido"></span>
                                    <span class="icon_status ico_bodega"       ng-switch-when="2" data-tippy-content = "En Bodega"></span>
                                    <span class="icon_status ico_factura"      ng-switch-when="3" data-tippy-content = "Facturación"></span>
                                    <span class="icon_status ico_ruta"         ng-switch-when="4" data-tippy-content = "En Ruta"></span>
                                    <span class="icon_status ico_entregado"    ng-switch-when="5" data-tippy-content = "Entregado"></span>
                                    <span class="icon_status ico_incompleto"   ng-switch-when="6" data-tippy-content = "Incompleto"></span>
                                    <span class="icon_status ico_cancelado"    ng-switch-when="7" data-tippy-content = "Cancelado"></span>
                                    <span class="icon_status ico_devoluciones" ng-switch-when="8" data-tippy-content = "Devolucion"></span>
                                 </div>
                              </td>
                              <td class="body_table">
                                 @{{pedido.created_at | date:'MM/dd/yyyy'}}
                              </td>
                              <td class="body_table conbo" ng-click="showPedido(pedido.id)">
                                 @{{pedido.empresa.nombre}} <span class="btnvisua">Ver</span>
                              </td>
                              <td class="body_table" ng-click="showPedido(pedido.id)">
                                 @{{pedido.no_orden}}
                              </td>
                              <td class="body_table" ng-click="showPedido(pedido.id)">
                                 <strong> <small>@{{pedido.moneda}}</small> @{{pedido.total | number:2}} </strong>
                              </td>
                           </tr>
                        </tbody>
                  </table>
               </div>

               <div class="col-sm-12 spd spi fleft_phone">
                  <nav aria-label="Page navigation example">
                     <ul class="pagination">

                        <li class="page-item" ng-repeat ="pag in paginacion.paginas" >
                           <a class="page-link"  style="color:#7200C6" ng-click="getPedidos(pag)" ng-class="{'back_morado': filtro.skip==pag}">@{{pag}}</a>
                        </li>

                     </ul>
                  </nav>
               </div>

            </div>
      </div>
   </div>

   <div class="modal-backdrop_pg" ng-if="fondodetalle" ng-click="showDetalle()"></div>

</div>

@endsection
