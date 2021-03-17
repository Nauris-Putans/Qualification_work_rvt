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
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body" style="overflow-y: auto; height: 550px;">
                    <div class="tab-content">
                      <div class="tab-pane active" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-envelope bg-primary"></i>
    
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 12:05</span>
    
                              <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
    
                              <div class="timeline-body">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                quora plaxo ideeli hulu weebly balihoo...
                              </div>
                              <div class="timeline-footer">
                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-user bg-info"></i>
    
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
    
                              <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                              </h3>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-comments bg-warning"></i>
    
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
    
                              <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
    
                              <div class="timeline-body">
                                Take me to your leader!
                                Switzerland is small and neutral!
                                We are more like Germany, ambitious and misunderstood!
                              </div>
                              <div class="timeline-footer">
                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->

                          <div>
                            <i class="far fa-clock bg-gray"></i>
                          </div>
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
<link href="/css/userAdmin.css" rel="stylesheet">
@stop

@section('js')

@stop