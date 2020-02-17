@if (Auth::user())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/my.css">
    <title>Note Found</title>
</head>
<body>

    <div class="img" >
        <img src="https://miro.medium.com/max/1600/1*viqIrYzAw_SbAb8TqShNIA.png" alt="">
           {{-- <h1 class="not-found"> Page not Found <br>404</h1> --}}
           <a class="not-found" href="/p"><h1 >Return to the home page</h1></a>
    </div>
</body>
</html>

@else
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Instapost</title>
         <!-- add icon link -->
         <link rel = "icon" href =
         "https://freepngimg.com/thumb/instagram/62705-logo-sticker-computer-instagram-icons-download-hd-png-thumb.png"
                 type = "image/x-icon">

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
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .insta-logo{
                width: 150px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="/profile/{{Auth::user()->id}}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md text-uppercase">
                    <img src="https://pngimage.net/wp-content/uploads/2018/06/instagram-transparent-logo-png-1.png" class="insta-logo" alt="Page loading">
                    <br>
                    Welcome To Instapost
                </div>


            </div>
        </div>
    </body>
</html>
@endif
