@extends('adminlte::page')
@section('title', __('User profile'))

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ URL::route('admin.user_admin.index') }}" >{{ __('Dashboard')}}</a>
                \
                <a href="{{ URL::route('monitor.list.show') }}" >{{ __('Monitor list')}}</a>
                \
                <a>{{ __('User profile')}}</a>
            </li>
        </ol>
    </nav>
@stop

@section('content')
    <section class="upTimeMonitor">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="card card-outline card-primary">
                    <div class="card-body text-center">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/images/256x256/256_12.png" alt="User profile picture" style="width: 150px; height: 150px">
                        </div>

                        <h3 class="profile-username text-center">{{$userInfo[0]->fullName}}</h3>

                        <p class="text-muted text-center">{{$userInfo[0]->display_name}}</p>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">{{ __('About Me')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <strong><i class="fas fa-envelope"></i> {{ __('Email')}}</strong>

                      <p class="text-muted">
                        {{$userInfo[0]->email}}
                      </p>

                      <hr>

                      <strong><i class="fas fa-venus-mars"></i> {{ __('Gender')}}</strong>

                      <p class="text-muted">{{$userInfo[0]->gender ?? __('No data')}}</p>

                      <hr>

                      <strong><i class="fas fa-calendar-day"></i> {{ __('BirthDay')}}</strong>

                      <p class="text-muted">
                        {{$userInfo[0]->birthday ?? __('No data')}}
                      </p>

                      <hr>

                      <strong><i class="fas fa-phone-alt"></i> {{ __('Mobile phone')}}</strong>

                      <p class="text-muted">{{$userInfo[0]->phone_number ?? __('No data')}}</p>

                      <hr>

                      <strong><i class="fas fa-map-marker-alt"></i> {{ __('Location')}}</strong>

                      <p class="text-muted">{{ $userInfo[0]->country.','.$userInfo[0]->city ?? __('No data')}}</p>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                  <div class="card-header bg-info">
                    <h1 class="card-title">{{ __('Timeline')}}</h1>
                  </div>
                  <div class="card-body" style="overflow-y: auto; height: 550px;">
                    <div class="tab-content">
                      <div class="tab-pane active" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse" id="timeline_wrapper">
                          {{-- Automaticaly created logs --}}
                        </div>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div>
        </div>
    </section>
@stop

@section('css')
{{-- <link href="/css/userAdmin.css" rel="stylesheet"> --}}
@stop

@section('js')
    <script>
      $(function(){

        function getLogEvent(logStatus){
          let event = 0;
          if(logStatus == "created monitor"){
            event = 0;
          }else if(logStatus == "edited monitor"){
            event = 1;
          }else if(logStatus == "deleted monitor"){
            event = 2;
          }else{
            event = 3;
          }

          return event;
        }

        const logsGroupedByDate = <?php echo json_encode($logsGroupedByDate); ?>;
        const logContainer = document.getElementById('timeline_wrapper');
        const icons = ['fa-plus bg-info', 'fa-pen-alt bg-warning', 'fa-trash-alt bg-red', 'fa-info bg-purple']
        const titles  = new Array(4);
          titles[0] = @json( __("Created monitor")  );
          titles[1] = @json( __("Edited monitor")  );
          titles[2] = @json( __("Deleted monitor")  );
          titles[3] = @json( __("Status has been changed for monitor")  );
        const position = "beforeend";

        for (const [key, groupedLogs] of Object.entries(logsGroupedByDate)) {
          const timeSeparator = `
              <div class="time-label">
                <span class="bg-red">${key}</span>
              </div>
              `
          logContainer.insertAdjacentHTML(position,timeSeparator);

          for(let i=0; i<groupedLogs.length; i++){
            const event = getLogEvent(groupedLogs[i].function);
            const element = `
                <div>
                  <i class="fas ${icons[event]}"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> ${groupedLogs[i].time}</span>

                    <h3 class="timeline-header">
                      ${titles[event]} 
                      <span style="font-weight: 550">${groupedLogs[i].decription}</span>
                    </h3>
                  </div>
                </div>
                `
            logContainer.insertAdjacentHTML(position,element);
          }

        }
      });
    </script>
@stop
