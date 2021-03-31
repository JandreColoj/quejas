<!-- OPTIONS -->
<div class="caja_modal" ng-show="modal_option">
   <div id="modal_nuevo" class="modal_dinamic" style="--width:350px; --height:200px;">
      <div class="header_area">
         <h1>Opciones: </h1>
         <div class="areacerrar">
            <a ng-click="modal_option=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <div class="ed-container full">
               <div class="ed-item s-50 main-center cross-center">
                  <button type="button" class="btn btn_save" style="width: 125px;" ng-click="nueva_ventana('ENTRADA')"> Entrada </button>
               </div>
               <div class="ed-item s-50 main-center cross-center" >
                  <button type="button" class="btn btn_save" style="width: 125px;" ng-click="nueva_ventana('SALIDA')"> Salida </button>
               </div>
            </div> 
         </div>
      </div>
   </div>
</div>

<div class="caja_modal" ng-show="modal_entrada">
   <div id="modal_nuevo" class="modal_dinamic" style="--width:350px; --height:450px;">
      <div class="header_area">
         <h1>Ingreso de M-POS </h1>
         <div class="areacerrar">
            <a ng-click="modal_entrada=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmMeta" ng-submit="setInventario()">

               <div class="ed-container full pass_piloto">
 
                  <div class="ed-item s-100 m-100 spi spd" style="margin-top: 25px;">
                     <label for="fecha">Fecha: </label>
                     <input type="date" class="form-control sinp" ng-model="ingreso.fecha"  required>
                  </div>

                  <div class="ed-item s-100 m-100 spi spd">
                     <label for="codigo">Correlativo: </label>
                     <input type="text" class="form-control sinp" ng-model="ingreso.codigo" required>
                  </div>
                  
                  <div class="ed-item s-100 m-100 spi spd">
                     <label for="codigo">Descripción: </label>
                     <input type="text" class="form-control sinp" ng-model="ingreso.descripcion" required>
                  </div>
 
                  <div class="ed-item s-100 m-100 spi spd">
                     <label for="cantidad">Cantidad: </label>
                     <input type="number" class="form-control sinp" ng-model="ingreso.cantidad" placeholder="100" required>
                  </div>

               </div>

               {{-- ERRORES DE VALIDACION --}}
               @include('fragment.error')

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmMeta.$invalid"> Aceptar </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="caja_modal" ng-show="modal_salida">
   <div id="modal_nuevo" class="modal_dinamic" style="--width:350px; --height:550px;">
      <div class="header_area">
         <h1>Salida de M-POS </h1>
         <div class="areacerrar">
            <a ng-click="modal_salida=false" class="icocerrar"></a>
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

                  <div class="ed-item s-100 m-100 spi spd">
                     <label for="codigo">Correlativo: </label>
                     <input type="text" class="form-control sinp" ng-model="salida.codigo" required>
                  </div> 
 
                  <div class="ed-item s-100 m-100 spi spd">
                     <label for="cantidad">Cantidad: </label>
                     <input type="number" class="form-control sinp" ng-model="salida.cantidad" placeholder="100" required>
                  </div>

                  <div class="ed-item s-100 spi spd">
                     <label for="rol">Agencia:</label>
                     <ol class="nya-bs-select mol relcont" ng-model="salida.agencia" data-live-search="true" data-size="5" title="Selecciona..." required>
                        <li nya-bs-option="agencia in agencias" data-value="agencia.id">
                           <a>
                              @{{agencia.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

               </div> 


               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmSalida.$invalid"> Aceptar </button>
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
         <h1>Inventario por agencia </h1>
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

<div class="caja_modal" ng-show="modal_disponible">
   <div id="modal_nuevo" class="modal_dinamic" style="--width:600px; --height:550px;">
      <div class="header_area">
         <h1>Disponible </h1>
         <div class="areacerrar">
            <a ng-click="modal_disponible=false" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop"> 

               <div class="ed-container full pass_piloto">
 
                  <div class="ed-item s-100 spi spd" style="margin-top: 20px;">
                     <table class="table table-bordered table-striped">
                        <thead class="table_head_pedido">
                           <tr>
                              <th>No. </th>
                              <th>Nombre</th>
                              <th>Ingresos</th> 
                              <th>Salidas</th> 
                              <th>Existencia</th>  
                           </tr>
                        </thead>

                        <tbody class="table_body_pedido">
 
                           <tr ng-repeat="data in inventarioAll">
                              <td class="radius_left">@{{$index+1}}</td>
                              <td>@{{data.nombre}}</td> 
                              <td>@{{data.ingreso}}</td>
                              <td>@{{data.salida}}</td>  
                              <td>@{{data.disponible}}</td>   
                           </tr>

                        </tbody>
                     </table>
                  </div>

               </div>  

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