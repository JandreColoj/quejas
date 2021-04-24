@extends('layouts.app')

@section('content')

<div ng-controller="WelcomeCtrl" ng-cloak>

   {{-- LOADDING --}}
   @include('fragment.loading')


   <header class="p-3 bg-dark text-white" style="background: #0077BB !important;">
      <div class="container">
         <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
               <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
               {{-- <li><a href="#" class="nav-link px-2 text-white">Tu queja</a></li> --}}
               <li><a href="#" class="nav-link px-2 text-white">DIACO</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" ng-submit="buscarQueja()">
               <input type="search" class="form-control form-control-dark" placeholder="buscar queja..." ng-model="queja.codigo">
            </form>

            <div class="text-end">

               <a  href="{{ url('/login') }}"  class="btn btn-outline-light me-2">
                  <p>Ingresar</p>
               </a>

               {{-- <button type="button" class="btn btn-outline-light me-2">Ingresar</button> --}}
               {{-- <button type="button" class="btn btn-warning">Sign-up</button> --}}
            </div>
         </div>
      </div>
   </header>

   <main class="container-fluid pb-3">

      <div class="ed-container" >

         <div class="ed-item  s-100 m-50">

             <div class="ed-container"  style="padding: 100px 40px 25px 40px;">
               <div class="ed-item s-100" >
                     <h3>Instrucciones:</h3>
                     <p>Para que quede ingresada su queja, necesita llenar TODOS los campos marcados con *,
                         los cuales son campos obligatorios. Mediante este formulario usted nos hace llegar su requerimiento.
                         La confirmación de su ingreso se le dara un código para poder consultar el estado de su queja.
                     </p>

                     <hr>
                     <h3>Pasos para el ingreso de una queja: </h3>
                     <p>1. ingrese la fecha del incidente. </p>
                     <p>2. ingrese los datos del comercio. </p>
                     <p>3. Maque la casilla enviar anonimamente para ocultar sus identidad. </p>
                     <p>3. Si desea que nos comuniquemos con usted ingrese sus datos. </p>
                     <p>5. Haga click en el boton enviar. </p>

                     <hr>
                     <h3>Consultar estado de la queja:</h3>
                     <p>1. Ingrese su codigo de queja en el buscador. </p>
                     <p>2. Precionar la techa enter. </p>
                     <p>3. Le mostrará el detalle de su queja. </p>

               </div>
            </div>
         </div>

         <div class="ed-item  s-100 m-50" >

            <form style="padding: 100px 40px 25px 40px;" ng-submit="sendQueja()">

               <div class="ed-container">
                  <div class="ed-item s-100 m-50" >
                     <div class="form-group">
                        <label for="name_comercio">Fecha *:</label>
                        <input type="date" class="form-control" id="name_comercio" ng-model="queja.fecha">
                     </div>
                  </div>
                  <div class="ed-item  s-100 m-50" >
                     <div class="form-group">
                        <label for="name_comercio">Nombre del comercio *:</label>
                        <input type="text" class="form-control" id="name_comercio" ng-model="queja.comercio_name">
                     </div>
                  </div>
               </div>

               <div class="ed-container">
                  <div class="ed-item  s-100 m-50" >
                     <label for="name">Departamento *:</label>
                     <select class="form-select " ng-model="queja.departamento"  ng-change="getMunicipio()">
                        <option selected>Selecciona un departamento</option>
                        <option  ng-repeat="depto in departamentos" value="@{{depto.id}}">
                           @{{depto.nombre}}
                        </option>
                     </select>
                  </div>

                  <div class="ed-item  s-100 m-50">
                     <label for="name">Municipio *:</label>
                     <select class="form-select"  ng-model="queja.municipio">
                        <option selected>Selecciona un municipio</option>
                        <option  ng-repeat="muni in municipios" value="@{{muni.id}}">
                           @{{muni.nombre}}
                        </option>
                     </select>
                  </div>
               </div>

               <br>
               <div class="ed-container">
                  <div class="ed-item  s-100 m-50" >
                     <div class="form-group">
                        <label for="nit_comercio">NIT *:</label>
                        <input type="text" class="form-control" id="nit_comercio" ng-model="queja.comercio_nit">
                     </div>
                  </div>

                  <div class="ed-item  s-100 m-50" >
                     <div class="form-group">
                        <label for="direccion_comercio">Direccion del comercio *:</label>
                        <input type="text" class="form-control" id="direccion_comercio" ng-model="queja.comercio_direccion">
                     </div>
                  </div>
               </div>


               <div class="form-group">
                  <label for="direccion_comercio">Detalle de la queja *:</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" ng-model="queja.detalle_queja">></textarea>
               </div>

               <div class="form-group">
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"  ng-click="sendAnonima()">
                     <label class="form-check-label" for="flexCheckDefault">
                        Enviar anonimamente la queja
                     </label>
                  </div>
               </div>

               <hr>

               <div ng-if="queja.anonima">
                  <div class="ed-container">
                     <div class="ed-item  s-100 m-50" >
                        <div class="form-group">
                           <label for="name">Nombre:</label>
                           <input type="text" class="form-control" id="name" ng-model="queja.consumidor_nombre">
                        </div>
                     </div>

                     <div class="ed-item  s-100 m-50" >
                        <div class="form-group">
                           <label for="phone">Telefono:</label>
                           <input type="text" class="form-control" id="phone" ng-model="queja.consumidor_telefono">
                        </div>
                     </div>

                     <div class="ed-item s-100" >
                        <div class="form-group">
                           <label for="email">Correo:</label>
                           <input type="text" class="form-control" id="email" ng-model="queja.consumidor_correo">
                        </div>
                     </div>
                  </div>
               </div>

               <div class="ed-container ">
                  <div class="ed-item s-100 cross-center main-center"  >
                     <button type="submit" class="btn btn-primary" style="width: 150px">Enviar</button>
                  </div>
               </div>

            </form>

         </div>

      </div>
   </main>


   <div class="caja_modal" ng-show="modal_queja" style="margin-top:50px">
      <div id="modal_nuevo" class="modal_dinamic" style="--width:500px; --height:350px;">
         <div class="header_area">
            <h1>Detalle de la queja:</h1>
            <div class="areacerrar">
               <a ng-click="modal_queja=false" class="icocerrar"></a>
            </div>
         </div>

         <div class="contenido_area coloblan">
            <div class="col-sm-12 fleft_phonecp mtop">
               <form class="form-horizontal container_statuspedido" name="frmVenta" ng-submit="salePOS()">

                  <div class="ed-container full pass_piloto datos_pedido" style="margin-top:0px">
                     <h2>Codigo: @{{detail.codigo}}</h2>
                     <div class="ed-item s-50 spi">
                        <div class="content_info">
                           <p><b>Fecha:</b> </p>
                           <p><b>Comercio:</b> </p>
                           <p><b>Dirección:</b> </p>
                           <p><b>NIT:</b> </p>
                           <p><b>Queja:</b></p>
                        </div>
                     </div>

                     <div class="ed-item s-50 spd">
                        <div class="content_info">
                           <p> @{{ detail.fecha | date:'MM/dd/yyyy'}}</p>
                           <p> @{{ detail.comercio.nombre }}</p>
                           <p> @{{ detail.sucursal.direccion  }}</p>
                           <p> @{{ detail.comercio.nit }}</p>
                           <p> @{{ detail.motivo }}
                        </div>
                     </div>

                  </div>

               </form>
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
