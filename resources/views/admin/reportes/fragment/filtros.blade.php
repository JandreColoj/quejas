<div class="ed-container full">
   <div class="container_filtro cont_btnsfill">
      <form ng-submit="generateReportGeneral()">
         <div class="ed-item ed-container full main-center cross-center">

            <div class="ed-item ed-container s-100 spi main-end cross-center">
               <div class="ed-item s-100 m-20 spi">
                  <label for="">Fecha inicio:</label>
                  <input id="fechaInicio" class="form-control" type="date" placeholder="Fecha Inicio" ng-model="filtro.fecha_inicio">
               </div>

               <div class="ed-item s-100 m-20 spi">
                  <label for="">Fecha final:</label>
                  <input id="fechaFinal" class="form-control" type="date" placeholder="Fecha Final" ng-model="filtro.fecha_fin">
               </div>

               <div class="ed-item s-100 m-20 spi">
                  <label for="estado">Estado pedido:</label>
                  <ol class="nya-bs-select" ng-model="filtro.estado"  title="Selecciona..." >
                     <li nya-bs-option="estado in estados" data-value="estado.codigo">
                        <a>
                           @{{ estado.nombre }}
                           <span class="glyphicon glyphicon-ok check-mark"></span>
                        </a>
                     </li>
                  </ol>
               </div>

               <div class="ed-item s-100 m-20 spi">
                  <label for="estado">Proveedor:</label>
                  <ol class="nya-bs-select" ng-model="filtro.id_provider"  title="Selecciona..." data-size="5"   data-live-search="true" >
                     <li nya-bs-option="provider in providers" data-value="provider.id">
                        <a>
                           @{{ provider.nombre }}
                           <span class="glyphicon glyphicon-ok check-mark"></span>
                        </a>
                     </li>
                  </ol>
               </div>

               <div class="ed-item s-100 m-15 spi">
                  <label for="estado">Cliente:</label>
                  <ol class="nya-bs-select" ng-model="filtro.id_client"  title="Selecciona..." data-size="5"   data-live-search="true" >
                     <li nya-bs-option="client in clients" data-value="client.id">
                        <a>
                           @{{ client.nombre }}
                           <span class="glyphicon glyphicon-ok check-mark"></span>
                        </a>
                     </li>
                  </ol>
               </div>

               <div class="ed-item s-100 m-5 spi">
                  <input class="btn-busfiltro" type="submit">
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
