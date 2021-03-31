
<div class="report_resumen_date">

   <h5> <b> DATOS GENERALES </b></h5>

   <div class="row" style="padding-top: 20px;">
      <div class="col-lg-3 col-xs-6">
         <div class="rad-info-box rad-txt-success">
            {{-- <i class="fa fa-windows"></i> --}}
            <span class="heading">Proveedores activos</span>
            <span class="value"><span>@{{resumen.total_provides}}</span></span>
         </div>
      </div>
      <div class="col-lg-3 col-xs-6">
         <div class="rad-info-box rad-txt-primary">
            {{-- <i class="fa fa-facebook"></i> --}}
            <span class="heading">Total clientes</span>
            <span class="value"><span>@{{resumen.total_clientes}}</span></span>
         </div>
      </div>
      <div class="col-lg-3 col-xs-6">
         <div class="rad-info-box rad-txt-danger">
            {{-- <i class="fa fa-google-plus"></i> --}}
            <span class="heading">Total Productos</span>
            <span class="value"><span>@{{resumen.total_products}}</span></span>
         </div>
      </div>
      <div class="col-lg-3 col-xs-6">
         <div class="rad-info-box rad-txt-success" >
            {{-- <i class="fa fa-apple"></i> --}}
            <span class="heading">Pedidos hoy</span>
            <span class="value"><span>@{{resumen.orders_now}}</span></span>
         </div>
      </div>
   </div>

</div>

