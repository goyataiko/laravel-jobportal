<x-mail::message>
# Introduction

Congratulations!
You are now a premium user!

<p>Purchase Detail:</p>
<p>Plan: {{$plan}}</p>
<p>Your plan ends on {{$billingEnds}}</p>

<x-mail::button :url="''">
Post a Job
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
