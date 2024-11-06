<style>
    /* Custom CSS for hiding/showing search input on scroll */
    .navbar {
        background-color: #FFFFFF;
        color: #111637;
        padding-top: 10px;
        padding-bottom: 15px;
        border-bottom: solid 1px #a8a8a834;
    }






    .Join-Professions-btn {
        border: none;
        padding-left: 15px;
        padding-right: 15px;
        padding-top: 5px;
        padding-bottom: 5px;
        background-color: #FFDB00;
        color: #2E7BF1;
        border-radius: 25px;
        font-weight: bold;
        box-shadow: 0 0 2px 1px #ffdd00e7;
    }

    .Join-Professions-btn:hover {
        border: none;
        padding-left: 15px;
        padding-right: 15px;
        padding-top: 5px;
        padding-bottom: 5px;
        background-color: #FFDB00;
        color: #2E7BF1;
        border-radius: 25px;
        font-weight: bold;
        box-shadow: 0 0 2px 1px #ffdd00e7;
    }

    .login-btn {
        margin-right: 25px;
        font-size: 18px;
        color: #111637;
        letter-spacing: 1px;

    }

    .login-btn:hover {
        margin-right: 25px;
        font-size: 18px;
        color: #0b102e;
        text-decoration: underline !important;

    }





    .dropdown-toggle {
        color: #111637 !important;
        font-size: large !important;
    }

    .dropdown-toggle:hover {
        text-decoration: underline !important;
    }

    .centeredss-text {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        font-weight: bold;

    }

    .login-phone {
        display: none;
    }

    .nav-phone {
        display: none;
    }

    @media (max-width: 991px) {
        .login-phone {
            display: block;
        }

        .nav-phone {
            display: block;
        }

        .login-lg {
            display: none;
        }

        .nav-b-lg {
            display: none;
        }

        .btn-h {
            align-items: center;
        }

    }



    .icon-class {
        margin-left: auto;
        /* Ensure the icon class is pushed to the right */
        font-weight: normal;
        /* Ensure the icon font weight remains normal */
    }


    .custom-dropdown .dropdown-menu {
        background-color: #f8f9fa;
        /* Background color */
        border: 1px solid #dee2e6;
        /* Border color */
        border-radius: 0.25rem;
        /* Border radius */
        width: 300px;
        /* Increased width */
    }

    .custom-dropdown .dropdown-item {
        color: #343a40;
        /* Text color */
        padding: 10px 20px;
        /* Padding */
    }

    .custom-dropdown .dropdown-item:hover {
        background-color: #e9ecef;
        /* Hover background color */
        color: #495057;
        /* Hover text color */
    }
</style>
<!--Navbar -->
<nav class="navbar navbar-expand-lg text-dark  fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand nav-phone" href="{{ url('/') }}">

            <img src="{{ asset($theme->logo ?? '') }}" alt="" style="width:150px;">
        </a>
        <a href="{{ url('/login') }}" class="login-btn login-lg"> Login </a>
        <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bi bi-list text-white pt-1"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown custom-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Explore</a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $data)
                        <li>
                            <a class="dropdown-item d-flex"
                                href="{{ url('/all/sub-services/' .  $data->service_category ) }}">
                                <span>{{ $data->service_category }} &nbsp;&nbsp;</span>
                                <!-- <i class="{{ $data->icon_class }} ml-auto"></i> -->
                            </a>
                        </li>
                        @endforeach
                        <li><a href="{{ url('/all/services') }}" class="dropdown-item"> View All</a></li>
                    </ul>
                </li>


            </ul>
            <h3 class="centeredss-text nav-b-lg "><a href="{{ url('/') }}"><img src="{{ asset($theme->logo ?? '') }}"
                        alt="Weconnect-logo" style="width:300px;"></a></h3>
            <div class="btn-h my-2 my-lg-0">


                <a style="text-decoration:none !important;"  href="{{ url('/account/professional/account/starter') }}" id="joinProfessionsBtn" class=" Join-Professions-btn my-2 my-sm-0" type="button"><i
                        class="bi bi-person-circle"></i>
                    &nbsp;
                    Join as a Professional
</a>
                <a href="{{ url('/login') }}" class="login-btn login-phone mt-3">Login </a>

            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function () {
            // When the button is clicked
            $("#joinProfessionsBtn").click(function () {
                // Redirect to the specified URL
                window.location.href =
                    "{{ url('/account/professional/account/starter') }}";
            });
        });
    </script>
</nav>
<!--/.Navbar -->

