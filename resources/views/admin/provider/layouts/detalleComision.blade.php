<div class="caja_modal" ng-show="modal_comision" id="form_detail_comision" >

   <div id="modal_nuevo" class="modal_dinamic" style="--width:650px; --height:650px;" >
      <div class="header_area">
         <h1>@{{provider.nombre_proveedor}} </h1>
         <div class="areacerrar">
            <a ng-click="modal_comision=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmComision">

               <div class="ed-container full pass_piloto">
                  <div class="ed-item s-100">
                     <p>Tipo de comisión: <b> @{{provider.tipoComision.nombre}} </b></p>
                  </div>

                  <br>

                  <div class="ed-item s-50">
                     <label for="estado">Año:</label>
                     <ol class="nya-bs-select mol" ng-model="datos.year"  title="Selecciona..." ng-change="detailComision()">

                        <li nya-bs-option="year in years" data-value="year" >
                           <a>
                              @{{year}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="ed-item s-50">
                     <label for="estado">Mes:</label>
                     <ol class="nya-bs-select mol" ng-model="datos.mes"  title="Selecciona..." ng-change="detailComision()">
                        <li nya-bs-option="mes in meses" data-value="mes.value" >
                           <a>
                              @{{ mes.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>
               </div>

               <hr>
               <div class="ed-container full">

                  <div class="ed-item s-100">
                     <div class="card" style="width: 50%;">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">Cantidad de Pedidos: <b>  @{{responseComision.total_pedidos}}  </b></li>
                          <li class="list-group-item">Total facturado:  <b> @{{responseComision.total_ventas | number:2}} </b></li>
                          <li class="list-group-item">Comisión: <b> @{{responseComision.comision | number:2}} </b> </li>
                        </ul>
                      </div>
                  </div>

                  <div class="ed-item s-100">
                     <b>DETALLE:</b>
                  </div>
                  <hr>
                  <div class="ed-item s-100" ng-if="provider.tipoComision.codigo=='TIPO_1'">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th>Ventas</th>
                              <th>%</th>
                              <th>Comisión</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr ng-repeat="detalle in responseComision.detalle">
                              <td>@{{detalle.monto | number:2}}</td>
                              <td>@{{detalle.porcentaje}}%</td>
                              <td>@{{detalle.comision | number:2}}</td>
                           </tr>
                           <tr>
                              <td colspan="2">Total</td>
                              <td><b>@{{ responseComision.comision | number:2 }}</b></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>

                  <div class="ed-item s-100" ng-if="provider.tipoComision.codigo=='TIPO_2' || provider.tipoComision.codigo=='TIPO_3'">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th>Pedidos</th>
                              <th>Acumulado</th>
                              <th>Monto por pedido</th>
                              <th>Comisión</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr ng-repeat="detalle in responseComision.detalle">
                              <td>@{{detalle.pedidos}}</td>
                              <td ng-if="provider.tipoComision.codigo=='TIPO_2'">@{{detalle.acumulado | number:2}}</td>
                              <td ng-if="provider.tipoComision.codigo=='TIPO_3'">@{{detalle.acumulado}}</td>
                              <td>@{{detalle.monto_pedido | number: 2}}</td>
                              <td>@{{detalle.comision | number:2}}</td>
                           </tr>
                           <tr>
                              <td colspan="3">TOTAL</td>
                              <td><b>@{{ responseComision.comision | number:2 }}</b></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>

                  <div class="ed-item s-100" ng-if="provider.tipoComision.codigo=='TIPO_4'">

                     <table class="table table-bordered ">
                        <thead>
                           <tr>
                              <th>SKU</th>
                              <th>Producto</th>
                              <th>Cantidad</th>
                              <th>Total</th>
                              <th>Porcentaje</th>
                              <th>Comisión</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr ng-repeat="detalle in responseComision.detalle">
                              <td>@{{detalle.sku}}</td>
                              <td>@{{detalle.nombre}}</td>
                              <td>@{{detalle.cantidad}}</td>
                              <td>@{{detalle.total | number: 2}}</td>
                              <td>@{{detalle.porcentaje}} %</td>
                              <td>@{{detalle.comision | number:2}}</td>
                           </tr>
                           <tr class="table-active">
                              <td colspan="2">TOTAL</td>
                              <td><b>@{{ responseComision.total_products}}</b></td>
                              <td><b>@{{ responseComision.total_ventas | number:2}}</b></td>
                              <td><b></b></td>
                              <td><b>@{{ responseComision.comision | number:2 }}</b></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>

               </div>

               <div class="ed-container full" ng-if="responseComision.total_ventas > 0">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="button" class="ico_pdf" ng-click="generatePDF_detail()"> </button>
                  </div>
               </div>

            </form>
         </div>
      </div>
   </div>


</div>
