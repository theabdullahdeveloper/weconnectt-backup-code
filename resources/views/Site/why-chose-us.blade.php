@extends('Site.layouts.app')
@section('SiteContent')
<style>
.heading-main {
    text-align: center;
    margin-top: 100px;
    margin-bottom: 150px;
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
    padding-top: 30px !important;
    padding-bottom: 100px !important;
}

.bg-color {
    background-color: #f1f0f0 !important;
}

.section-heading {
    color: #2E7BF1;
    font-weight: bold;
    padding-top: -100px;
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
    margin-top: 200px !important;
}
</style>
<!-- How It Works for Customers Page Section -->
<div class="how-it-works-customers-section">


    <div class="heading-main">
        <h1 class="page-heading">Why Choose Us?</h1>
    </div>

    <!-- Section  Color Back Ground -->
    <div class="container-fluid  bg-color">
        <div class="container">
            <div class=" row align-items-center justify-content-between">
                <!-- Image Section -->
                <div class="col-md-6 col-12   mb-4 ">
                    <img src="{{ asset('Site/Images/wcu-1.jpeg') }}" class="img-fluid rounded    image-top"
                        alt="Image">
                </div>
                <!-- Text Section -->
                <div class="col-md-6 col-12   justify-content-center   mb-4  content-padding" >
                    <h2 class="how-it-works-heading-customers section-heading display-5 ">Trusted Providers</h2>
                    <p class="section-para mt-3">We vet all service providers on our platform to ensure they meet our high standards of quality and reliability. Each provider undergoes a thorough background check and verification process.</p>
                    <br><br><br><br>
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
                <div class="col-md-6 col-12   justify-content-center   mb-4  content-padding" style="margin-top:-150px !important;">

                    <h2 class="how-it-works-heading-customers section-heading display-5 ">User-Friendly Platform</h2>
                    <p class="section-para mt-3">Our platform is designed for simplicity and ease of use. From searching for providers to making contact and hiring, every step is straightforward and intuitive.</p>
                </div>
                <!-- Image Section -->
                <div class="col-md-6 col-12   mb-4 " style="margin-top:-50px !important;">
                    <img src="{{ asset('Site/Images/wcu-2.webp') }}" class="img-fluid rounded   image-top-sm mb-4"
                        alt="Image">
                </div>
            </div>
        </div>
    </div>

<br><br><br><br>
 <!-- Section  Color Back Ground -->
    <div class="container-fluid  bg-color">
        <div class="container">
            <div class=" row align-items-center justify-content-between">
                <!-- Image Section -->
                <div class="col-md-6 col-12   mb-4 ">
                    <img src="{{ asset('Site/Images/Why-choose-us-pic-3.jpg') }}" class="img-fluid rounded    image-top"
                        alt="Image">
                </div>
                <!-- Text Section -->
                <div class="col-md-6 col-12   justify-content-center   mb-4  content-padding" >
                    <h2 class="how-it-works-heading-customers section-heading display-5 ">Exceptional Customer Support</h2>
                    <p class="section-para mt-3">We’re here for you at every step. Our friendly customer support team is ready to assist you with any questions or concerns, ensuring a smooth and pleasant experience.</p>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>

    <!-- End Section  -->



</div>

@include('Site.layouts.footer')

@endsection











































































n
