@extends('layouts.app')

    @section('content')
    <section class="Faq py-4 pb-5" style="background-color: #182232">
            <div class ="container">

                <h1>Frequently asked questions</h1>
                    <button type="button" class="collapsible">What is monitoring?</button>
                    <div class="content">
                      <p>
                        Website monitoring is the process of testing and verifying that end-users can interact with a website or web application as expected. 
                        Website monitoring is often used by businesses to ensure website uptime, performance, and functionality is as expected.
                     </p>
                    </div>
                
                    <button type="button" class="collapsible">Why do you need to use it?</button>
                    <div class="content">
                      <p> 
                        Using a monitoring solution to keep an eye on your website produces a ton of valuable data. 
                        You will have accurate statistics about your site’s uptime and loading speed.
                     </p>
                    </div>
            
                    <button type="button" class="collapsible">Why our monitoring is the best?</button>
                    <div class="content">
                      <p>
                          Our monitorng service is the best, because we haven’t got tria. Free version, which has a lot of features will always be with. 
                        However, if you want to have more, you can buy Pro version and get everiything, that we offer on our website. 
                     </p>
                    </div>
                
                    <button type="button" class="collapsible">What you can get from pro version?</button>
                    <div class="content">
                      <p>
                        From 10€ per month you will be able to use a maximum offer of our website. 
                        If your accont goes down or there will be any errors on it, you will get notification  your phone and e-mail. 
                        You will have an opportunity to check 50 monitors at the same time. Checking time will be just 1 minute instead of 5. 
                        Also there will be available to see all your webstie history for unlimited time.  Finally your page will be checked for SSL certification and will have a status page option. 
                     </p>
                    </div>
            
                    <button type="button" class="collapsible">What should I do if my website goes down?</button>
                    <div class="content">
                      <p>
                          If you will notice, that your website has error or it is not working correctly, you can contact us and we will help you to solve this problem. 
                     </p>
                    </div>
                
                    <button type="button" class="collapsible">Do I need to download any programms to check my website?</button>
                    <div class="content">
                      <p>
                        You don’t have to, because our monitoring is working online on the web. 
                        There is two things, that you need - browser and internet. 
                     </p>
                    </div>
            
                    <button type="button" class="collapsible">Why do I need to have e-mail or sms alerts?</button>
                    <div class="content">
                      <p>
                          If your website will have any alerts or errors, than you will receive notofication on your email and phone. 
                          You will be informed, that in this time.
                     </p>
                    </div>


            </div>

        
    </section>

    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script type="text/javascript">
    $(function () {
        let coll = document.getElementsByClassName("collapsible");
        let i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                console.log(this.nextElementSibling);
                var content = this.nextElementSibling;
                if (content.style.maxHeight){
                    content.style.maxHeight = null;
            } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    
    });
    </script>


@endsection