<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
        <link rel="stylesheet" href="/css/notifications.css">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.css">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        {{-- Data table css --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.5/fc-3.3.1/fh-3.1.7/r-2.2.6/sc-2.0.3/sb-1.0.0/sp-1.2.1/datatables.min.css"/>
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif

</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/locales-all.min.js"></script>

        {{-- Calendar--}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // Date variables
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    themeSystem: 'bootstrap',
                    selectable: true,
                    editable: true,
                    firstDay: 1,
                    height: "auto",

                    // HeaderToolbar elements
                    headerToolbar: {
                        left: 'prev',
                        center: 'title',
                        right: 'next today'
                    },

                    // Event days
                    events: [
                        {
                            title: 'All Day Event',
                            start: new Date(y, m, 1)
                        },
                        {
                            title: 'Long Event',
                            start: new Date(y, m, d-5),
                            end: new Date(y, m, d-2)
                        },
                        {
                            id: 999,
                            title: 'Repeating Event',
                            start: new Date(y, m, d-3, 16, 0),
                            allDay: false
                        },
                        {
                            id: 999,
                            title: 'Repeating Event',
                            start: new Date(y, m, d+4, 16, 0),
                            allDay: false
                        },
                        {
                            title: 'Meeting',
                            start: new Date(y, m, d, 10, 30),
                            allDay: false
                        },
                        {
                            title: 'Lunch',
                            start: new Date(y, m, d, 12, 0),
                            end: new Date(y, m, d, 14, 0),
                            allDay: false
                        },
                        {
                            title: 'Birthday Party',
                            start: new Date(y, m, d+1, 19, 0),
                            end: new Date(y, m, d+1, 22, 30),
                            allDay: false
                        },
                        {
                            title: 'Click for Google',
                            start: new Date(y, m, 28),
                            end: new Date(y, m, 29),
                            url: 'https://google.com/'
                        }
                    ],

                    // Buttons text localize
                    buttonText: {
                        today:    "<?php echo __('today')?>",
                        month:    "<?php echo __('month')?>",
                        week:     "<?php echo __('week')?>",
                        day:      "<?php echo __('day')?>",
                        list:     "<?php echo __('list')?>",
                    },
                });

                // Sets calendar locale
                calendar.setOption('locale', '{{ \Illuminate\Support\Facades\Lang::locale() }}');

                // Renders calendar
                calendar.render();
            });

            //Notifications Managment
            $(function () {  

                function startLookingForNotifications(){
                    const url = "{{ URL::route('notifications.getNotifications') }}";
                    ajaxRequest(url, null);
                    setTimeout( startLookingForNotifications, 30000 ); //repear function after 30 secounds
                }
                startLookingForNotifications()

                function addGroupInvitationRequests(invitations){
                    const notificationWrapper = document.getElementById('invitationWrapper');

                    //Insert new notifications to dropdown element
                    for (i = 0; i < invitations.length; i++) {
                        const requestID = invitations[i].requestID;
                        const groupName = invitations[i].group_name;
                        const requestorName = invitations[i].name;

                        const elementHtlm = `
                            <div class="dropdown-item" id="invitation${requestID}">
                                <i class="fas fa-users mr-2"></i>
                                <div class="item-body">
                                    <div class="item-title">${groupName}</div>
                                    <div class="item-decr">{{ __('Invited by') }} <span>${requestorName}</span></div>
                                </div>
                                <div class="item-buttons">
                                    <button class="button button-join" id="join${requestID}">{{ __('Join')}}</button>
                                    <button class="button button-decline" id="decline${requestID}">{{ __('Decline')}}</button>
                                </div>
                            </div>
                            <div class="dropdown-divider" id="divider${requestID}"></div>
                            `

                        const position = "beforeend";
                        notificationWrapper.insertAdjacentHTML(position, elementHtlm);

                        //Add event listener to decline button
                        const declineBtn = document.getElementById('decline'+requestID);
                        declineBtn.addEventListener('click', () =>{
                            declineInvitation(requestID);
                        })

                        //Add event listener to join button
                        const acceptBtn = document.getElementById('join'+requestID);
                        acceptBtn.addEventListener('click', () =>{
                            acceptInvitation(requestID);
                        })
                    } 
                }

                function getRequestRefusedHtml(requestID, groupName, recipientName){
                    const elementHtlm = `
                        <div class="dropdown-item" id="invitation${requestID}">
                            <i class="far fa-times-circle"></i>
                            <div class="item-body">
                                <div class="item-decr">{{ __('User') }} <span> ${recipientName}</span></div>
                                <div class="item-decr">{{ __('decline your request to') }} </div>
                                <div class="item-decr">{{ __('join the group:') }} <span>${groupName}</span></div>
                            </div>
                            <div class="item-buttons">
                                <button class="button button-join" id="informed${requestID}">{{ __('OK')}}</button>
                            </div>
                        </div>
                        <div class="dropdown-divider" id="divider${requestID}"></div>
                        `

                    return elementHtlm;
                }

                function getRequestComfirmedHtml(requestID, groupName, recipientName){
                    const elementHtlm = `
                        <div class="dropdown-item" id="invitation${requestID}">
                            <i class="far fa-check-circle"></i>
                            <div class="item-body">
                                <div class="item-decr">{{ __('User') }} <span> ${recipientName}</span></div>
                                <div class="item-decr">{{ __('accepted your request to') }} </div>
                                <div class="item-decr">{{ __('join the group:') }} <span>${groupName}</span></div>
                            </div>
                            <div class="item-buttons">
                                <button class="button button-join" id="informed${requestID}">{{ __('OK')}}</button>
                            </div>
                        </div>
                        <div class="dropdown-divider" id="divider${requestID}"></div>
                        `

                    return elementHtlm;
                }

                function addRequestResponseItems(requestResponse){
                    //Insert requestRespones to dropdown element
                    for (i = 0; i < requestResponse.length; i++) {
                        const requestID = requestResponse[i].requestID;
                        const groupName = requestResponse[i].group_name;
                        const recipientName = requestResponse[i].name;
                        const requestResponseStatus = requestResponse[i].status;

                        let requestResponseHtml = '';

                        if(requestResponseStatus == 2) {
                            requestResponseHtml = getRequestRefusedHtml(requestID, groupName, recipientName)
                        }else {
                            requestResponseHtml = getRequestComfirmedHtml(requestID, groupName, recipientName)
                        }

                        const notificationWrapper = document.getElementById('invitationWrapper');
                        const position = "beforeend";
                        notificationWrapper.insertAdjacentHTML(position, requestResponseHtml);

                        const informedBtn = document.getElementById('informed'+requestID);
                        informedBtn.addEventListener('click', () =>{
                            removeInvitation(requestID);
                        })
                    } 
                }

                function displayNotifications(invitations, requestResponse){

                    let notificationCount = 0;
                    //Remove all old notifications
                    const notificationWrapper = document.getElementById('invitationWrapper');
                    notificationWrapper.innerHTML = "";

                    //Add new Notifications
                    if(Array.isArray(invitations) && invitations.length > 0){
                        addGroupInvitationRequests(invitations);

                        notificationCount += invitations.length;
                    }

                    //Add new request responses
                    if(Array.isArray(requestResponse) && requestResponse.length > 0){
                        addRequestResponseItems(requestResponse);

                        notificationCount += requestResponse.length;
                    }

                    //Display how many notifications this user has
                    const notificationCountLable = document.getElementById('notificationCountLable');

                    if(notificationCount > 0){
                        notificationCountLable.style.display = 'inline-block'
                    }else{
                        notificationCountLable.style.display = 'none'
                    }

                    notificationCountLable.innerText = notificationCount;
                }

                //Removes notification item
                function removeNotificationitem(itemId){
                    document.getElementById('invitation'+itemId).remove();
                    document.getElementById('divider'+itemId).remove();

                    let label = document.getElementById('notificationCountLable');
                    let currentNotificationCount = parseInt(label.textContent);

                    if(currentNotificationCount-1 > 0){
                        label.style.display = 'inline-block'
                        label.innerText = currentNotificationCount-1;
                    }else{
                        label.style.display = 'none'
                        label.innerText = currentNotificationCount-1;
                    }

                    label.innerText = currentNotificationCount-1;
                }

                function declineInvitation(requestID){
                    const url = "{{ URL::route('invitation.decline') }}";
                    ajaxRequest(url, requestID);
                }

                function acceptInvitation(requestID){
                    const url = "{{ URL::route('invitation.accept') }}";
                    ajaxRequest(url, requestID);
                }

                function removeInvitation(requestID){
                    const url = "{{ URL::route('invitation.removeRequest') }}";
                    ajaxRequest(url, requestID);
                }

                //Ajax request
                function ajaxRequest(url, data){

                    $.ajax( {
                    type:'POST',
                    header:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    data:{
                    _token: "{{ csrf_token() }}",
                    dataType: 'json', 
                    contentType:'application/json',
                    //My passed data 
                    data: data
                    }


                    })
                    .done(function(data) {
                        if(data[0] === 'getNotifications'){
                            displayNotifications(data[1], data[2])
                        }else if(data[0] === 'requestResponded'){
                            removeNotificationitem(data[1])
                        }

                    })
                    .fail(function(error) {
        
                    });
                }
            })

        </script>

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

        {{-- Data table script --}}
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.5/fc-3.3.1/fh-3.1.7/r-2.2.6/sc-2.0.3/sb-1.0.0/sp-1.2.1/datatables.min.js"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')

</body>

</html>
