@extends('layouts.app')
@section('content')

{{-- CONTROLADOR JAVASCRITP --}}
{{-- Controller/Admin/EscritorioCtrl.js --}}

@include('layouts.menulateral')

<script>
   var csrfToken ="{{csrf_token()}}";
</script>

<div class="ed-container s-100 m-85 cross-start container_dash" ng-controller="EscritorioCtrl" ng-cloak>


   {{-- LOADDING --}}
   @include('fragment.loading')


   <!-- FILTROS -->
   @include('dashboard.filtros')

   <div class="container" ng-class="{'elglass': cargarinfo==true}">
      <div class="col-sm-12 col-xs-12 spd spi mtop">

         <div class="contepa">
            <div class="col-sm-12 spi spd">
               <h1>Inicio</h1>
            </div>

            <div class="ed-container full">

               <div class="ed-item s-90">
                  <ul class="filtroescri">
                     <li ng-repeat="year in years"><a ng-click="getDetail(year)" ng-class="{'act': filtro.filtro == year}">@{{year}}</a></li>
                     <!-- <li><a ng-click="getDetail('all')" ng-class="{'act': filtro.year =='all'}">Todos</a></li> -->
                  </ul>
               </div>

               {{-- <div class="ed-item s-10">
                  <a class="btn btn-primary  btn-filtro maba" ng-click="abrirFiltro()"></a>
               </div> --}}

            </div>

            <div class="boxdata_container">
               <div class="ed-container full">
                  <div class="boxdata_cardcontainer">
                     <div class="boxdata_item">
                        <div class="boxdata_head">
                           <h1 class="boxdata_title">Proveedores</h1>
                           <h2 class="boxdata_gtq">@{{resumen.total_proveedores}}</h2>
                        </div>
                     </div>

                     <div class="boxdata_item">
                        <div class="boxdata_head">
                           <h1 class="boxdata_title">Clientes</h1>
                           <h2 class="boxdata_gtq">@{{resumen.total_clientes}}</h2>
                        </div>

                        {{-- <div class="ed-item ed-container border_data">
                           <div class="ed-item s-50 spd spi boxdata_flex border_datar">
                              <h3 class="boxdata_gtq">@{{resumen.incompleto}}</h3>
                              <p class="boxdata_titlefoo">Incompleto</p>
                           </div>

                           <div class="ed-item s-50 spd spi boxdata_flex">
                           <h3 class="boxdata_gtq">@{{resumen.proceso}}</h3>
                              <p class="boxdata_titlefoo">proceso</p>
                           </div>
                        </div> --}}
                     </div>

                     <div class="boxdata_item">
                        <div class="boxdata_head">
                           <h1 class="boxdata_title">Pedidos (Entregados)</h1>
                           <h2 class="boxdata_gtq">@{{resumen.total_pedidos}}</h2>
                        </div>

                     </div>

                     <div class="boxdata_item">
                        <div class="boxdata_head">
                           <h1 class="boxdata_title">Facturación</h1>
                           <h2 class="boxdata_gtq"> MXN @{{resumen.facturacion | number:2}}  </h2>
                        </div>

                        <div class="ed-item ed-container border_data">
                           <div class="ed-item s-50 spd spi boxdata_flex border_datar">
                              <h3 class="boxdata_gtq"> </h3>
                              <p class="boxdata_titlefoo"> Ticket promedio </p>
                           </div>

                           <div class="ed-item s-50 spd spi boxdata_flex">
                              <h3 class="boxdata_gtq">@{{resumen.tiket_promedio | number:2}}</h3>
                              <p class="boxdata_titlefoo"></p>
                           </div>
                        </div>

                     </div>

                  </div>
               </div>
            </div>

            <div class="ed-container full">
               <div class="ed-item s-100">
                  <figure class="highcharts-figure">
                     <div id="container"></div>
                     <p class="highcharts-description">

                     </p>
                  </figure>
               </div>
            </div>

         </div>
      </div>
   </div>
</div>

@endsection
