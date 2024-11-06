@extends('Site.layouts.app')

@section('SiteContent')
<style>
    .reg-ser {
        padding-bottom: 10%;
        padding-top: 15%;
    }

    @media (max-width: 1000px) {
        .reg-ser {
            padding-bottom: 120%;
            padding-top: 40%;
        }
    }
</style>
<div class="container-fluid muted">
    <div class="reg-ser d-flex justify-content-center">
        <div id="step-1" class="col-md-7 step-1">
            <br>
            <div class="card">
                <div class="card-body reg-card-body">
                    <center class="mb-4 mt-4">
                        <h3>Full Name</h3>
                        
                    </center>
                    <form method="POST" action="{{ route('get.service.store') }}" class="mt-4">
                        @csrf
                        <input type="hidden" name="role" value="GetService" />
                        <input type="hidden" name="email" value="{{ $email }}" />
                        <input type="hidden" name="email_verified" value="0" />
                        <br>
                        <div class="mb-4">
                            
                            <input type="text" class="custom-input-header1 py-2" id="option1" name="name" required placeholder="Enter full name">
                            <div class="text-danger" id="name-error">

                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" id="next-btn-1" class="btn btn-primary px-4 py-2 next-btn mt-4">Next</button>
                        </div>
                    
                </div>
            </div>
        </div>
        <div id="step-2" class="col-md-7 step-2" style="display: none;">
            <br>
            <div class="card">
                <div class="card-body reg-card-body">
                    <center class="mt-4 mb-4">
                        <h3>Your number is safe with us.</h3>
                        <small class="text-muted">Some matches prefer to provide quotes over the phone to get more details.</small>
                    </center>
                   
                        <div class="mb-4 mt-4">
                            <input type="tel" class="custom-input-header1 py-2" name="phone_number" required placeholder="Enter Your Phone Number">
                            <div id="phone-error" class="error-message text-danger"></div>
                        </div>
                        <div class="mb-3 mt-5 d-flex justify-content-between">
                            <button id="back-btn-2" type="button" class="btn px-4 py-2">Back</button>
                            <button id="next-btn-2" type="button" class="btn btn-primary px-4 py-2 next-btn mt-4">Next</button>
                        </div>
                    
                </div>
            </div>
        </div>
        <div id="step-3" class="col-md-7 step-3" style="display: none;">
            <br>
            <div class="card">
                <div class="card-body reg-card-body">
                 
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a href="javascript:void(0);" onclick="togglePasswordVisibility('password')" style="color: #111637; font-size: small;">Show</a>
                                </div>
                            </div>
                            <input type="password" class="custom-input-header1 input-req py-2 mt-2 password" id="password" name="password" autocomplete="off" required>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="confirmPassword">Confirm Password</label>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a href="javascript:void(0);" onclick="togglePasswordVisibility('confirmPassword')" style="color: #111637; font-size: small;">Show</a>
                                </div>
                            </div>
                            <input type="password" class="custom-input-header1 input-req py-2 confirmPassword mt-2" id="confirmPassword" autocomplete="off" required>
                        </div>
                        <div class="small text-danger error-message" id="errorMessage"></div>
                        <div class="mb-3 mt-5 d-flex justify-content-between">
                            <button id="back-btn-3" type="button" class="btn px-4 py-2">Back</button>
                            <button type="submit" class="btn btn-primary px-4 py-2">Create Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.getElementById('next-btn-1').addEventListener('click', function () {
        var postcode = document.getElementById('option1').value.trim();
        if (postcode === "") {
            document.getElementById('name-error').innerText = "Please enter name.";
        } else {
            document.getElementById('name-error').innerText = "";
            document.getElementById('step-1').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
        }
    });

    document.getElementById('back-btn-2').addEventListener('click', function () {
        document.getElementById('step-2').style.display = 'none';
        document.getElementById('step-1').style.display = 'block';
    });

    document.getElementById('next-btn-2').addEventListener('click', function () {
        var phoneNumber = document.getElementsByName('phone_number')[0].value.trim();
        if (phoneNumber === "") {
            document.getElementById('phone-error').innerText = "Please enter your phone number.";
        } else {
            document.getElementById('phone-error').innerText = "";
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-3').style.display = 'block';
        }
    });

    document.getElementById('back-btn-3').addEventListener('click', function () {
        document.getElementById('step-3').style.display = 'none';
        document.getElementById('step-2').style.display = 'block';
    });

    function togglePasswordVisibility(inputId) {
        var passwordInputs = document.querySelectorAll('.' + inputId);
        passwordInputs.forEach(function (input) {
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        });
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
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
            } else {
                errorMessage.textContent = "";
                confirmPassword.style.borderBottom = "2px solid #198754";
            }
        }

        password.addEventListener("keyup", validatePassword);
        confirmPassword.addEventListener("keyup", validatePassword);
    });
</script>
@endsection
