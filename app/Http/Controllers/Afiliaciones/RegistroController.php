<?php

namespace App\Http\Controllers\Afiliaciones;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Pagalo\Usuarios;
use App\Models\Pagalo\RoleUsuarios;
use App\Models\Pagalo\ProfileUsuarios;
use App\Models\Pagalo\DocumentoEmpresa;
use App\Models\Pagalo\Empresas;
use App\Models\Pagalo\RelevanteEmpresa;
use App\Models\Pagalo\RepLegal;
use App\Models\Pagalo\BancoEmpresa;
use App\Models\Pagalo\ModuloEmpresa;
use App\Models\Pagalo\ServicioPlan;
use App\Models\Pagalo\ModuloConfiguracion;
use App\Models\Pagalo\PlanEmpresa;
use App\Models\Pagalo\CodigoPromocion;
use App\Models\Pagalo\CodigoEmpresa;
use App\Models\Pagalo\PersonalizarEmpresa;  
use App\Models\Pagalo\Distribuidores;
use App\Models\Usuario\UserRegister;
use App\Mail\Bienvenida;
use Carbon\Carbon;
use Slack; 
use Auth;
use App\User;

class RegistroController extends Controller{

   public function index(){
      return view('admin.registro.registro');
   }

   public function createRegister(Request $request){
       
      $validation = Validator::make($request->all(), [
         'empresa'     => 'required',
         'idCategoria' => 'required',
         'telefono'    => 'required|max:10', 
         'correo'      => 'required|email|unique:users,email',
      ]);

      if($validation->fails()){
         return response()->json(['errors' => $validation->messages(), 'codigo' => 403]);
      } 


      if ($request->tarjeta){

         $validation = Validator::make($request->all(), [
            'accountNumber'   => 'required',
            'expirationMonth' => 'required',
            'expirationYear'  => 'required', 
            'nameCard'        => 'required',
         ]);
   
         if($validation->fails()){
            return response()->json(['errors' => $validation->messages(), 'codigo' => 403]);
         } 
      }

      $exist = Usuarios::where('email',$request['correo'])->first();

      if($exist){
         return response()->json(['errors' => "El correo electronico ya ha sido registrado", 'codigo' => 400]);
      }

      $password = $this->generarPassword(); 
      $nit_empresa = strtoupper(str_replace("-", "",$request['nit_empresa']));

      if($nit_empresa=="C/F" || $nit_empresa=="CF"){
         return response()->json(['errors' => "El NIT no puede ser Consumidor Final, Ingresa el NIT de tu empresa.", "codigo" => 400]);
      } 

      DB::beginTransaction();

      try{

         $user = Auth::User(); 
         $usuario = User::find($user->id);

         if($usuario->RolUsuario->Rol->slug=='consultor'){
            $id_zona    = $usuario->Zona->id;
            $id_agencia = 0;
            $agencia    = null;
         }else{
            $id_zona    = $usuario->Zona->id;
            $id_agencia = $usuario->Agencia->id;
            $agencia    = $usuario->Agencia->nombre;
         }


         $user = Usuarios::create([
            'name'        => $request['nombre_apellido'],
            'email'       => $request['correo'],
            'password'    => bcrypt($password),
            'verifytoken' => Str::random(40),
            'status'      => 1,
         ]); 

         RoleUsuarios::create([
            'role_id' => 4,
            'user_id' => $user->id,
         ]); 

         $profile = ProfileUsuarios::create([
            'nombre'       => $request['nombre_apellido'],
            'telefono'     => $request['telefono'],
            'ciudad'       => '',
            'departamento' => '',
            'pais'         => '',
            'estado'       => 1,
            'id_pd'        => 0,
            'user_id'      => $user->id,
         ]); 

         $randIden    = mt_rand(100000000,999999999);
         $subnombre   = substr($request['nom_empresa'],0,1);
         $idenEmpresa = $subnombre.$randIden;

         if ($request['plan']==null) { 
            $miplan = ServicioPlan::where('codigo', 'PB')->first();
            $ModuloConfig = ModuloConfiguracion::where('id_plan',$miplan->id)->get();
         }else{
            $miplan = ServicioPlan::where('codigo', $request['plan'])->first();
            $ModuloConfig = ModuloConfiguracion::where('id_plan',$miplan->id)->get();
         }

         $distribuidor = Distribuidores::where('distribuidor','BAM')->first();

         $empresas = Empresas::create([
            'id_user'             => $user->id,
            'nombre'              => $request['nom_empresa'],
            'nit'                 => $nit_empresa,
            'identidad_empresa'   => $idenEmpresa,
            'telefono_empresa'    => $request['telefono'],
            'id_categoria'        => $request['idCategoria'],
            'id_tipo'             => $request['empresa'],
            'id_plataforma'       => '1',
            'ventames'            => 0,
            'moneda'              => 'GTQ',
            'estado'              => 2,
            'llave'               => 'PA',
            'id_plan'             => $miplan->id,
            'estado_produccion'   => 'test',
            'url_short'           => '',
            'direccionValida'     => '',
            'slug'                => '',
            'nombreValido'        => '',
            'firma'               => '',
            'ubicacion'           => '',
            'web'                 => '',
            'ticket'              => 0,
            'id_lenguaje'         => 0,
            'pos'                 => 0,
            'trans_min'           => 0,
            'trans_max'           => 0,
            'pcuo'                => 0,
            'id_user_exter'       => 0,
            'pais'                => 'GT',
            'logo'                => '',
            'id_pd'               => 0,
            'id_distribuidor'     => isset($distribuidor->id) ? $distribuidor->id : 0,
            'codigo_distribuidor' => isset($agencia) ? $agencia : 'BAM',
            'slug'                => ''
         ]);

         #Crear slug si no tiene, valida si existe el slug en uso
         $slug        = str_slug($empresas->nombre);
         $slugempresa = Empresas::where('slug', $slug)->first();
         $mislug      = $slugempresa ? str_slug($slug.$empresas->id) : str_slug($slug);
         $url         = 'pagaloshop.com/'.$empresas->slug;

         $empresas->fill(['url_short' => $url, 'slug' => $mislug]);
         $empresas->save();

         PlanEmpresa::create([
            'id_empresa'  => $empresas->id,
            'idenEmpresa' => $empresas->identidad_empresa,
            'id_plan'     => $miplan->id,
            'porcentaje'  => $miplan->porcentaje,
            'monto_max'   => $miplan->monto_max,
            'user_admin'  => $user->id,
            'tarifaUSD'   => $miplan->tarifaUSD,
            'tarifaGTQ'   => $miplan->tarifaGTQ,
            'pago_aldia'  => '',
            'cupon_aldia' => '',
            'estado'      => 1,
         ]); 

         foreach ($ModuloConfig as $value) {

            ModuloEmpresa::create([
               'id_empresa' => $empresas->id,
               'id_modulo'  => $value['id_modulo'],
               'id_plan'    => $miplan->id,
               'estado'     => 1,
            ]); 
         }

         DocumentoEmpresa::create([
            'id_empresa'               => $empresas->id,
            'pdf_registro'             => '',
            'documento_identificacion' => '',
            'pasaporte'                => '',
            'licencia_conducir'        => '',
            'nombramiento_legible'     => '',
            'rtu'                      => '',
            'patente_comercio'         => '',
            'patente_sociedad'         => '',
            'recibo_comercio'          => '',
            'constitucion_sociedad'    => '',
            'direccion_fiscal'         => '',
            'fotografia_comercio'      => '',
            'cheque_cuenta'            => '',
            'acuerdo_gubernativo'      => '',
         ]); 

         RelevanteEmpresa::create([
            'id_empresa'            => $empresas->id,
            'nombre_contacto'       => $request['nombre_apellido'],
            'telefono_contacto'     => $request['telefono'],
            'actividad_economica'   => '',
            'proveedor_linea'       => '',
            'proveedor_internet'    => '',
            'cantidad_empleados'    => 1,
            'email_contacto'        => '',
            'descripcion_productos' => '',
         ]); 

         BancoEmpresa::create([
            'id_empresa'  =>  $empresas->id,
            'banco'       => '',
            'pais'        => '',
            'cuenta'      => '',
            'numero'      => '',
            'tipo_cuenta' => '',
            'moneda'      => '',
            'estado'      => 0,
            'activar'     => 0,
         ]); 

         RepLegal::create([
            'id_empresa' =>  $empresas->id,
            'profesion'  =>  '',
            'direccion'  =>  '',
            'nombre'     =>  '',
         ]); 

         PersonalizarEmpresa::create([
            'id_empresa' => $empresas->id,
            'logo'       => '',
            'portada'    => '',
            'correo'     => '',
            'telefono'   => '',
            'facebook'   => '',
            'instagram'  => '',
            'direccion'  => '',
            'estado'     => 1,
            'costo_envio_GTQ'  => 0,
            'costo_envio_USD'  => 0
         ]);

         $codigo_promocion = isset($request['cod_referido']) ? $request['cod_referido'] : 'BAM100';       

         $codigoPromo = CodigoPromocion::with('Distribuidor')->where('codigo',$codigo_promocion)->where('estado',1)->first(); 

         if($codigoPromo){

            #Agrega meses gratis si es distribuidor BAM
            if(isset($codigoPromo->Distribuidor->distribuidor)){

               #consulta el codigo que lleva el conteo de los registros BAM
               $codigoBAM = CodigoPromocion::where('codigo','BAM100')->where('estado',1)->first();

               $meses_gratis = $codigoBAM->conteo_empresas<=100 ? 3 : 1;

               CodigoEmpresa::create([
                  'id_empresa'      => $empresas->id,
                  'id_codigo'       => $codigoPromo->id,
                  'codigo'          => $codigoPromo->codigo,
                  'meses_restantes' => $meses_gratis,
                  'meses_promocion' => $meses_gratis,
                  'estado'          => 1,
               ]);

               $codigoBAM->increment('conteo_empresas');
            } 

         }

         UserRegister::create([
            'id_registro' => $empresas->id,
            'id_user'     => $usuario->id,
            'id_zona'     => $id_zona,
            'id_agencia'  => $id_agencia,
         ]);

        DB::commit();

         #valida datos de la tarjeta
         if($request->tarjeta){

            $data = [
               'nameCard'        => $request->nameCard,
               'expirationMonth' => $request->expirationMonth,
               'expirationYear'  => $request->expirationYear,
               'accountNumber'   => $request->accountNumber,
               'cvv'             => $request->cvv,
               'accion'          => 'nuevo',
               'id_empresa'      => $empresas->id,
            ];

           $result_tarjeta = $this->guardaTarjeta($data);

            if(!$result_tarjeta){

               $user->email = $request['correo'].strtotime("now");
               $user->save();
               
               return response()->json(['errors'=> 'Ocurrio un error al validar la tarjeta', 'codigo' => 400]);
            }

         }


      }catch(\Exception $e){
         DB::rollback();
         return response()->json(['errors'=> 'Ocurrio un error al crear su usuario, vuelva a intentarlo!.'.$e->getMessage(), 'codigo' => 400]);
      }

      #Enviar notificacion a Slack de nuevo Registro.
      // try{

      //    Slack::to('#paga-nclientes')
      //          ->attach([
      //             'fallback' => 'Nuevo Registro - Distribuidores',
      //             'color'    => '#46c95a',
      //             'footer' => 'Pagalo Guatemala',
      //             'fields'   =>
      //             [
      //                ['title'   => 'Nombre',
      //                   'value' => $profile->nombre,
      //                   'short' => true],

      //                ['title'   => 'Correo',
      //                   'value' => $user->email,
      //                   'short' => true],

      //                ['title'   => 'Teléfono',
      //                   'value' => $profile->telefono,
      //                   'short' => true]
      //             ]

      //          ])
      //          ->send('El usuario '.$profile->nombre.'  ha sido creado, el dia '.Carbon::now()->toDateString());

      // } catch (\Exception $e) {
      //    echo "Error al generar  notificaciòn a Slack ".$e;
      // }

      $DatosEmail = (object) [
         'nombre'      => $profile->nombre,
         'correo'      => $user->email,
         'empresa'     => $empresas->nombre,
         'plan'        => $miplan->nombre,
         'pass'        => $password,
         'verifytoken' => $user->verifytoken
      ];

      Mail::to($user->email, $profile->nombre)->send(new Bienvenida($DatosEmail));

      try{

         $usuario='JUPITER';
         $clave='D57D7A35B40A9F2CC8B067CC2C18F3FD41D8CD98F00B204E9800998ECF8427E';
         $datosCliente = array('usuario'=> $usuario, 'clave'=> $clave, 'nit'=> $nit_empresa);

         $client = new \SoapClient('https://www.ingface.net/ServiciosIngface/ingfaceWsServices?wsdl',array('exceptions' => true));
         $resultado = $client->nitContribuyentes($datosCliente);

         if($resultado->return->nombre != "Nit no valido"){

            $empresas->fill([
               'direccionValida' => $resultado->return->direccion_completa,
               'nombreValido' => $resultado->return->nombre,
            ]);
            $empresas->save();

         }

      }catch(\Exception $e){
           'Excepción capturada: '.  $e->getMessage(). "\n";
      }

      return response()->json(['password' => $password, 'empresa'=> $empresas->id, 'codigo' => 200]);
   }


   public static function guardaTarjeta($data) {
      
      try{  

         $base = env('APP_ENV')=='local' ? env('pagalo_test') : env('pagalo_live');
         $url = $base.'apij/validaCard';
         
         $body = json_encode($data);

         $curl = curl_init();
         curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => $body,
         ));

         $res = curl_exec($curl);

         $decision = json_decode($res,true); 
 
         curl_close($curl);

         if($decision['codigo'] == 200){
            return true;
         }else{
            return false;
         }

      }catch(\Exception $e){ 
         return false;
      }


   }

   public function generarPassword(){
      $key = '';
      $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $max = strlen($pattern)-1;
      for($i=0; $i < 12; $i++) $key .= $pattern{mt_rand(0,$max)};
      return $key;
   }

}
