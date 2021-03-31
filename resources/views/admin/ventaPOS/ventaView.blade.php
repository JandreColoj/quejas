@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRITP --}}
{{-- Controller/Venta/VentaCtrl.js --}}

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="VentaCtrl" ng-cloak>

   {{-- LOADDING --}}
   @include('fragment.loading')
 
   @include('admin.ventaPOS.venta')

   <!-- FILTROS -->
   @include('admin.ventaPOS.filtros') 


   <div class="head_content">
      <h1>Venta</h1>
      <div class="cont_btns_head">
         @role('gerenteAgencia | user')
            <a ng-click="nueva_ventana('VENTA')" class="btn btn_opcion">Nueva venta</a> 
         @endrole 
         @role('admin')
            <a ng-click="abrirFiltro()" class="btn btn-primary  btn-filtro maba" style="width: 50px"></a> 
         @endrole 
      </div>
   </div>

   <div class="ed-container full">
      <div class="ed-item s-100 spi spd">
         <div class="container_pedidos">
            <table class="table table-bordered table-striped">
               <thead class="table_head_pedido">
                  <tr> 
                     <th>Fecha</th>
                     <th>Nombre</th>
                     <th>Correo</th>
                     <th>Teléfono</th>
                     <th>Correlativo</th>  
                     <th>Cantidad</th>  
                     <th>Boleta</th>  
                     <th>Agencia</th>  
                  </tr>
               </thead>

               <tbody class="table_body_pedido">
 
                  <tr ng-repeat="venta in ventas"> 
                     <td class="radius_left">@{{venta.fecha}}</td>
                     <td>@{{venta.nombre}}</td>
                     <td>@{{venta.correo}}</td> 
                     <td>@{{venta.telefono}}</td> 
                     <td>@{{venta.codigo}}</td> 
                     <td>@{{venta.cantidad}}</td> 
                     <td>@{{venta.boleta_pago}}</td>  
                     <td>@{{venta.agencia.nombre}}</td>  
                  </tr>

               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>
@endsection
