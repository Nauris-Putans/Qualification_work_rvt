@extends('layouts.app')

    @section('content')
        <div class ="container">
            <div class="accordion">
                <h1>Frequently asked questions</h1>
                <div class="accordion-item" id="qusetion1"> 
                    <a class="accordian-link" href="#question1">
                        What is monitoring?
                    </a>
                    <div class = "answer">
                       Website monitoring is the process of testing and verifying that end-users can interact with a website or web application as expected. 
                       Website monitoring is often used by businesses to ensure website uptime, performance, and functionality is as expected.
                    </div>
                </div>

                <div class="accordion-item" id="qusetion2">
                    <a class="accordian-link" href="#question2">
                        Why do you need to use it
                    </a>

                    <div class = "answer">
                        Using a monitoring solution to keep an eye on your website produces a ton of valuable data. You will have accurate statistics about your site’s uptime and loading speed.
                    </div>
                </div>

                <div class="accordion-item" id="qusetion3">
                    <a class="accordian-link" href="#question3">
                        Why our monitoring is the best?
                    </a>
                    <div class = "answer">
                        Our monitorng service is the best, because we haven’t got tria. Free version, which has a lot of features will always be with. 
                        However, if you want to have more, you can buy Pro version and get everiything, that we offer on our website. 
                    </div>
                </div>

                <div class="accordion-item" id="qusetion4">
                    <a class="accordian-link" href="#question4">
                        What you can get from pro version?
                    </a>
                    <div class = "answer">
                        From 10€ per month you will be able to use a maximum offer of our website. 
                        If your accont goes down or there will be any errors on it, you will get notification  your phone and e-mail. 
                        You will have an opportunity to check 50 monitors at the same time. Checking time will be just 1 minute instead of 5. 
                        Also there will be available to see all your webstie history for unlimited time.  Finally your page will be checked for SSL certification and will have a status page option. 
                    </div>
                </div>

                <div class="accordion-item" id="qusetion5">
                    <a class="accordian-link" href="#question5">
                        What should I do if my website goes down?
                    </a>
                    <div class = "answer">
                        If you will notice, that your website has error or it is not working correctly, you can contact us and we will help you to solve this problem. 
                    </div>
                </div>

                <div class="accordion-item" id="qusetion6">
                    <a class="accordian-link" href="#question6">
                        Do I need to download any programms to check my website?
                    </a>
                    <div class = "answer">
                        You don’t have to, because our monitoring is working online on the web. 
                        There is two things, that you need - browser and internet. 
                    </div>
                </div>

                <div class="accordion-item" id="qusetion7">
                    <a class="accordian-link" href="#question7">
                        Why do I need to have e-mail or sms alerts?
                    </a>
                    <div class = "answer">
                        If your website will have any alerts or errors, than you will receive notofication on your email and phone. 
                        You will be informed, that in this time.
                    </div>
                </div>
                    
                <div class = "phrase">
                    Have more questions about something?
                </div>

                <div class = "row justify-content-center"> 
                    <a href="/contacts" class="btn btn-primary">Contact us</a> 
                </div>

            </div>
        </div>
    </section>
@endsection