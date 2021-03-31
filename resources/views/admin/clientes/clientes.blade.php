@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRIPT --}}
@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>


<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="ClientesCtrl" ng-cloak>

   <!-- looadding -->
   @include('fragment.loading')

   <!-- MODAL PRINCIPAL -->
   @include('admin.clientes.detalleCliente')
   <!-- FILTROS -->
   {{-- @include('admin.pedidos.filtros') --}}


   <div class="container">
      <div class="col-sm-12 spd spi mtop fleft_phone">

            <div class="contepa">

               <div class="head_content">
                  <h1>Clientes</h1>
               </div>

               <div class="col-sm-12 spd spi fleft_phone">
                  <div class="col-sm-12 col-xs-12 spd spi opcidownload">
                  </div>

                  <div class="col-sm-12 spd fleft_phone">

                     {{-- <div class="col-sm-6 spi opcidownload">
                        <ul>

                           <li class="spd spi filtros">
                              <a  href=""# class="btn btn-primary icoexcel" ng-click="exportData()"></a>
                           </li>
                        </ul>
                     </div> --}}

                     <div class="col-sm-12 spd">
                        <form class="form fleft_phone formbus" ng-submit="getClientes(1)">
                           <div class="form-group">
                              <div class="col-sm-6"></div>
                              <div class="col-sm-4 spd spi">
                                 <input type="text" class="form-control sinbiz sinp" placeholder="Buscar..." ng-model="filtro.parametro">
                              </div>

                              <div class="col-sm-2 spi spd">
                                 <button type="submit" class="btn btn-primary  btn-busqueda maba" ng-click="getPedidos()"></button>
                              </div>
                              {{-- <div class="col-xs-2 spd">
                                 <a class="btn btn-primary  btn-filtro maba" ng-click="abrirFiltro()"></a>
                              </div> --}}
                           </div>
                        </form>
                     </div>

                  </div>

               </div>

               <div class="col-sm-12 spd spi nuTable fleft_phone dnone_phone" id="exportable">
                  <table class="table mtop_table table_phone">
                     <thead>
                           <th></th>
                           <th class="title_table">Comercio</th>
                           <th class="title_table">Contacto</th>
                           <th class="title_table">Correo</th>
                           <th class="title_table">Teléfono</th>
                     </thead>
                     <tbody>

                        <tr ng-repeat="cliente in clientes">
                           <td class="tdac"><span></span></td>

                           <td class="body_table conbo" ng-click="showClient(cliente.id)">
                                 @{{cliente.empresa}}
                                 <span class="btnvisua">Ver</span>
                           </td>
                           <td class="body_table" ng-click="showClient(cliente.id)">
                                 @{{cliente.nombre}} @{{cliente.apellido}}
                           </td>
                           <td class="body_table" ng-click="showClient(cliente.id)">
                              @{{cliente.email}}
                           </td>
                           <td class="body_table">
                              @{{cliente.telefono}}
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>

            </div>


            <nav aria-label="Page navigation example">
               <ul class="pagination">

                  <li class="page-item" ng-repeat ="pag in paginacion.paginas" >
                     <a class="page-link"  style="color:#7200C6" ng-click="getClientes(pag)" ng-class="{'back_morado': filtro.skip==pag}">@{{pag}}</a>
                  </li>

               </ul>
            </nav>

      </div>
   </div>

   <div class="modal-backdrop_pg" ng-if="fondodetalle" ng-click="showDetalle()"></div>

</div>

@endsection
