@extends('layouts.app')
{{-- design and text for the faq page  --}}
@section('content')
    <section class="Team py-4 pb-5">
        <div class="wrapper">
            <h1> {{ __("WebCheck's Team") }}<h1>
            <div class="team">
            {{-- design and text for the first team member page  --}}
            <div class="team_member">
                <div class="team_img">
                    <img src="{{ URL::to('/images/Team1.png') }}">
                </div>
                    <h3>Rolands Bidzāns</h3>
                        <p class="role">{{ __("Full-stack devoloper") }}</p>
                        <p class="role">{{ __("Zabbix expert") }}</p>
                        <p class="role">{{ __("ER diagramm expert") }}</p>
                            
            </div>
            {{-- design and text for the second team member page  --}}
            <div class="team_member">
                <div class="team_img">
                    <img src="{{ URL::to('/images/Team2.png') }}">
                </div>
                    <h3>Nauris Putāns</h3>
                        <p class="role">{{ __("Full-stack devoloper") }}</p>
                        <p class="role">{{ __("Project manager") }}</p>
                        <p class="role">{{ __("Zabbix expert") }}</p>
            </div>
            {{-- design and text for the third team member page  --}}
            <div class="team_member">
                <div class="team_img">
                <img src="{{ URL::to('/images/Team3.png') }}">
                </div>
                    <h3>Dmitrijs Zverugo</h3>
                        <p class="role"></p>
                        <p class="role">{{ __("Full-stack devoloper") }}</p>
                        <p class="role">{{ __("Data system expert") }}</p>
                        <p class="role">{{ __("Design expert") }}</p>
            </div>
        </div>
        </div>	
    </section>
@endsection

@section('css')
    <link href="/css/sections/team.blade.css" rel="stylesheet">
@endsection

@section('scripts-top')

@endsection

@section('scripts-bottom')

@endsection
