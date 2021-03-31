app.factory('voucher', function() {

   return {

      generar: function(datos) {
         
         var doc = new jsPDF();

         doc.setFontSize(20);
         doc.setTextColor('#292929');
         doc.setFontStyle("bold");
         doc.text('COMPROBANTE DE PAGO', 105, 20, null, null, 'center');

         doc.setFontSize(18);
         doc.setTextColor('#292929');
         doc.setFontStyle("normal");
         doc.text(`${datos.empresa}`, 105, 30, null, null, 'center');

         doc.setFontSize(15);
         doc.setTextColor('#292929');
         doc.setFontStyle("normal");
         doc.text(`${datos.ubicacion}`, 105, 40, null, null, 'center');

         doc.setFontSize(15);
         doc.setTextColor('#292929');
         doc.setFontStyle("normal");
         doc.text(`AF ${datos.afiliacion}`, 105, 65, null, null, 'center');


         doc.setLineWidth(0.1);
         doc.setDrawColor(0, 0, 0);
         doc.setLineDash([2.5])
         doc.line(10, 75, 200, 75)

         doc.setFontSize(15);
         doc.setTextColor('#292929');
         doc.setFontStyle("normal");
         doc.text(`AUDIT: ${datos.correlativo}`, 10, 85);

         doc.setFontSize(15);
         doc.setTextColor('#292929');
         doc.setFontStyle("normal");
         doc.text(`Guatemala, ${datos.fecha}`, 10, 95);

         doc.setFontSize(15);
         doc.setTextColor('#292929');
         doc.setFontStyle("normal");
         doc.text(`Ref: ${datos.requestID} Aut: ${datos.requestToken}`, 10, 105);

         doc.setFontSize(15);
         doc.setTextColor('#292929');
         doc.setFontStyle("normal");
         doc.text(`No.Tarjeta **** **** **** ${datos.tarjeta}   Exp: **/**`, 10, 115);

         doc.setLineWidth(0.1);
         doc.setDrawColor(0, 0, 0);
         doc.setLineDash([2.5])
         doc.line(10, 120, 200, 120)

         doc.setFontSize(15);
         doc.setTextColor('#0087D5');
         doc.setFontStyle("normal");
         doc.text(`Pago: ${datos.moneda} ${parseFloat(datos.total)}`, 105, 135, null, null, 'center');

         doc.setFontSize(15);
         doc.setTextColor('#0087D5');
         doc.setFontStyle("normal");
         doc.text(`${datos.cliente}`, 105, 145, null, null, 'center');

         doc.setFontSize(15);
         doc.setTextColor('#0087D5');
         doc.setFontStyle("normal");
         doc.text('Copia Cliente', 105, 155, null, null, 'center');

         doc.setFontSize(15);
         doc.setTextColor('#0087D5');
         doc.setFontStyle("normal");
         doc.text('VÁLIDO SIN FIRMA', 105, 165, null, null, 'center');

         doc.setFontSize(15);
         doc.setTextColor('#0087D5');
         doc.setFontStyle("normal");
         doc.text('(01) PAGADO ELECTRÓNICAMENTE', 105, 175, null, null, 'center');

         let rnd = 0;
         rnd = Math.floor(Math.random() * (1000 - 2) + 1);

         doc.save(`pago-comprobante-${rnd}.pdf`);
      },

   }

});
