<link href="/css/iziToast.min.css" rel="stylesheet">
<script src="/../dashboard/js/jquery.js" type="text/javascript"></script>
<script src="/js/iziToast.min.js"></script>

<div class="container" style="position: relative">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <p>{{ session('message') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="alertDivbtn">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif




    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <p>{{ session('error') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="alertDivbtn">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


    @endif

</div>
