{{-- Filtros --}}
<div class="caja_modal" ng-if="filtro_obj">
    <div id="area_fID">
        <div class="header_area">
            <h1>Filtrar transacciones</h1>
            <div class="areacerrar">
                <a ng-click="cerrarFiltro()" class="icocerrar"></a>
            </div>
        </div>

        <div  class="contenido_area coloblan">
            <div class="col-sm-12">
                <ul class="btnfil">
                    <li><a ng-click="actiFi(1)">Por fecha</a></li>
                    {{-- <li><a ng-click="actiFi(2)">Por empresa</a></li> --}}
                </ul>
            </div>

            <div class="col-sm-12 mtop">
                <form class="form-horizontal" name="frm" ng-submit="getPedidos()">
                    <div class="form-group fleft_phone" ng-if="pfecha">
                        <div class="col-sm-12 spd spi">
                            <div class="col-sm-8 spi">
                                <p for="">Por Fecha</p>
                            </div>
                            <div class="col-sm-4 spd">
                                <a class="btn-canfil" ng-click="canFiltro(1)">Quitar filtro</a>
                            </div>

                        </div>

                        <div class="col-sm-6 col-xs-6  spi fleft_phone">
                            <input type="date" class="form-control sinp" name="dia" ng-model="filtro.fecha_inicio" required>
                        </div>
                        <div class="col-sm-6 col-xs-6  spd fleft_phone">
                            <input type="date" class="form-control sinp" name="dia" ng-model="filtro.fecha_fin" required>
                        </div>
                    </div>

                    <div class="form-group fleft_phone" ng-if="pempresa">
                        <div class="col-sm-12 spd spi">
                            <div class="col-sm-8 spi">
                                <p for="">Por Empresa</p>
                            </div>
                            <div class="col-sm-4 spd">
                                <a class="btn-canfil" ng-click="canFiltro(2)">Quitar filtro</a>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12  spi spd fleft_phone">
                            <ol class="nya-bs-select mol" ng-model="filtro.empresa" data-live-search="true"  title="Empresa..." data-size="7" required>
                                <li nya-bs-option="empresa in empresas" data-value="empresa.id">
                                <a>
                                    @{{ empresa.nombre }}
                                    <span class="glyphicon glyphicon-ok check-mark"></span>
                                </a>
                                </li>
                            </ol>
                        </div>
                    </div>


                    <div class="form-group fleft_phone" ng-if="pfecha || pempresa">
                        <div class="col-sm-6 col-xs-12  col-sm-offset-3  spf">
                            <button type="submit" class="btn btn-primary  btn-login" ng-disabled="frm.$invalid"> Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
