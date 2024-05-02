@extends('layout.admin_layout')

@section('content')
    <div class="col-lg-8 col-xl-9 noPad">
        <div class="dashMainContent">
            {{-- {{ auth()->user() }} --}}
            <div class="container mT10">
                <h3 class="mainContentTitle">
                    <i class="fa-solid fa-sheet-plastic"></i> New Ad Campaign
                </h3>


            </div>
            <hr>
            <x-flash />

            {{-- {{ $users[0] }} --}}


            <div class="container mT25">

                <div class="dashCoats">
                    <h3 class="dashCoatHeadingMid mB10">New Ad Campaign</h3>
                    <div class="table-responsive">
                        {{ $advert }}
                        <table class="table mainTable table-striped table-hover table-sm table-bordered">
                            <tr>
                                <th class="mainTableTdTh">User Name</th>
                                <th class="mainTableTdTh">Ad Campaign</th>
                                <th class="mainTableTdTh">Date Created</th>
                                <td class="mainTableTdTh">Action</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="mainTableTdTh"></td>
                            </tr>

                            @foreach ($advert as $ad)
                                <tr>
                                    <td class="mainTableTdTh">{{ $ad->user }}</td>
                                    <td class="mainTableTdTh">{{ $ad->title }}</td>
                                    <td class="mainTableTdTh">
                                        @php
                                            echo date('d/m/Y', strtotime($ad->created_at));
                                        @endphp
                                    </td>
                                    <td class="mainTableTdTh">
                                        <a class="deleteButton" id="{{ $ad->id }}"
                                            href="view_advert/{{ $ad->id }}"><i class="fa-solid fa-info-circle"></i>
                                            More
                                            Info</a>
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
                {{ $advert->links() }}

            </div>


            <div class="footerCoat">
                <p class="footerPar">&copy; 2023 Ads Maldorini</p>
            </div>
        </div>
    </div>
@endsection
