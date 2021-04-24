<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Headers · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


      <!-- Styles -->
      <link href="{{ asset('css/headers.css') }}" rel="stylesheet">
      {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  </head>

   <body id="app" ng-app="app"  >

   <div >

      <header class="p-3 bg-dark text-white">
         <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
               <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
               <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
               </a>

               <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
               <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
               <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
               <li><a href="#" class="nav-link px-2 text-white">About</a></li>
               </ul>

               <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
               <input type="search" class="form-control form-control-dark" placeholder="Search...">
               </form>

               <div class="text-end">
                  <button type="button" class="btn btn-outline-light me-2">Login</button>
                  {{-- <button type="button" class="btn btn-warning">Sign-up</button> --}}
               </div>
            </div>
         </div>
      </header>

      <main class="container-fluid pb-3">
         <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
            <div class="bg-light border rounded-3">
               <br><br><br><br><br><br><br><br><br><br>
            </div>
            <div class="bg-light border rounded-3">
               <br><br><br><br><br><br><br><br><br><br>
            </div>
         </div>
      </main>

   </div>


   <script type="text/javascript" src="{{asset('js/core/angular.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/core/angularController.js')}}"></script>

   {{-- <script type="text/javascript" src="{{asset('js/Controller/Controllers.js')}}"></script> --}}



  </body>



</html>
