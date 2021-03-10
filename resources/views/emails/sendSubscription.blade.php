@component('mail::message')
# {{ __($data['title']) }}

{{ __($data['message']) }}<br>

@component('mail::button', ['url' => url('user/settings'), 'color' => 'orange'])
{{ __('Your Subscription') }}
@endcomponent

{{ __('You can view the subscription plan at any time by pressing this button or accessing account settings.') }}<br>

{{ __('Regards') }},<br>
{{ __('WEBcheck') }}

@component('mail::subcopy')
{{ __("If you’re having trouble clicking the ':button_text' button, copy and paste the URL below into your web browser:", ['button_text' => __('Your Subscription')]) }}
<span class="break-all" style="word-break: break-all;"><a target="_blank" rel="noopener noreferrer" href="{{ url('user/settings') }}">{{ url('user/settings') }}</a></span>
@endcomponent
@endcomponent
