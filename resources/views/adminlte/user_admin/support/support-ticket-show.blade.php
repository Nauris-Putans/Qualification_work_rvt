@extends('adminlte::page')

@section('title', $ticket->title)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a>{{ __('Support') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>{{ __('View Ticket') }}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    {{-- Back button --}}
    <a class="btn btn-primary mb-3" href="/user/support/tickets" role="button">
        <i class="fas fa-chevron-left mr-1"></i>
        {{ __('Back') }}
    </a>

    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card card-outline card-primary">

                <div class="card-header">
                    <h1 class="card-title">#{{ $ticket->ticket_id }} - {{ $ticket->title }}</h1>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="ticket-info">

                        <p>{{ $ticket->message }}</p>

                        <p>{{ __('Category: ') . $ticket->category->name }}</p>

                        <p>
                            @if ($ticket->status === 'Opened')
                                {{ __('Status: ') }}
                                <span class="badge Opened ml-1 mb-0">
                                    {{ $ticket->status }}
                                </span>
                            @elseif ($ticket->status === 'Closed')
                                {{ __('Status: ') }}
                                <span class="badge Closed ml-1 mb-0">
                                    {{ $ticket->status }}
                                </span>
                            @endif
                        </p>

                        <p>{{ __('Created on: ') .  $ticket->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="card direct-chat direct-chat-primary direct-chat-contacts-open">
                        <div class="card-header ui-sortable-handle" style="cursor: default;">
                            <h3 class="card-title">
                                {{ __('Support Chat') }}
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="direct-chat-messages">
                                <!-- Message. Default to the left -->
                                @foreach($ticket->comments as $comment)

                                    {{-- Checks if comment user is who created comment --}}
                                    @if($comment->user->name == auth()->user()->getUser()->name)

                                        <!-- Message to the left -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-left">
                                                    {{ $comment->user->name }}
                                                </span>
                                                <span class="direct-chat-timestamp float-right">
                                                    {{ $comment->created_at->format('d M h:m') }}
                                                </span>
                                            </div>

                                            @if(file_exists(public_path() . auth()->user()->getUser()->profile_image) && auth()->user()->getUser()->profile_image != '')
                                                <img class="direct-chat-img" src="{{ asset(auth()->user()->getUser()->profile_image) }}" alt="message user image">
                                            @else
                                                @if(auth()->user()->getUser()->gender == 'Male')
                                                    <img class="direct-chat-img" src="{{ asset('images/256x256/256_1.png') }}" alt="message user image">
                                                @else
                                                    <img class="direct-chat-img" src="{{ asset('images/256x256/256_12.png') }}" alt="message user image">
                                                @endif
                                            @endif

                                            <div class="direct-chat-text">
                                                {{ $comment->comment }}
                                            </div>
                                        </div>

                                    {{-- Checks if comment user is not who created comment --}}
                                    @elseif ($comment->user->name != auth()->user()->getUser()->name)

                                    <!-- Message to the right -->
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-right">
                                                    {{ $comment->user->name }}
                                                </span>
                                                <span class="direct-chat-timestamp float-left">
                                                    {{ $comment->created_at->format('d M h:m') }}
                                                </span>
                                            </div>

                                            @if(file_exists(public_path() . $comment->user->profile_image) && $comment->user->profile_image != '')
                                                <img class="direct-chat-img" src="{{ asset($comment->user->profile_image) }}" alt="message user image">
                                            @else
                                                @if($comment->user->gender == 'Male')
                                                    <img class="direct-chat-img" src="{{ asset('images/256x256/256_1.png') }}" alt="message user image">
                                                @else
                                                    <img class="direct-chat-img" src="{{ asset('images/256x256/256_12.png') }}" alt="message user image">
                                                @endif
                                            @endif

                                            <div class="direct-chat-text">
                                                {{ $comment->comment }}
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>

                        <div class="card-footer">
                            <form action="{{ url('/user/support/tickets/' . $ticket->ticket_id . '/comment') }}" method="POST" class="form">
                                @csrf

                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                <div class="input-group">
                                    <input type="text" name="comment" placeholder="{{ __('Type Message ...') }}" class="form-control">
                                    <span class="input-group-append">
                                       <button type="submit" class="btn btn-primary">
                                           {{ __('Reply') }}
                                       </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
@stop

@section('js')

@stop
