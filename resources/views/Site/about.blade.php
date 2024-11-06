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
        <h1 class="page-heading">About WeConnectt</h1>
    </div>

    <!-- Section  -->
    <div class="container-fluid  bg-color">
        <div class="container">
            <div class=" row align-items-center justify-content-between">
                <!-- Image Section -->
                <div class="col-md-6 col-12   mb-4 ">
                    <img src="{{ asset('Site/Images/about-1.jpeg') }}" class="img-fluid rounded    image-top"
                        alt="Image">
                </div>
                <!-- Text Section -->
                <div class="col-md-6 col-12   justify-content-center   mb-4  content-padding" >
                    <h2 class="how-it-works-heading-customers section-heading display-5 ">A Network for Everyone</h2>
                    <p class="section-para mt-3">At WeConnectt, we take the hassle out of finding and hiring top-notch service providers. Whether you need a skilled plumber, a dedicated tutor, a motivating personal trainer, or any other professional, our platform connects you with trusted experts swiftly and seamlessly.</p>
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

                    <h2 class="how-it-works-heading-customers section-heading display-5 ">Our Mission</h2>
                    <p class="section-para mt-3">Our mission is to bridge the gap between service providers and users, creating effortless connections and ensuring top-quality, reliable services. We are committed to making your experience smooth, enjoyable, and stress-free.</p>
                </div>
                <!-- Image Section -->
                <div class="col-md-6 col-12   mb-4 " style="margin-top:-50px !important;">
                    <img src="{{ asset('Site/Images/about-2.webp') }}" class="img-fluid rounded   image-top-sm mb-4"
                        alt="Image">
                </div>
            </div>
        </div>
    </div>


</div>

@include('Site.layouts.footer')

@endsection











































































n
