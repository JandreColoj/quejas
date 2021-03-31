{{-- NUEVO USUARIO --}}
<div class="caja_modal" ng-show="nuevo_usuario">
   <div id="modal_nuevo" class="modal_dinamic" style="--width:500px; --height:400px;">
      <div class=" ">
         <h1>Nuevo Usuario</h1>
         <div class="areacerrar">
            <a ng-click="nueva_ventana()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmnew" ng-submit="saveUser()">

               <div class="ed-container full">
                  <div class="ed-item s-50 spi">
                     <label for="p_nombre">Nombres y apellidos: </label>
                     <input id="p_nombre" type="text" class="form-control" name="nombre" ng-model="usuario.nombres" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="telefono">Teléfono</label>
                     <input id="telefono" type="text" class="form-control sinp" name="telefono" ng-model="usuario.telefono"  required>
                  </div>
               </div>

               <h6> <b>Usuario:</b></h6>


               <div class="ed-container full pass_piloto">

                  <div class="ed-item s-100  spi">
                     <ol class="nya-bs-select" ng-model="usuario.rol"  title="Selecciona . . .">
                        <li nya-bs-option="rol in roles" data-value="rol.slug">
                           <a>
                              @{{ rol.name }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>


                  <div class="ed-item s-100 m-100 spi spd"  style="margin-top: 20px">
                     <input type="email" class="form-control " ng-model="usuario.correo" name="correo" placeholder="Ingrese el correo electrónico" required>

                     <div class="alert-danger" ng-if="frmnew.correo.$dirty && frmnew.correo.$error.required">
                        Requerido
                     </div>

                     <div class="alert-danger" ng-show="frmnew.correo.$dirty && frmnew.correo.$error.email">
                        Ingresa un correo valido.
                     </div>
                  </div>

                  <div class="ed-item s-100 m-50 spi" style="margin-top: 20px">
                     <input type="password" class="form-control sinp" ng-model="usuario.pass" placeholder="Ingrese la contraseña" required >
                  </div>

                  <div class="ed-item s-100 m-50 spi spd" style="margin-top: 20px">
                     <input type="password" class="form-control sinp" ng-model="usuario.pass2" placeholder="Confirmar la contraseña" required>
                  </div>

                  <div class="ed-item s-100 alert-danger" ng-if="passIncorrect">
                     @{{passIncorrect}}
                  </div>
               </div>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmnew.$invalid">
                        Crear Usuario
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- EDITAR USUARIO --}}
<div class="caja_modal" ng-show="editar_usuario">
   <div id="modal_nuevo" class="modal_dinamic" style="--width:500px; --height:400px;">
      <div class="">
         <h1>Editar Usuario</h1>
         <div class="areacerrar">
            <a ng-click="nueva_ventana()" class="icocerrar"></a>
         </div>
      </div>

      <div class="contenido_area coloblan">
         <div class="col-sm-12 fleft_phonecp mtop">
            <form class="form-horizontal" name="frmedit" ng-submit="updateUser()">

               <div class="ed-container full">
                  <div class="ed-item s-50  spi">
                     <label for="e_nombre">Nombres</label>
                     <input id="e_nombre" type="text" class="form-control sinp" name="nombre" ng-model="usuario.name" required >
                  </div>
                  <div class="ed-item s-100 m-50 spi spd">
                     <label for="e_telefono">Teléfono</label>
                     <input id="e_telefono" type="text" class="form-control sinp" name="telefono" ng-model="usuario.telefono"  required>
                  </div>
               </div>

               <h6><b>Credenciales del Usuario:</b></h6>


               <div class="ed-container full pass_piloto">

                  <div class="ed-item s-100  spi">
                     <ol class="nya-bs-select" ng-model="usuario.rol"  title="Selecciona . . .">
                        <li nya-bs-option="rol in roles" data-value="rol.slug">
                           <a>
                              @{{ rol.name }}
                              <span class="glyphicon glyphicon-ok check-mark"></span>
                           </a>
                        </li>
                     </ol>
                  </div>


                  <div class="ed-item s-100 m-100 spi spd" style="margin-top: 20px">
                     <input type="email" class="form-control" ng-model="usuario.email" name="correo" placeholder="Ingrese el correo electrónico" readonly readonly>

                     <div class="alert-danger" ng-if="frmedit.correo.$dirty && frmedit.correo.$error.required">
                        Requerido
                     </div>

                     <div class="alert-danger" ng-show="frmedit.correo.$dirty && frmedit.correo.$error.email">
                        Ingresa un correo valido.
                     </div>
                  </div>

                  <br>

                  <div class="ed-item s-100 m-50 spi" style="margin-top: 20px">
                     <input type="password" class="form-control sinp" ng-model="usuario.pass" placeholder="Ingrese la contraseña" required>
                  </div>

                  <div class="ed-item s-100 m-50 spi spd" style="margin-top: 20px">
                     <input type="password" class="form-control sinp" ng-model="usuario.pass2" placeholder="Confirmar la contraseña" required>
                  </div>

                  <div class="ed-item s-100 alert-danger" ng-if="passIncorrect">
                     @{{passIncorrect}}
                  </div>
               </div>

               <hr>

               <div class="ed-container full">
                  <div class="ed-item s-100 main-center cross-center">
                     <button type="submit" class="btn btn_save" ng-disabled="frmedit.$invalid">
                        Editar usuario
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
