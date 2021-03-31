{{-- DETALLE DE OBSERVACIONES --}}
<div class="caja_modal z_loading" ng-if="modalObser">
   <div id="modal_nuevo" class="custom__obsers">
      <div class="header_area">
         <h1>Observaciones del Pedido</h1>
         <div class="areacerrar">
            <a ng-click="showObsers()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area">

         <table class="table table-borderless table_separate">
            <thead class="table_head_pedido">
               <tr>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th>Observación</th>
               </tr>
            </thead>

            <tbody class="table_body_pedido">
               <tr ng-repeat="observacion in selectPedido.observaciones">
                  <td>@{{observacion.created_at | date:'MM/dd/yyyy'}}</td>
                  <td> <b> @{{observacion.rol}} </b> </td>
                  <td>@{{observacion.observacion}}</td>
               </tr>
            </tbody>
         </table>

      </div>
   </div>
</div>
