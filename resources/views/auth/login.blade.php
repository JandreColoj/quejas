@extends('layouts.app')

@section('content')


<div class="ed-container full h_content" ng-controller="loginCtrl">
   <div class="ed-item s-100 m-35 spi spd main-center cross-center">
      <div class="logo_pos"></div>

      <form class="ed-item ed-container full main-center cross-center" method="POST" action="{{ route('login_pagalob2b') }}">
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
            <input id="email" type="email" class="input_login border_mail form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

            @if ($errors->has('email'))
               <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
         </div>

         <div class="ed-item s-80 m-60 spi spd">
            <div class="form-group">
               <input id="password" type="password" class="input_login border_pass form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>

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

            <button type="submit" class="btn btn_login">
               {{ __('Ingresar') }}
            </button>

            @if(session('notification')) {{session('notification')}} @endif

         </div>
      </form>

      <div class="logo_powerby_login"></div>

   </div>

   <div class="ed-item s-100 m-65 spd spi bg_logo">
      <div class="bg_loging"></div>
   </div>
</div>

@endsection
