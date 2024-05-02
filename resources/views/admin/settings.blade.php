@extends('layout.admin_layout')

@section('content')
    <div class="col-lg-8 col-xl-9 noPad">
        <div class="dashMainContent">

            <div class="container mT10">
                <h3 class="mainContentTitle">
                    <i class="fa-solid fa-gear"></i> Settings
                </h3>
            </div>
            <hr>

            <x-errors />
            <x-flash />

            <div class="container mT25">

                <div class="dashCoats">
                    <h4 class="dashCoatHeadingSmall mB5">Update Password</h4>
                    <form method="POST" action="/admin/settings/updatepassword">
                        @csrf
                        <input type="password" class="form-control mB5" required placeholder="Enter Old Password"
                            name="current_password">
                        <input type="password" class="form-control mB5" required placeholder="Enter New Password"
                            name="password">
                        <input type="password" class="form-control mB5" required placeholder="Confirm New Password"
                            name="password_confirmation">
                        <button class="dashButton mT10">Update</button>
                    </form>
                </div>

            </div>

            @if (auth()->guard('admin')->user()->access == 0)
                <div class="container mT25">
                    1$ = {{ number_format(Session::get('dollar_rate'), 2) }} Naira
                    <div class="dashCoats">
                        <h4 class="dashCoatHeadingSmall mB5">Buy and Sell Value</h4>
                        <form method="POST" action="/admin/settings/updateoptions">
                            @csrf
                            <input type="number" class="form-control mB5" required placeholder="Enter Buy value rate"
                                name="buy">
                            <input type="number" class="form-control mB5" required placeholder="Enter Sell value rate"
                                name="sell">
                            <button class="dashButton mT10">Update</button>
                        </form>
                    </div>

                </div>
            @endif

            {{-- <div class="container mT25">

                <div class="dashCoats">
                    <h4 class="dashCoatHeadingSmall mB5">Delete Your Account</h4>
                    <form method="POST" action="/secure/settings/deleteaccount" class="accountDeleteForm">
                        @csrf
                        <input type="password" class="form-control mB5" required placeholder="Enter Account Password"
                            name="password">
                        <button class="deleteButton mT10 btn btn-block accDeleteBtn">Delete Account</button>
                    </form>
                </div>

            </div> --}}


            <div class="footerCoat">
                <p class="footerPar">&copy; 2023 {{ config('app.name') }}</p>
            </div>
        </div>
    </div>
@endsection
