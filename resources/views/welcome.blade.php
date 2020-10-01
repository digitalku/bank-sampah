<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
              height: 300px;
              margin-top: -100px;
            }

            #showcase h1{
              font-size: 50px;
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
                </div>
                <div class="col-md-12">
                    <header id="showcase">
                      <h1>Selamat Datang di Bank Sampah</h1>
                    </header>
                </div>
                <div class="col-md-12">        
                    <div id="content" class="container mt-5">
                      We're playing around with animations in CSS. It's really good to know that you don't have to use JavaScript or jQuery to animate and create interactions ALL of the time. Digging deeper into CSS.
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
                                  Login
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
