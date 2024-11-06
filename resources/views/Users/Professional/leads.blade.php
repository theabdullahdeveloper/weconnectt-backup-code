@extends('Users.Professional.layouts.app')

@section('UserContent')
@foreach($user_auth as $userAuth)
@if($userAuth->role == 'Professional')
<style>
  .tab-link::-webkit-scrollbar-track
{
	/* -webkit-box-shadow: inset 0 0 6px #0078CA; */
	background-color: transparent;
   
}

.tab-link::-webkit-scrollbar
{
	width: 6px;
   
	background-color: transparent;
}

.tab-link::-webkit-scrollbar-thumb
{
	background-color: #2e2e2e50;
    border-radius: 10px;
}
    .main-lead {
        margin-top: 6%;
    }

    .tab-link {
        overflow-y: auto;
        overflow-x: hidden;
        height: 100vh;
        position: fixed;
        background-color: #F9F9FA;
        padding-bottom: 100px;
        
    }

    .tab-main {
        margin-left: auto;
        background-color:white;
        margin-top:17px; 
        min-height: 100vh;
    }

    .tab-nav-link {
        color: #111637 !important;
    }

    .all-leads-count {
        background-color: #111637;
        color: #F9F9FA;
    }

    .services_count {
        color: #F9F9FA;
        font-size: small;
    }

    @media (max-width: 768px) {
        .tab-link {
            position: relative;
            height: auto;
            overflow-y: auto;
        }

        .tab-main {
            margin-left: 0;
            display: block;
        }

        .main-lead {
            margin-top: 20%;
        }
    }

    #main {
        margin: 50px 0;
    }

    #main #faq .card {
        margin-bottom: 5px;
        border: 0;
    }

    #main #faq .card .card-header {
        border: 0;
        -webkit-box-shadow: 0 0 20px 0 rgba(213, 213, 213, 0.5);
        box-shadow: 0 0 20px 0 rgba(213, 213, 213, 0.5);
        border-radius: 2px;
        padding: 0;
    }

    #main #faq .card .card-header .btn-header-link {
        color: #111637;
        display: block;
        text-align: left;
        background: #F9F9FA;
        padding: 10px;
    }

    #main #faq .card .card-header .btn-header-link:after {
        content: "\f106";
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        float: right;
    }

    #main #faq .card .card-header .btn-header-link.collapsed {
        background: #F9F9FA;
        color: #111637;
    }

    #main #faq .card .card-header .btn-header-link.collapsed:after {
        content: "\f107";
    }

    #main #faq .card .collapsing {
        background: #F9F9FA;
    }

    #main #faq .card .collapse {
        border: 0;
    }
    
    /* Add blue border to active tab */
.tab-nav-link.active {
    border-left: 4px solid #0078CA; /* Blue color for active tab */
    /*background-color: #F9F9FA; */
     border-radius: 4px; /* Rounded corners */
}


.hide-focus:focus {
  outline: none !important;
  box-shadow: none !important;
  border-color: #ced4da !important;
}


.fixed-top-section {
    position: sticky;
    top: 0;
    z-index: 999;
    background-color: #F9F9FA;
    padding-bottom: 15px;
}

.lead-cards-scrollable {
    
    overflow-y: auto;
    padding-top: 10px;
}


.all-leads-count, .searchDiv {
    margin-bottom: 10px;
}




</style>

<div class="container-fluid main-lead">
    <div class="row">
        <div class="col-md-4 tab-link">
            @if($userAuth->email_verified == '0')
            <div class="verifyemial" style="padding-top: 10px;">
                <div class="container-fluid bg-danger text-white rounded">
                    <center>
                        <p style="padding-top: 10px; padding-bottom: 10px;">
                            Your email address has not been verified. Please verify your email.&nbsp;
                            <a href="{{ url('/professional-dashboard/settings/' . $userAuth->id ) }}"
                                style="text-decoration: underline; color: whitesmoke;"> Verify Email</a>
                        </p>
                    </center>
                </div>
            </div>
            @endif

            @php
            $matchingLeadsCount = 0;
            $userServices = explode(',', $userAuth->service);
            @endphp

            @foreach($allLeads as $lead)
            @php
            $user = \App\Models\User::where('email', $lead->email)->first();
            @endphp

            @if(in_array($lead->service_sub_category, $userServices))
            @php $matchingLeadsCount++; @endphp
            @endif
            @endforeach

           <!-- Fixed Header Section -->
    <div class="fixed-top-section">
        <div class="container-fluid px-4 py-3 rounded all-leads-count mt-3">
            <h5>{{ $matchingLeadsCount }} matching leads</h5>
            <div class="d-flex justify-content-between">
                <div class="services_count">
                    @php
                    $userServices_count = count(explode(',', $userAuth->service));
                    @endphp
                    <i class="bi bi-building"></i> &nbsp;{{ $userServices_count }} Services
                </div>
            </div>
        </div>

        <div class="input-group mb-3 mt-3 rounded overflow-hidden border searchDiv"> 
            <span class="input-group-text bg-white border-0 pe-1" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search font-weight-bold" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </span>
            <input type="search" id="searchInput" class="form-control hide-focus border-0 placeholder-italics" placeholder="Search lead by postcode" aria-label="Search" aria-describedby="basic-addon1">
        </div>
    </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
 <!-- Scrollable Leads Section -->
    <div class="lead-cards-scrollable">
            @foreach($allLeads as $lead)
            @php
            $user = \App\Models\User::where('email', $lead->email)->first();
            @endphp

            @if(in_array($lead->service_sub_category, $userServices))
            <div class="card mt-2 lead-card" data-postcode="{{ $lead->postcode }}">
                <a class="nav-link tab-nav-link" id="user-{{ $lead->id }}" data-bs-toggle="tab" href="#{{ $lead->id }}"
                    role="tab" aria-controls="{{ $lead->id }}" aria-selected="false">
                    <div class="d-flex pt-4 px-2">
                        @if($user->profile_image)
                        <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;"
                            src="/{{ $user->profile_image }}" alt="" />
                        @else
                        @php
                        $randomColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                        $initial = strtoupper(substr($user->name, 0, 1));
                        @endphp
                        <div class="rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 50px; height: 50px; background-color: {{ $randomColor }}; color: white; font-weight: bolder;">
                            {{ $initial }}
                        </div>
                        @endif
                        <div class="ms-3 ml-2 mt-1">
                            <span class="fs-5 font-weight-bold">{{ $user->name }}</span>
                            <p class="font-weight-bold" style="font-size: small;">{{ $lead->city }}, <span style="text-transform: uppercase;">{{ $lead->postcode }}</span></p>
                        </div>
                        <span class="badge post-time"
                            style="float: right;position:absolute;right: 4%; background-color: #e2e2e23d; padding: 5px; color: #11163777; font-weight:bolder;"
                            data-timestamp="{{ $lead->post_time }}"></span>
                    </div>
                    <div class="container mt-1">
                        <div class="row">
                            <div class="col">
                                <div class="bg-light rounded p-3">
                                    <p class="font-weight-bold">{{ $lead->service_sub_category }}</p>
                                    <span style="display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 20px; background-color: #e6f7e8; color: #155724; font-size: 12px;">
    <i class="bi bi-check-circle-fill" style="margin-right: 4px; font-size: 14px; color: #47BF9C;"></i> 
    Verified Phone
</span>
<br>

                                   @php
    $finalAnswers = [];
    foreach ($lead->questionAnswers as $qa) {
        $finalAnswers[] = $qa->answer;
    }

    // If less than 4 answers are present, use credit answers to fill
    if (count($finalAnswers) < 4) {
        foreach ($postCredits as $pc) {
            // Match only if service sub-categories and credits are the same
            if (
                $pc['service_sub_category'] == $lead->service_sub_category &&
                $pc['service_sub_category_parent'] == $lead->service_sub_category_parent &&
                $pc['credits'] == $lead->credits
            ) {
                $finalAnswers[] = $pc['credit_answer'];

                // Stop adding once we have 4 answers
                if (count($finalAnswers) >= 4) {
                    break;
                }
            }
        }
    }
@endphp
<br>
@foreach ($finalAnswers as $index => $answer)
    <small class="text-muted font-weight-bold" style="display: inline-flex;">
        {{ $answer }}@if($index !== count($finalAnswers) - 1) / @endif
    </small>
@endforeach
                      
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start px-4 pt-4">
                        <p>
                            <img style="width: 35px; height: 35px; object-fit: cover; border-radius: 50%;"
                                src="{{ asset('Site/download.png') }}" alt="" />
                            <span class="ml-1 font-weight-bold">{{ $lead->credits }} Tokens</span>
                        </p>
                    </div>
                </a>
            </div>
            @endif
            @endforeach
            
            
            <div id="noResults" class="mt-3" style="display: none; text-align: center; color: red;">
    No leads found for this postcode.
</div>
<br><br>
        </div>
</div>
        <div class="col-md-8 tab-main">
            <div class="tab-content-container">
                <div class="tab-content" id="cardTabsContent" >
                    @foreach($allLeads as $lead)
                    @php
                    $user = \App\Models\User::where('email', $lead->email)->first();
                    @endphp
                    @if(in_array($lead->service_sub_category, $userServices))
                    <div class="tab-pane fade" id="{{ $lead->id }}" role="tabpanel"
                        aria-labelledby="user-{{ $lead->id }}">

                        <div class="card-content">
                            <div class="card-bo" style="padding-top: 8%; padding-left: 4%; padding-right: 4%;">
                                <div class="align-items-center">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="font-weight-bold fs-6">{{ $user->name }}</h5>
                                        <div class="text-secondary font-weight-bold text-sm mr-3 post-time"
                                            data-timestamp="{{ $lead->post_time }}"></div>
                                    </div>
                                    <p class="font-weight-bold fs-6">{{ $lead->service_sub_category }} <br> <span>{{ $lead->city }}, </span><span style="text-transform: uppercase;">{{
                                        $lead->postcode }}</span></p>
                                </div>
                                <div>
                                    @if($user->phone_number)
                                    <p class="font-weight-bold" style="color: #111637;">
                                        <span class="font-weight-bold"><i class="bi bi-telephone-fill"></i>&nbsp;</span>
                                        {{ substr_replace($user->phone_number, str_repeat('*',
                                        strlen($user->phone_number) - 2), 0, -2) }}
                                        
                                       &nbsp;   <span style="display: inline-flex; align-items: center; padding: 2px 8px; border-radius: 20px; background-color: #f4fef6;color: #47BF9C; font-size: 12px;font-weight:bold;">
    <i class="bi bi-check" style="margin-right: 4px; font-size: 16px; "></i> 
    Verified 
</span>
                                    
                                        
                                        
                                    </p>
                                    @else
                                    <p style="color: #111637;">
                                        <span class="font-weight-bold"><i
                                                class="bi bi-telephone-fill"></i>&nbsp;</span>Phone details not
                                        provided.
                                    </p>
                                    @endif
                                    <p class="font-weight-bold"  style="color: #111637;">
                                        <span class="font-weight-bold"><i class="bi bi-envelope-fill"></i>&nbsp;</span>
                                        {{ substr_replace($lead->email, str_repeat('*', strlen($lead->email) - 4), 0,
                                        -4) }}
                                    </p>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <img style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;"
                                        src="{{ asset('Site/download.png') }}" alt="" />
                                    <strong style="font-size: 16px; padding-left: 10px;">{{ $lead->credits }}
                                        Tokens</strong>
                                </div>
                                <!-- <div class="col-md-10 col-sm-12 col-12 mr-auto d-flex justify-content-between rounded p-2"
                                    style="background-color: #FEF8ED; padding-top: 10px !important; padding-bottom: 10px !important;">
                                    <div class="col-md-4 d-flex align-items-center mr-auto">
                                        <img style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;"
                                            src="{{ asset('Site/download.png') }}" alt="" />
                                        <strong>&nbsp;&nbsp;{{ $lead->credits }} credits</strong>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="text-warning" style="height: 70px; border-left: 1px solid;"></div>
                                    </div>
                                    <div class="col-md-7 d-flex align-items-center justify-content-center">
                                        <div>
                                            <small class="m-0">Covered by our Get hired Guarantee</small>
                                            <br>
                                            <small class="m-0" style="font-size: 13px;color: #858585;">If you are not
                                                hired during the starter pack, we will refund all the credits</small>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="d-flex mt-4">
                                    @foreach($LOGINEDuser as $logineduser)
                                    @if ($logineduser->balance >= $lead->credits )
                                    <form id="yourFormId"
                                        action="{{ route('professional.get.contact.details.submit') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="name" value="{{ $user->name }}">
                                        <input type="hidden" name="phone_number" value="{{ $user->phone_number }}">
                                        <input type="hidden" name="email" value="{{ $lead->email }}">
                                        <input type="hidden" name="postcode" value="{{ $lead->postcode }}">
                                        <input type="hidden" name="balance" value="{{ $logineduser->balance }}">
                                        <input type="hidden" name="credits" value="{{ $lead->credits }}">
                                        <input type="hidden" name="LoginedUserEmail" value="{{ $logineduser->email }}">
                                        <button type="submit" class="btn btn-primary rounded p-2">Get Contact
                                            Details</button>
                                    </form>
                                    @else
                                    <a href="{{ url('/user/payment/stripe/' . $userAuth->email) }}"
                                        class="btn btn-primary rounded p-2">Get Contact Details</a>
                                    @endif
                                    @endforeach
                                    <!--<button class="ml-4 btn text-primary p-2">Not interested</button>-->
                                </div>
                                <br><br>
                                <h5>Details</h5>
                                <hr>
                               

                                @foreach($lead->questionAnswers as $qa)
                                <p class="text-muted">{{ str_replace('_', ' ', $qa->question) }} <br> <span
                                        style="color: #111637;font-weight:bold;">{{ $qa->answer }}</span></p>
                                @endforeach
                                
                                
                                 @foreach ($postCredits as $pc)
                                @if ($pc['service_sub_category'] == $lead->service_sub_category &&
                                $pc['service_sub_category_parent'] == $lead->service_sub_category_parent &&
                                $pc['credits'] == $lead->credits)
                                <p class="text-muted">{{ $pc['credit_question'] }} <br> <span style="color: #111637;font-weight:bold;">{{
                                        $pc['credit_answer'] }}</span></p>


                                @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                    
                    
             
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="tabModal" tabindex="-1" aria-labelledby="tabModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <p class="p-4" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-arrow-left-circle-fill"></i> Back
            </p>
            <div class="modal-body">
                <!-- Modal body content -->
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        // Event delegation for card click
        $(document).on("click", ".card", function () {
            var targetId = $(this).find(".nav-link").attr("href");
            var serviceSubCategory = targetId.substr(1); // remove leading '#'
            // Replace underscores with escaped underscores for jQuery selector
            var target = $('#' + serviceSubCategory.replace(/[_]/g, '\\_'));

            if ($(window).width() <= 768) {
                $(".modal-body").html($(target).html());
                $("#tabModal").modal("show");
            } else {
                 $(".tab-pane").removeClass("active show");
            $(".tab-nav-link").removeClass("active"); // Remove active class from all tabs
            $(this).find(".nav-link").addClass("active"); // Add active class to the clicked tab
            $(target).addClass("active show");
            }
        });

        $(".tab-nav-link:first").click();
    });

    // Function to update the "ago" time based on the stored timestamp
    function updateAgoTime() {
        var postTimeElements = document.querySelectorAll('.post-time');

        postTimeElements.forEach(function (element) {
            var postTime = new Date(element.dataset.timestamp);
            var now = new Date();
            var timeDifference = Math.floor((now.getTime() - postTime.getTime()) / 1000); // Time difference in seconds

            var agoText;
            if (timeDifference < 60) {
                agoText = timeDifference + " s";
            } else if (timeDifference < 3600) {
                agoText = Math.floor(timeDifference / 60) + " min";
            } else if (timeDifference < 86400) {
                agoText = Math.floor(timeDifference / 3600) + " H";
            } else if (timeDifference < 2592000) { // Less than 30 days
                agoText = Math.floor(timeDifference / 86400) + " D";
            } else if (timeDifference < 31536000) { // Less than 12 months
                agoText = Math.floor(timeDifference / 2592000) + " months";
            } else {
                agoText = Math.floor(timeDifference / 31536000) + " years";
            }

            element.textContent = agoText;
        });
    }
    updateAgoTime();
    setInterval(updateAgoTime, 1000);
</script>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    var searchValue = this.value.toLowerCase();
    var leadCards = document.querySelectorAll('.lead-card');
    var hasResults = false; // Flag to track if any results are found
    
    leadCards.forEach(function(card) {
        var postcode = card.getAttribute('data-postcode').toLowerCase();
        
        if (postcode.includes(searchValue)) {
            card.style.display = 'block'; // Show the lead if postcode matches
            hasResults = true; // Mark that we have at least one result
        } else {
            card.style.display = 'none'; // Hide the lead if no match
        }
    });
    
    // Show "No leads found" message if no results, otherwise hide it
    if (hasResults) {
        document.getElementById('noResults').style.display = 'none';
    } else {
        document.getElementById('noResults').style.display = 'block';
    }
});
</script>




@endif
@endforeach
@endsection