@extends('layout.admin_auth')

@section('content')
    <div class="container mT50">
        <div class="row">
            <div class="col-sm-1 col-md-2 col-lg-3"></div>
            <div class="col-sm-10 col-md-8 col-lg-6">
                <div class="mB25 text-center">
                    <h3 class="pageHeadings">Welcome Back</h3>
                    <p class="parMainnest">Enter your login details.</p>
                    <x-errors />
                    <x-flash />
                </div>

                <div class="loginFormCoat">
                    <form method="POST" action="/admin/login">
                        @csrf
                        <div class="inputCoat d-flex align-items-center">
                            <i class="fa-solid fa-envelope formIcons"></i>
                            <input class="formInputForm" type="email" placeholder="email address" required
                                name="email" />
                        </div>
                        <div class="inputCoat d-flex align-items-center">
                            <i class="fa-solid fa-lock formIcons"></i>
                            <input class="formInputForm" type="password" placeholder="password" required name="password" />
                        </div>

                        <button class="submitButton" type="submit">Login</button>
                    </form>
                    {{-- <div class="text-center mT10">
                        <a href="forgotpassword" class="formTips cyan">I forgot my password</a>
                    </div> --}}

                </div>
            </div>
            <div class="col-sm-1 col-md-2 col-lg-3"></div>
        </div>
    </div>
@endsection
