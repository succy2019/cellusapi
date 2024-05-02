<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} -</title>

    <link rel="shortcut icon" href="/images/pick.jpg" type="image/png" />
    <link href="/../admin/icons/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/../admin/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="/../admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/../admin/css/mediaqueries.css" rel="stylesheet" type="text/css" />
    @php

    @endphp
</head>

<body>

    <div class="dashHeadingCoat">
        <div class="d-none d-lg-block">
            <div class="row">
                <div class="col-lg-4 col-xl-3 noPad">
                    <div class="pCDashTitleCoat d-flex justify-content-center align-items-center">
                        {{-- <img src="/images/pick.jpg" class="logo">
                        <h3 class="logoTitle">{{ config('app.name') }} </h3> --}}
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9 noPad">
                    <div class="pCDashNavCoat d-flex align-items-center">
                        <div class="container d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                {{-- <img src="../dashboard/images/user.png" class="userImage">
                                <h4 class="pCDashNavWelcomeNote"> Welcome <span>
                                        {{ Auth::guard('admin')->user()->full_name }}</span>
                                </h4> --}}
                                <img src="/images/pick.jpg" class="logo userImage">
                                <h3 class="logoTitle">{{ config('app.name') }} Admin</h3>
                            </div>

                            <a href="/secure/logout" id="formAnchor" class="pCDashNavLogout logoutBtn">
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
                    <img src="/images/pick.jpg" class="logo userImage">
                    <h3 class="logoTitle">{{ config('app.name') }} Admin </h3>
                </div>
                <i class="fa-solid fa-bars mobileMenuIcon" data-toggle="modal" data-target="#mobileMenuModal"></i>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4 col-xl-3 noPad">
            <div class="pcMenu d-none d-lg-block">
                <div class="dashMenuCoat">
                    <a href="/admin/index" class="dashMenuLinks"> <i class="fa-solid fa-users"></i>
                        Users</a>
                    <a href="/admin/buy" class="dashMenuLinks"> <i class="fa-solid fa-dollar"></i>
                        Buy Crypto Requests</a>
                    <a href="/admin/sell" class="dashMenuLinks"> <i class="fa-solid fa-coins"></i>
                        Sell Crypto Requests</a>


                    @if (auth()->guard('admin')->user()->access == 0)
                        <a href="/admin/register" class="dashMenuLinks"> <i class="fa-solid fa-user-plus"></i>
                            Create Admin User</a>
                    @endif

                    <a href="settings" class="dashMenuLinks"> <i class="fa-solid fa-gear"></i> Settings</a>


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
                    <a href="/admin/index" class="dashMenuLinks"> <i class="fa-solid fa-users"></i>
                        Users</a>
                    <a href="/admin/buy" class="dashMenuLinks"> <i class="fa-solid fa-dollar"></i>
                        Buy Crypto Requests</a>
                    <a href="/admin/sell" class="dashMenuLinks"> <i class="fa-solid fa-coins"></i>
                        Sell Crypto Requests</a>
                    <a href="settings" class="dashMenuLinks"> <i class="fa-solid fa-gear"></i> Settings</a>

                    <a href="/admin/register" class="dashMenuLinks"> <i class="fa-solid fa-user-plus"></i>
                        Create Admin User</a>

                    <a id="formAnchor" href="/secure/logout" class="dashMenuLinks logoutBtn"> <i
                            class="fa-solid fa-right-from-bracket"></i>
                        Logout</a>


                </div>
            </div>
        </div>
    </div>



    <script src="/../dashboard/js/jquery.js" type="text/javascript"></script>
    <script src="/../dashboard/js/proper.js" type="text/javascript"></script>
    <script src="/../dashboard/js/responsive.js" type="text/javascript"></script>
    <script src="/../dashboard/js/main.js" type="text/javascript"></script>
    <script>
        $(".logoutBtn").on("click", function(e) {
            $("#LogoutForm").submit();
        })

        $(".advert_del_btn").on("click", function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            let target_id = e.target.id;
            let question = confirm(
                "Are you sure you want to delete this advert?\nNote, this actiion is not reversible.")

            if (question) {
                // alert(target_id);
                $.ajax({
                    url: "delete/advert/" + target_id,
                    type: "GET",
                    // data: {
                    //     id: target_id
                    // },
                    success: function(response) {
                        console.log(response)
                        if (response == 1) {
                            alert("Advert deleted successfully")
                            location.reload();
                        } else {
                            alert("Unable to complete request, please try again")
                        }
                    }
                })
            } else {
                alert("Operation cancelled");

            }
        })

        $(".approveBtn").click(function(e) {
            let target_id = e.target.id;
            let userId = $("#userId")[0].innerHTML;
            // let coat = $("#advertControlBtns").attr('class', "d-flex d-none");

            // 

            // $("#spinner").attr("class", "d-flex");

            let question = confirm(
                "Are you sure you want to approve this advert?")

            if (question) {

                $("#spinner").attr('class', "spinner-border");
                $("#advertControlBtns").attr('class', "d-none");
                $.ajax({
                    url: "/admin/accept/advert/",
                    type: "POST",
                    data: {
                        id: target_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response)
                        if (response == 1) {
                            $("#spinner").attr('class', "spinner-border d-none");
                            $("#advertControlBtns").attr('class', "d-flex");
                            alert("Advert approved successfully")
                            // location.reload();
                            window.location.href = `/admin/view/${userId}`;
                        } else {
                            alert("Unable to complete request, please try again")
                        }
                    },
                    error: function(error) {
                        console.log("error  --->", error)
                    }
                })
            }
        })

        $(".rejectBtn").click(function(e) {
            let target_id = e.target.id;
            let question = confirm(
                "Are you sure you want to reject this advert?")
            if (question) {
                $("#spinner").attr('class', "spinner-border");
                $("#advertControlBtns").attr('class', "d-none");
                $.ajax({
                    url: "/admin/reject/advert/",
                    type: "POST",
                    data: {
                        id: target_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response)
                        if (response == 1) {
                            alert("Advert rejected successfully")
                            $("#spinner").attr('class', "spinner-border d-none");
                            $("#advertControlBtns").attr('class', "d-flex");
                            // location.reload();
                            history.back()
                        } else {
                            alert("Unable to complete request, please try again")
                        }
                    }
                })
            }
        })
    </script>

</body>

</html>
