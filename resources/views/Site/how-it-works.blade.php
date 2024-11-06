@extends('Site.layouts.app')
@section('SiteContent')
<style>
   .heading-main {
    text-align: center;
    margin-top: 100px;
    margin-bottom: 170px;
}

.page-heading {
    font-size: 70px;
    color: #111637;
    font-weight:bolder;
    text-decoration: underline !important;
}

@media (max-width: 767px) {
    .page-heading {
        font-size: 36px;
        margin-top: 200px;
        margin-bottom: 70px;
    }
}

.content-padding {
    
    padding-bottom: 200px !important;
}

.bg-color {
    background-color: #f1f0f0 !important;
}

.section-heading {
    color: #2E7BF1;
    font-weight: bold;
    padding-top: 50px;
}

.section-para {
    color: #555;
    font-weight: 500;
    font-size: large;
}

.image-top {
    padding-top: 50px;
    margin-top: -150px !important;
}

.image-top-sm {
    margin-top: -100px !important;
}

.col-md-6 col-12 img {
    max-width: 100%;
    height: auto;
}

.margin-height {
    margin-top: 120px !important;
}
</style>





<div
    class=" how-it-works-section py-5"
    style=" margin-top: 70px"
>
    <div
        class="d-flex flex-column justify-content-center align-items-center mt-4 mb-4"
    >
        <!-- <h4 class="how-it-works-heading">How its work</h4> -->
        <h1 class="display-5 font-weight-bold">
            WeConnectt For The Professionals
        </h1>

        <center style="color: #a5a4a4; font-size: 18px" class="mb-4">
            WeConnectt brings services to the people. Millions use Weconnectt
            <br />to find the perfect service providers everyday.
        </center>

        <button
            id="joinProfessionsBtn2"
            class="btn btn-lg btn-primary mt-4 mb-4"
        >
            Join as a Professional
        </button>
    </div>

    <script>
        $(document).ready(function () {
            // When the button is clicked
            $("#joinProfessionsBtn2").click(function () {
                // Redirect to the specified URL
                window.location.href =
                    "{{ url('/account/professional/account/starter') }}";
            });
        });
    </script>

    <br />

<div class="how-it-works-customers-section">


    <div class="heading-main">
        <h1 class="page-heading">How It Works?</h1>
        <p class="section-para" style="font-weight:bolder; font-size:26px;"> At Weconnectt, we make finding new clients and growing your
            business simple and efficient. <br>Here's a step-by-step guide
            on how to get started:</p>
    </div>




 <!-- Section  -->
    <div class="container-fluid  bg-color">
        <div class="container">
            <div class=" row align-items-center justify-content-between">
                <!-- Image Section -->
                <div class="col-md-6 col-12   mb-4 "  style="margin-top: 30px;">
                    <img src="{{ asset('Site/Images/hiwp-2.webp') }}" class="img-fluid rounded    image-top"
                        alt="Image">
                </div>
                <!-- Text Section -->
                <div class="col-md-6 col-12   justify-content-center ">
                    <h2 class="how-it-works-heading-customers section-heading display-5 ">Customer Needs, Your Expertise</h2>
                    <p class="section-para mt-3">We cover a wide range of services for individuals and small
                        businesses, gathering detailed information on exactly what
                        our customers need.</p>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- End Section  -->
    
    
    
        <!-- Section  -->
    <div class="container-fluid   margin-height">
        <div class="container">
            <div class=" row  align-items-center justify-content-between">
                <!-- Text Section -->
                <div class="col-md-6 col-12   justify-content-center   mb-4  content-padding">

                    <h2 class="how-it-works-heading-customers section-heading display-5 ">Customers Find You</h2>
                    <p class="section-para mt-3">On Weconnectt, customers can easily find and connect with
                        your business. Additionally, we send you leads that match
                        your services. For a small fee per introduction, we provide
                        you with the potential customer's phone number and email
                        address, allowing you to reach out directly.</p>
                </div>
                <!-- Image Section -->
                <div class="col-md-6 col-12   mb-4 ">
                    <img src="{{ asset('Site/Images/hiwp-3.webp') }}" class="img-fluid rounded   image-top mb-4"
                        alt="Image">
                </div>
            </div>
        </div>
    </div>
    <!-- End Section  -->
<br><br><br>
    
    
    
  <!-- Section  wITH BACKGORUND COLOR    -->
    <div class="container-fluid  bg-color">
        <div class="container">
            <div class=" row align-items-center justify-content-between">
                <!-- Image Section -->
                <div class="col-md-6 col-12    " >
                    <img src="{{ asset('Site/Images/hiwp-4.webp') }}" class="img-fluid rounded   image-top"
                        alt="Image" >
                </div>
                <!-- Text Section -->
                <div class="col-md-6 col-12   justify-content-center   mb-4  ">
                    <h2 class="how-it-works-heading-customers section-heading display-5 ">Grow Your Business With
                        WeConnectt</h2>
                    <p class="section-para mt-3"> We streamline the process of promoting your services,
                        ensuring efficiency and effectiveness. As a Weconnectt
                        professional, you'll receive immediate, live leads as soon
                        as they're available. Join now and gain instant access to
                        leads tailored to your business needs.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- End Section  -->


    <!-- Section  -->
    <div class="container-fluid   margin-height">
        <div class="container">
            <div class=" row  align-items-center justify-content-between">
                <!-- Text Section -->
                <div class="col-md-6 col-12   justify-content-center   mb-4  content-padding">

                    <h2 class="how-it-works-heading-customers section-heading display-5 ">And that's just the
                        beginning—unlock a world of additional
                        benefits!</h2>
                    <p class="section-para mt-3">As a WeConnectt Professional, you will enjoy a range of
                        benefits, including an enhanced online profile designed to
                        increase your web presence and promote your business
                        effectively. Additionally, you will have access to our
                        award-winning customer success team, available via email and
                        telephone, to assist you every step of the way.</p>
                </div>
                <!-- Image Section -->
                <div class="col-md-6 col-12   mb-4 ">
                    <img src="{{ asset('Site/Images/hiwp-5.webp') }}" class="img-fluid rounded   image-top mb-4"
                        alt="Image">
                </div>
            </div>
        </div>
    </div>
    <!-- End Section  -->


    


</div>

@include('Site.layouts.footer')

@endsection