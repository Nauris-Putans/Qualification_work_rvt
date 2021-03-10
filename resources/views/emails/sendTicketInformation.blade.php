@component('mail::message')
# {{ __("Hello :user!", ['user' => ucwords($user->name)]) }}

{{ __('Thank you for contacting our support team. A support ticket has been opened for you. You will be notified when a response is made by email or sms.') }}<br>

@component('mail::button', ['url' => url('user/support/tickets/'. $hashids->encode($ticket->id)), 'color' => 'orange'])
{{ __('Your Ticket') }}
@endcomponent

{{ __('You can view the ticket at any time by pressing this button or accessing user support table.') }}<br>

{{ __('Regards') }},<br>
{{ __('WEBcheck') }}

@component('mail::subcopy')
{{ __("If you’re having trouble clicking the ':button_text' button, copy and paste the URL below into your web browser:", ['button_text' => __('Your Ticket')]) }}
<span class="break-all" style="word-break: break-all;"><a target="_blank" rel="noopener noreferrer" href="{{ url('user/support/tickets/'. $hashids->encode($ticket->id)) }}">{{ url('user/support/tickets/'. $hashids->encode($ticket->id)) }}</a></span>
@endcomponent
@endcomponent
