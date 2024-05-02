<x-mail::message>
    {{ $subject }}

    {{ $message }}

    Thanks,{{ config('app.name') }} Team
</x-mail::message>
