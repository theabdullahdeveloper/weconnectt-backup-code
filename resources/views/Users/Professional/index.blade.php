@extends('Users.Professional.layouts.app')
@section('UserContent')


@if($user->role == 'Professional')

<div class="dashboard-body">
    @if($user->email_verified == '0')
    <div class="verifyemial" style="padding-top: 10px;">
        <div class=" px-4 ">
            <div class="container bg-danger text-white rounded">
                <center>
                    <p style="padding-top: 10px; padding-bottom: 10px;">Your email address has not been verified. Please
                        verify your email.&nbsp; <a
                            href="{{ url('/professional-dashboard/settings/' . session('UserAuth')->id ) }}"
                            style="text-decoration: underline ; color: whitesmoke;"> Verify Email</a></p>
                </center>
            </div>

        </div>
    </div>
    @endif
    <br>
    <div class="container">
        <div>
            <p class="user-name">
                Welcome, <span style="font-weight:700;">{{$user->name}}</span>! <br>

            </p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0">
                    <span class="p-2 dashboard-body-profile-image"> @if($user->profile_image)
                        <img src="/{{ $user->profile_image }}" alt="{{ $user->name }}" style=" object-fit: cover;">
                        @else
                        @php

                        $initial = strtoupper(substr($user->name, 0, 1));
                        @endphp
                        <div class="rounded-circle d-flex justify-content-center align-items-center mt-2"
                            style="width: 100px; height: 100px; background-color: #455AC7; color: white; font-weight: bolder; font-size:32px;">
                            {{ $initial }}
                        </div>
                        @endif
                    </span>
                    <br>
                    <h6 class="card-title px-4 mt-2 mb-4">{{ $user->name }}</h6>
                    <hr class="col-10 m-auto mt-4 mb-2">
                    <div class="card-body p-2">
                        <div class=" container px-2 mb-4">
                            <p id="greeting"></p>
                            <p class="text-muted small fw-bold" id="datetime"></p>
                        </div>

                        <!--Progress Bar -->
                        <div class="container px-2">
                            <p style="font-weight:bold;">Profile Score</p>
                            <div class="progress">
                                <div class="progress-bar 
            {{ $profileCompletion < 50 ? 'bg-danger' : ($profileCompletion < 75 ? 'bg-warning' : 'bg-success') }}"
                                    role="progressbar" aria-valuenow="{{ intval($profileCompletion) }}"
                                    aria-valuemin="0" aria-valuemax="100"
                                    style="width:{{ intval($profileCompletion) }}%">
                                    <!-- Display percentage without "Complete" if less than 30 -->
                                    {{ intval($profileCompletion) }}%
                                    @if ($profileCompletion >= 30)
                                    Complete
                                    @endif
                                </div>
                            </div>
                            <br>
                        </div>


                        <!--End Progress Bar-->

                    </div>
                </div>
                <!--<br>-->
                <!--<div class="card border-0 ">-->
                <!--    <h5 class="card-title  px-4 py-2 pt-3">Get started </h5>-->
                <!--    <hr>-->
                <!--    <div class="card-body p-2 py-2" style="background-color:white;">-->
                <!--        <div class="mx-4 my-1 get-start-body text-center rounded  pt-1"  style="background-color:white;">-->
                <!--            <br>-->
                <!--            <span class="small bg-primary text-white px-3 rounded-pill py-1">-->
                <!--                20% OFF STARTER PACK OFFER-->
                <!--            </span> <br>-->
                <!--<center class="py-3 px-2">-->
                <!--    Starter pack offer-->
                <!--    <br>-->
                <!--    <span class="text-center text-muted small container">Respond to up to 10 customers-->
                <!--        <b>20% OFF </b>and a <b>get hired guarantee.</b> </span>-->
                <!--</center>-->

                <!--        </div>-->
                <!--        <br>-->
                <!--    </div>-->
                <!--</div>-->
                <br>
                <div class="card border-0 mb-4">
                    <h5 class="card-title px-4 pt-3">Help</h5>
                    <br>
                    <hr class="col-10 m-auto mt-4 mb-2">
                    <div class="card-body p-2 py-4">
                        <div class="container">
                            <i class="bi bi-question bg-primary text-white px-2 py-2 rounded-circle mr-2"></i>
                            Visit help centre for tips & advice.
                            <br>
                            <br>
                            <div class="container ml-4">
                                <span class="pb-4"> {{$theme->c_email }}</span>
                                <br>
                                <span class="pt-4">Call {{$theme->c_no }} <br> </span>
                                <small class="text-muted">Monday - Sunday 9am - 5pm</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0  mb-4">
                    <h4 class="card-title px-4 py-3">Lead settings</h4>
                    <hr class="col-11 m-auto">
                    <div class="card-body p-2">
                        <div class="row px-2 mt-4">
                            <div class="col-10 ">
                                <h6 style="font-weight:bold;">Services</h6>
                            </div>
                            <div class="col-2 d-flex justify-content-end">
                                <a href="{{ url('/professional-dashboard/settings/' . $user->email ) }}"
                                    class="dashboard-link"><span>Edit</span></a>
                            </div>
                            <span class="text-muted container">
                                You'll receive leads in these categories
                            </span>
                            <div>
    @php
    // Assuming $user is passed to the view containing the user data
    if ($user->service) {
        $services = explode(',', $user->service);
        $limit = 3;
        $totalServices = count($services);
        $displayServices = array_slice($services, 0, $limit);
        $remainingCount = $totalServices - $limit;
    } else {
        $services = [];
        $remainingCount = 0;
    }
    @endphp

    @if(!empty($services))
        @foreach($displayServices as $service)
        <p class="category-show badge mb-1">
            {{ $service }}
        </p>
        @endforeach

        @if($remainingCount > 0)
        <p class="category-show badge mb-1">
            {{ $remainingCount }} more
        </p>
        @endif
    @else
    <small class="text-muted container">
                               Service Not Define.
                            </small>
    @endif
</div>

                            <br>
                        </div>
                        <hr class="col-11 m-auto">
                        <div class="row px-2 mt-4">
                            <div class="col-10 ">
                                <h6 style="font-weight:bold;">Locations</h6>
                            </div>
                            <div class="col-2 d-flex justify-content-end">
                                <a href="{{ url('/professional-dashboard/settings/' . $user->email ) }}"
                                    class="dashboard-link"><span>Edit</span></a>
                            </div>
                        </div>
                        @if($user->customer_serve == 'nationwide' ?? 'N/A')
                        <span class="text-muted px-2">
                            You're receiving customers within
                        </span>
                        <div class="row px-2 mt-4 mb-4">
                            <div class="col-1 ">
                                <i class="bi bi-pin-map-fill text-muted"></i>
                            </div>
                            <div class="col-10 text-dark">
                                Nationwide
                            </div>
                        </div>
                        @else
                        <span class="text-muted px-2">
                            You're receiving customers within
                        </span>
                        <div class="row px-2 mt-4 mb-4">
                            <div class="col-1 ">
                                <i class="bi bi-pin-map-fill text-muted"></i>
                            </div>
                            <div class="col-10 text-muted" style="text-transform: uppercase;">
                                {{ $user->postcode  ?? 'N/A' }}
                            </div>

                        </div>
                        @endif
                        <hr class="col-11 m-auto">
                        <div class="row px-2 mt-4">
                            <div class="col-12 ">
                                <h6 style="font-weight:bold;">Sending new leads to</h6>
                            </div>
                        </div>
                        <span class="text-muted px-2 pt-4">

                        </span>
                        <br>
                        <span class="px-2">
                            {{ $user->email }}
                        </span>
                        <br>
                        <!--<a href="{{ url('/professional-dashboard/settings/' . $user->email ) }}"-->
                        <!--    class="dashboard-link pt-3 px-2"> Change</a>-->
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0">
                    <div class="row px-3 mt-3 mb-4">
                        <div class="col-10 ">
                            <h4>Leads</h4>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                            <a href="{{ url('/professional-dashboard/leads') }}"
                                class="dashboard-link"><span>View</span></a>
                        </div>
                    </div>
                    <hr class="col-10 m-auto">
                    <div class="card-body p-2">
                        <center>
                            <p class="lead_count text-primary">
                                @if ($user->customer_serve == 'postcode')
                                @php
                                // Extract first two letters from the user's postcode
                                $user_postcode = $user->postcode;
                                preg_match('/[a-zA-Z0-9]{2}/', $user_postcode, $matches);
                                $firstTwoLetters = $matches[0];

                                // Get leads that match the user's postcode
                                $leadsByPostcode = \App\Models\Posts::where('status', '1')
                                ->where('permanently_disabled', '0')
                                ->where('postcode', 'LIKE', $firstTwoLetters . '%')
                                ->get();
                                @endphp
                                @else
                                @php
                                // Get all leads if not filtering by postcode
                                $leadsByPostcode = \App\Models\Posts::where('status', '1')
                                ->where('permanently_disabled', '0')
                                ->get();
                                @endphp
                                @endif

                                @php
                                $matchingLeadsCount = 0;
                                $userServices = explode(',', $user->service);
                                @endphp

                                @foreach($leadsByPostcode as $lead)
                                @if(in_array($lead->service_sub_category, $userServices))
                                @php $matchingLeadsCount++; @endphp
                                @endif
                                @endforeach

                                {{ $matchingLeadsCount }}
                            </p>
                            Leads
                        </center>
                        <br>
                    </div>
                </div>
                <br>
                <div class="card border-0">
                    <div class="row px-3 mt-3 mb-3">
                        <div class="col-10 ">
                            <h4>Tokens</h4>
                        </div>
                        <div class="col-2 d-flex justify-content-end">

                        </div>
                    </div>
                    <hr class="col-10 m-auto">
                    <div class="card-body p-4">
                        <center>
                            <p class="lead_count text-info">
                                {{ $user->balance }}
                            </p>
                            Available Tokens
                            <br><br>
                            <a href="{{ url('/user/payment/stripe/' . $user->email) }}"
                                class="btn btn-primary btn-sm w-100">Buy Tokens</a>
                        </center>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateGreetingAndTime() {
    // Create a new Date object
    var now = new Date();

    // Get the current hour
    var hour = now.getHours();

    // Set the greeting based on the time of the day
    var greeting = "";
    if (hour >= 5 && hour < 12) {
        greeting = "Good morning,";
    } else if (hour >= 12 && hour < 18) {
        greeting = "Good afternoon,";
    } else {
        greeting = "Good evening,";
    }

    // Display the greeting
    document.getElementById("greeting").textContent = greeting;

    // Get the day, date, month, hour, minute, and AM/PM
    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var day = days[now.getDay()]; // Day of the week
    var date = now.getDate(); // Date (day of the month)
    var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var month = monthNames[now.getMonth()]; // Month
    var hours = now.getHours(); // Hour
    var minutes = now.getMinutes(); // Minute
    var ampm = hours >= 12 ? 'pm' : 'am'; // AM or PM
    hours = hours % 12;
    hours = hours ? hours : 12; // Convert 0 to 12
    minutes = minutes < 10 ? '0' + minutes : minutes; // Add leading zero to minutes if less than 10

    // Construct the formatted date and time string
    var formattedDateTime = day + ', ' + date + ' ' + month + ' ' + hours + ':' + minutes + ampm;

    // Display the formatted date and time
    document.getElementById("datetime").textContent = formattedDateTime;
}

// Call the function initially to display greeting and time immediately
updateGreetingAndTime();

// Call the function every minute to update the greeting and time in real-time
setInterval(updateGreetingAndTime, 1000);
</script>


@endif

@endsection