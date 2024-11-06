@extends('Users.GetService.layouts.app')
@section('GetServiceUserContent')
@foreach($users as $user)
@if($user->role == 'GetService')
@if($user->email_verified == '1')
<style>
.main-gs {
    min-height: 100vh;
    background-color: #F9F9FA;
    padding-top: 8%;
    padding-bottom: 8%;
    color: #111637;
}

@media only screen and (max-width: 767px) {
    .main-gs {
        padding-top: 25%;
    }
}

.custom-input-header1,
.custom-input-header2 {
    padding: 15px;
    border: solid 1px #a5a4a46c;
    --bs-border-opacity: .5;
    width: 100%;
}

.custom-input-header1:focus,
.custom-input-header2:focus {
    border: none;
    border-bottom: solid 2px #2E7BF1;
    outline: none;
}

.btn-password {
    text-decoration: none !important;
    background-color: #d8e5fc62;
    color: #2D7AF1;
    padding: 7px 15px;
}


.btn-password:hover {
    background-color: #D5E4FC;
    color: #2D7AF1;
}

.password-view {
    text-decoration: none;
    color: #979696b2;
    cursor: pointer;
}
</style>

<div class="main-gs">

    <div class="container">
        <div class="card col-md-8 col-sm-12 p-4 mb-4">
            <div class="d-flex justify-content-between">
                <h5>My Details</h5>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#viewRequestModal">Edit <i
                        class="bi bi-pencil"></i> </a>
            </div>
            <div class="card-body user-card" id="user-card">
                @if($user->profile_image)
                <img src="/{{$user->profile_image}}" alt="User Image" class="rounded-full "
                    style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;" />
                @else
                @php

                $initial = strtoupper(substr($user->name, 0, 1));
                @endphp
                <div class="rounded-circle d-flex justify-content-center align-items-center mt-2"
                    style="margin-left:20px;width: 100px; height: 100px; background-color: #455AC7; color: white; font-weight: bolder; font-size:32px;">
                    {{ $initial }}
                </div>
                @endif
                <div class=" mt-4">
                    <label for="name">Name</label> <br>
                    <input type="text" name="ss" id="name" class="custom-input-header1 py-2" disabled
                        value="{{ $user->name }}">
                </div>
                <div class=" mt-4">
                    <label for="phone">Phone Number</label> <br>
                    <input type="tel" name="phone_number" id="phone" class="custom-input-header1 py-2" disabled
                        value="{{ $user->phone_number }}">
                </div>
                <div class=" mt-4">
                    <label for="email">Email &nbsp;&nbsp;<small class="text-warning">Cannot be changed</small></label>
                    <br>
                    <input type="text" name="email" id="email" class="custom-input-header1 py-2" disabled
                        value="{{ $user->email }}">
                </div>

            </div>
        </div>

        <!-- MODAL Profile Edit -->
        <div class="modal fade" id="viewRequestModal" tabindex="-1" role="dialog"
            aria-labelledby="viewRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="px-4 mt-4">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('get.service.user.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class=" mt-4">
                                <label for="file">Profile Image</label> <br>
                                <input type="file" name="profile_image" id="file" class="custom-input-header1 py-2">
                            </div>
                            <div class=" mt-4">
                                <label for="name">Name</label> <br>
                                <input type="text" name="name" id="name" class="custom-input-header1 py-2"
                                    value="{{ $user->name }}">
                            </div>
                            <div class=" mt-4">
                                <label for="phone">Phone Number</label> <br>
                                <input type="tel" name="phone_number" id="phone" class="custom-input-header1 py-2"
                                    value="{{ $user->phone_number }}">
                            </div>

                            <div class=" mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-small">Save Changes</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card col-md-8 col-sm-12 p-4 mt-4">
            <div class="d-flex justify-content-between px-4">
                <h5>Password</h5>
            </div>
            <div class="card-body">
                <button class="btn-password border-0" data-toggle="modal" data-target="#passwordModal">Change
                    Password</button>
            </div>
        </div>

        <!-- MODAL Password change Edit -->
        <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="px-4 mt-4">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('get.service.password.update') }}" method="POST">
                            @csrf

                            <input type="hidden" name="id" value="{{ $user->id }}">


                            <div class=" mt-4">
                                <div class="d-flex ">
                                    <div class="col-6"><label for="current">Current Password</label> </div>
                                    <div class="col-6 d-flex justify-content-end"></div>
                                </div>
                                <input type="password" name="current_password" id="current"
                                    class="custom-input-header1 py-2">
                            </div>

                            <div class=" mt-4">
                                <div class="d-flex ">
                                    <div class="col-6"><label for="new">New Password</label> </div>
                                    <div class="col-6 d-flex justify-content-end"><a href="javascript:void(0)"
                                            class="password-view" id="viewNew"> View</a></div>
                                </div>
                                <input type="password" name="new_password" id="new" class="custom-input-header1 py-2">
                            </div>

                            <div class=" mt-4">
                                <div class="d-flex ">
                                    <div class="col-6"><label for="Confirm">Confirm New Password</label> </div>
                                    <div class="col-6 d-flex justify-content-end"><a href="javascript:void(0)"
                                            class="password-view" id="viewConfirm"> View</a></div>
                                </div>
                                <input type="password" id="Confirm" class="custom-input-header1 py-2">
                            </div>
                            <small id="errorDiv" class="text-danger "></small>

                            <div class=" mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-small" id="changeBtn" disabled>Change
                                    Password</button>
                            </div>

                        </form>

                        <script>
                        const newPassword = document.getElementById('new');
                        const confirmPassword = document.getElementById('Confirm');
                        const changeButton = document.getElementById('changeBtn');
                        const errorDiv = document.getElementById('errorDiv');
                        const viewNew = document.getElementById('viewNew');
                        const viewConfirm = document.getElementById('viewConfirm');

                        // Function to toggle password visibility
                        function togglePasswordVisibility(inputField, viewLink) {
                            const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                            inputField.setAttribute('type', type);
                            viewLink.textContent = type === 'password' ? 'View' : 'Hide';
                        }

                        viewNew.addEventListener('click', function() {
                            togglePasswordVisibility(newPassword, viewNew);
                        });

                        viewConfirm.addEventListener('click', function() {
                            togglePasswordVisibility(confirmPassword, viewConfirm);
                        });

                        // Function to validate new password strength
                        function validatePasswordStrength(password) {
                            const regexUpperCase = /[A-Z]/;
                            const regexLowerCase = /[a-z]/;
                            const regexDigit = /[0-9]/;
                            const regexSpecialChar = /[!@#$%^&*(),.?":{}|<>]/;

                            let errorMessages = [];

                            if (password.length < 8) {
                                errorMessages.push("Password should be at least 8 characters long.");
                            }
                            if (!regexUpperCase.test(password)) {
                                errorMessages.push("Password should contain at least one uppercase letter.");
                            }
                            if (!regexLowerCase.test(password)) {
                                errorMessages.push("Password should contain at least one lowercase letter.");
                            }
                            if (!regexDigit.test(password)) {
                                errorMessages.push("Password should contain at least one digit.");
                            }
                            if (!regexSpecialChar.test(password)) {
                                errorMessages.push("Password should contain at least one special character.");
                            }

                            return errorMessages.join(" ");
                        }

                        // Function to handle input and validate passwords
                        function handlePasswordInput() {
                            const newPasswordValue = newPassword.value;
                            const confirmPasswordValue = confirmPassword.value;

                            const passwordError = validatePasswordStrength(newPasswordValue);

                            if (passwordError) {
                                errorDiv.textContent = passwordError;
                                changeButton.disabled = true;
                                return;
                            }

                            if (newPasswordValue !== confirmPasswordValue) {
                                errorDiv.textContent = "Password and confirm password fields do not match.";
                                changeButton.disabled = true;
                                return;
                            }

                            errorDiv.textContent = "";
                            changeButton.disabled = false;
                        }

                        // Listen for input changes in the password fields
                        newPassword.addEventListener('input', handlePasswordInput);
                        confirmPassword.addEventListener('input', handlePasswordInput);
                        </script>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Function to fetch and update user data
function fetchUserData() {
    $.ajax({
        url: '/fetch-users', // Replace this with the endpoint that fetches user data
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Clear existing content
            $('#user-card').empty();

            // Iterate through the received data and populate the container
            $.each(data, function(index, user) {
                var html = `
                        <img src="${user.profile_image}" alt="User Avatar" class="rounded-full" style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;" />
                        <div class="mt-4">
                            <label for="name">Name</label><br>
                            <input type="text" name="ss" id="name" class="custom-input-header1 py-2" disabled value="${user.name}">
                        </div>
                        <div class="mt-4">
                            <label for="phone">Phone Number</label><br>
                            <input type="tel" name="phone_number" id="phone" class="custom-input-header1 py-2" disabled value="${user.phone_number}">
                        </div>
                        <div class="mt-4">
                            <label for="email">Email</label><br>
                            <input type="text" name="email" id="email" class="custom-input-header1 py-2" disabled value="${user.email}">
                        </div>
                    `;
                $('#user-card').append(html);
            });
        }
    });
}

// Fetch user data initially and then set interval to periodically update
$(document).ready(function() {
    fetchUserData();
    setInterval(fetchUserData, 5000); // Update every 5 seconds (adjust as needed)
});
</script>

@else
<br><br><br><br><br><br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-body">
                <h3 class="card-title">Verify Your Email Address</h3>
                <p class="card-text">To complete your registration, we need to verify your email address. Please click
                    the button below to receive the verification email.</p>
                @if (session('existserror'))
                <small class="text-danger">
                    {!! session('existserror') !!}
                    <a href="#" onclick="document.getElementById('resend-form').submit();"
                        style="font-weight:bold;text-decoration:underline;">
                        Resend Email
                    </a>
                    <form id="resend-form" action="{{ route('resend.verify.email') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                    </form>
                </small>
                @endif
                <form action="{{ route('send.verify.email') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <br>
                    <center><button type="submit" class="btn btn-success">Send Email</button></center>
                </form>
            </div>
        </div>
    </div>
</div>
@endif


@else
@endif
@endforeach
@endsection