<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/get/service/dashboard') }}">
        <img src="{{ asset($theme->logo) }}" alt="" style="width:150px;">
        </a>
     <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bi bi-list text-white pt-1"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link user-nav-bar {{ request()->is('get/service/dashboard') ? 'active' : '' }}"
                            href="{{ url('/get/service/dashboard') }}">My Requests</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link user-nav-bar {{ request()->is('get/service/dashboard/completed/requests') ? 'active' : '' }}"
                            href="{{ url('/get/service/dashboard/completed/requests') }}">Complete Requests</a>
                    </li>
                    
                    
                    <li class="nav-item nav-drop-item">
                        <a class="nav-link user-nav-bar {{ request()->is('profile') ? 'active' : '' }}"
                            href="{{ url('/get/service/user/setting/' . session('UserAuth')->id) }}">Setting</a>
                    </li>
                    <li class="nav-item nav-drop-item">
                        <a class="nav-link user-nav-bar {{ request()->is('get/service/user/switch/to/seller') ? 'active' : '' }}"
                            href="{{ url('/get/service/user/switch/to/seller') }}">Switch to Seller</a>
                    </li>
                    

                    <li class="nav-item nav-drop-item">
                        <a class="nav-link user-nav-bar"  href="{{ url('/user/logout') }}">Sign Out</a>
                    </li>
                    <div class="profile">
                        <div class="img-box">
                        @if(session('UserAuth')->profile_image)
                            <img src="/{{ session('UserAuth')->profile_image }}" alt="{{ session('UserAuth')->name }}">
                        @else
                            @php
            $initial = strtoupper(substr(session('UserAuth')->name, 0, 1));
        @endphp
       <div class="d-flex justify-content-center align-items-center"
     style="width: 50px; height: 50px; background-color: #455AC7; color: white; font-weight: bolder; font-size: 20px; padding-right:10px;padding-bottom:10px;">
    {{ $initial }}
</div>

                        @endif
                        </div>
                        <span>{{ session('UserAuth')->name }}</span>
                        <div class="menu">
                            <ul>
                                <li><a href="{{ url('/get/service/user/setting/' . session('UserAuth')->id) }}"><i class="bi bi-person dop"></i>&nbsp;Profile</a></li>
                                <li><a href="{{ url('/get/service/user/switch/to/seller') }}"><i class="bi bi-diamond-half dop"></i>&nbsp;Switch to Seller</a></li>
                                <li><a href="{{ url('/user/logout') }}"><i class="bi bi-indent dop"></i>&nbsp;Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</nav>
<script>
    let profile = document.querySelector('.profile');
    let menu = document.querySelector('.menu');

    profile.onclick = function () {
        menu.classList.toggle('active');
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--/.Navbar -->