@extends('adminlte::page')
@section('title', __('User group'))

@section('content_header')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ URL::route('admin.user_admin.index') }}" >{{ __('Dashboard')}}</a>
            \
            <a href="{{ URL::route('userGroup.show') }}" >{{ __('User groups')}}</a>
            \
            <a >{{ __('User group control')}}</a>
        </li>
    </ol>
</nav>
@stop

@section('content')
    <div class="row" style="flex-wrap: wrap">
        <div class="col-12 col-sm-6 col-md-3">
            <section class="InviteNewMember">
                <div class="row ">
                    <div class="col-12">
                        <div class="sectionHeader">
                            <i class="fas fa-user-plus"></i>
                            <div class="sectionHeader-title">
                                Invite new member
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-inline">
                            <div class="input-group" data-widget="sidebar-search">
                              <input id="searchInput" class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                              <div class="input-group-append">
                                <button class="btn btn-sidebar" id="searchBtn">
                                  <i class="fas fa-search fa-fw"></i>
                                </button>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 foundUsersBox" id="foundUsersBox">

                    </div>
                </div>
            </section>
        </div>
        <div class="col-12 col-sm-6 col-md-9">
            <section class="GroupMembers">
                <div class="row">
                    <div class="col-12">
                        <div class="sectionHeader">
                            <i class="fas fa-user-secret"></i>
                            <div class="sectionHeader-title">
                                Group members
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($users as $person)
                    <div class="col-12 col-sm-12 col-md-6 d-flex align-items-stretch">
                        <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            {{ $person->permission}}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b>{{ $person->name}}</b></h2>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$person->city}}, {{$person->country}} </li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone : {{$person->phone_number}}</li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                @if($person->profile_image)
                                    <img alt="Person image" class="table-avatar" src="../../..{{ $person->profile_image}}">
                                @else
                                    @if($person->gender == 'Female')
                                        <img alt="Person image" class="table-avatar" src="../../../images/256x256/256_12.png">
                                    @else
                                        <img alt="Person image" class="table-avatar" src="../../../images/256x256/256_15.png">
                                    @endif
                                @endif
                            </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                            <a href="#" class="btn btn-sm bg-teal">
                                <i class="fas fa-comments"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-user"></i> View Profile
                            </a>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

@stop

@section('css')
    <link href="/css/adminlte/user_admin/userGroupControl.css" rel="stylesheet">
@stop

@section('js')
    <script>
        $(function () {  
            const groupID = "<?php Print($groupId); ?>";

            const searchBtn = document.getElementById('searchBtn');
            searchBtn.addEventListener('click', () => {
                const inputForm = document.getElementById('searchInput');
                findUsers(inputForm.value)
            });

            function removeAllFoundUsers(){
                document.getElementById('foundUsersBox').innerHTML = '';
            }

            function changeAddButtonToRequested(elementId){
                let btn = document.getElementById(elementId);

                btn.classList.remove('button-add');
                btn.classList.add('button-requested');
                btn.innerText = 'requested';
            }

            function addEventToAddUserBtn(elementId){

                const btn = document.getElementById(elementId)

                btn.addEventListener('click', () =>{
                    const userId = parseInt(elementId.replace('addUser', ''));
                    inviteUser(userId);
                })
            }

            function addNewUserBoxes(users){

                const userWrapper = document.getElementById('foundUsersBox');

                let i;
                for(i=0; i < users.length; i++){

                    let imgPath = '';
                    if(users[i].profile_image){
                        imgPath = '../../..'+users[i].profile_image;
                    }else if(users[i].gender == 'Female'){
                        imgPath = '../../../images/256x256/256_11.png';
                    }else{
                        imgPath ='../../../images/256x256/256_15.png';
                    }

                    const card = `
                        <div class="card">
                            <img src="${imgPath}" alt="user img">
                            <div class="card-text">
                                <div class="card-title">${users[i].name}</div>
                                <div class="card-decr">${users[i].email}</div>
                            </div>
                            <button class="button" id="addUser${users[i].id}">
                                <i class="fas fa-plus"></i>
                                Add
                            </button>
                        </div>
                    `

                    const position = "beforeend";

                    userWrapper.insertAdjacentHTML(position, card);

                    const btn = document.getElementById('addUser'+users[i].id);

                    if(users[i].request == 'member'){
                        btn.classList.add('button-member');
                        btn.innerHTML = 'member'; 
                    }else if(users[i].request == 'requested'){
                        btn.classList.add('button-requested');
                        btn.innerHTML = 'requested';
                    }else{
                        btn.classList.add('button-add');
                        btn.innerHTML = 
                            `
                                <i class="fas fa-plus"></i>
                                Add
                            `
                    }

                    addEventToAddUserBtn("addUser"+users[i].id);
                }

            }

            //Find users
            function findUsers(email){
                removeAllFoundUsers();
                if(email){
                    $.ajax( {
                    type:'POST',
                    header:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ URL::route('userGroup.findUsers') }}",
                    data:{
                    _token: "{{ csrf_token() }}",
                    dataType: 'json', 
                    contentType:'application/json',
                    //My passed data 
                    emailToFind: email,
                    group : groupID
                    }


                    })
                    .done(function(data) {
                        console.log(data);
                        addNewUserBoxes(data)
                    })
                    .fail(function(error) {
        
                    });
                }else{

                }
            }

            //Find user
            function inviteUser(userId){
                if(userId){
                    $.ajax( {
                    type:'POST',
                    header:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ URL::route('userGroup.inviteUser') }}",
                    data:{
                    _token: "{{ csrf_token() }}",
                    dataType: 'json', 
                    contentType:'application/json',
                    //My passed data 
                    user: userId,
                    group : groupID
                    }


                    })
                    .done(function(data) {
                        console.log(data);
                        changeAddButtonToRequested("addUser"+data)

                    })
                    .fail(function(error) {
        
                    });
                }else{

                }
            }
        });
    </script>
@stop
