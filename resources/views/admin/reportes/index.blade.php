@extends('layouts.app')
@section('content')

@include('layouts.menulateral')

   <script>
      var csrfToken ="{{csrf_token()}}";
   </script>

   <div class="ed-container s-100 m-100 cross-start container_dash" ng-controller="ReportesCtrl" ng-cloak>

      <!-- looadding -->
      @include('fragment.loading')

      <div class="container">
         <div class="col-sm-100 spd spi mtop">
            <div class="dash_content">

               @include('admin.reportes.fragment.filtros')


               @include('admin.reportes.fragment.resumen')

               <hr>

               {{-- MAPA DE CALOR --}}
               <div class="boxdata_container">
                  <div class="ed-container full" >

                     <div class="ed-item m-20 s-100 ">
                        <div class="body_box__reports" style="height: 440px">
                           <div class="ed-contanier full">
                              <div class="ed-item s-100">
                                 <div class="rad-info-box rad-txt-normal">
                                    <i class="fa fa-building" style="color: #9863ff"></i>
                                    <span class="heading">Proveedores</span>
                                    <span class="value"><span>@{{dataReport.resumen.total_providers}}</span></span>
                                 </div>
                              </div>

                              <div class="ed-item s-100">
                                 <div class="rad-info-box rad-txt-normal">
                                    <i class="fa fa-user" style="color: #9863ff"></i>
                                    <span class="heading">Clientes</span>
                                    <span class="value"><span>@{{dataReport.resumen.total_clients}}</span></span>
                                 </div>
                              </div>

                              <div class="ed-item s-100">
                                 <div class="rad-info-box rad-txt-normal">
                                    <i class="fa fa-dollar" style="color: #9863ff"></i>
                                    <span class="heading">Total en pedidos</span>
                                    <span class="value"><span> @{{dataReport.currency}}  @{{dataReport.orders.total | number:2}}</span></span>
                                 </div>
                              </div>

                              <div class="ed-item s-100">
                                 <div class="rad-info-box rad-txt-normal">
                                    <i class="fa fa-truck" style="color: #9863ff"></i>
                                    <span class="heading">Cantidad pedidos</span>
                                    <span class="value"><span>@{{dataReport.orders.quantity}}</span></span>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>

                     <div class="ed-item m-80 s-100 ">
                        <div class="base_charts">

                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Mapa de calor de pedidos</p>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports" style="height: 370px">
                              <div class="content_chart" id="map_calor">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               {{-- PROVEEDORES Y PEDIDOS --}}
               <div class="boxdata_container">
                  <div class="ed-container full" >

                     <div class="ed-item m-60 s-100 ">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Top proveedores</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('topProviders')" style="cursor:pointer"> </div>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_top_providers">
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="ed-item m-40 s-100">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Estado de pedidos</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('statusOrder')" style="cursor:pointer"> </div>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_orders">
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>

               {{-- CLIENTES Y CATEGORIAS --}}
               <div class="boxdata_container">
                  <div class="ed-container full" >

                     <div class="ed-item m-60 s-100 ">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Top clientes</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('topClients')" style="cursor:pointer"> </div>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_top_clients">
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="ed-item m-40 s-100">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Categoría de productos</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('topCategories')" style="cursor:pointer"> </div>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_category">
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>

               {{-- PRODUCTOS MAS VENDIDOS --}}
               <div class="ed-container full">
                  <div class="ed-item s-100 m-100 spi report_nopadding">
                     <div class="box_new__reports" style="padding-left: 15px; height: 400px;">

                        <div class="head_box__reports">
                           <div class="ed-container full">
                              <div class="ed-item s-85">
                                 <p style="font-weight: 600; padding-top: 10px;">Productos más vendidos</p>
                              </div>

                              <div class="ed-item s-15 spi spd">
                                 <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('topProducts')" style="cursor:pointer"></div>
                              </div>
                           </div>
                        </div>

                        <table class="table">
                           <thead>
                           <tr class="flex">
                              <th scope="col" class="col-sm-1">Producto</th>
                              <th scope="col" class="col-sm-2">Nombre</th>
                              <th scope="col" class="col-sm-2">Categoría</th>
                              <th scope="col" class="col-sm-2">Cantidad</th>
                              <th scope="col" class="col-sm-3"> </th>
                              <th scope="col" class="col-sm-2">Total</th>
                           </tr>
                           </thead>
                           <tbody>
                           <tr ng-repeat="product in dataReport.top_product.products" class="flex">
                                 <td class="col-sm-1">
                                    <div class="image_perfil" >
                                       <img id="img_logo" style="width: 40px;" src="@{{product.img}}" class="imagePreview">
                                    </div>
                                 </td>
                                 <td class="col-sm-2"> @{{product.name}}</td>
                                 <td class="col-sm-2"> @{{product.category}} </td>
                                 <td class="col-sm-2"> @{{product.cantidad}} </td>
                                 <td class="col-sm-3">
                                    <div class="progress">
                                       <div class="progress-bar bg-success" role="progressbar" style="width: @{{(product.total*100)/dataReport.top_product.total}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </td>
                              <td class="col-sm-2">@{{dataReport.currency}} @{{product.total | number:2}} </td>
                           </tr>
                           </tbody>
                        </table>

                     </div>
                  </div>
               </div>

               <hr>
               <div class="contepa">
                  <div class="col-sm-12 spd spi fleft_phone">
                     <div class="ed-container full main-end">
                        <div class="ed-item s-100">
                           <h1>Efectividad</h1>
                        </div>
                     </div>
                  </div>
               </div>

               {{-- PEDIDOS POR RANGO DE FECHA --}}
               <div class="boxdata_container">
                  <div class="ed-container full" >
                     <div class="ed-item m-100 s-100 ">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Pedidos por día</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('dayOrders')" style="cursor:pointer"> </div>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_orderRangeDate">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               {{-- PEDIDOS POR DIA y HORA --}}
               <div class="boxdata_container">
                  <div class="ed-container full" >
                     <div class="ed-item m-40 s-100 ">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Pedidos por día de la semana</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('orderDayWeek')" style="cursor:pointer"> </div>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_daysOrder">
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="ed-item m-60 s-100 ">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Pedidos por hora</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('orderHours')" style="cursor:pointer"> </div>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_hoursOrder">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               {{-- TIEMPOS DE ENTREGA  y PEDIDOS MODIFICADOS--}}
               <div class="boxdata_container">
                  <div class="ed-container full" >
                     <div class="ed-item m-70 s-100 ">
                        <div class="base_charts" style="padding: 15px;">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;"> Tiempos de entrega </p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('timeDelivery')" style="cursor:pointer"> </div>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <table class="table">
                                 <thead>
                                 <tr>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">Tiempo de entrega</th>
                                    <th scope="col">Promedio</th>
                                    <th scope="col">Máximo </th>
                                    <th scope="col">Mínimo</th>
                                    <th scope="col">Pedidos a tiempo</th>
                                    <th scope="col">Fuera de tiempo</th>
                                    <th scope="col">Efectividad</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 <tr ng-repeat="provider in dataReport.delivery_time.data">
                                    <td>@{{provider.name}}</td>
                                    <td>@{{provider.time_delivery}} día</td>
                                    <td>@{{provider.promedio | number:2}} día</td>
                                    <td>@{{provider.max_time}} día</td>
                                    <td>@{{provider.min_time}} día</td>
                                    <td style="text-align: center">@{{provider.good}} </td>
                                    <td style="text-align: center">@{{provider.bad}} </td>
                                    <td ng-class="{'text_good': provider.porcentaje>=60, 'text_bad': provider.porcentaje<=59  }">@{{provider.porcentaje | number:2}} %</td>
                                 </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="ed-item m-30 s-100 ">
                        <div class="base_charts" style="padding: 15px;">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;"> Pedidos Modificados por stock</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('modifiedOrders')" style="cursor:pointer"> </div>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <table class="table">
                                 <thead>
                                 <tr>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">Cantidad</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 <tr ng-repeat="provider in dataReport.orders_modify.data">
                                    <td>@{{provider.name}}</td>
                                    <td>@{{provider.cantidad}} </td>
                                 </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>

   </div>

@endsection

@push('scripts')
   <script src="/js/Controller/Registro/registroEmpresaCtrl.js"></script>

@endpush

