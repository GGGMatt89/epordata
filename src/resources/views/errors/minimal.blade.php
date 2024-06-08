<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="/css/custom_db.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: rgb(5, 32, 66);
                /* font-family: 'Nunito', sans-serif; */
                font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            button:hover {
                cursor: pointer;
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

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>

            <div>
                <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                    <button class="btn btn-dark-blue-out">
                        {{ __('Go Home') }}
                    </button>
                </a>
            </div>
        </div>
        
    </body>
</html>
