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




                    <form method="POST" action="/admin/register">
                        @csrf
                        <div class="inputCoat d-flex align-items-center">
                            <input class="formInputForm" type="email" placeholder="email address" required
                                name="email" />
                        </div>

                        <div class="inputCoat d-flex align-items-center">
                            <input class="formInputForm" type="text" placeholder="Full Name" required name="full_name" />
                        </div>

                        <div class="inputCoat d-flex align-items-center">
                            <input class="formInputForm" type="tel" placeholder="Mobile Number" required
                                name="mobile_number" />
                        </div>
                        <div class="inputCoat d-flex align-items-center">
                            <i class="fa-solid fa-lock formIcons"></i>
                            <input class="formInputForm" type="password" placeholder="password" required name="password" />
                        </div>

                        <div class="inputCoat d-flex align-items-center">
                            <i class="fa-solid fa-lock formIcons"></i>
                            <input class="formInputForm" type="password" placeholder="password" required
                                name="password_confirmation" />
                        </div>

                        <button class="submitButton" type="submit">Create Account</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-1 col-md-2 col-lg-3"></div>
        </div>
    </div>
@endsection
