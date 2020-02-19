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
           {{-- uuuuuuuuuuuuuuuuiiiiiiiiiiiiiiikkkkkkkkkkkiiiiiiiiiittttt --}}
           <link rel="stylesheet" href={{asset('css/uikit-rtl.min.css')}}>
           <link rel="stylesheet" href={{asset('css/uikit-rtl.css')}}>
           <link rel="stylesheet" href={{asset('css/uikit.min.css')}}>
           <link rel="stylesheet" href={{asset('css/uikit.css')}}>
           <script src={{asset('js/uikit.js')}}></script>
           <script src={{asset('js/uikit.min.js')}}></script>
           <script src={{asset('js/uikit-icons.js')}}></script>
           <script src={{asset('js/uikit-icons.min.js')}}></script>
   {{-- uuuuuuuuuuuuuuuuiiiiiiiiiiiiiiikkkkkkkkkkkiiiiiiiiiittttt --}}

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
                width: 100px;
                /* animation-name: zoom; */
                /* animation-duration: 4s; */
                /* the animation repetion */
                /* animation-iteration-count: infinite;
                /* the animation go back and forward  */
                /* animation-direction: alternate;  */

                /* maintain the last style value */
                /* animation-fill-mode: forwards; */

                /* animation: zoom 4s infinite alternate ; */
                animation: zoom 4s forwards ;

            }
            @keyframes zoom {
                /* from {width: 100px;} */
                100% {width: 200px;}
                0%{transform: rotate(-1800deg);}

            }
            .insta-logo:hover{
                animation: zoom 4s infinite alternate-reverse  ;
            }

            /* text animation */
            .text-anime {
                position: relative;
                font-family: sans-serif;
                text-transform: uppercase;
                font-size: 1em;
                letter-spacing: 4px;
                overflow: hidden;
                background: linear-gradient(90deg, red, #f4fb3f, #fd6df3 );
                background-repeat: no-repeat;
                background-size: 80%;
                animation: animate 3s linear infinite;
                -webkit-background-clip: text;
                -webkit-text-fill-color: rgba(255, 255, 255, 0);
            }

            @keyframes animate {
            0% {
                background-position: -500%;
            }
            100% {
                background-position: 500%;
            }
            }
            /* end */
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
                    {{-- <div class="uk-animation-toggle" tabindex="0"> --}}
                        {{-- <div class="uk-animation-kenburns"> --}}
                            <img src="https://cdn.icon-icons.com/icons2/1826/PNG/512/4202090instagramlogosocialsocialmedia-115598_115703.png" class="insta-logo" alt="Page loading">
                        {{-- </div> --}}
                    {{-- </div> --}}
                    <div class="text-anime">
                        Welcome To Instapost
                    </div>
                </div>


            </div>
        </div>
    </body>
</html>
@endif
