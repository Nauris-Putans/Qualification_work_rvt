@extends('layouts.app')

    @section('content')
    <section class="Faq py-4 pb-5" style="background-color: #182232">
        <div class="box">
            <div class ="container">
                <div class="accordion">

                    <div class = "phrase">Frequently asked questions</div>

                    <div class="accordion-item">
                        <a class="accordian-link" onclick="myFunction1()">
                            1. What is monitoring?
                        </a>
                            <hr class="fade-in">
                        <div class ="answer">
                            <a class = "show" id="answer1">
                                Website monitoring is the process of testing and verifying that end-users can interact with a website or web application as expected. 
                                Website monitoring is often used by businesses to ensure website uptime, performance, and functionality is as expected.
                            </a>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <a class="accordian-link" onclick="myFunction2()">
                            2. Why do you need to use it?
                        </a>
                            <hr class="fade-in">
                        <div class ="answer">
                            <a class="show" id="answer2">
                                Using a monitoring solution to keep an eye on your website produces a ton of valuable data. You will have accurate statistics about your site’s uptime and loading speed.
                            </a>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <a class="accordian-link" onclick="myFunction3()">
                            3. Why our monitoring is the best?
                        </a>
                            <hr class="fade-in">
                        <div class ="answer">
                            <a class = "show" id= "answer3">
                                Our monitorng service is the best, because we haven’t got tria. Free version, which has a lot of features will always be with. 
                                However, if you want to have more, you can buy Pro version and get everiything, that we offer on our website. 
                            </a>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <a class="accordian-link" onclick="myFunction4()">
                            4. What you can get from pro version?
                        </a>
                            <hr class="fade-in">
                        <div class ="answer">
                            <a class = "show" id="answer4">
                                From 10€ per month you will be able to use a maximum offer of our website. 
                                If your accont goes down or there will be any errors on it, you will get notification  your phone and e-mail. 
                                You will have an opportunity to check 50 monitors at the same time. Checking time will be just 1 minute instead of 5. 
                                Also there will be available to see all your webstie history for unlimited time.  Finally your page will be checked for SSL certification and will have a status page option. 
                            </a>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <a class="accordian-link" onclick="myFunction5()">
                            5. What should I do if my website goes down?
                        </a>
                            <hr class="fade-in">
                        <div class ="answer">
                            <a class = "show" id= "answer5" class="hide">
                                If you will notice, that your website has error or it is not working correctly, you can contact us and we will help you to solve this problem. 
                            </a>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <a class="accordian-link" onclick="myFunction6()">
                            6. Do I need to download any programms to check my website?
                        </a>
                            <hr class="fade-in">
                        <div class ="answer">
                            <a class = "show" id= "answer6">
                                You don’t have to, because our monitoring is working online on the web. 
                                There is two things, that you need - browser and internet. 
                            </a>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <a class="accordian-link" onclick="myFunction7()">
                            7. Why do I need to have e-mail or sms alerts?
                        </a>
                            <hr class="fade-in">
                        <div class ="answer">
                            <a class = "show" id= "answer7">
                                If your website will have any alerts or errors, than you will receive notofication on your email and phone. 
                                You will be informed, that in this time.
                            </a>
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
        </div>
    </section>

    <script>
        function myFunction1() 
        {
            var x = document.getElementById("answer1");
            if (x.style.display === "none") 
            {
                x.style.display = "block";
            } 
            else 
            {
                x.style.display = "none";
            }
        }
    </script>

    <script>
        function myFunction2() 
        {
            var x = document.getElementById("answer2");
            if (x.style.display === "none") 
            {
                x.style.display = "block";
            } 
            else 
            {
                x.style.display = "none";
            }
        }
    </script>

    <script>
        function myFunction3() 
        {
            var x = document.getElementById("answer3");
            if (x.style.display === "none") 
            {
                x.style.display = "block";
            } 
            else 
            {
                x.style.display = "none";
            }
        }
    </script>

    <script>
        function myFunction4() 
        {
            var x = document.getElementById("answer4");
            if (x.style.display === "none") 
            {
                x.style.display = "block";
            } 
            else 
            {
                x.style.display = "none";
            }
        }
    </script>

    <script>
        function myFunction5() 
        {
            var x = document.getElementById("answer5");
            if (x.style.display === "none") 
            {
                x.style.display = "block";
            } 
            else 
            {
                x.style.display = "none";
            }
        }
    </script>

    <script>
        function myFunction6() 
        {
            var x = document.getElementById("answer6");
            if (x.style.display === "none") 
            {
                x.style.display = "block";
            } 
            else 
            {
                x.style.display = "none";
            }
        }
    </script>

    <script>
        function myFunction7() 
        {
            var x = document.getElementById("answer7");
            if (x.style.display === "none") 
            {
                x.style.display = "block";
            } 
            else 
            {
                x.style.display = "none";
            }
        }
    </script>

@endsection