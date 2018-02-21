<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
               <style>
                div{    
                /* background-color: green; */
                /* background-image: url(/pic/icon.ico);
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover; */

                }
                </style>  
    <link rel="icon" href="pic/icon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--  CSRF token is added for secuurity reasons   --}}

    <title>{{ config('app.name', 'needalabourer') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--  <link href="{{ asset('css/register.css') }}" rel="stylesheet">  --}}
    
                   

</head>
<body>



<div id="app">
            

      
      @include('inc.navbar');    
      
      <div class="container">
      @yield('content')
      @include('inc.messages')
    
      </div>
    
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    {{--  the above lines are added frm https://github.com/UniSharp/laravel-ckeditor and inside that usage to enable ckeditor  --}}



</body>
</html>
