@component('mail::message')
# Welcome to {{ config('app.name') }}

@component('mail::button', ['url' => route('portfolio')])
Access your portfolio
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
