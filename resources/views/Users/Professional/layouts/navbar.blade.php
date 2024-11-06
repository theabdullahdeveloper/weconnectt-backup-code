<nav class="navbar navbar-expand-lg text-dark fixed-top scrolled shadow-sm">

    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/professional-dashboard') }}">
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
                        <a class="nav-link user-nav-bar {{ request()->is('professional-dashboard') ? 'active' : '' }}"
                            href="{{ url('/professional-dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link user-nav-bar {{ request()->is('professional-dashboard/leads') ? 'active' : '' }}"
                            href="{{ url('/professional-dashboard/leads') }}">Leads</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link user-nav-bar {{ request()->is('professional-dashboard/settings/' . session('UserAuth')->id) ? 'active' : '' }}" href="{{ url('/professional-dashboard/settings/' . session('UserAuth')->id ) }}">Settings</a>

                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link user-nav-bar {{ request()->is('help') ? 'active' : '' }}"
                            href="{{ url('/help') }}">Help</a>
                    </li> -->
                    <li class="nav-item nav-drop-item">
                        <a class="nav-link user-nav-bar {{ request()->is('professional/public/profile/' . session('UserAuth')->email) ? 'active' : '' }}"
                        target="_blank" href="{{ url('professional/public/profile/' . session('UserAuth')->email) }}">Public Profile</a>
                    </li>
                    <li class="nav-item nav-drop-item">
                        <a class="nav-link user-nav-bar {{ request()->is('professional/user/switch/to/buyer') ? 'active' : '' }}"
                            href="{{ url('/professional/user/switch/to/buyer') }}">Switch to Buyer</a>
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
                                <!-- <li><a href="#"><i class="bi bi-person dop"></i>&nbsp;Profile</a></li> -->
                                <li><a target="_blank" href="{{ url('/professional/public/profile/' . session('UserAuth')->email) }}"><i class="bi bi-person-lines-fill dop"></i>&nbsp;Public Profile</a></li>
                                <li><a href="{{ url('/professional/user/switch/to/buyer') }}"><i class="bi bi-diamond-half dop"></i>&nbsp;Switch to Buyer</a></li>
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
<!--/.Navbar -->