<!DOCTYPE html>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a98fcd6d7591465c7082dd5/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

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



<!--Footer-->
<footer class="page-footer font-small indigo pt-0">

    <!--Footer Links-->
    <div class="container">

        <!--Grid row-->
        <div class="row pt-5 mb-3 text-center d-flex justify-content-center">

            <!-- Grid column
            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">About us</a>
                </h6>
            </div> -->
            <!--Grid column-->

            <!--Grid column-->
            <!-- <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Products</a>
                </h6>
            </div> -->
            <!--Grid column-->

            <!--Grid column-->
            <!-- <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Awards</a>
                </h6>
            </div> -->
            <!--Grid column-->

            <!--Grid column-->
            <!-- <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Help</a>
                </h6>
            </div> -->
            <!--Grid column-->

            <!--Grid column-->
            <!-- <div class="col-md-2 mb-3">
                <h6 class="text-uppercase font-weight-bold">
                    <a href="#!">Contact</a>
                </h6>
            </div> -->
            <!--Grid column-->

        <!-- </div> -->
        <!--Grid row-->

        <!-- <hr class="rgba-white-light" style="margin: 0 15%;"> -->

        <!--Grid row-->
        <!-- <div class="row d-flex text-center justify-content-center mb-md-0 mb-4"> -->

            <!--Grid column-->
            <!-- <div class="col-md-8 col-12 mt-5">
                <p style="line-height: 1.7rem">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                    totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                    vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                    aut fugit, sed quia consequuntur.</p>

            </div> -->
            <!--Grid column-->

        <!-- </div> -->
        <!--Grid row -->

        <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">

        <!--Grid row-->
        <div class="row pb-3">

            <!--Grid column-->
            <div class="col-md-12">

                <div class="mb-5 flex-center">
                    <!--Facebook-->
                    <a class="fb-ic">
                        <i class="fa fa-facebook fa-lg white-text mr-md-4"> </i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--Twitter-->
                    <a class="tw-ic">
                        <i class="fa fa-twitter fa-lg white-text mr-md-4"> </i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--Google +-->
                    <a class="gplus-ic">
                        <i class="fa fa-google-plus fa-lg white-text mr-md-4"> </i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--Linkedin-->
                    <a class="li-ic">
                        <i class="fa fa-linkedin fa-lg white-text mr-md-4"> </i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--Instagram-->
                    <a class="ins-ic">
                        <i class="fa fa-instagram fa-lg white-text mr-md-4"> </i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--Pinterest-->
                    <a class="pin-ic">
                        <i class="fa fa-pinterest fa-lg white-text"> </i>
                    </a>
                </div>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->

    </div>
    <!--/Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        © 2018 Copyright:
        <a href="needalabourer.com">needalabourer.com </a>
    </div>
    <!--/Copyright-->

</footer>
<!--/Footer-->
                      
                      

</body>
</html>
