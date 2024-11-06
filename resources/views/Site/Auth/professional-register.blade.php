@extends('Site.layouts.app')

@section('SiteContent')
<div class="container-fluid muted">
    <div class="reg-pro d-flex justify-content-center">
        <div id="step-1" class="col-md-7 step-1">
            <center>
                <h3>Where would you like to see leads from?</h3>
                <h6 class="text-muted">Tell us the area you cover so we can show you leads for your location</h6>
            </center>
            <br>
            <div class="card">
                <div class="card-body reg-card-body">
                    <form action="{{ route('store.professional.user') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service" value="{{ $selectedCategory }}" />
                        <input type="hidden" name="role" value="Professional" />
                        <input type="hidden" name="email_verified" value="0" />
                        <br>
                        <div class="form-group">
                            <input type="radio" class="form-radio" id="option1" name="customer_serve" value="nationwide"
                                checked>
                            <label for="option1" id="label1" class="form-radio-label ml-2">I serve customers
                                nationwide</label>
                        </div>

                        <div class="form-group">
                            <input type="radio" class="form-radio" id="option2" name="customer_serve" value="postcode">
                            <label for="option2" id="label2" class="form-radio-label ml-2">I serve customers
                                within</label>
                        </div>

                        <div class="form-row align-items-center">
                            
                            <div class="col-md-12 col-sm-12">
                                <input type="text" name="postcode" id="postcode"
                                    class="custom-input-header1 py-2 rounded" placeholder="Post code" autocomplete="off">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div id="postcode-error" class="text-danger mr-4"></div>
                        </div>
                        <div class="mb-3 mt-5 d-flex justify-content-end">
                            <button id="next-btn" type="button" class="btn btn-primary px-4 py-2">Next</button>
                        </div>

                </div>
            </div>
        </div>

        <div id="step-2" class="col-md-7 step-2" style="display: none;">
            <center>
                <h3>Some details about you</h3>
                <h6 class="text-muted">You’re just a few steps away from viewing our {{ $selectedCategory }} leads</h6>
            </center>
            <br>
            <div class="card">
                <div class="card-body reg-card-body">

                    <div class="form-group mb-3">
                        <label class="form-label lable-reg">Your Name</label>
                        <input type="text" class="custom-input-header1 input-req py-2" name="name" required autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label lable-reg">Company name</label>
                        <input type="text" class="custom-input-header1 input-req py-2" name="company_name" autocomplete="off">
                        <small style="color: #727171b9;margin-top:10px !important; font-weight: lighter !important;">If
                            you aren't a business or don't have this information, you can leave this blank</small>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label lable-reg">Email</label>
                        <input type="email" class="custom-input-header1 input-req py-2" name="email" required autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label lable-reg">Phone number </label>
                        <input type="tel" class="custom-input-header1 input-req py-2" name="phone_number"
                            placeholder="Optional" autocomplete="off">
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label lable-reg">Does your company have a website?</label>
                        <div class="boxed">
                            <input type="radio" id="yes" name="has_website" value="Yes" onclick="toggleWebsiteInput()">
                            <label for="yes" class="px-3 py-1 rounded-pill mr-2">Yes</label>
                            <input type="radio" id="no" name="has_website" value="No" onclick="toggleWebsiteInput()"
                                checked>
                            <label for="no" class="px-3 py-1 rounded-pill">No</label>
                        </div>
                        <input type="url" class="custom-input-header1 input-req py-2 mt-3" name="website_link"
                            placeholder="Website address (optional)" autocomplete="off">
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label lable-reg">Company size, employees</label>
                        <div class="boxed">
                            <input type="radio" id="self-employed" name="company_size"
                                value="Self-employed, Sole trader" onclick="toggleSalesAndSocialMediaInputs()" checked>
                            <label for="self-employed" class="px-3 py-1 rounded-pill mr-2">Self-employed, Sole
                                trader</label>
                            <input type="radio" id="2–10" name="company_size" value="2–10"
                                onclick="toggleSalesAndSocialMediaInputs()">
                            <label for="2–10" class="px-3 py-1 rounded-pill">2–10</label>
                            <input type="radio" id="11–50" name="company_size" value="11–50"
                                onclick="toggleSalesAndSocialMediaInputs()">
                            <label for="11–50" class="px-3 py-1 rounded-pill">11–50</label>
                            <input type="radio" id="51-200" name="company_size" value="51-200"
                                onclick="toggleSalesAndSocialMediaInputs()">
                            <label for="51-200" class="px-3 py-1 rounded-pill">51-200</label>
                            <input type="radio" id="200+" name="company_size" value="200+"
                                onclick="toggleSalesAndSocialMediaInputs()">
                            <label for="200+" class="px-3 py-1 rounded-pill">200+</label>
                        </div>
                    </div>
                    <div class="form-group mt-4" id="salesTeamGroup" style="display: none;">
                        <label class="form-label lable-reg">Does your company have a sales team?</label>
                        <div class="boxed">
                            <input type="radio" id="yes2" name="hasSalesTeam" value="Yes">
                            <label for="yes2" class="px-3 py-1 rounded-pill mr-2">Yes</label>
                            <input type="radio" id="no2" name="hasSalesTeam" value="No">
                            <label for="no2" class="px-3 py-1 rounded-pill">No</label>
                        </div>
                    </div>
                    <div class="form-group mt-4" id="socialMediaGroup" style="display: none;">
                        <label class="form-label lable-reg">Does your company use social media?</label>
                        <div class="boxed">
                            <input type="radio" id="yes3" name="usesSocialMedia" value="Yes">
                            <label for="yes3" class="px-3 py-1 rounded-pill mr-2">Yes</label>
                            <input type="radio" id="no3" name="usesSocialMedia" value="No">
                            <label for="no3" class="px-3 py-1 rounded-pill">No</label>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <a href="javascript:void(0);" onclick="togglePasswordVisibility('password')"
                                    style="color: #111637; font-size: small;">Show</a>
                            </div>
                        </div>
                        <input type="password" class="custom-input-header1 input-req py-2 mt-2 password" id="password"
                            name="password" autocomplete="off" required>
                    </div>
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="confirmPassword">Confirm Password</label>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <a href="javascript:void(0);" onclick="togglePasswordVisibility('confirmPassword')"
                                    style="color: #111637; font-size: small;">Show</a>
                            </div>
                        </div>
                        <input type="password" class="custom-input-header1 input-req py-2 confirmPassword mt-2"
                            id="confirmPassword" autocomplete="off" required>
                    </div>
                    <div class="small text-danger error-message" id="errorMessage"></div>
                    <div class="mb-3 mt-5 d-flex justify-content-between">
                        <button id="back-btn" type="button" class="btn px-4 py-2">Back</button>
                        <button id="submitButton" type="submit" class="btn btn-primary px-4 py-2">Create
                            Account</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to enable/disable postcode input based on selected option
    function togglePostcodeField() {
        var option1Checked = document.getElementById('option1').checked;
        var postcodeInput = document.getElementById('postcode');

        if (option1Checked) {
            // If "nationwide" is selected, disable and clear the postcode field
            postcodeInput.value = '';  // Clear the value
            postcodeInput.disabled = true;  // Disable the field
        } else {
            // If "I serve customers within" is selected, enable the postcode field
            postcodeInput.disabled = false;
        }
    }

    // Attach the togglePostcodeField function to radio buttons change event
    document.getElementById('option1').addEventListener('change', togglePostcodeField);
    document.getElementById('option2').addEventListener('change', togglePostcodeField);

    // Next button validation logic
    document.getElementById('next-btn').addEventListener('click', function () {
        var option2Checked = document.getElementById('option2').checked;
        var postcodeValue = document.getElementById('postcode').value;
        var postcodeError = document.getElementById('postcode-error');

        // If "I serve customers within" is selected and postcode is empty, show error
        if (option2Checked && postcodeValue.trim() === '') {
            postcodeError.textContent = 'Please fill in the Post code field.';
        } else {
            // Hide current step and move to next step
            document.getElementById('step-1').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';

            // Clear postcode error message if valid
            postcodeError.style.display = 'none';
        }
    });

    // Run the toggle function on page load to set initial state (optional)
    document.addEventListener('DOMContentLoaded', function () {
        togglePostcodeField();
    });
</script>


<script>
    function toggleWebsiteInput() {
        var hasWebsiteYes = document.getElementById('yes').checked;
        var websiteInput = document.querySelector('input[name="website_link"]');
        var websiteLabel = document.querySelector('label[for="website"]');

        if (hasWebsiteYes) {
            websiteInput.required = true;
            websiteInput.style.display = 'block';
            websiteLabel.style.display = 'block';
        } else {
            websiteInput.required = false;
            websiteInput.value = ''; // Clear input value when hiding
            websiteInput.style.display = 'none';
            websiteLabel.style.display = 'none';
        }
    }

    function toggleSalesAndSocialMediaInputs() {
        var companySize = document.querySelector('input[name="company_size"]:checked').value;
        var salesTeamGroup = document.getElementById('salesTeamGroup');
        var socialMediaGroup = document.getElementById('socialMediaGroup');

        if (companySize === '11–50' || companySize === '51-200' || companySize === '200+') {
            salesTeamGroup.style.display = 'block';
            socialMediaGroup.style.display = 'block';
        } else {
            salesTeamGroup.style.display = 'none';
            socialMediaGroup.style.display = 'none';
        }
    }

    window.onload = function () {
        toggleWebsiteInput();
        toggleSalesAndSocialMediaInputs();
    };
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
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