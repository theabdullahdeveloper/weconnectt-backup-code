@extends('Users.GetService.layouts.app')

@section('GetServiceUserContent')
@foreach($users as $user)
@if($user->role == 'GetService')

<style>
    .main-gs {
        min-height: 100vh;
        background-color: #F9F9FA;
        padding-top: 8%;
        padding-bottom: 8%;
    }

    .btn-request {
        text-decoration: none !important;
        background-color: #d8e5fc62;
        color: #2D7AF1;
        padding: 7px 15px;
    }

    .btn-request:hover {
        background-color: #D5E4FC;
        color: #2D7AF1;
    }

    .ago {
        color: #cacaca;
        font-size: small;
    }

    .msc {
        margin-left: 20px;
    }

    @media only screen and (max-width: 767px) {
        .main-gs {
            padding-top: 25%;
        }

        .btn-request {
            font-size: small;
            padding: 5px 10px;
        }

        .msc {
            margin-left: 10px;
        }
    }
</style>

<div class="main-gs">
@if($user->email_verified == '0')
    <div class="verifyemial" style="padding-top: 10px;">
        <div class=" px-4 ">
            <div class="container bg-danger text-white rounded">
                <center>
                    <p style="padding-top: 10px; padding-bottom: 10px;">
                        Your email address has not been verified. Please verify your email.&nbsp;
                        <a href="{{ url('/get/service/user/setting/' . $user->id ) }}" style="text-decoration: underline ; color: whitesmoke;">
                            Verify Email
                        </a>
                    </p>
                </center>
            </div>
        </div>
    </div>
@endif

<div class="container">
    <div class="d-flex">
        <div class="col-md-6">
            <h4>Your requests</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <a href="{{ url('/') }}" class="btn-request">Place New Request</a>
        </div>
    </div>
</div>
<br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-11 col-11 m-auto">
            <div class="row">
                @foreach($leads as $lead)
                    <div class="card border-0 col-md-5 col-sm-12 pt-3 pb-3 px-3 mb-2 ml-auto mr-auto">
                        <div class="d-flex">
                        <!-- <span class="mr-auto">Date</span> -->
                        <span class="ml-auto text-muted post-time mb-4" data-timestamp="{{ $lead->post_time }}"></span>
                        </div>
                        <center>
                            <h5>{{ $lead->service_sub_category }}</h5>
                            <p class="text-muted">{{ $lead->service_sub_category_parent }}</p>
                           
                        </center>
                        <div class="card-body text-center">
                            <button class="btn btn-primary btn-small view-request-btn" data-toggle="modal" data-target="#viewRequestModal_{{ $lead->id }}">View Request</button>
                            <a href="{{ url('/get/service/dashboard/mark/request/complete/' . $lead->id) }}" class="btn btn-success btn-small msc">Mark complete</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@foreach($leads as $lead)
    <!-- Define a modal for each lead -->
    <div class="modal fade" id="viewRequestModal_{{ $lead->id }}" tabindex="-1" role="dialog" aria-labelledby="viewRequestModalLabel_{{ $lead->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="viewRequestModalLabel_{{ $lead->id }}">{{ $lead->service_sub_category }} Request Details</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($lead->questionAnswers as $qa)
                        <p class="text-muted">{{ $qa->question }} <br> <span style="color: #111637;">{{ $qa->answer }} </span></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach

</div>

<script>
    // Function to update the "ago" time based on the stored timestamp
    function updateAgoTime() {
        var postTimeElements = document.querySelectorAll('.post-time');

        postTimeElements.forEach(function(element) {
            var postTime = new Date(element.dataset.timestamp);
            var now = new Date();
            var timeDifference = Math.floor((now.getTime() - postTime.getTime()) / 1000); // Time difference in seconds

            var agoText;
            if (timeDifference < 60) {
                agoText = timeDifference + " seconds ago";
            } else if (timeDifference < 3600) {
                agoText = Math.floor(timeDifference / 60) + " minutes ago";
            } else if (timeDifference < 86400) {
                agoText = Math.floor(timeDifference / 3600) + " hours ago";
            } else if (timeDifference < 2592000) { // Less than 30 days
                agoText = Math.floor(timeDifference / 86400) + " days ago";
            } else if (timeDifference < 31536000) { // Less than 12 months
                agoText = Math.floor(timeDifference / 2592000) + " months ago";
            } else {
                agoText = Math.floor(timeDifference / 31536000) + " years ago";
            }

            element.textContent = agoText;
        });
    }

    // Call updateAgoTime function initially and then every second to update the time
    updateAgoTime();
    setInterval(updateAgoTime, 1000);
</script>

@endif
@endforeach
@endsection
