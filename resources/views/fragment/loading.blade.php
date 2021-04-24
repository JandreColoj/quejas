<div class="caja_modal z_loading" ng-show="modalError || modalSuccess || loadding">

   <div class="caja_cargando2" ng-class="{'modal_infoss': modal_error}">

      <div class="col-sm-12" ng-show="loadding">
         <div class="cargador topg"></div>
         <p>@{{mensaje}}</p>
      </div>

      <div class="col-sm-12" ng-show="modalSuccess">
         <div class="tranacep topac"></div>
         <p>@{{mensaje}}</p>
         <div class="col-sm-12">
            <a class="btn btn-primary  btn-login" style="background: #0077BB" ng-click="cerrar()">Cerrar</a>
         </div>
      </div>

      <div class="col-sm-12 elerror" ng-show="modalError">
         <div class="tranerror topac"></div>
         <p>@{{mensaje}}</p>
         <div class="col-sm-12">
            <a class="btn btn-primary btn-login"  style="background: #0077BB"ng-click="cerrar()">Cerrar</a>
         </div>
      </div>

   </div>
</div>
