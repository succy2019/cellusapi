{{-- @component('mail::message') --}}


{{-- @component('mail::panel') --}}

{{-- @endcomponent --}}


{{ config('app.name') }}
{{-- @endcomponent --}}


<x-mail::message>
    {{ $subject }}

    {{ $message }}



    Thanks,Myzane Team
    {{-- {{ config('app.name') }} --}}
</x-mail::message>
