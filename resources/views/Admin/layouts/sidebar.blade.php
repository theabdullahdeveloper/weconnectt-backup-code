<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ url('/admin-dashboard') }}" class="logo logo-light text-white mt-2" style="text-decoration:none;">
        <span class="logo-lg">
            <!-- <img src="{{ asset($theme->logo) }}" alt="logo"> -->
            <h3>
                Weconnectt
            </h3>
        </span>
        <span class="logo-sm">
            <!-- <img src="{{ asset($theme->favicon) }}" alt="small logo"> -->
            <h3>
                Weconnectt
            </h3>
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ url('/admin-dashboard') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset($theme->logo) }}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset($theme->favicon) }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Main</li>

            <li class="side-nav-item">
                <a href="{{ url('/admin-dashboard') }}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <!-- <span class="badge bg-success float-end">9+</span> -->
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-title">Categories</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#service-category" aria-expanded="false"
                    aria-controls="service-category" class="side-nav-link">
                    <i class="bi bi-grid-fill"></i>
                    <span> Service Category </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="service-category">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ url('/admin/add/new/service/category') }}">Add New Service Category</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/add/list/service/categories') }}">List Service Category</a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesAuth" aria-expanded="false"
                    aria-controls="sidebarPagesAuth" class="side-nav-link">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    <span> Service Sub-Category </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesAuth">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ url('/admin/add/new/service/sub-category') }}">Add New Sub Category</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/add/list/service/sub-categories') }}">List Sub Category</a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            <li class="side-nav-title">Users</li>
            <li class="side-nav-item">
                <a href="{{ url('/admin/users/all') }}" class="side-nav-link">
                    <i class="ri-team-fill"></i>
                    <!-- <span class="badge bg-success float-end">9+</span> -->
                    <span> All Users </span>
                </a>
            </li>
            <li class="side-nav-title">Others</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#featuredon" aria-expanded="false"
                    aria-controls="featuredon" class="side-nav-link">
                    <i class="ri-aspect-ratio-line"></i>
                    <span> Featured on</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="featuredon">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ url('/admin/add/new/featured-on/featured-by') }}">Add Featured By</a>
                        </li>                 
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#ourclients" aria-expanded="false"
                    aria-controls="ourclients" class="side-nav-link">
                    <i class="ri-user-smile-fill"></i>
                    <span>Our Clients</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="ourclients">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ url('/admin/add/new/clients/list') }}">Clients list</a>
                        </li>                 
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#testimonial" aria-expanded="false"
                    aria-controls="testimonial" class="side-nav-link">
                    <i class="ri-star-fill"></i>
                    <span>Testimonials</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="testimonial">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ url('/admin/add/new/testimonial/list') }}">Testimonial list</a>
                        </li>                 
                    </ul>
                </div>
            </li>


            <li class="side-nav-title">Terms and Conditions</li>
            <li class="side-nav-item">
                <a href="{{ route('TermsAndConditions') }}" class="side-nav-link">
                    <i class="ri-rotate-lock-line"></i>
                    <!-- <span class="badge bg-success float-end">9+</span> -->
                    <span> Terms and Conditions </span>
                </a>
            </li>

            <li class="side-nav-title">Pravicy and Policy</li>
            <li class="side-nav-item">
                <a href="{{ route('PravicyPolicy') }}" class="side-nav-link">
                    <i class="ri-secure-payment-fill"></i>
                    <!-- <span class="badge bg-success float-end">9+</span> -->
                    <span> Pravicy and Policy </span>
                </a>
            </li>


            <li class="side-nav-title">Theme</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#theme" aria-expanded="false"
                    aria-controls="theme" class="side-nav-link">
                    <i class="ri-settings-5-fill"></i>
                    <span>Theme Settings</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="theme">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ url('/admin/theme/settings') }}">Settings</a>
                        </li>                 
                    </ul>
                </div>
            </li>
           

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->