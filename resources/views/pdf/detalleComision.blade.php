<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalle Comision</title>
</head>
<body>

   <style>

      .clearfix:after {
         content: "";
         display: table;
         clear: both;
      }

      a {
         color: #0087C3;
         text-decoration: none;
      }

      body {
         position: relative;
         width: 18cm;
         height: 29.7cm;
         margin: 0 auto;
         color: #555555;
         background: #FFFFFF;
         font-size: 12px;
         font-family: "Source Sans Pro", sans-serif !important;
      }

      header {
         padding: 5px 0;
         margin-bottom: 20px;
         border-bottom: 1px solid #AAAAAA;
      }

      #logo {
         float: left;
         margin-top: 8px;
      }

      #logo img {
         height: 70px;
      }

      #company {
         padding-left: 10px;
         padding-top: 14px;
      }

      #details {
         margin-bottom: 50px;
      }

      #client {
         padding-left: 6px;
         border-left: 6px solid #0087C3;
         float: left;
      }

      #client .to {
         color: #777777;
      }

      h2.name {
         font-size: 1.4em;
         font-weight: normal;
         margin: 0;
      }

      h2.name_one {
         font-size: 1.2em;
         font-weight: normal;
         margin: 0;
      }

      #invoice {
         float: right;
         text-align: justify;
      }

      #invoice h1 {
         color: #595a5a;
         font-size: 2.4em;
         line-height: 1em;
         font-weight: normal;
         margin: 0  0 10px 0;
      }

      #invoice .date {
         font-size: 1.1em;
         color: rgb(70, 69, 69);
      }

      table {
         width: 100%;
         border-collapse: collapse;
         border-spacing: 0;
         margin-bottom: 20px;
      }

      table th,
      table td {
         padding: 8px;
         background: #888888;
         text-align: center;
         border-bottom: 1px solid #FFFFFF;
      }

      table th {
         white-space: nowrap;
         font-weight: normal;
      }

      table td {
         text-align: right;
      }

      table td h3{
         color: #57B223;
         font-size: 1.2em;
         font-weight: normal;
         margin: 0 0 0.2em 0;
      }

      table .no {
         color: #FFFFFF;
         font-size: 12px;
         background: #9561e2;
      }

      table .desc {
         text-align: left;
      }

      table .border {
         background: #fff;
         border: #AAAAAA 1px solid;
      }

      table .unit {
         background: #DDDDDD;
      }

      table .qty {
      }

      table .total {
         background: #9561e2;
         color: #FFFFFF;
      }

      table td.unit,
      table td.qty,
      table td.total {
         font-size: 1.2em;
      }

      table tbody tr:last-child td {
         border: none;
      }

      table tfoot td {
         padding: 10px 20px;
         background: #FFFFFF;
         border-bottom: none;
         font-size: 1.2em;
         white-space: nowrap;
         border-top: 1px solid #AAAAAA;
      }

      table tfoot tr:first-child td {
         border-top: none;
      }

      table tfoot tr:last-child   {
         color: #000;
         font-size: 1.2em;
         border-top: 1px solid #AAAAAA;
      }

      table tfoot tr td:first-child {
         border: none;
      }

      #thanks{
         font-size: 2em;
         margin-bottom: 50px;
      }

      #notices{
         padding-left: 6px;
         border-left: 6px solid #0087C3;
      }

      #notices .notice {
         font-size: 1.2em;
      }

      footer {
         color: #777777;
         width: 100%;
         height: 30px;
         position: absolute;
         bottom: 0;
         border-top: 1px solid #AAAAAA;
         padding: 8px 0;
         text-align: center;
      }

   </style>

   <header class="clearfix">
      <div id="company">
         <h2 class="name"> {{$data['provider']['nombre_proveedor']}} </h2>
         <div> <b>Tipo comisión: </b>  {{$data['provider']['tipoComision']['nombre']}} </div>
      </div>
   </header>

   <main>

      <div id="details" class="clearfix">
         <div id="client">
            <h2 class="name_one"><b>RESUMEN</b> </h2>
            <div style="font-size: 14px; padding-top: 5px"> Cantidad de Pedidos: {{$data['total_pedidos']}}</div>
            <div style="font-size: 14px; padding-top: 5px"> Total facturado: {{number_format($data['total_ventas'], 2, '.', ',') }}</div>
            <div style="font-size: 14px; padding-top: 5px"> Comisión: {{number_format($data['comision'], 2, '.', ',') }} </div>
         </div>
         <div id="invoice">
            <h1 style="font-size: 18px;"> Fecha </h1>
            <div class="date" style="font-size: 14px; padding-top: 5px">Año: {{ $data['datos']['year'] }} </div>
            <div class="date" style="font-size: 14px; padding-top: 5px">Mes: {{ $month }}</div>
         </div>
      </div>

      @if($data['provider']['tipoComision']['codigo']=='TIPO_1')

         <table cellspacing="0" cellpadding="0">
            <thead>
               <tr style="font-weight: 400; color:#ffff;">
                  <th class="desc" > VENTAS </th>
                  <th class="desc" > % </th>
                  <th class="desc" > COMISION</th>
               </tr>
            </thead>

            @foreach($data['detalle'] as $pedido)

               <tbody>
                  <tr>
                     <td class="desc border"> {{number_format($pedido['monto'], 2, '.', ',')}}</td>
                     <td class="desc border"> {{$pedido['porcentaje']}}</td>
                     <td class="desc border">{{number_format($pedido['comision'], 2, '.', ',')}}</td>
                  </tr>
               </tbody>

            @endforeach

            <tfoot>
               <tr>
                  <td class="desc">TOTAL</td>
                  <td colspan="2"> {{number_format($data['comision'], 2, '.', ',') }} </td>
               </tr>
            </tfoot>
         </table>

      @endif

      @if($data['provider']['tipoComision']['codigo']=='TIPO_2' || $data['provider']['tipoComision']['codigo']=='TIPO_3')

         <table cellspacing="0" cellpadding="0">
            <thead>
               <tr style="font-weight: 400; color:#ffff;">
                  <th class="desc" > PEDIDOS </th>
                  <th class="desc" > ACUMULADO </th>
                  <th class="desc" > MONTO POR PEDIDO </th>
                  <th class="desc" > COMISION</th>
               </tr>
            </thead>

            @foreach($data['detalle'] as $pedido)

               <tbody>
                  <tr>
                     <td class="desc border">{{$pedido['pedidos']}}</td>

                     @if($data['provider']['tipoComision']['codigo']=='TIPO_2')
                        <td class="desc border">  {{number_format($pedido['acumulado'], 2, '.', ',')}} </td>
                     @endif

                     @if($data['provider']['tipoComision']['codigo']=='TIPO_3')
                        <td class="desc border"> {{$pedido['acumulado']}}</td>
                     @endif

                     <td class="desc border">{{number_format($pedido['monto_pedido'], 2, '.', ',')}}</td>
                     <td class="desc border">{{number_format($pedido['comision'], 2, '.', ',')}} </td>
                  </tr>
               </tbody>

            @endforeach

            <tfoot>
               <tr>
                  <td class="desc">TOTAL</td>
                  <td colspan="3"> {{number_format($data['comision'], 2, '.', ',') }} </td>
               </tr>
            </tfoot>
         </table>

      @endif


      @if($data['provider']['tipoComision']['codigo']=='TIPO_4')

         <table cellspacing="0" cellpadding="0">
            <thead>
               <tr style="font-weight: 400; color:#ffff;">
                  <th class="desc" > SKU</th>
                  <th class="desc" > PRODUCTO</th>
                  <th class="desc" > CANTIDAD</th>
                  <th class="desc" > TOTAL</th>
                  <th class="desc" > PORCENTAJE</th>
                  <th class="desc" > COMISION</th>
               </tr>
            </thead>

            @foreach($data['detalle'] as $producto)

               <tbody>
                  <tr>
                     <td class="desc border">{{$producto['sku']}}</td>
                     <td class="desc border">{{$producto['nombre']}}</td>
                     <td class="desc border">{{$producto['cantidad']}}</td>
                     <td class="desc border">{{number_format($producto['total'], 2, '.', ',')}} </td>
                     <td class="desc border"> {{$producto['porcentaje']}} %</td>
                     <td class="desc border"> {{number_format($producto['comision'], 2, '.', ',')}}  </td>
                  </tr>
               </tbody>

            @endforeach

            <tfoot>
               <tr>
                  <td class="desc" colspan="2">TOTAL</td>
                  <td> {{$data['total_products']}} </td>
                  <td> {{number_format($data['total_ventas'], 2, '.', ',') }} </td>
                  <td> </td>
                  <td> {{number_format($data['comision'], 2, '.', ',') }} </td>
               </tr>
            </tfoot>
         </table>

      @endif

      {{-- <div id="notices">
         <div>NOTAS:</div>
         <div class="notice"> </div>
      </div> --}}
   </main>

   {{-- <footer>
      Invoice was created on a computer and is valid without the signature and seal.
   </footer> --}}

   <div id="details" class="clearfix">

</body>
</html>

