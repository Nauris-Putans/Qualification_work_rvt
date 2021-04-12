<div class="boxed">
    <div class="input-info">
        <div spellcheck="false" class="form justify-content-center">
            <form method="POST" action="{{ URL::route('user.settings.personal_info.update', [$hashids->encode($user->id)]) }}" id="personal_info">
                @method('PATCH')
                @csrf

                <div class="col-12 mb-4">
                    <h5>
                        {{ __('Change :attribute here', ['attribute' => __("Subscription")]) }}
                    </h5>
                </div>

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="card col-sm-12 col-md-6 col-lg-3 text-center mr-3">
                            <div class="card-body">
                                <h4 class="card-title text-muted" style="float: none;">{{ __('Current subscription') }}</h4>

                                @if ($planName === null)
                                    <h5 class="card-text"><strong>{{ __('None') }}</strong></h5>
                                @else
                                    <h5 class="card-text"><strong>{{ $planName . " - " . __('plan') }}</strong></h5>
                                @endif

                            </div>
                        </div>

                        <div class="card col-sm-12 col-md-6 col-lg-3 text-center">
                            <div class="card-body">
                                <h4 class="card-title text-muted" style="float: none;">{{ __('Next billing date') }}</h4>

                                @if ($timestamp === null)
                                    <h5 class="card-text"><strong>{{ __('None') }}</strong></h5>
                                @else
                                    @if (Config::get('app.locale') !== 'ru')
                                        <h5 class="card-text">
                                            <strong>{{ strftime("%B %e, %Y", strtotime($timestamp)) }}</strong>
                                        </h5>
                                    @else
                                        <h5 class="card-text">
                                            <strong>{{ iconv('windows-1251', 'utf-8', strftime("%B %e, %Y", strtotime($timestamp))) }}</strong>
                                        </h5>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                @if ($planName !== null && $timestamp !== null)
                    <div class="col-12 mt-3 mb-3">

                        {{ Form::component('subscriptionChangeForm', 'components.form.adminlte.user_admin.subscription-change-form', ['hashids' => $hashids, 'user' => $user, 'timestamp' => $timestamp, 'planName' => $planName]) }}
                        {{ Form::subscriptionChangeForm() }}

                        {{ Form::component('subscriptionCancelForm', 'components.form.adminlte.user_admin.subscription-cancel-form', ['hashids' => $hashids, 'user' => $user, 'timestamp' => $timestamp, 'planName' => $planName]) }}
                        {{ Form::subscriptionCancelForm() }}

                        <hr>
                    </div>

                    <div class="col-12">
                        <div class="card card-info collapsed-card">
                            <div class="card-header ui-sortable-handle" style="cursor: default;">
                                <h3 class="card-title">
                                    {{ __('Activity') }}
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="tab-pane active" id="timeline">
                                            @if($invoices->isEmpty())
                                                <a>{{ __('No activity for this user') }}</h3>
                                            @else
                                                <div class="timeline timeline-inverse">
                                                    @foreach ($invoices as $invoice)
                                                        <div class="time-label">
                                                            <span class="bg-green">
                                                                @if (Config::get('app.locale') !== 'ru')
                                                                    {{ strftime("%d %b", strtotime($invoice->date()->setTimezone(new DateTimeZone('Europe/Riga')))) }}
                                                                @else
                                                                    {{ iconv('windows-1251', 'utf-8', strftime("%d %b", strtotime($invoice->date()->setTimezone(new DateTimeZone('Europe/Riga'))))) }}
                                                                @endif
                                                                <input name="stop" type="hidden" value="stop">
                                                            </span>
                                                        </div>

                                                        <div>
                                                            <i class="fas fa-file-invoice bg-primary"></i>

                                                            <div class="timeline-item">
                                                                <span class="time">
                                                                    <i class="far fa-clock"></i>{{ strftime(" %H:%M", strtotime($invoice->date()->setTimezone(new DateTimeZone('Europe/Riga')))) }}
                                                                </span>

                                                                <h3 class="timeline-header">{{ __('Subscription invoice') }}</h3>

                                                                <div class="timeline-body">
                                                                    {{ __($invoice->lines->data[0]->description) }}
                                                                </div>

                                                                <div class="timeline-footer">
                                                                    <a href="{{ route('invoice.download', ['invoice' => $invoice->id, 'userID' => $user->id]) }}" class="btn btn-info btn-sm">{{ __('Download .pdf') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </form>
        </div>
    </div>
</div>
