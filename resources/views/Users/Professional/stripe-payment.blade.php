@extends('Users.Professional.layouts.app')
@section('UserContent')

@foreach($users as $user)
@if($user->role == 'Professional')
<style>
    .dashboard-body-2 {
        /* background-color: #F9F9FA; */
        margin-top: 10%;
        color: #111637;
        padding-bottom: 50px;
    }

    @media (max-width: 992px) {
        .dashboard-body-2 {
            margin-top: 20% !important;

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
        /* color: #222; */
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
        /* line-height: 20px; */
    }

    #main #faq .card .collapse {
        border: 0;
    }

    .loading {
        border-radius: 50px;
        width: 50px;
        left: calc(50vw - 25px);
    }

    .button.loading::after {
        width: 40px;
        left: 5px;
        top: 12px;
        border-radius: 100%;
    }

    .spinner {
        display: block;
        width: 34px;
        height: 34px;
        position: absolute;
        top: 8px;
        left: calc(50% - 17px);
        background: transparent;
        box-sizing: border-box;
        border-top: 4px solid white;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-bottom: 4px solid transparent;
        border-radius: 100%;
        animation: spin 0.6s ease-out infinite;
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg)
        }
    }
</style>

<div class="dashboard-body-2">
    @if($user->email_verified == '0')
    <div class="verifyemail" style="padding-top: 10px;">
        <div class="px-4">
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
    <div class="container">
        <div class=" p-4 " id="viewRequestPayment">



            <div class="px-3 align-items-center text-center">
                <h2 style="color: #111637;">You need tokens to get contact
                    details
                    <h6 class="text-muted">To get some tokens, you need to buy a
                        starter pack of tokens
                        <br>(Enough for this lead + roughly another 9 leads)
                    </h6>
                </h2>

            </div>
            <div id="main">
                <div class="container">
                    <div class="accordion" id="faq">
                        <div class="card">
                            <div class="card-header" id="faqhead1">
                                <a href="#" class="btn btn-header-link collapsed fw-600" data-toggle="collapse"
                                    data-target="#faq1" aria-expanded="true" aria-controls="faq1"><b>What are
                                        tokens?</b></a>
                            </div>

                            <div id="faq1" class="collapse " aria-labelledby="faqhead1" data-parent="#faq">
                                <div class="card-body">
                                    tokens are Bark’s online currency. If you see a
                                    job that you like and you want to get in contact
                                    with that customer, then you use tokens to
                                    purchase their contact details (you will receive
                                    their personal phone number and email address).
                                    The amount of tokens required to contact a
                                    customer varies depending on the potential value
                                    of the job e.g. you will need less tokens to
                                    contact a customer looking for a cleaner once a
                                    month for a 1 bedroomed flat than a customer
                                    looking for a cleaner once a week for a 5
                                    bedroomed house.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="faqhead2">
                                <a href="#" class="btn btn-header-link collapsed fw-600" data-toggle="collapse"
                                    data-target="#faq2" aria-expanded="true" aria-controls="faq2"><b>What is the starter
                                        pack?</b></a>
                            </div>

                            <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                                <div class="card-body">
                                    The starter pack is the only way to get started
                                    and trial Bark properly. It provides enough
                                    tokens to contact roughly 10 customers and is
                                    designed so that you get hired at least once and
                                    get a great return on your investment. We’re so
                                    confident that you’ll get hired at least once
                                    from the starter pack that we offer a full Get
                                    Hired Guarantee. We also offer a massive 20%
                                    discount off the standard price.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="card px-3 py-4">

                    <div class="container row">
                        <div class="col-md-6 ">
                            <p>
                                <img style="width: 35px; height: 35px; object-fit: cover; border-radius: 50%; margin-top: -5px;"
                                    src="{{ asset('Site/download.png') }}" alt="" />
                                <span class="ml-1 " style="font-size: large; font-weight: 700; ">60
                                    Tokens</span>
                                <br>
                                <span style="font-weight: lighter;">Enough for about
                                    10 leads</span>
                            </p>
                        </div>
                        <div class="col-md-6 justify-content-center mb-4" style="font-size: large; font-weight: 700; ">
                            £76.80 (ex
                            VAT) / £1.28 per credit <br><span class="text-muted"
                                style="font-weight: lighter; font-size: medium;text-decoration: line-through;">£96.00
                                (ex VAT)</span>
                        </div>
                    </div>
                    <div class=" mt-4">
                        <center>
                            <span class="m-0">Covered by our Get hired
                                Guarantee</span>
                            <br>
                            <span class="m-0" style="font-size: 13px;color: #858585;">If you are
                                not
                                hired during the starter pack, we will refund all
                                the tokens</span>
                        </center>
                    </div>
                    <br>
                    <br>
                    <button data-toggle="modal" data-target="#newModal" id="buy60CreditsBtn"
                        class="btn btn-primary py-2"> Buy 60 Tokens </button>

                </div>
                <br>
            </div>
        </div>
    </div>
</div>



<div class="modal fade border-0" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLable"
    aria-hidden="true">
    <div class="modal-dialog border-0" role="document">
        <!-- Use modal-lg for a large modal -->
        <div class="modal-content border-0">
            <button type="button" class="close ml-auto px-4 pt-4" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="px-3 align-items-center text-center">
                <h3 style="color: #111637;">Enter Card Details

                </h3>

            </div>
            <div class="modal-body">
                <form id='checkout-form' method='POST' action="{{ route('stripe.post') }}">

                    @csrf

                    <input type='hidden' name='stripeToken' id='stripe-token-id'>
                    <input type='hidden' name='amount' id='amount' value="76.80">

                    <br>

                    <div id="card-element" class="form-control"></div>
                    <small class="text-danger" id="error-message"></small>
                    <button id="pay-btn" class="btn btn-primary mt-4 d-flex justify-content-between align-items-center "
                        type="button" style="margin-top: 20px; width: 100%; padding: 7px;" onclick="createToken()">
                        <span>Pay £76.80 (exVAT)</span>
                        <span class="ml-auto"><i class="bi bi-lock-fill"></i></span>
                    </button>

                    <form>
            </div>
            <script src="https://js.stripe.com/v3/"></script>
            <script type="text/javascript">

                var stripe = Stripe('{{ env('STRIPE_KEY') }}')
                var elements = stripe.elements();
                var cardElement = elements.create('card');
                cardElement.mount('#card-element');

                /*------------------------------------------
                --------------------------------------------
                Create Token Code
                --------------------------------------------
                --------------------------------------------*/
                function createToken() {
                    document.getElementById("pay-btn").disabled = true;

                    stripe.createToken(cardElement).then(function (result) {

                        if (typeof result.error != 'undefined') {
                            document.getElementById("pay-btn").disabled = false;
                            document.getElementById('error-message').innerHTML = result.error.message;
                        }

                        /* creating token success */
                        if (typeof result.token != 'undefined') {
                            document.getElementById("stripe-token-id").value = result.token.id;
                            document.getElementById('pay-btn').innerHTML = '<center>Loading...</center>';

                            document.getElementById('checkout-form').submit();
                        }
                    });
                }
            </script>
        </div>
    </div>
</div>

@endif
@endforeach

@endsection