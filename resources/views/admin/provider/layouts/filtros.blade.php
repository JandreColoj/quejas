<div class="contepa" style="margin-left: 50px; width:92%; margin-top:50px" >
   <div class="ed-container full spd spi ">
      <div class="ed-item s-100 spi spd">
         <div class="container_filtro">
            <form ng-submit="getRegistros()">
               <div class="row">
                  <div class="col-sm-2">
                     <label for="">Buscar por</label>
                     <input class="form-control" type="text"  ng-model="filtro.busqueda" placeholder="Comercio">
                  </div>

                  <div class="col-sm-2 spi">
                     <label for="estado">Region</label>
                     <ol class="nya-bs-select" ng-model="filtro.region"  title="Selecciona..." ng-change="getDepartamentos()">
                        <li nya-bs-option="region in regiones" data-value="region[0]['region']"  >
                           <a>
                              @{{ region[0]['region'] }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="col-sm-2 spi">
                     <label for="estado">Departamento</label>

                     <ol class="nya-bs-select" ng-model="filtro.departamento"  ng-change="getMunicipio()" title="Selecciona...">
                        <li nya-bs-option="depto in departamentos" data-value="depto.id"  >
                           <a>
                              @{{depto.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>

                  </div>

                  <div class="col-sm-2 spi">
                     <label for="estado">Municipio</label>

                     <ol class="nya-bs-select" ng-model="filtro.municipio"  title="Selecciona...">
                        <li nya-bs-option="muni in municipios" data-value="muni.id"  >
                           <a>
                              @{{muni.nombre}}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>

                  </div>

                  {{-- <div class="col-sm-2 spi">
                     <label>Fecha inicio</label>
                     <input class="form-control" type="date" placeholder="Fecha Inicio" ng-model="filtro.fechaInicio">
                  </div>

                  <div class="col-sm-2 spi">
                     <label>Fecha final</label>
                     <input class="form-control" type="date" placeholder="Fecha Final" ng-model="filtro.fechaFinal">
                  </div> --}}

                  <div class="col-sm-1 spi">
                     <input class="btn-busfiltro" type="submit">
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
