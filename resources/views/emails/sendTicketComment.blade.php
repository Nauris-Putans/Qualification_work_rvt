@component('mail::message')
# {{ __("Hello :ticket_owner!", ['ticket_owner' => ucwords($ticketOwner->name)]) }}

{{ __("You got replied by: :role_display_name", ['role_display_name' => __($user->roles[0]->display_name)]) }}<br>

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
