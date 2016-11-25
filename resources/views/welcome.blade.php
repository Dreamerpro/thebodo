<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>The Bodo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            @-webkit-keyframes pulse {
              from {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
              }

              50% {
                -webkit-transform: scale3d(1.05, 1.05, 1.05);
                transform: scale3d(1.05, 1.05, 1.05);
              }

              to {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
              }
            }

            @keyframes pulse {
              from {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
              }

              50% {
                -webkit-transform: scale3d(1.05, 1.05, 1.05);
                transform: scale3d(1.05, 1.05, 1.05);
              }

              to {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
              }
            }

            .pulse {
              -webkit-animation-name: pulse;
              animation-name: pulse;
            }

            .animated {
              -webkit-animation-duration: 1s;
              animation-duration: 1s;
              -webkit-animation-fill-mode: both;
              animation-fill-mode: both;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
        <!-- Route::has('login') -->
            @if (Auth::guest())
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @else
                <div class="top-right links">
                    <a href="{{ url('/home') }}">Home</a>
                   
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md animated pulse">
                    The Bodo
                </div>
                <div class="text-center">
                    <b><i>By the Community. For the Community.</i></b>
                </div>
                <!-- <div class="links">
                    <a href="/admin/">Admin</a>
                </div> -->
            </div>
        </div>
    </body>
</html>
