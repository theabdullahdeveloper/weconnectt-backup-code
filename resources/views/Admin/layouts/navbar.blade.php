<!-- ========== Topbar Start ========== -->
<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="/admin-dashboard" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset($theme->logo) }}" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset($theme->favicon) }}" alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="/admin-dashboard" class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset($theme->logo) }}" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset($theme->favicon) }}" alt="small logo">
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="ri-menu-line"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

           
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            
           
          

            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode">
                    <i class="ri-moon-line fs-22"></i>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <!-- <span class="account-user-avatar">
                        <img src="{{ asset('Admin/images/users/avatar-1.jpg') }}" alt="user-image" width="32" class="rounded-circle">
                    </span> -->
                    <span class="d-lg-block d-none">
                        <h5 class="my-0 fw-normal">Action <i
                                class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i></h5>
                    </span>
                </a>
                
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                  
                    <!-- <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div> -->

                    
                    <!-- <a href="pages-profile.html" class="dropdown-item">
                        <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                        <span>My Account</span>
                    </a>

                    
                    <a href="pages-profile.html" class="dropdown-item">
                        <i class="ri-settings-4-line fs-18 align-middle me-1"></i>
                        <span>Settings</span>
                    </a>

                    
                    <a href="pages-faq.html" class="dropdown-item">
                        <i class="ri-customer-service-2-line fs-18 align-middle me-1"></i>
                        <span>Support</span>
                    </a>

                    
                    <a href="auth-lock-screen.html" class="dropdown-item">
                        <i class="ri-lock-password-line fs-18 align-middle me-1"></i>
                        <span>Lock Screen</span>
                    </a> -->

                    
                    <a href="{{ url('/weconnectt-logout') }}" class="dropdown-item">
                        <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- ========== Topbar End ========== -->