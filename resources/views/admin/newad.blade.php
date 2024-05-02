@extends('layout.admin_layout')

@section('content')
    <div class="col-lg-8 col-xl-9 noPad">
        <div class="dashMainContent">
            {{-- {{ auth()->user() }} --}}
            <div class="container mT10">
                <h3 class="mainContentTitle">
                    <i class="fa-solid fa-sheet-plastic"></i> Dashboard
                </h3>


            </div>
            <hr>
            <x-flash />



            <div class="container mT25">

                <div class="container mT25">

                    <div class="dashCoats">
                        <h4 class="dashCoatHeadingSmall mB5">Register New advert</h4>
                        <form method="POST" enctype="multipart/form-data" action="/secure/newad">
                            @csrf
                            {{-- <h4 class="dashCoatHeadingSmall mB5">Advert Title</h4> --}}
                            <input type="text" class="form-control mB5" name="title" required
                                placeholder="Advert Title">
                            {{-- <h4 class="dashCoatHeadingSmall mB5">Advert Duration</h4> --}}
                            <select name="duration" id="" class="form-control mB5">
                                <option value="">Select Advert Duration</option>
                                <option value="1 week">1 Week</option>
                                <option value="2 weeks">2 Weeks</option>
                                <option value="3 weeks">3 Weeks</option>
                                <option value="4 weeks">4 Weeks</option>
                                <option value="5 weeks">5 Weeks</option>
                            </select>
                            <textarea id="" class="form-control mB5" placeholder="Advert Description" name="description"></textarea>
                            <input type="file" class="form-control mB5" required name="media">
                            <button class="dashButton mT10">Update</button>
                        </form>
                    </div>

                </div>

            </div>


            <div class="footerCoat">
                <p class="footerPar">&copy; 2023 Ads Maldorini</p>
            </div>
        </div>
    </div>
@endsection
