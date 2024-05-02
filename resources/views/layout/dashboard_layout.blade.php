<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{ config('app.name') }} - Maldorini advert platform</title>

    <link rel="shortcut icon" href="/images/pick.jpg" type="image/png" />
    <link href="/../dashboard/icons/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/../dashboard/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="/../dashboard/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/../dashboard/css/mediaqueries.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="dashHeadingCoat">
        <div class="d-none d-lg-block">
            <div class="row">
                <div class="col-lg-4 col-xl-3 noPad">
                    <div class="pCDashTitleCoat d-flex justify-content-center align-items-center">
                        <img src="/images/pick.jpg" class="logo">
                        <h3 class="logoTitle"> {{ config('app.name') }}</h3>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9 noPad">
                    <div class="pCDashNavCoat d-flex align-items-center">
                        <div class="container d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="/../dashboard/images/user.png" class="userImage">
                                <h4 class="pCDashNavWelcomeNote"> Welcome <span> {{ auth()->user()->full_name }}</span>
                                </h4>
                            </div>

                            <a href="#" id="formAnchor" class="pCDashNavLogout logoutBtn">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout</a>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mobileMenuCoat d-flex align-items-center d-lg-none">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="/images/pick.jpg" class="logo">
                    <h3 class="logoTitle"> {{ config('app.name') }}</h3>
                </div>
                <i class="fa-solid fa-bars mobileMenuIcon" data-toggle="modal" data-target="#mobileMenuModal"></i>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4 col-xl-3 noPad">
            <div class="pcMenu d-none d-lg-block">
                <div class="dashMenuCoat">
                    <a href="/secure/index" class="dashMenuLinks"> <i class="fa-solid fa-sheet-plastic"></i>
                        Dashboard</a>
                    <a href="/secure/newad" class="dashMenuLinks"> <i class="fa-solid fa-plus-circle"></i> Create
                        Ad Campaign</a>


                    <a href="/secure/settings" class="dashMenuLinks"> <i class="fa-solid fa-cog"></i>

                        Settings</a>


                    <form id="LogoutForm" method="POST" action="/secure/logout">
                        @csrf
                        <a id="formAnchor" class="dashMenuLinks logoutBtn"> <i
                                class="fa-solid fa-right-from-bracket"></i>
                            Logout</a>
                        {{-- <span id="logoutBtnSPan" class="dashMenuLinks"><i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </span> --}}
                        {{-- <a href="#" class="pCDashNavLogout"><i class="fa-solid fa-right-from-bracket"></i>
                            Logout</a> --}}
                    </form>
                </div>
            </div>
        </div>


        @yield('content')
    </div>




















    <!-- Mobile Menu Modal -->
    <div class="modal fade" id="mobileMenuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="border:none !important;">
                    <button class="mMenuExitButton" data-dismiss="modal">Exit Menu</button>
                </div>
                <div class="modal-body">
                    <a href="/secure/index" class="dashMenuLinks"> <i class="fa-solid fa-sheet-plastic"></i>
                        Dashboard</a>
                    <a href="/secure/newad" class="dashMenuLinks"> <i class="fa-solid fa-plus-circle"></i>
                        Create Ad Campaign</a>

                    <a href="#" class="dashMenuLinks logoutBtn"> <i class="fa-solid fa-right-from-bracket"></i>
                        Logout</a>
                </div>
            </div>
        </div>
    </div>

    <x-live-chat />

    <script src="/../dashboard/js/jquery.js" type="text/javascript"></script>
    <script src="/../dashboard/js/proper.js" type="text/javascript"></script>
    <script src="/../dashboard/js/responsive.js" type="text/javascript"></script>
    <script src="/../dashboard/js/main.js" type="text/javascript"></script>






</body>

</html>
