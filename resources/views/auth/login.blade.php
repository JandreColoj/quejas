@extends('layouts.app')

@section('content')


<div class="ed-container full h_content" ng-controller="loginCtrl">
   <div class="ed-item s-100 m-35 spi spd main-center cross-center">
      {{-- <div class="logo_pos"></div> --}}

      <form class="ed-item ed-container full main-center cross-center" method="POST" action="{{ route('login') }}">
         @csrf

         @if (session('status'))
            <div class="alert alert-success">
               {{ session('status') }}
            </div>
         @endif

         <div class="ed-item s-80 m-60 spi spd" style="text-align: center; font-weight: 600">
            <p>Area Administrativa</p>
         </div>
         <div class="ed-item s-80 m-60 spi spd">
            <input id="email" type="email"
                            class="input_login border_mail form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}"
                            placeholder="Email" required autofocus
                            style="background: rgba(148, 148, 150, 0.2) !important" >

            @if ($errors->has('email'))
               <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
         </div>

         <div class="ed-item s-80 m-60 spi spd">
            <div class="form-group">
               <input id="password" type="password"
               class="input_login border_pass form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
               name="password" placeholder="Contraseña" required
               style="background: rgba(150, 150, 150, 0.2) !important" >

               @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
               @endif

               @if($errors->any())
                  <span class="invalid-feedback alert" role="alert" style="color:brown" ><strong>{{$errors->first()}}</strong></span>
               @endif
            </div>
         </div>



         <div class="ed-item s-60 spi spd flex-column cross-center main-center">

            {{-- @if (Route::has('password.request'))
               <a class="btn btn-link link_pass" href="{{ route('password.request') }}">
                     {{ __('Recuperar contraseña') }}
               </a>
            @endif --}}

            <button type="submit" class="btn btn_login" style="background: #0077BB">
               {{ __('Ingresar') }}
            </button>

            @if(session('notification')) {{session('notification')}} @endif

         </div>
      </form>

      {{-- <div class="logo_powerby_login"></div> --}}

   </div>

   <div class="ed-item s-100 m-65 spd spi" style="background: #0077BB">
      {{-- <div class="bg_loging"></div> --}}
      <div style="background: #0077BB"></div>
   </div>
</div>

@endsection
