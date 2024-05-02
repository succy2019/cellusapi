@extends('layout.admin_layout')

@section('content')
    <div class="col-lg-8 col-xl-9 noPad">
        <div class="dashMainContent">
            {{-- {{ auth()->user() }} --}}
            <div class="container mT10">
                <h3 class="mainContentTitle">
                    <i class="fa-solid fa-users"></i>All Users
                </h3>


            </div>
            <hr>
            <x-flash />

            {{-- {{ $users[0] }} --}}


            <div class="container mT25">
                {{-- <p>We buy $1 at {{ Session::get['dollar_rate'] }} </p> --}}

                {{-- {{ $values[0] }} --}}
                <p>
                    We buy 1$ = {{ number_format(Session::get('dollar_rate') + $values[0]['buy'], 2) }} Naira
                </p>

                <p>
                    We sell 1$ = {{ number_format(Session::get('dollar_rate') + $values[0]['sell'], 2) }} Naira
                </p>
                {{-- <div class="container mT25">
                        1$ = {{ number_format(Session::get('dollar_rate'), 2) }} Naira
                        <div class="dashCoats">
                            <h4 class="dashCoatHeadingSmall mB5">Buy and Sell Value</h4>
                    
                        </div>

                    </div> --}}

                <div class="dashCoats">
                    <div class="">
                        <div class="row ">
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Users</h5>
                                        <p class="card-text">
                                            {{ $count }}
                                        </p>
                                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Dollar To Naira Rate</h5>
                                        <p class="card-text">
                                            $1 = &#8358;{{ number_format(Session::get('dollar_rate')) }}
                                        </p>
                                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">P2P Buy Rate</h5>
                                        <p class="card-text">
                                            &#8358;{{ number_format(Session::get('dollar_rate') + $values[0]['buy'], 2) }}
                                        </p>
                                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">P2P Sell Rate</h5>
                                        <p class="card-text">
                                            &#8358;{{ number_format(Session::get('dollar_rate') + $values[0]['sell'], 2) }}
                                        </p>
                                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="dashCoats">
                    {{-- <h3 class="dashCoatHeadingMid mB10">All Users : </h3> --}}
                    <div class="table-responsive">
                        <table class="table mainTable table-striped table-hover table-sm table-bordered">
                            <tr>
                                <th class="mainTableTdTh">Name</th>
                                <th class="mainTableTdTh">Email</th>
                                <th class="mainTableTdTh">Mobile</th>
                                <th class="mainTableTdTh">Date Created</th>
                                {{-- <td class="mainTableTdTh">Action</td> --}}
                            </tr>
                            <tr>
                                <td colspan="4" class="mainTableTdTh"></td>
                            </tr>

                            @foreach ($users as $user)
                                <tr>
                                    <td class="mainTableTdTh">{{ $user->name }}</td>
                                    <td class="mainTableTdTh">{{ $user->email }}</td>
                                    <td class="mainTableTdTh">{{ $user->mobile }}</td>
                                    <td class="mainTableTdTh">
                                        @php
                                            echo date('d/m/Y', strtotime($user->created_at));

                                        @endphp
                                    </td>
                                    {{-- <td class="mainTableTdTh">
                                        <a class="deleteButton" id="{{ $user->id }}" href="view/{{ $user->id }}"><i
                                                class="fa-solid fa-eye"></i>View Ad Campaign(s)</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <hr>
                <div>
                    {{-- {{ $adverts->links() }} --}}
                </div>
                {{ $users->links() }}

            </div>


            <div class="footerCoat">
                <p class="footerPar">&copy; 2023 Ads Maldorini</p>
            </div>
        </div>
    </div>
@endsection
