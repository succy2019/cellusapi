

<div class="container" style="position: relative">
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->

 
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach


            </ul>
        </div>
    @endif
</div>

