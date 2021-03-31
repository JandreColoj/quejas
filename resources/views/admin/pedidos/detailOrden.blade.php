{{-- Estatus Pedido --}}
   <div class="my_modalpg" ng-show="fondodetalle">
      <div class="modalpg_dialog">
         <div id="area_detallepedido" ng-show="verdetalle">
            <div class="header_dprocuto no_border">
               <h1 class="title_pedido">Pedido No. @{{ selectPedido.no_orden}}</h1>
               <div class="areacerrar">
                  <a ng-click="hiddeDetalle()" class="icocerrar"></a>
               </div>
            </div>

            <div class="container_statuspedido">

               <div class="proces_order">
                  <h1>Proceso de pedido</h1>
                  <div class="content_icons__process">
                     <div class="icon_process ico_pnueva"      ng-class="{'icon_op': !nuevo_pedido}"></div>
                     <div class="icon_process ico_pbodega"     ng-class="{'icon_op': !bodega}"></div>
                     <div class="icon_process ico_pfactura"    ng-class="{'icon_op': !facturacion}"></div>
                     <div class="icon_process ico_pruta"       ng-class="{'icon_op': !ruta_pedido}"></div>
                     <div class="icon_process ico_pentregado"  ng-class="{'icon_op': !entregado}"></div>
                     <div class="icon_process ico_pincompleto" ng-if="incompleto && !entregado" ng-class="{'icon_op': !incompleto}"></div>

                     <div class="content_line__proces">
                        <div class="line_pedido" ng-class="{'cl_order': nuevo_pedido, 'cl_bodega': bodega, 'cl_fac': facturacion, 'cl_ruta': ruta_pedido, 'cl_entregado': entregado || incompleto}">
                        </div>
                     </div>
                  </div>

                  {{-- <div class="content_datosvitacora">
                     <p>@{{selectPedido.created_at | date:'MM/dd/yyyy'}}         <strong> @{{selectPedido.created_at | date:'MM/dd/yyyy'}}</strong> </p>
                     <p>@{{bitacora.bodega.created_at | date:'MM/dd/yyyy'}}      <strong> @{{bitacora.bodega.created_at | date:'MM/dd/yyyy'}}</strong> </p>
                     <p>@{{bitacora.facturacion.created_at | date:'MM/dd/yyyy'}} <strong> @{{bitacora.facturacion.created_at | date:'MM/dd/yyyy'}}</strong> </p>
                     <p>@{{bitacora.ruta.created_at | date:'MM/dd/yyyy'}}        <strong> @{{bitacora.ruta.created_at | date:'MM/dd/yyyy'}}</strong> </p>
                     <p>@{{bitacora.completado.created_at | date:'MM/dd/yyyy'}}  <strong> @{{bitacora.completado.created_at | date:'MM/dd/yyyy'}}</strong> </p>
                  </div> --}}
               </div>

               <div class="datos_pedido">
                  <h1><b> Ficha de Pedido </b></h1>

                  <div class="ed-container full">

                     <div class="ed-item s-50 spi">
                        <div class="content_info">
                           <p><b>Cliente:</b> @{{ selectPedido.cliente.empresa}}</p>
                           <p><b>Contacto:</b> @{{ selectPedido.cliente.nombre }}</p>
                           <p><b>Dirección:</b> @{{ selectPedido.direccion.ubicacion}}</p>
                           <p><b>Teléfono:</b> @{{ selectPedido.cliente.telefono }}</p>
                           <p><b>Tipo de pedido:</b> @{{ selectPedido.usuario.tipo.nombre }}</p>
                        </div>
                     </div>

                     <div class="ed-item s-50 spd">
                        <div class="content_info">
                           <p><b>Piloto:</b> @{{ selectPedido.piloto.user.name}}</p>
                           <p><b>Teléfono:</b> @{{ selectPedido.piloto.user.telefono }}</p>
                           {{-- <p><b>Vendedor:</b> @{{ selectPedido.vendedor.user.name}} @{{ selectPedido.vendedor.user.telefono }}</p> --}}
                           {{-- <p><b>Bodega de salida:</b> @{{ selectPedido.direccion.ubicacion }}</p> --}}
                           <p><b>Entrega estimada:</b> @{{selectPedido.fecha_entrega | date:'MM/dd/yyyy'}}</p>
                           <p><b>Forma de Pago:</b> @{{ selectPedido.metodo_pago.metodo.nombre }}
                           <p ng-if="selectPedido.observaciones.length > 0">  <span class="observacion" ng-click="showObsers()">Ver observaciones</span></p>
                        </div>
                     </div>
                  </div>

                  {{-- LISTADO DE PRODUCTOS --}}
                  <div class="ed-container full">

                     {{-- PEDIDO EN BODEGA Y FACTURACION --}}
                     <div class="ed-item ed-container full spi spd" >
                        <div class="container_titlebox__pedido" ng-class="{'p_scroll': selectPedido.productos_pedidos.length >= 7}">
                           <div class="ed-item ed-container full head_box__productostitle">
                              <div class="ed-item s-20 main-start cross-center">SKU</div>
                              <div class="ed-item s-50 main-start cross-center">Producto</div>
                              <div class="ed-item s-10 main-center cross-center">Cantidad</div>
                              <div class="ed-item s-10 main-center cross-center">Precio</div>
                              <div class="ed-item s-10 main-center cross-center">Subtotal</div>
                           </div>
                        </div>

                        <div class="scroll_pedidos">
                           <div class="ed-container full box_detalleproducto" ng-class="{'mb_nuevopedido': nuevo_pedido, 'mb_proceso': !nuevo_pedido}">
                              <div class="ed-item ed-container full body_box" ng-repeat="item in selectPedido.productos_pedidos">
                                 <div class="ed-item s-20 content__sku sku_order">@{{ item.producto.sku }}</div>
                                 <div class="ed-item s-50">@{{ item.producto.nombre }}</div>
                                 <div class="ed-item s-10 main-center cross-center">
                                    @{{ item.cantidad }} @{{ item.medida }}
                                 </div>
                                 <div class="ed-item s-10 main-center cross-center">
                                    @{{selectPedido.moneda.simbolo}} @{{ item.precio | number:2 }}
                                 </div>
                                 <div class="ed-item s-10 main-center cross-center">
                                    @{{selectPedido.moneda.simbolo}} @{{ item.precio * item.cantidad | number:2 }}
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>



               <div class="content_total">
                  <h2>Total pedido <span>@{{selectPedido.moneda.simbolo}} @{{ selectPedido.total | number:2 }}</span></h2>
               </div>
            </div>
         </div>
      </div>
   </div>
{{-- Fin Estatus Pedido --}}
