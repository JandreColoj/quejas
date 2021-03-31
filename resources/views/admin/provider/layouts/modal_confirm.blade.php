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


<div class="modal fade" id="modal_editar_producto" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Editar comisión</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>

       <form ng-submit="setCommissionProduct()">

         <div class="modal-body ed-container">
            <div class="ed-item s-60">
               <p>Producto:  <b> @{{producto.nombre}} </b></p>
            </div>
            <div class="ed-item s-40">
               <input type="number" step="any" min="0" max="100" class="form-control text_card sinp" name="comision" ng-model="producto.comision" required>
            </div>
         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary back_morado">Confirmar</button>
         </div>

      </form>

     </div>
   </div>
</div>
