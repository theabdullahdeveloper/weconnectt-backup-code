@extends('Users.Professional.layouts.app')

@section('UserContent')

@if($user->role == 'Professional')


<style>
    .dashboard-body-2 {
        margin-top: 6%;
        color: #111637;
        padding-bottom: 50px;
        font-size: small;
    }
    @media (max-width: 992px) {
        .dashboard-body-2 {
            margin-top: 20% !important;
        }
    }

  
</style>

<div class="dashboard-body-2">
    @if($user->email_verified == '0')
    <div class="verifyemail" style="padding-top: 10px;">
        <div class="px-4">
            <div class="container bg-danger text-white rounded">
                <center>
                    <p style="padding-top: 10px; padding-bottom: 10px;">
                        Your email address has not been verified. Please verify your email.&nbsp;
                        <a href="{{ url('/professional-dashboard/settings/' . session('UserAuth')->id ) }}" style="text-decoration: underline; color: whitesmoke;">Verify Email</a>
                    </p>
                </center>
            </div>
        </div>
    </div>
    @endif
    <div class="container">
        <div class="col-md-12 col-sm-12 p-4 mb-4">
            <a href="{{ url('/professional-dashboard/settings/' . session('UserAuth')->id ) }}" style="color:#111637;">
                <i class="bi bi-arrow-left-circle-fill"></i> Setting
            </a>
            <br><br>
            <a href="{{ url('/user/payment/stripe/' . $user->email) }}" class="btn btn-success" style="float:right;">Buy Tokens</a>

            <br><br> <br><br>
            <center><h5>Your Card Payment Details</h5></center>
            <br>
            <div class="col-12">
                <!-- <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for names.." style="margin-bottom: 20px;"> -->
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Payment Amount</th>
                            <th>Currency</th>
                            <th>Tokens Purchased</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($user_creditDetails as $data)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $data->payment_amount }}</td>
                            <td>{{ $data->currency }}</td>
                            <td>{{ $data->credits_purchased }}</td>
                            <td>{{ $data->payment_date }}</td>
                            
                            
                        </tr>
                       @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

@endif


@endsection
