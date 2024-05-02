<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} - We tell the world about your services</title>

    <link rel="shortcut icon" href="/images/pick.jpg" type="image/png" />
    <link href="/icons/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/css/mediaqueries.css" rel="stylesheet" type="text/css" />
    <link href="/css/iziToast.min.css" rel="stylesheet">
    <script src="/js/iziToast.min.js"></script>
    <script src="/../dashboard/js/jquery.js" type="text/javascript"></script>
</head>

<body>

    <div class="menuCoat d-flex align-items-center">
        <div class="container">
            <div class="menuHolder d-flex justify-content-between align-items-center">
                <div class="logoCoat">
                    <a href="/index" class="d-flex align-items-center">
                        <img src="/images/pick.jpg" class="menuLogo" />
                        <h3 class="adsMaldoriniLogoText"><span class="blueee">{{ config('app.name') }}</span></h3>
                    </a>
                </div>

                <div class="mobileMenuIconCoat d-flex align-items-center d-lg-none">
                    <i class="fa-solid fa-bars menuIcon" data-toggle="modal" data-target="#menuModal"></i>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-2"></div>
        <div id="ytWidget"></div>
    </div>







    @yield('content')



















































    <div style="margin-top: 500px;"></div>
    <div class="footerCoat">
        <div class="container">




            <div class="d-flex justify-content-center">
                <p class="footerParSub">
                    &copy; 2024 {{ config('app.name') }}. All rights reserved
                </p>
            </div>
        </div>
    </div>










    {{-- <script src="/js/jquery.js" type="text/javascript"></script> --}}
    <script src="/../dashboard/js/jquery.js" type="text/javascript"></script>
    <script src="/js/proper.js" type="text/javascript"></script>
    <script src="/js/responsive.js" type="text/javascript"></script>
    <script src="/js/main.js" type="text/javascript"></script>

</body>

</html>
