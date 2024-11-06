@extends('Site.layouts.app')
@section('SiteContent')


<!-- SUB CATEGORY  -->
@foreach($sub_categories->groupBy('service_sub_category_parent') as $parentName => $subCategories)
@php
$parent = \App\Models\ServiceCategory::where('service_category' , $parentName)->first()
@endphp
<style>
    /* styles.css */
    .bg-image {
        background-image: url('{{ asset($parent->service_category_image) }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
        object-fit: cover;
    }

    .text-white {
        color: white;
    }

    .search-box {
        background: rgb(255, 255, 255);
        padding: 20px;
        border-radius: 5px;
        max-width: 400px;
        margin: 20px auto;
    }

    .custom-input-header1 {
        width: 100%;

    }

    .custom-input-header1 {
        padding: 15px;
        border: solid 1px #a5a4a46c;
        --bs-border-opacity: .5;
    }

    .custom-input-header1::placeholder {
        color: #a5a4a4;
    }

    .custom-input-header1:focus {
        border: none !important;
        border-bottom: solid 2px #2E7BF1 !important;
    }
</style>
<br><br>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center text-center bg-image">
        <div class="col-12">
            <br>
            <br>
            <h1 class="text-white">{{ $parentName }}</h1>
            <br>

            <div class="search-box">
                <br><br>
                <form>
                    <div class="d-flex">

                        <input type="text" id="searchInput" class="custom-input-header1 py-1 mr-2"
                            placeholder="Search ">
                    </div>


                </form>
                <br><br>
            </div>
            <br>
            <br>
            <br>
            <br>
            <center>
                <a href="#cs" id="scroll-link"><i class="bi bi-arrow-down-circle"
                        style="color:white; font-size:64px;"></i></a>

            </center>
        </div>
    </div>
</div>

<div id="cs" class="container-fluid col-11 category" style="margin:auto !important;">
    <!-- <div class="col-4 mt-4 ml-auto row "><label for="searchInput"> Search Service </label><input type="text" id="searchInput" class="custom-input-header1 py-1 mr-2" placeholder="Search Sub Service of {{ $parentName }}"></div> -->

    <br><br> <br><br>

    <div class="row p-2  ">
        @foreach($subCategories as $subCategory)

        <div class="col-md-4 col-12 mt-2 sub-service-card" data-name="{{ $subCategory->service_sub_category }}">
            <a style="color:#111637; cursor:pointer;" data-toggle="modal"
                data-target="#Modal{{ str_replace(' ', '_', $subCategory->service_sub_category) }}"
                data-subcategory="{{ $subCategory->service_sub_category }}">
                <div class="card c-card">
                    <div class="">
                        <img src="/{{ $subCategory->service_sub_category_image }}" class="card-img-top image-zoom"
                            alt="sub category Image">
                        @if($subCategory->sub_category_available_online == 1)
                        <span class="badge p-2 text-white"
                            style="position:absolute; top:3%; right:3%; font-weight:500 !important; background-color:#4287F2; font-size:14px; border-radius:15px;">Available
                            Online</span>
                        @endif
                    </div>
                    <h5 class="card-title p-2 pt-3">{{ $subCategory->service_sub_category }}</h5>
                </div>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="Modal{{ str_replace(' ', '_', $subCategory->service_sub_category) }}"
                tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <button type="button" class="close ml-auto mr-4 mt-4" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="stepForm{{ $subCategory->service_sub_category }}" method="POST"
                                action="{{ route('post.submit') }}">
                                @csrf
                                <input type="hidden" name="post_time" id="post_time">
                                <input type="hidden" name="service_sub_category"
                                    value="{{ $subCategory->service_sub_category }}">
                                <input type="hidden" name="service_sub_category_parent"
                                    value="{{ $subCategory->service_sub_category_parent }}">

                                <!-- First Step for Email, Postcode, City -->
                                <div class="step">
                                    <section class="p-4">
                                        <div class="form-group mb-4">
                                            <label for="email">Email address</label>
                                            <input type="email" class="custom-input-header1" name="email"
                                                id="email_{{ str_replace(' ', '_', $subCategory->service_sub_category) }}"
                                                required placeholder="Email Address">

                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label for="postcode">Postcode</label>
                                                <input type="text" class="custom-input-header1" name="postcode"
                                                    id="postcode_{{ str_replace(' ', '_', $subCategory->service_sub_category) }}"
                                                    required placeholder="Postcode">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="city">City/Town</label>
                                                <input type="text" class="custom-input-header1" name="city"
                                                    id="city_{{ str_replace(' ', '_', $subCategory->service_sub_category) }}"
                                                    required placeholder="City/Town">
                                            </div>
                                        </div>
                                        <div class="d-flex mt-4">
                                            <button class="btn btn-primary nextBtnEmail ml-auto" type="button"
                                                onclick="checkEmail('{{ str_replace(' ', '_', $subCategory->service_sub_category) }}')">Continue</button>
                                        </div>
                                    </section>
                                </div>

                                <!-- Dynamic Steps for Questions and Answers -->
                                @foreach($subCategory->questions as $key => $question)
                                <div class="step" @if($key !==0) style="display: none;" @endif>
                                    <section>
                                        <center>
                                            <h4>{{ $question->question }}</h4>
                                        </center>
                                        <br>
                                        <div class="requireError text-danger mb-4"></div>
                                        @foreach($question->answers as $answer)
                                        <div class="form-check step-check-feild">
                                            <input class="step-check-input" type="radio"
                                                name="answer_{{ $question->question }}"
                                                id="ans_{{ $question->question }}_{{ $answer->id }}"
                                                value="{{ $answer->answer }}"
                                                onclick="toggleOtherInput('{{ $question->question }}', this)">
                                            <label class="check-label" style="font-weight:bold;"
                                                for="ans_{{ $question->question }}_{{ $answer->id }}">
                                                {{ $answer->answer }}
                                            </label>
                                        </div>
                                        @endforeach
                                        <div class="form-check step-check-feild">
                                            <input class="step-check-input" type="radio"
                                                name="answer_{{ $question->question }}"
                                                id="ans_{{ $question->question }}_other"
                                                onclick="toggleOtherInput('{{ $question->question }}', this)">
                                            <label class="check-label" for="ans_{{ $question->question }}_other"
                                                style="font-weight:bold;">Other</label>
                                            <input type="text" class="custom-input-header1 other-input"
                                                name="other_{{ $question->question }}"
                                                id="other_{{ $question->question }}" style="display: none;"
                                                placeholder="Please specify">
                                        </div>
                                    </section>
                                    <div class="modal-footer d-flex">
                                        @if($key !== 0)
                                        <button class="btn prevBtn" type="button">Back</button>
                                        @endif
                                        <button class="btn btn-primary nextBtn ml-auto" type="button">Continue</button>
                                    </div>
                                </div>
                                @endforeach

                                <div class="step" style="display: none;">
                                    <section class="p-4">
                                        @php
                                        $filteredPostCredits = $post_credits->where('service_sub_category',
                                        $subCategory->service_sub_category)->where('service_sub_category_parent',
                                        $parentName);
                                        @endphp
                                        @foreach($filteredPostCredits->groupBy('credit_question') as $question =>
                                        $answers)
                                        <center>
                                            <h4>{{ $question }}</h4>
                                        </center>
                                        <br>
                                        <div class="requireError text-danger mb-4" id="radioError"
                                            style="display: none;">Please select an option.</div>
                                        <!-- Error div for showing radio selection error -->

                                        @foreach($answers as $answer)
                                        <div class="form-check step-check-feild">
                                            <input class="step-check-input" type="radio" name="user_answer_about_credit"
                                                id="{{ $answer->credit_answer }}_{{ $answer->id }}"
                                                value="{{ $answer->credit_answer }}">
                                            <label class="check-label"
                                                for="{{ $answer->credit_answer }}_{{ $answer->id }}"
                                                style="font-weight:bold;">
                                                {{ $answer->credit_answer }}
                                            </label>
                                        </div>
                                        @endforeach
                                        @endforeach
                                        <div class="d-flex mt-4">
                                            <button class="btn prevBtn" type="button">Back</button>
                                            <button class="btn btn-primary ml-auto" type="button"
                                                onclick="validateRadioSelection('{{ $subCategory->service_sub_category }}')">Submit</button>
                                            <!-- Submit button triggers validation -->
                                        </div>
                                    </section>
                                </div>

                                <script>
                                    // Function to validate radio button selection and submit the form
                                    function validateRadioSelection(subCategory) {
                                        var radioButtons = document.getElementsByName('user_answer_about_credit');
                                        var isChecked = false;

                                        // Loop through radio buttons to check if any is selected
                                        for (var i = 0; i < radioButtons.length; i++) {
                                            if (radioButtons[i].checked) {
                                                isChecked = true;
                                                break;
                                            }
                                        }

                                        // Show error if no radio button is selected, otherwise proceed to submit form
                                        var errorDiv = document.getElementById('radioError');
                                        if (!isChecked) {
                                            errorDiv.style.display = 'block'; // Show error message
                                        } else {
                                            errorDiv.style.display = 'none'; // Hide error message
                                            // Submit the form after validation
                                            var form = document.getElementById('stepForm' +
                                                subCategory); // Get the form by ID
                                            form.submit(); // Submit the form
                                        }
                                    }
                                </script>

                            </form>
                            <!-- OTP Confirmation Step -->
                            <div class="otp_step" style="display:none">
                                <section class="p-4">
                                    <div class="form-group mb-4">
                                        <label for="otp_code">Enter OTP Code</label>
                                        <input type="text" class="custom-input-header1" name="otp_code" id="otp_code"
                                            required placeholder="OTP Code">
                                    </div>

                                    <div class="small text-danger" id="otpErrorMessage"></div>
                                    <!-- OTP Error message container -->

                                    <div class="d-flex mt-4">
                                        <button class="btn btn-primary ml-auto" id="verifyOtpButton"
                                            type="button">Verify OTP</button>
                                    </div>
                                </section>
                            </div>

                            <div class="account_creation_step" style="display:none">
                                <section class="p-4">
                                    <form id="getserviceuserstore" method="POST"
                                        onsubmit="event.preventDefault(); submitRegistrationForm();">
                                        @csrf
                                        <input type="hidden" name="role" value="GetService">
                                        <input type="hidden" name="email_verified" id="hidden_email_verified" value="">
                                        <input type="hidden" name="email" value="" id="hidden_email">

                                        <!-- Prefilled via JS -->

                                        <div class="form-group mb-4">
                                            <label for="name">Name</label>
                                            <input type="text" class="custom-input-header1 input-req" name="name"
                                                id="name" required placeholder="Name">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" class="custom-input-header1 input-req"
                                                name="phone_number" id="phone_number" required
                                                placeholder="Phone Number">
                                        </div>

                                        <div class="form-group mt-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="password">Password</label>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="javascript:void(0);"
                                                        onclick="togglePasswordVisibility('password')"
                                                        style="color: #111637; font-size: small;">View</a>
                                                </div>
                                            </div>
                                            <input type="password" class="custom-input-header1 input-req mt-2 password"
                                                id="password" name="password" placeholder="Password" autocomplete="off"
                                                required>
                                        </div>

                                        <div class="form-group mt-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="confirmPassword">Confirm Password</label>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="javascript:void(0);"
                                                        onclick="togglePasswordVisibility('confirmPassword')"
                                                        style="color: #111637; font-size: small;">View</a>
                                                </div>
                                            </div>
                                            <input type="password" class="custom-input-header1 input-req mt-2"
                                                id="confirmPassword" placeholder="Confirm Password" autocomplete="off"
                                                required>
                                        </div>

                                        <div class="small text-danger error-message" id="errorMessage"></div>

                                        <div class="d-flex mt-4">
                                            <button class="btn btn-primary ml-auto accountSubmitBtn" id="submitButton"
                                                type="button">Submit</button>
                                            <!-- Changed to type="button" -->
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODEL  -->
        </div>
        @endforeach
    </div>
</div>

@endforeach

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>

            </div>
            <div class="modal-body text-primary">
                <br>
                Are you sure you want to quit?
                <br>
                <br>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-primary no_btn" data-dismiss=".modal"> Continue</button>
                <button type="button" class="btn btn-danger" id="confirmCancel">Quit</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var modals = document.querySelectorAll('.modal');
        var previousModal = null;

        modals.forEach(function (modal) {
            var currentStep = 0;
            var steps = modal.querySelectorAll('.step');
            var prevBtns = modal.querySelectorAll('.prevBtn');
            var nextBtns = modal.querySelectorAll('.nextBtn');
            showStep(currentStep);
            prevBtns.forEach(function (btn) {
                btn.addEventListener("click", function () {
                    navigate(-1);
                });
            });
            nextBtns.forEach(function (btn) {
                btn.addEventListener("click", function () {
                    var radioButtons = steps[currentStep].querySelectorAll(
                        'input[type="radio"]');
                    var errorDiv = steps[currentStep].querySelector('.requireError');

                    if (radioButtons.length >
                        0
                    ) {
                        var selected = Array.from(radioButtons).some(function (radio) {
                            return radio.checked;
                        });
                        if (!selected) {
                            if (errorDiv) {
                                errorDiv.textContent =
                                    'Please select an option before proceeding.';
                                errorDiv.style.display = 'block';
                            }
                            return;
                        } else {
                            if (errorDiv) {
                                errorDiv.textContent = '';
                                errorDiv.style.display = 'none';
                            }
                        }
                    }
                    navigate(1);
                });
            });

            function navigate(stepChange) {
                var newStep = currentStep + stepChange;
                if (newStep >= 0 && newStep < steps.length) {
                    steps[currentStep].style.display = "none";
                    steps[newStep].style.display = "block";
                    currentStep = newStep;
                }
            }

            function showStep(stepIndex) {
                if (stepIndex >= 0 && stepIndex < steps.length) {
                    steps.forEach(function (step, index) {
                        if (index === stepIndex) {
                            step.style.display = "block";
                        } else {
                            step.style.display = "none";
                        }
                    });
                }
            }
            var modalCloseButtons = modal.querySelectorAll('[data-dismiss="modal"]');
            modalCloseButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    previousModal = modal;
                    $('#confirmationModal').modal('show');
                });
            });
        });
        var confirmCancelBtn = document.getElementById('confirmCancel');
        var noButton = document.querySelector('#confirmationModal .modal-footer .no_btn');
        confirmCancelBtn.addEventListener('click', function () {
            $('#confirmationModal').modal('hide');
            location.reload();
        });
        noButton.addEventListener('click', function () {
            $('#confirmationModal').modal('hide');
            if (previousModal) {
                $(previousModal).modal('show');
                previousModal = null;
            }
        });
    });

    function toggleOtherInput(questionId, selected) {
        var otherInput = document.getElementById('other_' + questionId);
        if (selected.checked && selected.id.endsWith('_other')) {
            otherInput.style.display = 'block';
            otherInput.setAttribute('name', 'answer_' + questionId);
        } else {
            otherInput.value = '';
            otherInput.style.display = 'none';
        }
    }

    function checkEmail(subCategory) {
        var emailInput = document.getElementById('email_' + subCategory.replace(/ /g, '_'));
        var postcodeInput = document.getElementById('postcode_' + subCategory.replace(/ /g, '_'));
        var cityInput = document.getElementById('city_' + subCategory.replace(/ /g, '_'));
        var modal = $('#Modal' + subCategory.replace(/ /g, '_'));

        function showError(inputElement, message) {
            var errorDiv = document.createElement('div');
            errorDiv.textContent = message;
            errorDiv.style.color = 'red';
            inputElement.after(errorDiv);
        }

        function clearError(inputElement) {
            if (inputElement.nextElementSibling) {
                inputElement.nextElementSibling.remove();
            }
        }
        emailInput.addEventListener('input', function () {
            clearError(emailInput);
            validateEmail();
        });
        postcodeInput.addEventListener('input', function () {
            clearError(postcodeInput);
            if (postcodeInput.value !== "") {
                clearError(postcodeInput);
            }
        });
        cityInput.addEventListener('input', function () {
            clearError(cityInput);
            if (cityInput.value !== "") {
                clearError(cityInput);
            }
        });

        function validateEmail() {
            var email = emailInput.value;
            clearError(emailInput);
            if (email === "") {
                showError(emailInput, "Email is required");
                return false;
            }
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                showError(emailInput, "Please enter a valid email address");
                return false;
            }
            return true;
        }

        function validatePostcode() {
            var postcode = postcodeInput.value;
            clearError(postcodeInput);
            if (postcode === "") {
                showError(postcodeInput, "Postcode is required");
                return false;
            }
            return true;
        }

        function validateCity() {
            var city = cityInput.value;
            clearError(cityInput);
            if (city === "") {
                showError(cityInput, "City/Town is required");
                return false;
            }
            return true;
        }
        if (!validateEmail() || !validatePostcode() || !validateCity()) {
            return;
        }
        let checkEmailButton = modal.find(".nextBtnEmail");
        checkEmailButton.prop("disabled", true).text("Processing...");
        $.ajax({
            url: '{{ route("check.email") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                email: emailInput.value
            },
            success: function (response) {
                if (response.exists) {
                    var currentStep = modal.find('.step:visible');
                    currentStep.hide();
                    currentStep.next('.step').show();
                    checkEmailButton.prop("disabled", false).text("Continue");
                } else {
                    sendOtp(emailInput.value);
                    $('.otp_step').show();
                    $('.step:visible').hide();
                    $('#hidden_email').val(emailInput.value);
                    checkEmailButton.prop("disabled", false).text("Continue");
                    Swal.fire('OTP Sent', 'An OTP has been sent to your email. Please check your inbox.',
                        'success');
                }
            },
            error: function () {
                Swal.fire('Error', 'There was an error checking the email.', 'error');
                checkEmailButton.prop("disabled", false).text("Continue");
            },
            complete: function () {
                checkEmailButton.prop("disabled", false).text("Continue");
            }
        });
    }

    function sendOtp(email) {
        $.ajax({
            url: '{{ route("send.otp") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                email: email
            },
            success: function (response) {
                if (response.status === 'success') {

                } else {
                    Swal.fire('Error', 'There was an error sending the OTP.', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Unable to send OTP at this moment.', 'error');
            }
        });
    }
    $('#verifyOtpButton').on('click', function () {
        var otpInput = $('#otp_code').val();

        if (!otpInput) {
            $('#otpErrorMessage').text('OTP is required.');
            return;
        }

        $.ajax({
            url: '{{ route("verify.otp") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                otp: otpInput
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('#hidden_email_verified').val(1);
                    $('.account_creation_step').show();
                    $('.otp_step').hide();
                } else {
                    $('#otpErrorMessage').text('Invalid OTP. Please try again.');
                }
            },
            error: function () {
                Swal.fire('Error', 'Unable to verify OTP at this moment.', 'error');
            }
        });
    });

    function togglePasswordVisibility(fieldId) {
        var field = document.getElementById(fieldId);
        field.type = field.type === 'password' ? 'text' : 'password';
    }

    function validatePassword(password) {
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        return passwordRegex.test(password);
    }

    function displayPasswordStrengthMessage() {
        var password = $('#password').val();
        var errorMessage = '';
        if (!validatePassword(password)) {
            errorMessage =
                'Password must be at least 8 characters, contain a capital letter, a small letter, a number, and a special character.';
        }
        $('#errorMessage').text(errorMessage);
    }

    function checkPasswordMatch() {
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        var errorMessage = '';
        if (!validatePassword(password)) {
            errorMessage =
                'Password must be at least 8 characters, contain a capital letter, a small letter, a number, and a special character.';
        }
        if (password !== confirmPassword) {
            errorMessage = 'Passwords do not match.';
        }

        $('#errorMessage').text(errorMessage);
        return !errorMessage;
    }

    function submitRegistrationForm() {
        $('#errorMessage').text('');
        if (!checkPasswordMatch()) {
            return;
        }
        var $form = $('#getserviceuserstore');
        var formData = $form.serialize();
        let accSubmitButton = $("#submitButton");
        accSubmitButton.prop("disabled", true).text("Processing...");

        $.ajax({
            url: '{{ route("get.service.store") }}',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function () {
                        window.location.reload();
                    });
                    accSubmitButton.prop("disabled", false).text("Submit");
                    $form.trigger('reset');
                } else if (response.status === 'error') {
                    Swal.fire('Error', response.message, 'error');
                    accSubmitButton.prop("disabled", false).text("Submit");
                }
            },
            error: function (xhr) {
                var errorMessage = xhr.responseJSON?.message ||
                    'There was an error processing your request. Please try again later.';
                Swal.fire('Error', errorMessage, 'error');
                accSubmitButton.prop("disabled", false).text("Submit");
            },
            complete: function () {
                accSubmitButton.prop("disabled", false).text("Submit");
            }
        });
    }
    $('#password').on('input', function () {
        displayPasswordStrengthMessage();
        checkPasswordMatch();
    });
    $('#confirmPassword').on('input', checkPasswordMatch);
    $('#submitButton').on('click', function () {
        submitRegistrationForm();
    });

    function toggleOtherInput(questionId, selected) {
        var otherInput = document.getElementById('other_' + questionId);
        if (selected.checked && selected.id.endsWith('_other')) {
            otherInput.style.display = 'block';
            otherInput.setAttribute('name', 'answer_' + questionId);
        } else {
            otherInput.value = '';
            otherInput.style.display = 'none';
        }
    }

    function updateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = (now.getMonth() + 1 < 10 ? "0" : "") + (now.getMonth() + 1);
        var day = (now.getDate() < 10 ? "0" : "") + now.getDate();
        var hours = (now.getHours() < 10 ? "0" : "") + now.getHours();
        var minutes = (now.getMinutes() < 10 ? "0" : "") + now.getMinutes();
        var seconds = (now.getSeconds() < 10 ? "0" : "") + now.getSeconds();
        var currentDate = year + "-" + month + "-" + day;
        var currentTime = hours + ":" + minutes + ":" + seconds;
        var postTimeInputs = document.querySelectorAll('input[name="post_time"]');
        postTimeInputs.forEach(function (input) {
            input.value = currentDate + " " + currentTime;
        });
    }
    setInterval(updateTime, 1000);
</script>
<!-- /SUB CATEGORY  -->






@endsection
@section('Sitefooter')
@include('Site.layouts.footer')
@endsection