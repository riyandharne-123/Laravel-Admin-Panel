<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>
        
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />

    </head>
    <body>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
             <!-- Brand -->
  <a class="navbar-brand" href="#"><h3>Laravel Admin Panel</h3></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
   
                    @if (Route::has('login'))
    
                    @auth
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}"><h5><i class="fa fa-home" aria-hidden="true"></i> Home</h5></a>
                        </li>
                    @else
                       <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><h5><i class="fa fa-sign-in" aria-hidden="true"></i> Login</h5></a>
                        </li>
                        @if (Route::has('register'))
                           <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><h5><i class="fa fa-user-plus" aria-hidden="true"></i> Register</h5></a>
                            </li>
                        @endif
                    @endauth
             
            @endif
    </ul>
  </div>
        </nav>


            <div class="content" style="padding-top:8%;">
                <div class="title m-b-md">
                 <div class="jumbotron jumbotron-fluid" style="height:50vh; padding-top:10%;">
            <div class="container" style="text-align:center;">
               <h1>Welcome To Laravel Admin Panel</h1>
            </div>
            </div>
                </div>
            </div>
        </div>
    </body>
</html>
