@extends('layout.admin_layout')

@section('content')
    <div class="col-lg-8 col-xl-9 noPad">
        <div class="dashMainContent">
            {{-- {{ auth()->user() }} --}}
            <div class="container mT10">
                <h3 class="mainContentTitle">
                    <i class="fa-solid fa-sheet-plastic"></i> {{ $user->full_name }}'s Ads Campaign(s)
                </h3>


            </div>
            <hr>
            <x-flash />




            <div class="container mT25">

                <div class="dashCoats">
                    <div class="table-responsive">
                        <table class="table mainTable table-striped table-hover table-sm table-bordered">
                            <tr>
                                <th class="mainTableTdTh">Ad Campaigns</th>
                                <th class="mainTableTdTh">Status</th>
                                {{-- <th class="mainTableTdTh">Expiry Date</th> --}}
                                <td class="mainTableTdTh">Action</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="mainTableTdTh"></td>
                            </tr>
                            @foreach ($adverts as $advert)
                                {{-- <tr>
                                    <td class="mainTableTdTh">{{ $advert->title }}</td>
                                    <td class="mainTableTdTh">
                                        @php
                                            echo date('h:i A d/m/Y', strtotime($user[0]->created_at));

                                        @endphp
                                    </td>
                                    <td class="mainTableTdTh">
                                        <a class="deleteButton" id="{{ $user[0]->id }}" href="view/{{ $user[0]->id }}"><i
                                                class="fa-solid fa-eye"></i>View</a>
                                    </td>
                                </tr> --}}

                                <tr>
                                    <td class="mainTableTdTh">{{ $advert->title }}</td>
                                    <td class="mainTableTdTh">
                                        @if ($advert->status == 0)
                                            Under Review
                                        @endif

                                        @if ($advert->status == 1)
                                            Approved
                                        @endif

                                        @if ($advert->status == 2)
                                            Rejected
                                        @endif
                                    </td>
                                    {{-- <td class="mainTableTdTh">{{ date('d-m-Y', $advert->expires) }}</td> --}}
                                    <td class="mainTableTdTh">
                                        <a class="actionButton" id="{{ $advert->id }}"
                                            href="/admin/view_advert/{{ $advert->id }}"><i
                                                class="fa-solid fa-info-circle"></i> More Info</a>
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
                {{ $adverts->links() }}

            </div>


            <div class="footerCoat">
                <p class="footerPar">&copy; 2023 Ads Maldorini</p>
            </div>
        </div>
    </div>
@endsection
