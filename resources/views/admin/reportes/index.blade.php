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

               <h3>Listado de Quejas</h3>

               @include('admin.reportes.fragment.filtros')


               @include('admin.reportes.fragment.resumen')

               <hr>

               {{-- PROVEEDORES Y PEDIDOS --}}
               <div class="boxdata_container">
                  <div class="ed-container full" >

                     <div class="ed-item m-60 s-100 ">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Quejas por comercios</p>
                                 </div>

                                 {{-- <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('topProviders')" style="cursor:pointer"> </div>
                                 </div> --}}
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_top_comercios">
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="ed-item m-40 s-100 ">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Comercios sin quejas</p>
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">

                              <table class="table">
                                 <thead class="thead-dark">
                                   <tr>
                                     <th scope="col">No.</th>
                                     <th scope="col">nombre</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                   <tr ng-repeat="comercio in dataReport.notComercios">
                                     <th scope="row">1</th>
                                     <td>@{{comercio.nombre}}</td>
                                   </tr>
                                 </tbody>
                               </table>
                           </div>
                        </div>
                     </div>



                  </div>
               </div>

               {{-- SUCURSAL --}}
               <div class="boxdata_container">
                  <div class="ed-container full" >

                     <div class="ed-item m-60 s-100 ">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Quejas por SUCURSAL</p>
                                 </div>

                                 {{-- <div class="ed-item s-15 spi spd">
                                    <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('topProviders')" style="cursor:pointer"> </div>
                                 </div> --}}
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_top_sucursal">
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="ed-item m-40 s-100">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Regiones</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    {{-- <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('statusOrder')" style="cursor:pointer"> </div> --}}
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_regiones">
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>


               {{-- DEPTOS Y MUNICIPIOS --}}
               <div class="boxdata_container">
                  <div class="ed-container full" >

                     <div class="ed-item m-50 s-100">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Departamento</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    {{-- <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('statusOrder')" style="cursor:pointer"> </div> --}}
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_departamentos">
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="ed-item m-50 s-100">
                        <div class="base_charts">
                           <div class="head_box__reports">
                              <div class="ed-container full">
                                 <div class="ed-item s-85">
                                    <p style="font-weight: 600; padding-top: 10px;">Municipio</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    {{-- <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('statusOrder')" style="cursor:pointer"> </div> --}}
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_municipios">
                              </div>
                           </div>
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
                                    <p style="font-weight: 600; padding-top: 10px;">Quejas por día</p>
                                 </div>

                                 <div class="ed-item s-15 spi spd">
                                    {{-- <div class="report_ico_excel" style="background-size: 25px;" ng-click="exportExcel('dayOrders')" style="cursor:pointer"> </div> --}}
                                 </div>
                              </div>
                           </div>

                           <div class="body_box__reports">
                              <div class="content_chart" id="container_quejasRangeDate">
                              </div>
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

