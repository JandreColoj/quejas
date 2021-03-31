app.controller('ProviderCtrl', ProviderCtrl);
ProviderCtrl.$inject = ['$scope', '$http', 'Helper', 'Ventana_modal', '$timeout'];

function ProviderCtrl($scope, $http, Helper,Ventana_modal, $timeout){

   $scope.icono_image = "https://jupi-bot.s3.amazonaws.com/Dashboard/uploadimagecamara.svg";

   $scope.tipomoneda = [
      {id:'1',nombre:'Guatemala GTQ',value:'GTQ'},
      {id:'2',nombre:'Dolar USD',value:'USD'},
   ];

   $scope.estados = [
      {nombre:'Activos', value: 1 },
      {nombre:'Desactivados', value: 0 },
   ];

   $scope.estados_promo = [
      {'nombre' : 'Activo' , 'codigo' : 1},
      {'nombre' : 'Inactivo' , 'codigo' : 0},
      {'nombre' : 'Finalizado' , 'codigo' : 2},
      {'nombre' : 'Futuras' , 'codigo' : 3},
   ];

   $scope.meses = [
      {value:1,  nombre:'Enero'},
      {value:2,  nombre:'Febrero',},
      {value:3,  nombre:'Marzo',},
      {value:4,  nombre:'Abril',},
      {value:5,  nombre:'Mayo',},
      {value:6,  nombre:'Junio',},
      {value:7,  nombre:'Julio',},
      {value:8,  nombre:'Agosto',},
      {value:9,  nombre:'Septiembre',},
      {value:10, nombre:'Octubre',},
      {value:11, nombre:'Noviembre',},
      {value:12, nombre:'Diciembre',},
   ];

   $scope.anio_inicial = 2020; //INICIO DE OPERACIONES
   $scope.anio_actual  = new Date().getFullYear();
   $scope.years = [];

   for(let a = 0; a < 5; a++){
      if(($scope.anio_actual-a) >= $scope.anio_inicial){
         $scope.years.push($scope.anio_actual-a);
      }
   }

   $scope.nueva_ventana = function(tipo = false, data = false){

      $scope.errors = [];

      switch (tipo) {

         case 'MODAL_COMISION':
            $scope.nueva_ventana();
            $scope.modal_comision = true;
            $scope.provider = data;
            $scope.detailComision();
            $scope.getTiposComision();
            break;

         case 'MODAL_CONFIR_DELETE':
            $scope.nueva_ventana();
            $scope.provider = data;
            $("#modal_confirm_deshabilitar").modal()
            break;

         case 'MODAL_CONFIRM_HABILITAR':
            $scope.nueva_ventana();
            $scope.provider = data;
            $("#modal_confirm_habilitar").modal()
            break;

         case 'MODAL_CONFIRM_HABILITAR':
            $scope.nueva_ventana();
            $scope.provider = data;
            $("#modal_confirm_habilitar").modal()
            break;

         case 'MODAL_EDITAR_PRODUCTO':
            $scope.nueva_ventana();
            $scope.producto = data;
            $("#modal_editar_producto").modal()
            break;

         // CIERRA MODALS
         case false:
            $scope.modal_comision = false;
         default:
            break;
      }

   }

   $scope.getRegistros = function(estado){

      $scope.estado_docu = estado;
      $scope.filtro.estado = estado;

      Ventana_modal.loader('Cargando . . .');

      $http.post('api/registros/getProviders', $scope.filtro).success(function(registros){

         $scope.filtro_obj     = false;
         $scope.registros      = registros.datos;
         $scope.TotalEmpresas  = registros.estado_registro;

         Ventana_modal.loader();
      });

   }

   $scope.cerrar_ID= function(){
      $scope.mas_obj = !$scope.mas_obj;
      $scope.areaEmpresa = 1;
   }

   $scope.detailProvider = function(id_provider){

      Ventana_modal.loader('Cargando . . .');

      $scope.mas_obj = true;

      $http.get('api/registros/getProvider/'+id_provider).success(function(response){
         $scope.provider = response.datos;
         Ventana_modal.loader();
      });

   };

   $scope.getTiposComision = function(){

      Ventana_modal.loader('Cargando . . .');

      $scope.datos.id_provider = $scope.provider.id;

      $http.post('api/registros/getTipoComision', $scope.datos).success(function(response){

         Ventana_modal.loader();

         $scope.tipos_comision = response.tipos;

         if (response.tipoComision!=null) {
            $scope.provider.tipoComision = response.tipoComision;
            $scope.datos.tipo_comision =  $scope.provider.tipoComision.id;
         }

      });
   };

   $scope.getProducts = function(id_provider){

      Ventana_modal.loader('Cargando . . .');

      $http.get('api/registros/getProducts/'+id_provider).success(function(response){

         Ventana_modal.loader();
         if(response.codigo==200){
            $scope.productos = response.datos;
         }

      });

   };

   $scope.getPromotions = function(id_provider){

      Ventana_modal.loader('Cargando . . .');

      $http.post('api/registros/getPromotions/'+id_provider, $scope.filtro).success(function(response){

         Ventana_modal.loader();
         if(response.codigo==200){
            $scope.promotions = response.data;
         }else{
            Ventana_modal.modalResponse(response.error_message, 'error');
         }

      });

   };

   $scope.setTipoComision = function(){

      Ventana_modal.loader('Actualizando . . .');

      $scope.datos.id_provider = $scope.provider.id;

      $http.post('api/registros/setTipoComision', $scope.datos).success(function(response){

         Ventana_modal.loader();

         if (response.codigo==200) {
            $scope.tiposComision = response.tipos;
            $scope.provider.tipoComision = response.tipoComision;
            Ventana_modal.modalResponse('Actualizado correctamente', 'success');
         }else{
            Ventana_modal.modalResponse(response.error_message, 'error');
         }

      });

   };

   $scope.detailComision = function(){

      Ventana_modal.loader('Calculando . . .');

      $scope.datos.id_provider = $scope.provider.id;

      $http.post('api/registros/detailComision', $scope.datos).success(function(response){

         Ventana_modal.loader();
         $scope.responseComision = [];

         if (response.codigo==200) {
            $scope.responseComision = response.result;
         }else{
            Ventana_modal.modalResponse(response.error_message, 'error');
         }

      });

   };

   $scope.setCommissionProduct = function(){

      $http.post('api/registros/setCommissionProduct/',$scope.producto).success(function(response){

         if(response.codigo==200){
            $('#modal_editar_producto').modal('hide');
         }else{
            Ventana_modal.modalResponse(response.message_error, 'error');
         }

      });
   }

   $scope.verificarCheckDocumentos = function (documentos) {

      $scope.documentos  = documentos;
      $scope.check_dpi_delante = false;
      $scope.check_rtu         = false;
      $scope.check_cheque      = false;

      if($scope.documentos.documento_identificacion){

         var check = $scope.existeRegistro.check.find(function(element) {
            return (element.documento == 'documento_identificacion' && element.check == 1);
         });

         if (check==undefined) {
            $scope.check_dpi_delante = false;
         }else{
            $scope.check_dpi_delante = true;
         }
      }

   }


   $scope.areaEmpresa = 1;
   $scope.habiEmpresa= function(area){

      $scope.areaEmpresa = area;

      if($scope.areaEmpresa==3) {
         $scope.areaMap();
      }else if($scope.areaEmpresa==4){
         $scope.getTiposComision();
      }else if($scope.areaEmpresa==5){
         $scope.getProducts($scope.provider.id);
      }else if($scope.areaEmpresa==6){
         $scope.getPromotions($scope.provider.id);
      }
   }

   $scope.nuevoBanco = function(registro){

      $scope.cargarnBanco = true;
      $scope.miregistro = registro;

      $scope.cancelarBanco= function(){
         $scope.cargarnBanco=false;
      }
      $scope.elbanco={};

      $scope.bancoEmpresa = function(empresa){

         Ventana_modal.loader('Registrando . . .');

         var databan = {
            banco:$scope.elbanco.banco,
            pais:$scope.elbanco.pais,
            cuenta:$scope.elbanco.cuenta,
            numero:$scope.elbanco.numero,
            tipo_cuenta:$scope.elbanco.tipo,
            moneda:$scope.elbanco.moneda,
            id_empresa:empresa,
         };

         $http.post('api/registros/newbank', databan).success(function (response){

            Ventana_modal.loader();
            $scope.existeRegistro.banco = response.banco;
            $scope.cargarnBanco = false;

         });

      }

   }

   $scope.existeBanco={};
   $scope.editarBanco= function(banco){

      $scope.cargareBanco = true;
      $scope.existeBanco  = banco;

      $scope.cancelarEBanco= function(){
         $scope.cargareBanco=false;
      }

      $scope.bancoedEmpresa=function(empresa){

         Ventana_modal.loader('Actualizando . . .');


         var databan = {
            banco:$scope.existeBanco.banco,
            pais:$scope.existeBanco.pais,
            cuenta:$scope.existeBanco.cuenta,
            numero:$scope.existeBanco.numero,
            tipo_cuenta:$scope.existeBanco.tipo_cuenta,
            moneda:$scope.existeBanco.moneda,
            id_empresa:empresa,
         };

         $http.put('api/registros/updateBank/'+$scope.existeBanco.id, databan).success(function (data, status, headers) {

            Ventana_modal.loader();

            $scope.cargareBanco=false;
            $scope.existeRegistro.banco = response.banco;
         });


      }

   }

   $scope.editarEmpresa = function(existeRegistro){

      $scope.vereditEmpresa = true;
      $scope.laempresa = existeRegistro;

      $scope.canceleditEmpresa= function(){
         $scope.vereditEmpresa = false;
         $scope.laempresa = {};
      }

      $scope.guardarEmpresa = function(){

         var dataempresa = {
            nombre_empresa:     $scope.laempresa.nombre,
            nit:                $scope.laempresa.nit,
            tipo_empresa:       $scope.laempresa.id_tipo,
            direccion:          $scope.laempresa.ubicacion,
            direccion_fiscal:   $scope.laempresa.direccionValida,
            categoria_empresa:  $scope.laempresa.id_categoria,
            plataforma_empresa: $scope.laempresa.id_plataforma,
            nombre_fiscal:      $scope.laempresa.nombreValido,
            id:                 $scope.laempresa.id
         };

         $http.put('api/registros/update',dataempresa).success(function (){

            $scope.getRegistros($scope.estado_docu);
            $scope.vereditEmpresa = false;
         });
      }

   }

   $scope.abrirFiltro= function(){
      $scope.filtro_obj=true;
   }

   $scope.cerrarFiltro= function(){
      $scope.filtro_obj=false;
   }

   $scope.activar_filtro= function(filtro){

      if(filtro=='fecha'){
         $scope.por_fecha = true;
      }else if(filtro=='estado'){
         $scope.por_estado = true;
      }
   }

   $scope.cancelar_filtro = function(filtro){

      if(filtro=='fecha'){
         $scope.por_fecha=false;
         $scope.filtro.finicio=null;
         $scope.filtro.ffin=null;
      }else if(filtro=='estado'){
         $scope.por_estado = false;
      }
   }

   $scope.areaMap = function(){

      Ventana_modal.loader('Cargando . . .');

      $scope.array = [
         [19.4069,-99.10779],//principal
         [19.33986,-99.10504],
         [19.46176,-99.0642],
         [19.47438,-99.1644],
         [19.37134,-99.22055],
      ];

      if($scope.provider.perimetro.length>3){

         $scope.array = [];

         $scope.provider.perimetro.forEach(element => {
            $coordenada = element.coordenadas.split(',');
            $scope.array.push([parseFloat($coordenada[0]),parseFloat($coordenada[1])]);
         });

      }else if($scope.provider.adicional_empresa.colonia!='' && $scope.provider.adicional_empresa.municipio!='' && $scope.provider.adicional_empresa.estado_!=''){

         var myAddressQuery = $scope.provider.adicional_empresa.estado_+', '+$scope.provider.adicional_empresa.municipio+', '+$scope.provider.adicional_empresa.colonia;
         console.log(myAddressQuery);

         var geocoder = new google.maps.Geocoder();

         geocoder.geocode({'address': myAddressQuery}, function(results, status){

            if(status === 'OK'){

               let latitud = results[0].geometry.location.lat();
               let longitud = results[0].geometry.location.lng();

               $scope.array = [
                  [latitud,longitud],//principal
                  [(latitud + (0.07148)), (longitud + (0.03964))],
                  [(latitud + (0.07789)), (longitud + (-0.03588))],
                  [(latitud + (-0.00512)), (longitud + (-0.09902))],
                  [(latitud + (-0.08093)), (longitud + (-0.03035))],
                  [(latitud + (-0.06498)), (longitud + (0.04611))],
               ];
            }

         });

      }

      $timeout(function () {
         $scope.initialize($scope.array);
         Ventana_modal.loader();
      }, 4000);

   }

   var bermudaTriangle;
   $scope.initialize = function(coordenadas) {

      var myLatLng = new google.maps.LatLng(coordenadas[0][0],coordenadas[0][1]);
      var mapOptions = {
         zoom: 12,
         center: myLatLng,
         mapTypeId: google.maps.MapTypeId.RoadMap
      };

      var map = new google.maps.Map(document.getElementById('map'), mapOptions);

      var triangleCoords = [];
      coordenadas.forEach(element => {
         triangleCoords.push(new google.maps.LatLng(element[0],element[1]));
      });

      // Construct the polygon
      bermudaTriangle = new google.maps.Polygon({
         paths: triangleCoords,
         draggable: true,
         editable: true,
         strokeColor: '#7200c6',
         strokeOpacity: 0.8,
         strokeWeight: 2,
         fillColor: '#7200c6',
         fillOpacity: 0.35
      });

      var result = bermudaTriangle.setMap(map);

      // google.maps.event.addListener(bermudaTriangle, "dragend", getPolygonCoords);
      google.maps.event.addListener(bermudaTriangle.getPath(), "insert_at", getPolygonCoords);
      google.maps.event.addListener(bermudaTriangle.getPath(), "remove_at", getPolygonCoords);
      google.maps.event.addListener(bermudaTriangle.getPath(), "set_at", getPolygonCoords);

   }

   function getPolygonCoords() {
      var len = bermudaTriangle.getPath().getLength();

      var htmlStr = "";
      $scope.coordenadas = [];
      for (var i = 0; i < len; i++) {
         $scope.coordenadas.push(bermudaTriangle.getPath().getAt(i).toUrlValue(5));
         htmlStr += bermudaTriangle.getPath().getAt(i).toUrlValue(5) + "<br>";
      }

      document.getElementById('info').innerHTML = htmlStr;
   }

   $scope.deshabilitar = function(){

      $('#modal_confirm_deshabilitar').modal('hide');

      Ventana_modal.loader('Cargando imagen');

      $http.get('api/registros/deshabilitar/'+$scope.provider.id).success(function (response){

         Ventana_modal.loader();

         if(response.codigo==400){
            Ventana_modal.modalResponse(response.mensaje, 'error');
         }else{
            $scope.getRegistros($scope.estado_docu);
         }
      });

   }

   $scope.habilitar = function(){

      $('#modal_confirm_habilitar').modal('hide');

      Ventana_modal.loader('Cargando imagen');

      $http.get('api/registros/habilitar/'+$scope.provider.id).success(function (response){

         Ventana_modal.loader();

         if(response.codigo==400){
            Ventana_modal.modalResponse(response.mensaje, 'error');
         }else{
            $scope.getRegistros($scope.estado_docu);
         }
      });

   }


   $scope.generatePDF_detail = function(){

      Ventana_modal.loader('Generando pdf . . .');

      $scope.responseComision.provider = $scope.provider;
      $scope.responseComision.datos    = $scope.datos;

      $http({
         method: 'POST',
         url: 'api/registros/generatePDF_detail',
         data: $scope.responseComision,
         responseType: 'arraybuffer',
      }).success(function (data) {

         Ventana_modal.loader();

         var blob = new Blob([data], {type: "attachment/pdf"});
         saveAs(blob, "reporte.pdf");

      }).error(function (data) {
         Ventana_modal.loader();
      });

   }


   $scope.dowloadProducts = function(){

      Ventana_modal.loader('Descargando productos . . .');

      $http({
         method: 'POST',
         url: 'api/registros/product/exportExcel',
         data: $scope.productos,
         responseType: 'arraybuffer',
      }).success(function (data) {

         Ventana_modal.loader();

         var blob = new Blob([data], {type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"});
         saveAs(blob, "products.xls");

      }).error(function (data, status, headers, config) {
         Ventana_modal.loader();

         $timeout(function () {
            Ventana_modal.modalResponse('Ocurrio un error al descargar', 'error');
         }, 2000);
      });
   }

   /******************************** CARGA MASIVA DE PRODUCTOS ********************************/
      $scope.read = function (workbook){

         $scope.valido = $scope.validarArchivo();

         if(!$scope.valido){

            $timeout(function(){
               Ventana_modal.modalResponse($scope.mierror, 'error');
               $scope.datosExcel = [];
            },1000);

            return 0;
         }

         $scope.headerNames = XLSX.utils.sheet_to_json( workbook.Sheets[workbook.SheetNames[0]], { header: 1 })[0];
         $scope.dataExcel = XLSX.utils.sheet_to_json( workbook.Sheets[workbook.SheetNames[0]]);

         $scope.cargaExcel();
      }

      $scope.cargaExcel = function () {

         //validacion de encabezados del excel
         var titulos = new Array('sku','nombre','comision');
         var existe = true;

         for(var i = 0; i < $scope.headerNames.length; i++) {
            if (!titulos.includes($scope.headerNames[i])) {
               existe = false;
               break;
            }
         }

         if(!existe){

            $timeout(function(){
               $scope.mierror = "El archivo no tiene las columnas correctas, descargue la plantilla.";
               Ventana_modal.modalResponse($scope.mierror, 'error');
            },1000);

            return 0;
         }

         $timeout(function(){
            $scope.resultadoProductos = [];
            Ventana_modal.loader('Cargando datos . . .');
         },50);

         if($scope.dataExcel[0].sku=='sku'){
            $scope.dataExcel.shift();
         }

         $timeout(function(){
            Ventana_modal.loader();
            $scope.updateComision();
         },100);

      }

      $scope.validarArchivo = function(){

         $scope.nombreArchivo = document.getElementById("excel").value;
         var extensiones_permitidas = new Array(".xls", ".xlsx");

         $scope.mierror = "";
         extension = ($scope.nombreArchivo.substring($scope.nombreArchivo.lastIndexOf("."))).toLowerCase();

         permitida = false;

         for (var i = 0; i < extensiones_permitidas.length; i++) {
            if (extensiones_permitidas[i] == extension) {
               permitida = true;
               break;
            }
         }

         if(!permitida){
            $scope.mierror = "Sólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
            return false;
         }else{
            return true;
         }

      }

   /******************************** CARGA DE PRODUCTOS ********************************/

   $scope.updateComision = function(){

      Ventana_modal.loader('Actualizando . . .');

      $http.post('api/registros/product/updateComision/'+$scope.provider.id, $scope.dataExcel).success(function (response){

         Ventana_modal.loader();

         if(response.codigo==400){
            Ventana_modal.modalResponse(response.message_error, 'error');
         }else{
            Ventana_modal.modalResponse('Actualizado', 'success');
            $scope.nombreArchivo = "";
            $scope.productos = response.datos;
         }

      });

   }

   //cierra modal de respuesta !importante
   $scope.cerrar = function(){
      Ventana_modal.cerrar();
   }

   $scope.init = function(){

      var hoy = new Date();

      $scope.imagen        = {};
      $scope.filtro        = {};
      $scope.filtro.activo = 1;
      $scope.filtro.estado_promo = 'Activo';

      $scope.comision      = {};
      $scope.datos         = {};
      $scope.datos.mes     = hoy.getMonth()+1;
      $scope.datos.year    = hoy.getFullYear();
      $scope.estado_docu   = '10';
      $scope.getRegistros($scope.estado_docu);
      // $scope.mas_obj = true;
   }
   $scope.init();

};
