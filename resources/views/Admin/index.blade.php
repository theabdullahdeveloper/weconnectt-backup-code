@extends('Admin.layouts.app')
@section('AdminContent')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->


<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <!-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Velonic</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Welcome!</li>
                        </ol>
                    </div> -->
                    <h4 class="page-title">Welcome!</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-pink">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-eye-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                        <h2 class="my-2">{{$User_count}}</h2>
                      
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-purple">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-wallet-2-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers"> Testimonials</h6>
                        <h2 class="my-2">{{$Testimonials_count}}</h2>
                       
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-info">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-shopping-basket-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers"> Sellers </h6>
                        <h2 class="my-2"> {{$SellerCount}}</h2>
                      
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-group-2-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Buyers</h6>
                        <h2 class="my-2">{{$BuyerCount}}</h2>
                       
                    </div>
                </div>
            </div> <!-- end col-->
        </div>



        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-widgets">
                            <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                            <a data-bs-toggle="collapse" href="#weeklysales-collapse" role="button"
                                aria-expanded="false" aria-controls="weeklysales-collapse"><i
                                    class="ri-subtract-line"></i></a>
                            <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                        </div>
                        <h5 class="header-title mb-0">Overview</h5>

                        <div id="weeklysales-collapse" class="collapse pt-3 show">
                            <div class="row text-center">
                                <div class="col">
                                    <p class="text-muted mt-3">Categories</p>
                                    <h3 class=" mb-0">
                                        <span>{{$ServiceCategory_count}}</span>
                                    </h3>
                                </div>
                                <div class="col">
                                    <p class="text-muted mt-3">Sub Categories</p>
                                    <h3 class=" mb-0">
                                        <span>{{$ServiceSubCategory_count}}</span>
                                    </h3>
                                </div>
                                <div class="col">
                                    <p class="text-muted mt-3">Featured On</p>
                                    <h3 class=" mb-0">
                                        <span>{{$FeaturedOn_count}}</span>
                                    </h3>
                                </div>
                                <div class="col">
                                    <p class="text-muted mt-3">Our Clients</p>
                                    <h3 class=" mb-0">
                                        <span>{{$OurClients_count}}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        

    </div>
    <!-- container -->

</div>
<!-- content -->





<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
@endsection