<x-mail::message>
# Introduction

Hi 
<b>{{$name}}</b>,
Your trial has ended today,

to continue using our service,
Please click button below to reactive your membership.

<x-mail::button :url="url('subscribe')">
    subscribe
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
