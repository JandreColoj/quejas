
<div class="col-sm-12"  ng-show="modalTarjeta">
    <div class="caja_modal" ></div>

    <div id="are_terminos" >
    <div class="header_area">
        <h1>Datos de la tarjeta</h1>
        <div class="areacerrar">
            <a ng-click="modalTarjeta=false" class="icocerrar"></a>
        </div>
    </div>

    <div  class="container_infoModulo">
        <div class="col-sm-12">

            <form class="mtop ed-item ed-container full" name="frm">

                <div class="ed-item s-100 main-center cross-center" ng-if="usuario.tarifa>0">
                <div class="text_inicior">
                    <p>Plan seleccionado <strong>@{{usuario.nombrePlan}}</strong> $ @{{usuario.tarifa | number: 2}} /mensuales </p>
                    <p>El cobro mensual se hará efectivo al momento de activar la empresa</p>
                </div>
                </div>

                <h2 class="tit_mcard">@{{menTitTarjeta}} </h2>
                <div class="ed-item s-100">
                <label for="">Nombre en la tarjeta</label>
                <input id="nameTarget" type="text" class="form-control text_card" name="nameTarget" ng-model="tarjeta.nameCard" autocomplete="off" required>
                </div>

                <div class="ed-item s-100">
                <label for="">Número de tarjeta</label>
                <p class="dnone__card"> </p>
                <div class="tipe_cardintnpos" style="@{{fondo}}" >
                    <input ng-change="showtCard()" id="accountNumber" type="tel" class="form-control text_card fondo_blanco" name="accountNumber" ng-model="tarjeta.accountNumber" mask="9999-9999-9999-9999" autocomplete="off" required>
                </div>
                </div>

                <div class="ed-item s-45">
                <label>Fecha de vencimiento</label>
                </div>

                <div class="ed-item s-50 main-end">
                <label for="">Código de Seguridad</label>
                <div class="btn_ayudacvv licocvv_soli" ng-click="dudacvv()"></div>
                </div>

                <div class="ed-item s-50">
                <div class="formpago_tarc">
                    <input type="text"
                            class="form-control text_card sinp"
                            name="expiration"
                            ng-model="tarjeta.expiration"
                            mask="99 / 99"
                            placeholder="12 / 20" required>
                </div>
                </div>

                <div class="ed-item s-50">
                <input id="Cvv" type="tel" class="form-control text_card sinp" name="Cvv" ng-model="tarjeta.Cvv"  maxlength="4" ng-maxlength="4" ng-pattern="/^[0-9]*$/" required>
                </div>

                <div class="ed-item s-100 main-center cross-center">
                <div class="text_inicior"> 
                    <!-- <h2>Los datos de tu tarjeta de crédito o débito son necesarios para la protección del consumidor final y por posibles contracargos que podrían surgir en el proceso de una venta.</h2> -->
                    <h2 class="descri" style="color:red"> *Se hará un cargo inicial de Q2.00 para verificar tu tarjeta.</h2>
                </div>
                </div>

                <div class="ed-container">
                <div class="ed-item s-50 main-center cross-start mbottom_cardpago mtop">
                    <button type = "button" class = "btn btn-primary btn-login" ng-click="CrearEmpresa(false)">
                        Omitir tarjeta
                    </button>
                </div>

                <div class="ed-item s-50 main-center cross-start mbottom_cardpago mtop">
                    <button type = "button" class = "btn btn-primary  btn-login" ng-click="CrearEmpresa(true)">
                        Validar tarjeta
                    </button>
                </div>
                </div>
            </form>

        </div>
    </div>
    </div>
</div>