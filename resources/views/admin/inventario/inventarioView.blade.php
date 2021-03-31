@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRITP --}}
{{-- Controller/Inventario/InventarioCtrl.js --}}

@include('layouts.menulateral')
<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="InventarioCtrl" ng-cloak>

   {{-- LOADDING --}}
   @include('fragment.loading')
 
   @include('admin.inventario.movimiento')

   <div class="head_content">
      <h1>Inventario</h1>
      <div class="cont_btns_head">
         @role('admin')
            <a ng-click="nueva_ventana('NUEVO')" class="btn btn_opcion">Nuevo movimiento</a>
            <a ng-click="nueva_ventana('AGENCIA')" class="btn btn_opcion">Agencias</a>
            <a ng-click="nueva_ventana('DISPONIBLE')" class="btn btn_opcion">Disponible</a>
         @endrole 
      </div>
   </div>

   <div class="ed-container full">
      <div class="ed-item s-100 spi spd">
         <div class="container_pedidos">
            <table class="table table-bordered table-striped">
               <thead class="table_head_pedido">
                  <tr>
                     <th>No. </th>
                     <th>Fecha</th>
                     <th>Descripción</th>
                     <th>Agencia</th>
                     <th>Entrada</th>
                     <th>Salida</th>  
                     <th>Existencia</th>  
                  </tr>
               </thead>

               <tbody class="table_body_pedido">

                  <tr>
                     <td class="radius_left"> </td>
                     <td> </td>
                     <td> </td>
                     <td>  <b> TOTAL </b> </td>
                     <td>@{{ inventario.ingreso }}</td>
                     <td>@{{ inventario.salida }}</td>  
                     <td>@{{ inventario.disponible }}</td>  
                  </tr>

                  <tr ng-repeat="data in inventario.inventario">
                     <td class="radius_left">@{{$index+1}}</td>
                     <td>@{{data.fecha}}</td>
                     <td>@{{data.descripcion}}</td>
                     <td>@{{data.agencia.nombre}}</td>
                     <td>@{{data.tipo=='ingreso' ? data.cantidad : 0}}</td>
                     <td>@{{data.tipo=='salida' ? data.cantidad : 0}}</td>  
                     <td>0</td>  
                  </tr>

               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>
@endsection
