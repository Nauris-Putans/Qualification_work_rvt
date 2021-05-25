@extends('adminlte::page')
@section('title', __('User group'))

@section('content_header')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ URL::route('admin.user_admin.index') }}" >{{ __('Dashboard')}}</a>
            \
            <a >{{ __('User group')}}</a>
        </li>
    </ol>
</nav>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <section class="groupHeader">
                <div class="titleBox">
                    <div class="titleBox-iconBox">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div class="titleBox-title">Groups</div>
                </div>
            </section>

            <section class="groupBody">
                
                @foreach ($groups as $group)
                    <div class="card">
                        <div class="card-header">
                            @if($group->currentlyInUse == true)
                                <div value="{{ $group->group_id}}" class="checkBox selected">
                                    <i class="fas fa-check"></i>
                                </div>
                            @else
                                <div value="{{ $group->group_id}}" class="checkBox">
                                    <i class="fas fa-check"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($group->profile_image)
                                <img alt="Avatar" class="table-avatar" src="../../../..{{ $group->profile_image}}">
                            @else
                                @if($group->gender == 'Female')
                                    <img alt="Avatar" class="table-avatar" src="../../../../images/256x256/256_9.png">
                                @else
                                    <img alt="Avatar" class="table-avatar" src="../../../../images/256x256/256_15.png">
                                @endif
                            @endif
                            <div class="text-company">{{ $group->group_name}}</div>
                            <div class="text-admin">{{ $group->name}}</div>
                            <div class="card-body-tools">
                                @if($group->currentlyInUse == true)
                                    <button value="{{ $group->group_id}}" type="button" class="button-changGroup disabled">Currently in use</button>
                                @else
                                    <button value="{{ $group->group_id}}" type="button" class="button-changGroup" >Use group</button>
                                @endif

                                <form method="GET" action="{{ URL::route('userGroup.controlGroupMembers', [$group->group_id]) }}">
                                    @csrf
                                    <button type="submit" class="button-groupControl" >Control group</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="footerBox">
                                <div class="title">Created</div>
                                <div class="decr">01 march 2021</div>
                            </div>
                            <div class="footerBox">
                                <div class="title">Members</div>
                                <div class="decr">{{ $group->totalMemberCount}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>

@stop

@section('css')
    <link href="/css/adminlte/user_admin/userGroup.css" rel="stylesheet">
@stop

@section('js')
  <script>
    $(function () {  


        //Set event listener to change group buttons
        function setEventToChangeGroupButton(){
            const buttons = document.querySelectorAll('.button-changGroup');

            buttons.forEach((button) => {
                button.addEventListener('click', () => {
                    changeGroup(button.value);
                });
            });
        }
        setEventToChangeGroupButton();

        //Remove class disabled from change group buttons
        function removeClassDisabledFromChangeGroupButtons(){
            const buttons = document.querySelectorAll('.button-changGroup');

            buttons.forEach((button) => {
                button.classList.remove('disabled');
                button.innerHTML = 'Use Group';
            });
        }

        //Remove class selected from card header checkBoxes
        function removeClassSelectedFromCheckBoxes(){
            const checkBoxes = document.querySelectorAll('.checkBox');

            checkBoxes.forEach((checkBox) => {
                checkBox.classList.remove('selected');
            });
        }

        //Add class selected to card header checkBoxes
        function addClassSelectedToCheckBox(groupId){
            const checkBoxes = document.querySelectorAll('.checkBox');

            checkBoxes.forEach((checkBox) => {

                if(groupId == checkBox.getAttribute('value')){
                    checkBox.classList.add('selected');
                }
            });
        }

        //Add class disabled to change group buttons
        function addClassDisabledFromChangeGroupButtons(groupId){
            const buttons = document.querySelectorAll('.button-changGroup');

            buttons.forEach((button) => {
                if(groupId == button.value){
                    button.classList.add('disabled');
                    button.innerHTML = 'Currently in use';
                }
            });
        }

        //Change group
        function changeGroup(groupId){
            removeClassDisabledFromChangeGroupButtons();
            removeClassSelectedFromCheckBoxes();

            let url = "{{ URL::route('userGroup.changeGroup', ':id') }}";
            url = url.replace(':id', groupId);

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
            groupId: groupId
            }


            })
            .done(function(data) {

                if(data.error){

                }else{
                    addClassSelectedToCheckBox(data);
                    addClassDisabledFromChangeGroupButtons(data);
                }
            })
            .fail(function(error) {
  
            });
        }

        
    });
  </script>
@stop
