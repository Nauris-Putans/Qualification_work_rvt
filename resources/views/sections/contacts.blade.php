@extends('layouts.app')

@section('content')
    <!-- Section - Kontakti -->
    <section class="Kontakti py-4 pb-5" style="background-image: url({{ URL::asset('/images/ContactBackground.jpg') }}); background-repeat: no-repeat; background-size: cover;">
        <div class="box">
            <div class="container">
                <div class="info-text">
                    <h1 class="fade-in align-self-center text-center text-md-center text-white font-weight-bold" style="text-shadow: 1px 1px 1px #000000;">
                        Any questions?
                    </h1>

                    <div class="contacts-info font-weight-bold" style="text-shadow: 1px 1px 1px #000000;">
                        <i class="fas fa-phone-alt mt-3"></i>
                        <a>(+371) 22222222</a>

                        <i class="fas fa-envelope mt-3"></i>
                        <a>webcheck@gmail.com</a>

                        <i class="fas fa-map-marker-alt mt-3"></i>
                        <a>Krišjāņa Valdemāra iela 1C, Centra rajons, Rīga, LV-1010</a>
                    </div>

                    {{ Form::component('contact', 'components.form.ticket-form', ['name', 'value' => null, 'attributes' => []]) }}
                    {{ Form::contact() }}
                </div>

                <div class="map-responsive">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2175.755876680212!2d24.10172601608214!3d56.95298370625549!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46eecf7bac058ce9%3A0x96a8a0e931b27448!2sR%C4%ABgas%20Valsts%20Tehnikums!5e0!3m2!1slv!2slv!4v1583158717906!5m2!1slv!2slv" width="1200" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>

            </div>
        </div>
    </section>
@endsection
