@component('mail::message')
# {{ __($data['title']) }}

{{ __($data['message']) }}<br>

@component('mail::subcopy')
{{ __('Fullname: ') . ucwords($data['fullname']) }}<br>
{{ __('Email: ') . $data['email'] }}<br>
{{ __('Date: ') . now() }}<br>
{{ __('Priority: ') . __($data['priority']) }}<br>
{{ __('Category: ') . __($data['category']) }}<br>
@endcomponent

@endcomponent
