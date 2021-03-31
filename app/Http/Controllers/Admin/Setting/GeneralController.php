<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Usuario\Roles;
use App\Models\Config\Agencias;
use App\Models\Config\Zonas;
use App\Models\Usuario\RoleUsuario;
use App\Models\Admin\UsuarioEmpresa;
use App\User;

class GeneralController extends Controller{

   private $url_SW = '';

   public function __construct(){
      $this->url_SW = session('enviroment')=='test' ? env('pagalob2b_test') : env('pagalob2b_live');
   }


   public function index(){
      return view('admin.config.general.index');
   }


}
