{{-- Area principal de registros de registros --}}
<div id="area_ID" ng-show="modal_detail_client">

   <div class="header_area">
      <h1>
         Cliente: @{{detailClient.empresa}}
      </h1>
      <div class="areacerrar">
         <a ng-click="modal_detail_client = false" class="icocerrar"></a>
      </div>
   </div>

   <div class="contenido_area">
      <div class="col-sm-12 spd spi">

         <div class="masinfo_area dnone_phone">
            <table class="table dnone_phone">
               <tbody>
                  <tr>
                     <td> <strong>Categoria: </strong> @{{detailClient.tipo_negocio}}</td>
                     <td> <strong>Usuario: </strong> @{{detailClient.nombre}}</td>
                     <td> <strong>Télefono: </strong> @{{detailClient.telefono}}</td>
                  </tr>
               </tbody>
            </table>
         </div>

         <div class="col-sm-12 winfo_phone">

            <!-- MENU DE REGISTRO -->
            <div class="col-sm-2 container__phone">
               <div class="menumas menumas__phone">
                  <ul>
                     <li><a ng-click="selectSection(1)" ng-class="{'selecme':area_detalle==1}">Información</a></li>
                     <li><a ng-click="selectSection(2)" ng-class="{'selecme':area_detalle==2}">Proveedores</a></li>
                     <li><a ng-click="selectSection(3)" ng-class="{'selecme':area_detalle==3}">Productos</a></li>
                  </ul>
               </div>
            </div>

            <!--  OPCIONES DE EMPRESA -->
            <div class="col-sm-10 fleft__phone">

               <div class="conte_empre" ng-if="area_detalle==1">
                  <div class="form-group col-sm-12 dflex_centerr">

                     <div class="content_startactive" ng-if="!cambioEstadop">
                        <h4>Detalle del cliente</h4>
                     </div>
                  </div>

                  <table class="table">
                     <tbody>
                        <tr>
                           <th class="maxt">Nombre cliente:</th>
                           <td>@{{detailClient.empresa}}</td>
                           <td></td>
                        </tr>

                        <tr>
                           <th class="maxt">Dirección:</th>
                           <td>
                              @{{detailClient.ubicacion}}
                           </td>
                           <td></td>
                        </tr>

                        <tr>
                           <th class="maxt">RFC:</th>
                           <td>@{{detailClient.nit}}</td>
                           <td></td>
                        </tr>

                        <tr>
                           <th class="maxt">Correo electrónico:</th>
                           <td>@{{detailClient.correo}}</td>
                           <td> </td>
                        </tr>

                        <tr>
                           <th class="maxt">Cantidad de pedidos:</th>
                           <td>@{{detailClient.cantidad_pedidos}}</td>
                           <td> </td>
                        </tr>

                        <tr>
                           <th class="maxt">Total de pedidos:</th>
                           <td>@{{detailClient.total_pedidos  | number:2}}</td>
                           <td> </td>
                        </tr>

                        <tr>
                           <th class="maxt">Creado:</th>
                           <td>@{{detailClient.fecha_creacion | date:'MM/dd/yyyy'}}</td>
                           <td> </td>
                        </tr>

                     </tbody>
                  </table>
               </div>

               <div class="conte_empre" ng-if="area_detalle==2">

                  <div class="col-sm-12 spd spi conbtn">
                     <h4>Proveedores</h4>
                  </div>

                  <table class="table">
                     <thead>
                        <tr class="tit_head">
                           <th class="maxt">Nombre del proveedor</th>
                           <th class="maxt">Categoría</th>
                           <th class="maxt">Teléfono</th>
                           <th>Cantidad pedidos</th>
                           <th>Total pedidos</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr ng-repeat="pedido in detailClient.pedidos">
                           <td>@{{pedido.proveedor}}</td>
                           <td>@{{pedido.categoria}}</td>
                           <td>@{{pedido.telefono}}</td>
                           <td>@{{pedido.cantidad_pedidos}} </td>
                           <td>@{{pedido.total_pedidos | number : 2}}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>

               {{-- PRODUCTOS --}}
               <div class="conte_empre" ng-if="area_detalle==3">

                  <div class="col-sm-12 spd spi conbtn">
                     <h4>Productos</h4>
                  </div>

                  <table class="table">
                     <thead>
                        <tr class="tit_head">
                           <th class="maxt">Nombre</th>
                           <th class="maxt">Cantidad</th>
                           <th class="maxt">Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr ng-repeat="pedido in detailClient.productos">
                           <td>@{{pedido.nombre}}</td>
                           <td>@{{pedido.cantidad}}</td>
                           <td>@{{pedido.total | number:2}}</td>
                        </tr>
                     </tbody>
                  </table>

               </div>



            </div>

         </div>
      </div>
   </div>

</div>
