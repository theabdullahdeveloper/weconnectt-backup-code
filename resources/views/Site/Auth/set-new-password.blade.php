@extends('Site.layouts.app')
@section('SiteContent')

<style>
    .auth-container {
        margin-top: 10% !important;


    }

    @media(max-width: 767px) {
        .auth-container {
            margin-top: 50% !important;

        }
    }

    .auth-card {
        background-color: #f9f9fa4b;
    }



    .login-inputs:focus {
        box-shadow: none !important;
        border-bottom: 2px solid #2E7BF1;
        border-top: none;
        border-left: none;
        border-right: none;

    }

    .serve_input:invalid {
        border: 1px solid rgb(179, 12, 12);

    }

    .serve_input:valid {
        border: 1px solid rgba(54, 179, 5, 0.692);

    }

    .forget-password {
        text-decoration: none !important;
        color: #adadad;
        font-size: 14px !important;
        margin-top: 2px;
    }

    .forget-password:hover {
        text-decoration: underline !important;
        color: #adadad;
        font-size: 14px !important;
        margin-top: 2px;
    }

    .login-form-btn {
        margin-top: 25px;
        width: 100%;
    }

    .auth-para {
        color: #A8A8A8;
    }

    .auth {
        background-color: #F9F9FA;
    }

    .figure-icon {
        font-size: 50px;
        border: 2px solid #111637;
        border-radius: 50%;
        padding-top: 15px;
        padding-bottom: 15px;
        padding-left: 25px;
        padding-right: 25px;
        /* margin-bottom: 30px; */
    }


    .figure-icon:hover {
        font-size: 50px;
        border: 2px solid #1955AE;
        border-radius: 50%;
        padding-top: 15px;
        padding-bottom: 15px;
        padding-left: 25px;
        /* padding-right: 25px; */
        color: #1955AE;
    }

    .account_link {
        cursor: pointer !important;
        color: #111637 !important;
    }


    .confirmPassword:focus {
        border-bottom: 1px solid rgba(0, 0, 0, 0.363) !important;

    }
</style>


<div class="container d-flex justify-content-center align-items-center auth-container">
    <div class="card col-md-6 auth-card ">

        <div class="card-body">
            <div class="card-title">
                <h1 class="">Change Password</h1>
            </div>
            @if(session('success'))
            <div class="text-success  fade show mt-4">
                <i class="bi bi-check2-circle me-1 align-middle fs-16"></i> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="text-danger  fade show mt-4">
                <i class="bi bi-exclamation-triangle me-1 align-middle fs-16"></i> {{ session('error') }}
            </div>
            @endif
            <form method="POST" action="{{ route('change.password.done') }}">
                @csrf
                <input type="hidden" name="token" value="{{$token}}">
                <div class="form-group mt-4">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control login-inputs mt-2" id="password" name="password"
                        autocomplete="off">
                </div>
                <div class="form-group mt-4">
                    <label for="confirmPassword">Re-type New Password</label>
                    <input type="password" class="form-control login-inputs mt-2" name="confrim_password"
                        autocomplete="off" id="confirmPassword">
                </div>
                <div class="small text-danger error-message" id="errorMessage"></div>
                <div class="form-group w-100">
                    <button type="submit" id="submitButton" class="btn btn-primary login-form-btn">Login</button>
                </div>
            </form>

        </div>


    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
        const submitButton = document.getElementById("submitButton");

        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords do not match");
                confirmPassword.style.borderBottom = "2px solid #dc3545";
                // submitButton.disabled = true;
            } else {
                confirmPassword.setCustomValidity("");
                confirmPassword.style.borderBottom = "2px solid #198754";
                // submitButton.disabled = false;
            }
        }

        password.addEventListener("change", validatePassword);
        confirmPassword.addEventListener("keyup", validatePassword);
    });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
        const submitButton = document.getElementById("submitButton");
        const errorMessage = document.getElementById("errorMessage");

        function validatePassword() {
            const regexUpperCase = /[A-Z]/;
            const regexLowerCase = /[a-z]/;
            const regexDigit = /[0-9]/;
            const regexSpecialChar = /[!@#$%^&*(),.?":{}|<>]/;

            let errorMessages = [];

            if (password.value.length < 8) {
                errorMessages.push("Password should be at least 8 characters long.");
            }
            if (!regexUpperCase.test(password.value)) {
                errorMessages.push("Password should contain at least one uppercase letter.");
            }
            if (!regexLowerCase.test(password.value)) {
                errorMessages.push("Password should contain at least one lowercase letter.");
            }
            if (!regexDigit.test(password.value)) {
                errorMessages.push("Password should contain at least one digit.");
            }
            if (!regexSpecialChar.test(password.value)) {
                errorMessages.push("Password should contain at least one special character.");
            }

            if (password.value !== confirmPassword.value) {
                errorMessages.push("Password and confirm password fields do not match.");
            }

            if (errorMessages.length > 0) {
                errorMessage.textContent = errorMessages.join('\n');
                confirmPassword.style.borderBottom = "2px solid #dc3545";
                submitButton.disabled = true;
            } else {
                errorMessage.textContent = "";
                confirmPassword.style.borderBottom = "2px solid #198754";
                submitButton.disabled = false;
            }
        }

        password.addEventListener("keyup", validatePassword);
        confirmPassword.addEventListener("keyup", validatePassword);
    });
</script>


@endsection
@section('Sitefooter')
@include('Site.layouts.footer')
@endsection