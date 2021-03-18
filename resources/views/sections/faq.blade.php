@extends('layouts.app')

@section('content')
    <section class="Faq py-4 pb-5" style="background-color: #182232">
        <div class="container">
            <h1 class="FeaturesPageHeader fade-in align-self-center text-center text-md-center text-white font-weight-bold text-shadow">
                {{ __("Frequently asked questions") }}
            </h1>

            <button type="button" class="collapsible">
                {{ __("What is monitoring?") }}
            </button>

            <div class="content">
                <p>
                    {{ __("Website monitoring is the process of testing and verifying that end-users can interact with a website or web application as expected. Website monitoring is often used by businesses to ensure website uptime, performance, and functionality is as expected.") }}
                </p>
            </div>

            <button type="button" class="collapsible">
                {{ __("Why should I use monitoring service?") }}
            </button>

            <div class="content">
                <p>
                    {{ __("By using monitoring service you can keep an eye on your website that produces a ton of valuable data.") }}
                </p>
            </div>

            <button type="button" class="collapsible">
                {{ __("Why our monitoring service is the unique?") }}
            </button>

            <div class="content">
                <p>
                    {{ __("Our monitoring service is unique by giving a lot of custom build in Zabbix features, that user can use for his needs. For free plan we give little inside of our website monitoring, however if you want to have more fantastic features, you can subscribe to our Pro, Webmaster or Enterprise plan, that we offer on our website.") }}
                </p>
            </div>

            <button type="button" class="collapsible">
                {{ __("Do I need to download any programs to check my website?") }}
            </button>

            <div class="content">
                <p>
                    {{ __("You don’t have to download anything, because our monitoring service is working online on the web. There is two things, that you need - browser and internet.") }}
                </p>
            </div>

            <button type="button" class="collapsible">
                {{ __("How much do I need to pay?") }}
            </button>

            <div class="content">
                <p>
                    {{ __("A fixed price is set depending on your subscription plan. Each month you pay same price.") }}
                </p>
            </div>

            <button type="button" class="collapsible">
                {{ __("How can I cancel my subscription plan?") }}
            </button>

            <div class="content">
                <p>
                    {{ __("You can cancel your subscription plan in account settings.") }}
                </p>
            </div>

            <button type="button" class="collapsible">
                {{ __("How can I upgrade my subscription plan?") }}
            </button>

            <div class="content">
                <p>
                    {{ __("You can upgrade your subscription plan in account settings.") }}
                </p>
            </div>

            <div class="container" style="text-align: center;">
                <h2 class="mt-5 fade-in align-self-center text-center text-md-center text-white font-weight-bold text-shadow">
                    {{ __("Have unanswered questions?") }}
                </h2>

                <a href="{{ route('contacts') }}" type="button" class="mt-2 btn btn-orange">
                    {{ __("Contact us") }}
                </a>
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('scripts-top')

@endsection

@section('scripts-bottom')
    <script type="text/javascript">

        // Shows and hides frequently asked questions script
        $(function ()
        {
            let coll = document.getElementsByClassName("collapsible");
            let i;

            for (i = 0; i < coll.length; i++)
            {
                coll[i].addEventListener("click", function()
                {
                    this.classList.toggle("active");
                    var content = this.nextElementSibling;

                    if (content.style.maxHeight)
                    {
                        content.style.maxHeight = null;
                    }

                    else
                    {
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            }
        });
    </script>
@endsection

@section('css')
 <link href="/css/sections/faq.blade.css" rel="stylesheet">
@stop
