 <div id="area_ID" ng-if="mas_obj">

   <div class="header_area">
      <h1>
         Proveedor: @{{provider.nombre_proveedor}}
      </h1>
      <div class="areacerrar">
         <a ng-click="cerrar_ID()" class="icocerrar"></a>
      </div>
   </div>

   <div class="contenido_area" style="margin-top: 25px;">
      <div class="col-sm-12 spd spi">

         <div class="datos_empresaphone col-sm-12">
            <div class="cont_cate">
               <p><strong>Categoria: </strong></p>
               <p>@{{provider.categoria.nombre}}</p>
            </div>

            <div class="cont_usuario">
               <p><strong>Usuario principal: </strong></p>
               <p>@{{provider.adicional_empresa.nombres}}</p>
            </div>

            <div class="cont_moneda">
               <p><strong>Moneda: </strong></p>
               <p>@{{provider.moneda}}</p>
            </div>
         </div>

         <div class="col-sm-12 winfo_phone">

            <!-- MENU DE REGISTRO -->
            <div class="col-sm-2 container__phone">
               <div class="menumas menumas__phone">
                  <ul>
                     <li><a ng-click="habiEmpresa(1)" ng-class="{'selecme':areaEmpresa==1}">Empresa</a></li>
                     <li><a ng-click="habiEmpresa(2)" ng-class="{'selecme':areaEmpresa==2}">Bancos</a></li>
                     <li><a ng-click="habiEmpresa(3)" ng-class="{'selecme':areaEmpresa==3}" ng-if="provider.estado_registro>5">Área de influencia</a></li>
                     <li><a ng-click="habiEmpresa(4)" ng-class="{'selecme':areaEmpresa==4}">Tipo de comisión</a></li>
                     <li><a ng-click="habiEmpresa(5)" ng-class="{'selecme':areaEmpresa==5}">Productos</a></li>
                     <li><a ng-click="habiEmpresa(6)" ng-class="{'selecme':areaEmpresa==6}">Promociones</a></li>
                  </ul>
               </div>
               <div class="infomail">
                  <h2> @{{provider.confirmed==1 ? 'Email verificado correctamente!' : 'Email no ha sido verificado!'}}</h2>
               </div>
            </div>

            <!--  OPCIONES DE EMPRESA -->
            <div class="col-sm-10 fleft__phone">

               {{-- Empresa --}}
               <div class="conte_empre" ng-if="areaEmpresa==1">
                  <div class="form-group col-sm-12 dflex_centerr">

                     <div class="content_startactive" ng-if="!cambioEstadop">
                        <h4>Empresa</h4>
                     </div>

                     {{-- <div class="content_startactive" ng-if="provider.perfil_usuario.estado!=10">
                        <button type="button" class="btn btn_ayuda" ng-click="editarEmpresa(provider)">
                           Editar información
                        </button>
                     </div> --}}

                  </div>

                  <table class="table">
                     <thead>
                        <tr class="tit_head">
                           <th class="maxt">Segmento</th>
                           <th class="maxt">Descripción</th>
                           <th class="maxt">Opciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th class="maxt">Nombre de la empresa</th>
                           <td>@{{provider.nombre_proveedor}}</td>
                           <td></td>
                        </tr>

                        <tr>
                           <th class="maxt">Dirección de la empresa</th>
                           <td>
                              @{{provider.adicional_empresa.calle}}
                              exterior: @{{provider.adicional_empresa.exterior}}
                              interior: @{{provider.adicional_empresa.interior}}
                              @{{provider.adicional_empresa.colonia}},
                              @{{provider.adicional_empresa.municipio}},
                              @{{provider.adicional_empresa.estado_}}</td>
                           <td></td>
                        </tr>

                        <tr>
                           <th class="maxt">Código postal</th>
                           <td>@{{provider.adicional_empresa.codigo_postal}}</td>
                           <td></td>
                        </tr>

                        <tr>
                           <th class="maxt">RFC</th>
                           <td>@{{provider.nit}}</td>
                           <td></td>
                        </tr>

                        <tr>
                           <th class="maxt">Email principal</th>
                           <td>@{{provider.email}}</td>
                           <td> </td>
                        </tr>

                        <tr>
                           <th class="maxt">Cantidad de clientes</th>
                           <td>@{{provider.adicional_empresa.numero_clientes}}</td>
                           <td> </td>
                        </tr>

                        <tr>
                           <th class="maxt">Cantidad de empleados</th>
                           <td>@{{provider.adicional_empresa.numero_empleados}}</td>
                           <td> </td>
                        </tr>

                        <tr>
                           <th class="maxt">Cantidad de productos</th>
                           <td>@{{provider.adicional_empresa.numero_productos}}</td>
                           <td> </td>
                        </tr>

                        <tr>
                           <th class="maxt">Cantidad de rutas</th>
                           <td>@{{provider.adicional_empresa.numero_rutas}}</td>
                           <td> </td>
                        </tr>

                        <tr>
                           <th class="maxt">Cantidad reserva de pedido</th>
                           <td>@{{provider.moneda}} @{{provider.reserva_pedido | number: 2}}</td>
                           <td> </td>
                        </tr>

                        <tr>
                           <th class="maxt">Creado:</th>
                           <td>@{{provider.fecha_creacion | date:'MM/dd/yyyy'}}</td>
                           <td> </td>
                        </tr>

                     </tbody>
                  </table>
               </div>

               {{-- Banco --}}
               <div class="conte_empre" ng-if="areaEmpresa==2">

                  <div class="col-sm-12 spd spi conbtn">
                     <h4>Banco</h4>
                     {{-- <div class="btn_nuevo" ng-if="provider.perfil_usuario.estado!=10">
                        <a ng-click="nuevoBanco(provider.id)">Nuevo Banco</a>
                     </div> --}}
                  </div>

                  <table class="table">
                     <thead>
                        <tr class="tit_head">
                           <th class="maxt">Nombre del Banco</th>
                           <th>Nombre</th>
                           <th>Número</th>
                           <th>Clave</th>
                           <th>Estado de cuenta</th>
                           <th>Identificación</th>
                           <th>Identificación</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr ng-repeat="banco in provider.banco_blm">
                           <td>@{{banco.banco}}</td>
                           <td>@{{banco.nombres}} @{{banco.apellido_paterno}} @{{banco.apellido_materno}}</td>
                           <td>@{{banco.No_cuenta}}</td>
                           <td>@{{banco.clabe}}</td>
                           <td ng-if="banco.url_estado_cuenta!=''" > <a href="@{{banco.url_estado_cuenta}}" target="_blank" >Ver</a></td>
                           <td ng-if="banco.url_identificacion_frontal!=''"> <a href="@{{banco.url_identificacion_frontal}}" target="_blank" >Ver</a></td>
                           <td ng-if="banco.url_identificacion_posterior!=''"> <a href="@{{banco.url_identificacion_posterior}}" target="_blank" >Ver</a></td>
                        </tr>
                     </tbody>
                  </table>
               </div>

               {{-- Mapa --}}
               <div class="conte_empre" ng-if="areaEmpresa==3">

                  <div class="content_maps" style="margin-top: 25px;">
                     <div class="ed-item ed-container full cross-center">
                        <div class="ed-container s-100 mtop">
                           <div class="ed-item s-100">

                              <div id="map" style="width: 100%; height: 500px; border: solid 2px #7200C6; border-radius: 10px;">  </div>
                              {{-- <div id="info" style="position: absolute; font-family: arial, sans-serif; font-size: 11px;"> </div> --}}

                           </div>
                        </div>

                     </div>
                  </div>

               </div>

               {{-- area de comision --}}
               <div class="conte_empre" ng-if="areaEmpresa==4">

                  <div class="content_maps" style="margin-top: 25px;">
                     <div class="ed-item ed-container full cross-center">
                        <div class="ed-container s-100 mtop">

                           <div class="ed-item s-100">
                              <div class="card text-center">

                                 <div class="card-header" style="font-size: 20px; font-weight: 600;">
                                    @{{provider.tipoComision.nombre}}
                                 </div>

                                 <div class="card-body">
                                    <p class="card-text">@{{provider.tipoComision.descripcion}}</p>

                                    <div class="ed-container cross-center main-center">
                                       <div class="ed-item s-50">
                                          <ol class="nya-bs-select mol" ng-model="datos.tipo_comision"  title="Selecciona...">
                                             <li nya-bs-option="tipo in tipos_comision" data-value="tipo.id" >
                                                <a>
                                                   @{{ tipo.nombre }}
                                                   <span class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                             </li>
                                          </ol>
                                       </div>

                                       <div class="ed-item s-100" style="margin-top: 20px">
                                          <a href="#" class="btn btn-primary back_morado" ng-click="setTipoComision()">Cambiar</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>

               </div>

               {{-- PRODUCTOS --}}
               <div class="conte_empre" ng-if="areaEmpresa==5">

                  <div class="ed-container spd spi conbtn">

                     <div class="ed-item s-60">
                        <h4>Productos</h4>
                     </div>

                     <div class="ed-item s-15">
                        <button type="button" class="btn btn-primary back_morado" ng-click="dowloadProducts()">Descargar plantilla</button>
                     </div>

                     <div class="ed-item s-25">
                        <div class="form-group container_formcuentas">
                           <label for="excel" class="label_filec">
                              <span>@{{nombreArchivo}}</span>
                              <strong>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25">
                                    <path fill="#fff" d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                                 </svg>
                                 <p>Carga masiva</p>
                              </strong>
                           </label>
                           <js-xls onread="read" onerror="error" class="form-control snip input_file inputfile" style="visibility:hidden;" id="excel"></js-xls>
                        </div>
                     </div>

                  </div>

                  <table class="table">
                     <thead>
                        <tr class="tit_head">
                           <th class="maxt">SKU</th>
                           <th>NOMBRE</th>
                           <th>STOCK</th>
                           <th>PRESENTACIÓN</th>
                           <th>PRECIO</th>
                           <th>COMISIÓN</th>
                           <th>EDITAR</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr ng-repeat="producto in productos">
                           <td>@{{producto.sku}}</td>
                           <td>@{{producto.nombre}}</td>
                           <td>@{{producto.stock}}</td>
                           <td>@{{producto.presentacion[0].medida}}</td>
                           <td>@{{producto.presentacion[0].precio | number:2}}</td>
                           <td> <b> @{{producto.comision | number:2}} % </b></td>
                           <td>
                              <span class="icoeditartarifa icotfaq"  uib-tooltip="Editar" ng-click="nueva_ventana('MODAL_EDITAR_PRODUCTO', producto)"></span>
                           </td>

                        </tr>
                     </tbody>
                  </table>
               </div>

               {{-- PROMOCIONES --}}
               <div class="conte_empre" ng-if="areaEmpresa==6">

                  <div class="ed-container spd spi conbtn">
                     <div class="ed-item s-60">
                        <h4>Promociones</h4>
                     </div>
                  </div>

                  {{-- Filtro de busqueda --}}
                  <div class="ed-container full">
                     <div class="ed-item s-100 spi spd">
                        <div class="container_filtro">
                           <form ng-submit="getPromociones()">
                              <div class="row">
                                 <div class="col-sm-3">
                                    <label for="estado">Estado</label>
                                    <ol class="nya-bs-select" ng-model="filtro.estado_promo"  title="Selecciona..."  data-size="10" ng-change="getPromotions(provider.id)">
                                       <li nya-bs-option="estado in estados_promo" data-value="estado.nombre">
                                          <a>
                                             @{{ estado.nombre}}
                                             <span class="glyphicon glyphicon-ok check-mark"></span>
                                          </a>
                                       </li>
                                    </ol>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>

                  <table class="table table-borderless table_separate">
                     <thead class="table_head_pedido">
                        <tr>
                           <th>Creado</th>
                           <th>Producto</th>
                           <th>Título</th>
                           <th>Descripción</th>
                           <th>Fecha Inicio</th>
                           <th>Fecha Fin</th>
                           <th>Pedidos</th>
                           {{-- <th>Opciones</th> --}}
                        </tr>
                     </thead>

                     <tbody class="table_body_pedido">
                        <tr ng-repeat="promo in promotions">
                           <td ng-click="verPromo(promo)">@{{promo.created_at}}</td>
                           <td ng-click="verPromo(promo)">@{{promo.producto}}</td>
                           <td class="radius_left" ng-click="verPromo(promo)">@{{promo.titulo}}</td>
                           <td ng-click="verPromo(promo)">@{{promo.descripcion}}</td>
                           <td ng-click="verPromo(promo)">@{{promo.date_start}}</td>
                           <td ng-click="verPromo(promo)">@{{promo.date_end}}</td>
                           <td ng-click="verPromo(promo)">@{{promo.total_pedidos}}</td>
                           {{-- <td class="radius_right">
                              <a ng-click="modalEditar(promo)" class="ico_editpromo icon_typpy" data-tippy-content="Editar" ng-if="filtro.estado=='Activo' || filtro.estado=='Finalizado' || filtro.estado=='Futuras'" ></a>
                              <a ng-click="eliminarPromo(promo.id)" class="ico_suprpromo icon_typpy" data-tippy-content="Desactivar" ng-if="filtro.estado=='Activo' || filtro.estado=='Futuras'"></a>
                              <a ng-click="ActivarPromo(promo.id)" class="ico_visualizar icon_typpy" data-tippy-content="Activar" ng-if="filtro.estado=='Inactivo'"></a>
                           </td> --}}
                        </tr>
                     </tbody>
                  </table>

               </div>

            </div>

         </div>

      </div>
   </div>

</div>
