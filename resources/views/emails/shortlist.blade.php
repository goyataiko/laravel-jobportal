<x-mail::message>
Dear {{$name}},

I hope this email finds you well.

I am writing to inform you that you have been shortlisted 
for an interview for the {{ $title }} .

Sincerely,<br>
{{ config('app.name') }}
</x-mail::message>
