 
 
<div class="caja_modal" ng-show="modal_venta">
   <div id="modal_nuevo" class="modal_dinamic" style="--width:500px; --height:650px;">
      <div class="header_area">
         <h1>Venta de M-POS </h1>
         <div class="areacerrar">
            <a ng-click="modal_venta=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmVenta" ng-submit="salePOS()">

               <div class="ed-container full pass_piloto">
 
                  <div class="ed-item s-100 spi">
                     <p> <b> Datos de facturación: </b> </p>
                  </div>

                  <div class="ed-item s-100 m-50 spi">
                     <label for="fecha">Fecha: </label>
                     <input type="date" class="form-control sinp" ng-model="venta.fecha" style="padding-top: 0px !important; padding-bottom: 0px !important;" required>
                  </div>

                  <hr>
                  <div class="ed-item s-100 m-50 spd">
                     <label for="nit">NIT: </label>
                     <input id="nit" type="text" class="form-control sinp" ng-model="venta.nit" required>
                  </div> 
 
                  <div class="ed-item s-100 m-100 spd spi">
                     <label for="nombre">Nombre: </label>
                     <input id="nombre" type="text" class="form-control sinp" ng-model="venta.nombre" placeholder="" required>
                  </div>
 
                  <div class="ed-item s-100 m-100 spd spi">
                     <label for="direccion">Dirección: </label>
                     <input id="direccion" type="text" class="form-control sinp" ng-model="venta.direccion" placeholder="" required>
                  </div>
                
                  <div class="ed-item s-100 m-50 spi">
                     <label for="telefono">Teléfono: </label>
                     <input id="telefono" type="number" class="form-control sinp" ng-model="venta.telefono" required>
                  </div>
                 
                  <div class="ed-item s-100 m-50 spd">
                     <label for="correo">Correo electronico: </label>
                     <input id="correo" type="email" class="form-control sinp" ng-model="venta.correo"  required>
                  </div>

                  
                  <div class="ed-item s-100 spi" style="margin-top: 25px">
                     <p> <b> Datos del M-POS: </b> </p>
                  </div>

                  <div class="ed-item s-100 m-50 spi">
                     <label for="Correlativo">Correlativo: </label>
                     <input id="Correlativo" type="text" class="form-control sinp" ng-model="venta.codigo" required>
                  </div>

                  <div class="ed-item s-100 m-50 spd">
                     <label for="cantidad">Cantidad: </label>
                     <input id="cantidad" type="integer" class="form-control sinp" ng-model="venta.cantidad" required>
                  </div>
                 
                  <div class="ed-item s-100 m-50 spi">
                     <label for="boleta">Boleta de pago: </label>
                     <input id="boleta" type="text" class="form-control sinp" ng-model="venta.boleta" required>
                  </div>

                  <div class="ed-item s-100 m-50 spd">
                     <label for="Valor">Valor: </label>
                     <input id="Valor" type="number" class="form-control sinp" ng-model="venta.valor" required>
                  </div>

               </div> 


               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmVenta.$invalid"> Aceptar </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="caja_modal" ng-show="modal_agencia">
   <div id="modal_nuevo" class="modal_dinamic" style="--width:600px; --height:550px;">
      <div class="header_area">
         <h1>Disponible </h1>
         <div class="areacerrar">
            <a ng-click="modal_agencia=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmSalida" ng-submit="subInventario()">

               <div class="ed-container full pass_piloto">
                  <div class="ed-item s-100 spi spd">
                     <label for="rol">Agencia:</label>
                     <ol class="nya-bs-select mol relcont" ng-model="select.agencia" data-size="5"  data-live-search="true" title="Selecciona..." ng-change="getInventarioAgencia(select.agencia)">
                        <li nya-bs-option="agencia in agencias" data-value="agencia.id">
                           <a>
                              @{{agencia.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div> 

                  <div class="ed-item s-100 spi spd" style="margin-top: 20px;">
                     <table class="table table-bordered table-striped">
                        <thead class="table_head_pedido">
                           <tr>
                              <th>No. </th>
                              <th>Fecha</th>
                              <th>Descripción</th> 
                              <th>Entrada</th>
                              <th>Salida</th>  
                              <th>Existencia</th>  
                           </tr>
                        </thead>

                        <tbody class="table_body_pedido">

                           <tr>
                              <td class="radius_left"> </td>
                              <td> </td> 
                              <td>  <b> TOTAL </b> </td>
                              <td>@{{ inventarioAgencia.ingreso }}</td>
                              <td>@{{ inventarioAgencia.salida }}</td>  
                              <td>@{{ inventarioAgencia.disponible }}</td>  
                           </tr>

                           <tr ng-repeat="data in inventarioAgencia.inventario">
                              <td class="radius_left">@{{$index+1}}</td>
                              <td>@{{data.fecha}}</td>
                              <td>@{{data.descripcion}}</td> 
                              <td>@{{data.tipo=='ingreso' ? data.cantidad : 0}}</td>
                              <td>@{{data.tipo=='salida' ? data.cantidad : 0}}</td>  
                              <td>0</td>  
                           </tr>

                        </tbody>
                     </table>
                  </div>

               </div> 

 
            </form>
         </div>
      </div>
   </div>
</div>

<!-- <div class="caja_modal" ng-show="modal_aceptar_ingreso">
   <div id="modal_nuevo" class="modal_dinamic" style="--width:400px; --height:300px;">
      <div class="header_area">
         <h1>Aceptar Ingreso </h1>
         <div class="areacerrar">
            <a ng-click="modal_aceptar_ingreso=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
           <form class="form-horizontal" name="frmSalida" ng-submit="subInventario()">

               <div class="ed-container full pass_piloto">
 
                  <div class="ed-item s-100 m-100 spi spd" style="margin-top: 25px;">
                     <label for="fecha">Fecha: </label>
                     <input type="date" class="form-control sinp" ng-model="salida.fecha"  required>
                  </div>  

               </div> 


               <div class="ed-container full">
                  <div class="ed-item s-50 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmSalida.$invalid" style="width: 125px;"> Aceptar </button>
                  </div>
                  <div class="ed-item s-50 main-center cross-center">
                     <button type="button" class="btn btn_save" ng-disabled="frmSalida.$invalid" style="width: 125px;"> Rechazar </button>
                  </div>
               </div>

            </form>

         </div>
      </div>
   </div>
</div> -->