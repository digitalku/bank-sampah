<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Bank Sampah Ansor Drajat') }}</title>
        
        
        <link rel="apple-touch-icon" sizes="57x57" href="https://img.bsdrajat.nix.id/icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="https://img.bsdrajat.nix.id/icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="https://img.bsdrajat.nix.id/icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="https://img.bsdrajat.nix.id/icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="https://img.bsdrajat.nix.id/icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="https://img.bsdrajat.nix.id/icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="https://img.bsdrajat.nix.id/icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="https://img.bsdrajat.nix.id/icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="https://img.bsdrajat.nix.id/icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="https://img.bsdrajat.nix.id/icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://img.bsdrajat.nix.id/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="https://img.bsdrajat.nix.id/icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://img.bsdrajat.nix.id/icon/favicon-16x16.png">
<link rel="manifest" href="https://img.bsdrajat.nix.id/icon/manifest.json">
<meta name="msapplication-TileColor" content="green">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="green">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/dist/css/adminlte.min.css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            body{
              font-family: Ariel, Helvetica, sans-serif;
              line-height: 1.6;
              text-align: center;
              background-color: #039b4e;
            }
            .container{
              max-width: 960px;
              margin: auto;
              padding: 0 30px;
            }

            #showcase{
              height: 200px;
              margin-top: -150px;
              margin-bottom: 100px;
            }

            #showcase h3{
              line-height: 1.3;
              position: relative;
              animation: heading;
              color: white;
              animation-duration: 1s;
              animation-fill-mode: forwards;
            }

            @keyframes heading{
              0% {top: -50px;}
              100% {top: 200px;}
            }

            #content {
              position: relative;
              animation-name: content;
              animation-duration: 1s;
              animation-fill-mode: forwards;
            }

            @keyframes content{
              0% {left: -1000px;}
              100% {left: 0px;}
            }

            .btnn{
                display: inline-block;
                color: white;
                text-decoration: none;
                margin-top: 40px;
                opacity: 0;
                animation-name: btn;
                animation-duration: 1s;
                animation-delay: 1s;
                animation-fill-mode: forwards;
                transition-property: transform;
                transition-duration: 1s;
              }

            @keyframes btn {
              0%{opacity: 0}
              100%{opacity: 1}
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="container-fluid">
                <div class="col-md-12 mt-5">
                    <img src="{{URL::asset('tempAdmin')}}/dist/img/icon-bg.png">
                    <img src="{{URL::asset('tempAdmin')}}/dist/img/ansor-login.jpg" height="145">
                </div>
                <div class="col-md-12">
                    <header id="showcase">
                      <h3>Selamat Datang di Bank Sampah</h3>
                    </header>
                </div>
                <div class="col-md-12">        
                    <div id="content" class="container mt-5">
                      Selamat datang di aplikasi web Bank Sampah untuk desa drajat. aplikasi ini di desain dan dikelola oleh Ansor Drajat team ekonomi kreatif dengan sepenuh hati. <br>
                      akun akan didapat dari petugas saat penyetoran sampah untuk pertama kalinya
                    </div>
                </div>
                <div class="col-md-12">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/home') }}" class="btnn"><button type="button" class="btn btn-lg btn-light" data-toggle="modal" data-target="#modal-default">
                                  Dashboard
                                </button></a>
                            @else
                                <a href="{{ route('login') }}" class="btnn"><button type="button" class="btn btn-lg btn-light" data-toggle="modal" data-target="#modal-default">
                                  SignIn
                                </button></a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                
                    <!-- <a href="#" class="btnn"><button type="button" class="btn btn-lg btn-light" data-toggle="modal" data-target="#modal-default">
                                  Login
                                </button></a> -->
                    
                </div>
            </div>
        </div>
    </body>
</html>
