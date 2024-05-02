@extends('layout.admin_layout')

@section('content')
    <div class="col-lg-8 col-xl-9 noPad">
        <div class="dashMainContent">
            {{-- {{ auth()->user() }} --}}
            <div class="container mT10">
                <h3 class="mainContentTitle">
                    <i class="fa-solid fa-users"></i>All Sell Request
                </h3>


            </div>
            <hr>
            <x-flash />

            {{-- {{ $users[0] }} --}}


            <div class="container mT25">

                <div class="dashCoats">
                    <h3 class="dashCoatHeadingMid mB10">All Sell Request</h3>
                    <div class="table-responsive">
                        <table class="table mainTable table-striped table-hover table-sm table-bordered">
                            <tr>
                                <th class="mainTableTdTh">Name</th>
                                <th class="mainTableTdTh">Email</th>
                                <th class="mainTableTdTh">Mobile</th>
                                <th class="mainTableTdTh">Amount</th>
                                <th class="mainTableTdTh">Network</th>
                                <th class="mainTableTdTh">Date Created</th>
                                <td class="mainTableTdTh">Action</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="mainTableTdTh"></td>
                            </tr>

                            @foreach ($users as $user)
                                <tr>
                                    <td class="mainTableTdTh">{{ $user->name }}</td>
                                    <td class="mainTableTdTh">{{ $user->email }}</td>
                                    <td class="mainTableTdTh">{{ $user->mobile }}</td>
                                    <td class="mainTableTdTh">{{ $user->amount }}</td>
                                    <td class="mainTableTdTh">{{ $user->network }}</td>
                                    <td class="mainTableTdTh">
                                        @php
                                            echo date('d/m/Y', strtotime($user->created_at));

                                        @endphp
                                    </td>
                                    <td class="mainTableTdTh">
                                        <a class="deleteButton" id="{{ $user->id }}"
                                            href="/admin/view/sell/{{ $user->id }}/{{ $user->user_id }}"><i
                                                class="fa-solid fa-eye"></i>View </a>
                                    </td>
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
