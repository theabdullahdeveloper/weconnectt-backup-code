<!-- Footer  -->

<footer class="footer">
    <div class="container row footer_sec">
    <div class="footer-col">
            <h4 style="color:#0078C9;">About</h4>
            <ul>
                <li><a href="{{ url('/about') }}">About WeConnectt</a></li>
                <li><a href="{{ url('/why/choose/us') }}">Why Choose Us</a></li>
                <!--<li><a href="#">Blog</a></li>-->
            </ul>
        </div>
        <div class="footer-col ">
            <h4 style="color:#0078C9;">For Customers</h4>
            <ul>
                <li><a href="{{ url('/how-it-works/customers') }}">How does WeConnectt Work</a></li>
                <li><a href="{{ url('/all/services')  }}">Search For A Service</a></li>
                <li><a href="{{ url('/login') }}">Login</a></li>

            </ul>
        </div>
        <div class="footer-col">
            <h4 style="color:#0078C9;">For Professionals</h4>
            <ul>
                <li><a href="{{ url('/how-it-works/sellers') }}">How Does it Work</a></li>
                <!--<li><a href="#">Pricing</a></li>-->
                <li><a href="mailto:{{$theme->c_email  ?? '#'}}">Help Centre</a></li>
                <li><a href="{{ url('/account/professional/account/starter')  }}">Join As a Professional</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <!-- <h4>Contact Us</h4> -->

            <ul>
                <br>
                <li><a href="mailto:{{$theme->c_email  ?? '#'}}" class="contact" style="text-transform: lowercase !important;">{{$theme->c_email ?? '' }}</a>
                </li>
                <li><a href="#" class="contact">{{$theme->c_no ?? '' }}</a></li>
                <p class="contact-line"> (open 24 hours a day, 7 days a week)</p>

            </ul>
            <div class="social-links">

                <a href="{{ $theme->facebook_link  ?? '' }}"><i class="bi bi-facebook"></i></a>
                <a href="{{ $theme->twitter_link  ?? '' }}"><i class="bi bi-twitter"></i></a>
                <a href="{{ $theme->linkedin_link  ?? '' }}"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
<br>
    <hr class="hr">

    <div class="container copy-right">
        <h3 class=" copy-right">© {{ $theme->footer_copyright  ?? '' }} . &nbsp;<a href="{{ url('/term/and/conditions') }}" class="copy-right-link">Terms &
                Conditions</a> / <a href="{{ url('/privacy/and/policies') }}"
                class="copy-right-link">Privacy policy</a></h3>
    </div>

</footer>

<!-- End Footer  -->
