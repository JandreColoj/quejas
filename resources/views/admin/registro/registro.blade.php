@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRITP --}}
{{-- Controller/Admin/RegistroCtrl.js --}}

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="container_register__cliente" ng-controller="RegistroCtrl" ng-cloak>

   <div class="areacontenido col-sm-12">

      {{-- LOADDING --}}
      @include('fragment.loading')
 
      {{-- CARD --}}
      @include('admin.registro.modalCard')

      <div class="menu_register">
         <div class="icon_cinta"></div>
         <div class="content_title_text">
            <h1 ng-if="modal_select_plan">Selecciona un plan</h1>
            <h1 ng-if="modal_informacion">Datos de usuario y negocio</h1>
         </div>
      </div>
 
      <div class="container_stepsregister"> 
         <!-- SELECCIONAR PLAN -->
         <div class="container_cardplan" ng-if="modal_select_plan">
            <div class="ed-container main-center cross-center">
               
               <div class="ed-item s-100 m-25" ng-click="selectPlan('free')">
                  <div class="card_plan plan_basico" style="height: 550px;" ng-class="{'active_card':basico}">
                     <div class="header_card">
                        <h1>Básico</h1>
                        <small>$0 al mes</small>
                     </div>

                     <div class="body_cardplan">
                        <div class="content_feature" ng-if="!verHerramienta1">
                           <ul>
                              <li class="icor_user">@{{planBasico.max_usuarios}} Usuarios</li>
                              <li class="icor_report">Reportes básicos</li>
                              <li class="icor_deposito">@{{planBasico.liquidacion_semana}} Deposito por semana</li>
                              <li class="icor_products">Carga hasta @{{planBasico.max_productos}} productos</li>
                              <li class="icor_sales">
                                 Ventas por mes @{{planBasico.max_ventas_usd |number:2}}
                                 <small>(Q @{{planBasico.max_ventas_gtq |number:2}})</small>
                              </li>
                           </ul>

                           <div class="content_priceplan">
                              {{-- @{{planBasico.plan.porcentaje_cybs}} --}}
                              <h2>@{{planBasico.plan.porcentaje}}% <small>+ $0.25</small></h2>
                              <p>por transacción</p>
                           </div>

                           <div class="contetn_btnplan">
                              <button class="btn btn_tools free" ng-click="habiHerramientas('basico')" ng-if="motrarHerramientas">
                                 Ver Herramientas
                              </button>
                           </div>
                        </div>

                        <div class="cardr_descripciont">
                           <div class="container_optionherramientas" ng-if="verHerramienta1">
                              <ul>
                                 <li class="ico_habicheck">Solicitud de Pago</li>
                                 <li class="ico_habicheck">Venta Rápida</li>
                                 <li class="ico_habicheck">Pasarela de Pago</li>
                                 <li class="ico_desabi">Tienda en Linea Básica</li>
                                 <li class="ico_desabi">Pagos Recurrentes</li>
                                 <li class="ico_desabi">Cuotas Visa y MasterCard</li>
                                 <li class="ico_desabi">Tokenización</li>
                              </ul>
                           </div>

                           <div class="content_feature">
                              <div class="contetn_btnplan">
                                 <button class="btn btn_tools free" ng-click="habibtnHerramientas('basico')" ng-if="regresarHerramientas">
                                    Regresar
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="ed-item s-100 m-25" ng-click="selectPlan('premium')">
                  <div class="card_plan plan_premium" style="height: 550px;" ng-class="{'active_card':premium}">
                     <div class="header_card">
                        <h1>Premium</h1>
                        <small>$@{{planPremium.plan.tarifaUSD}} al mes</small>
                     </div>

                     <div class="body_cardplan">
                        <div class="content_feature" ng-if="!verHerramienta2">
                           <ul>
                              <li class="icor_user">@{{planPremium.max_usuarios}} Usuarios</li>
                              <li class="icor_report">Reportes básicos</li>
                              <li class="icor_deposito">@{{planPremium.liquidacion_semana}} Deposito por semana</li>
                              <li class="icor_products">Carga ilimitada de productos</li>
                              <li class="icor_depo">Tienda Avanzada</li>
                           </ul>

                           <div class="content_priceplan">
                              {{-- @{{planPremium.plan.porcentaje_cybs}} --}}
                              <h2>@{{planPremium.plan.porcentaje}}% <small>+ $0.25</small></h2>
                              <p>por transacción</p>
                           </div>

                           <div class="contetn_btnplan">
                              <button class="btn btn_tools premium" ng-click="habiHerramientas('premium')" ng-if="motrarHerramientas2">
                                 Ver Herramientas
                              </button>
                           </div>
                        </div>

                        <div class="cardr_descripciont">
                           <div class="container_optionherramientas" ng-if="verHerramienta2">
                              <ul>
                                 <li class="ico_habicheck">Solicitud de Pago</li>
                                 <li class="ico_habicheck">Venta Rápida</li>
                                 <li class="ico_habicheck">Tienda en Linea</li>
                                 <li class="ico_habicheck">Pasarela de Pago</li>
                                 <li class="ico_habicheck">Pagos Recurrentes</li>
                                 <li class="ico_habicheck">Cuotas Visa y MasterCard</li>
                                 <li class="ico_habicheck">Tokenización</li>
                              </ul>
                           </div>

                           <div class="content_feature">
                              <div class="contetn_btnplan">
                                 <button class="btn btn_tools premium" ng-click="habibtnHerramientas('premium')" ng-if="regresarHerramientas2">
                                    Regresar
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="ed-item s-100 m-25" ng-click="selectPlan('enter')">
                  <div class="card_plan plan_enterprise" style="height: 550px;" ng-class="{'active_card':enterprise}">
                     <div class="header_card">
                        <h1>Enterprise</h1>
                        <small>$ 150 al mes</small>
                     </div>

                     <div class="body_cardplan">
                        <div class="content_feature" ng-if="!verHerramienta3">
                           <ul>
                              <li class="icor_liquien">Liquidaciones diarias</li>
                              <li class="icor_reporten">Reportería relevante a tu industria</li>
                              <li class="icor_soen">Soporte técnico personalizado</li>
                              <li class="ico_useren">Usuarios ilimitados</li>
                              <li class="icor_featureen">Herramientas de pago personalizadas</li>
                           </ul>

                           <div class="section_pre">
                              <p>Tarifa preferencial por transacción</p>
                           </div>

                           <div class="contetn_btnplan">
                              <button class="btn btn_tools enterprise" ng-click="habiHerramientas('enterprice')" ng-if="motrarHerramientas3">
                                 Ver Herramientas
                              </button>
                           </div>
                        </div>

                        <div class="cardr_descripciont">
                           <div class="container_optionherramientas" ng-if="verHerramienta3">
                              <ul>
                                 <li class="ico_habicheck">Solicitud de Pago</li>
                                 <li class="ico_habicheck">Venta Rápida</li>
                                 <li class="ico_habicheck">Tienda en Linea</li>
                                 <li class="ico_habicheck">Pasarela de Pago</li>
                                 <li class="ico_habicheck">Pagos Recurrentes</li>
                                 <li class="ico_habicheck">Cuotas Visa y MasterCard</li>
                                 <li class="ico_habicheck">Tokenización</li>
                              </ul>
                           </div>

                           <div class="content_feature">
                              <div class="contetn_btnplan">
                                 <button class="btn btn_tools enterprise" ng-click="habibtnHerramientas('enterprice')" ng-if="regresarHerramientas3">
                                    Regresar
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="ed-item s-100 main-center cross-center" style="text-align: center;" ng-if="basico || premium || enterprise">
                  <button class="btn btn_next_register" ng-click="nueva_ventana('SELECCION_INFORMACION')">Siguiente</button>
               </div>
            </div>
         </div>

         <!-- INFORMACION DE USUARIO -->
         <div class="container_databusiness" ng-if="modal_informacion">
            <form class="ed-container main-center cross-center" name="frm" ng-submit="CrearEmpresa()">
               <div class="ed-item ed-container s-100 m-40">
                  <div class="ed-item s-100 top_sections">
                     <h1>Usuario Administrador</h1>
                  </div>

                  <div class="ed-item s-100 top_sections">
                     <label>Nombre y apellido</label>
                     <input type="text" ng-model="usuario.nombre_apellido" name="nombrea" id="nombrea" class="form-control" ng-pattern="/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$/" required>

                     <div class="width_register menarea" ng-if="frm.nombrea.$dirty && frm.nombrea.$invalid">
                        <div class="men_error" ng-show="frm.nombrea.$error.required && frm.nombrea.$error.required">
                           Nombre y Apellido Requeridos
                        </div>

                        <div class="men_error" ng-show="frm.nombrea.$viewValue">No uses puntos ni números solo letras</div>
                     </div>
                  </div>

                  <div class="ed-item s-100 top_sections">
                     <label>Teléfono</label>
                     <input type="number" ng-model="usuario.telefono" name="telefono" id="telefono" class="form-control" minlength="6" ng-minlength="6"  maxlength="14" ng-maxlength="14"  ng-pattern="/^[0-9]*$/"  required>

                     <div class="menarea" ng-if="frm.telefono.$dirty && frm.telefono.$invalid || frm.telefono.$dirty && frm.telefono.$error.maxlength || frm.telefono.$dirty && frm.telefono.$error.minlength">
                        <div class="men_error" ng-show="frm.telefono.$dirty && frm.telefono.$error.maxlength">
                           Máximo 14 números
                        </div>

                        <div class="men_error" ng-show="frm.telefono.$dirty && frm.telefono.$error.minlength">
                           Mínimo 6 números
                        </div>

                        <div class="men_error" ng-if="frm.telefono.$error.required && frm.telefono.$error.required">
                           No.Teléfono Requerido
                        </div>
                     </div>
                  </div>

                  <div class="ed-item s-100 top_sections">
                     <label>Correo electrónico</label>
                     <input type="email" ng-model="usuario.correo" name="email" id="email" class="form-control" required>

                     <div class="menarea" ng-if="frm.email.$dirty && frm.email.$invalid">
                        <div class="men_error" ng-show="frm.email.$error.required">
                           Correo Requerido
                        </div>

                        <div class="men_error" ng-show="frm.email.$error.email">
                           Correo invalido
                        </div>
                     </div>
                  </div>

                  <div class="ed-item s-100 top_sections">
                     <label>Código de promoción</label>
                     <input class="form-control" type="text" placeholder="(opcional)" ng-model="usuario.cod_referido" name="cod_referido"
                           id="cod_referido">
                  </div>
               </div>

               <div class="ed-item ed-container s-100 m-40">
                  <div class="ed-item s-100 top_sections">
                     <h1>Negocio</h1>
                  </div>

                  <div class="ed-item s-100 top_sections">
                     <label>Categoría de negocio</label>

                     <ol class="nya-bs-select custom_nyaselect" ng-model="usuario.idCategoria" title="Categoría..." data-size="5" required>
                        <li nya-bs-option="categoria in categorias | orderBy:'nombre'" data-value="categoria.id">
                           <a>
                              @{{ categoria.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="ed-item s-100 top_sections">
                     <label>Regimen negocio</label>

                     <ol class="nya-bs-select custom_nyaselect" ng-model="usuario.empresa"  title="Empresa..." data-size="5" required>
                        <li nya-bs-option="empresa in tiposempresa | orderBy:'id'" data-value="empresa.id">
                           <a>
                              @{{ empresa.nombre }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>

                  <div class="ed-item s-100 top_sections">
                     <label>Nombre comercial</label>
                     <input type="text" ng-model="usuario.nom_empresa" name="empresa" id="empresa" class="form-control" required>

                     <div class="menarea" ng-if="frm.empresa.$dirty && frm.empresa.$invalid">
                        <div class="men_error" ng-show="frm.empresa.$error.required && frm.empresa.$error.required">
                           Empresa Requerida
                        </div>
                     </div>
                  </div>

                  <div class="ed-item s-100 top_sections">
                     <label>Nombre fiscal</label>
                     <input type="text" ng-model="usuario.nom_empresa_fiscal" name="fiscal" id="fiscal" class="form-control" required>

                     <div class="menarea" ng-if="frm.fiscal.$dirty && frm.fiscal.$invalid">
                        <div class="men_error" ng-show="frm.fiscal.$error.required && frm.fiscal.$error.required">
                           Empresa Requerida
                        </div>
                     </div>
                  </div>

                  <div class="ed-item s-100 top_sections">
                     <label>NIT de negocio</label>
                     <input type="text" ng-model="usuario.nit_empresa" name="nitempresa" id="nitempresa" class="form-control" required>

                     <div class="menarea" ng-if="frm.nitempresa.$dirty && frm.nitempresa.$invalid">
                        <div class="men_error" ng-show="frm.nitempresa.$error.required">
                           NIT de la Empresa Requerido. No puede ser C/F.
                        </div>
                     </div>
                  </div>

               </div>

               <!-- <div class="ed-item s-100 m-50 main-center cross-center conent_conditions" >
                  <input class="chk_terms" type="checkbox" id="myCheck" value="acepto" ng-checked="checkVal" required>
                  <label for="myCheck">
                     He leído y acepto los Términos y Condiciones  de la plataforma.
                  </label>
               </div> -->

               <!-- <div class="btn_terminos" ng-click="mostrarTerminos()">
                  Ver Términos y Condiciones
               </div> -->

               <div class="ed-item s-100 main-center cross-center">
                  {{-- ERRORES DE VALIDACION --}}
                  @include('fragment.error')
               </div>

               <div class="ed-item s-100 m-100 main-center cross-center" style="text-align: center;">
                  {{-- ng-disabled="frm.$invalid" --}}
                  <div class="btn btn_regresar_register" ng-click="nueva_ventana('SELECCION_PLAN')">Regresar</div>
                  <button class="btn btn_next_register" style="margin-left: 50px;">Aceptar</button>
               </div>

            </form>
         </div>

      </div> 

   </div>

</div>
@endsection

 