@extends('layout.admin_layout')

@section('content')
    <div class="col-lg-8 col-xl-9 noPad">
        <div class="dashMainContent">
            {{-- {{ auth()->user() }} --}}
            <div class="container mT10">
                <h3 class="mainContentTitle">

                </h3>


            </div>
            <hr>
            <x-flash />




            <div class="container mT25">

                <div class="dashCoats">
                    <h3 class="dashCoatHeadingMid mB10"></h3>
                    <div class="table-responsive">

                        {{-- @php
                            echo '<pre>';
                            print_r($user);
                            print_r($payment_method);
                            echo '</pre>';
                        @endphp --}}
                        <p>

                            Network : {{ $data->network }}
                        </p>

                        <p>

                            Amount : ${{ $data->amount }}
                        </p>

                        <p>
                            Bank Name : {{ $payment_method->bank_name }}
                        </p>

                        <p>
                            Account Name : {{ $payment_method->account_name }}
                        </p>

                        <p>
                            Account Number : {{ $payment_method->account_number }}
                        </p>

                        <p>
                            Amount (Naira) : ${{ number_format($data->to_pay) }}
                        </p>
                        {{-- Invoice ID :
                        </p> --}}
                    </div>
                </div>

                <hr>
                <div>
                    <a href="/admin/requeststatus/2/1/{{ $data->id }}" class="btn btn-primary">Approve</a>
                    <a href="/admin/requeststatus/2/2/{{ $data->id }}" class="btn btn-danger">Decline</a>
                    {{-- {{ $adverts->links() }} --}}
                </div>


            </div>


            <div class="footerCoat">
                <p class="footerPar">&copy; 2023 Ads Maldorini</p>
            </div>
        </div>
    </div>
@endsection
