@component('mail::message')
# {{ __($data['title']) }}

{{ __($data['message']) }}<br>

@component('mail::button', ['url' => url("https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=" . $data['email'] . "&su=" . $data['title']), 'color' => 'orange'])
{{ __('Reply') }}
@endcomponent

@component('mail::subcopy')
{{ __("Fullname: :fullname", ['fullname' => ucwords($data['fullname'])]) }}<br>
{{ __("Email: :email", ['email' => $data['email']]) }}<br>
{{ __("Date: :date", ['date' => now()->format('d.m.Y H:i')]) }}<br>
{{ __("Priority: :priority", ['priority' => __($data['priority'])]) }}<br>
{{ __("Category: :category", ['category' => __($data['category'])]) }}<br><br>

{{ __("If you’re having trouble clicking the ':button_text' button, copy and paste the URL below into your web browser:", ['button_text' => __('Reply')]) }}
<span class="break-all" style="word-break: break-all;"><a target="_blank" rel="noopener noreferrer" href="{{ url("https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=" . $data['email'] . "&su=" . $data['title']) }}">{{ url("https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=" . $data['email'] . "&su=" . $data['title']) }}</a></span>
@endcomponent
@endcomponent
