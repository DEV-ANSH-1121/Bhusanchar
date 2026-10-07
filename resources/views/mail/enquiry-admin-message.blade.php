<x-mail::message>
# Hello {{ $recipientName }}

We have an update on {{ $topic }}.

{{ $adminMessage }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
