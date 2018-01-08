<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name','LSAPP')}}</title>
        
<body>
@include('inc.navbar')
{{--  include navbar which is inside inc folder  --}}
<div class="container">

@include('inc.messages')
{{--  include error and success messages file which is inside inc folder  --}}

 @yield('content')

</div>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>
