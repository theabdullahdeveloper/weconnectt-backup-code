@extends('Users.Professional.layouts.app')

@section('UserContent')
@foreach($users as $user)
@if($user->role == 'Professional')
@if($user->email_verified == '1')


<style>
    @font-face {
        font-family: 'Gordita';
        src: url('/fonts/Gordita-Medium.ttf');

    }

    /* Navbar  */


    h5 {
        font-family: 'Gordita', sans-serif !important;
        font-weight: 600;
    }

    h6 {
        font-family: 'Gordita', sans-serif !important;
        font-weight: 400;
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

    /* .custom-input-header1:valid{
    border-bottom: solid 2px #269903;
  }
  .custom-input-header1:focus:invalid{
    border-bottom: solid 2px #c20303;
  } */

    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group input {
        flex: 1;
    }

    .input-group .toggle-password {
        cursor: pointer;
        padding: 0 10px;
    }

    .hidden {
        opacity: 0;
        max-height: 0;
        overflow: hidden;
        transition: opacity 1.5s ease, max-height 1.5s ease;
    }

    .visible {
        opacity: 1;
        max-height: fit-content;
        /* Set a large value to allow for dynamic content */
        overflow: visible;
        transition: opacity 1.5s ease, max-height 1.5s ease;
    }


    .image-container {
        width: 100%;
        max-width: 1000px;
        /* Set a max-width for the container */
        overflow: hidden;
        /* Hide overflow */

        margin: auto;
        /* Center the container */
    }

    .image-row {
        display: flex;
        flex-wrap: wrap;
        /* Allow images to wrap to the next line */
        gap: 10px;
        /* Space between images */
    }

    .responsive-image {
        object-fit: cover;
        width: 190px;
        /* Set the width of the images */
        height: 190px;
        /* Set the height of the images */
        display: block;
        border-radius: 5px;
        /* Optional: Rounded corners for images */
    }


    .custom-btn {
        background-color: transparent;
        border-radius: 50%;
        border: 1px solid #111637;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .custom-btn:hover {
        background-color: rgba(200, 200, 200, 0.1);
        border-color: rgba(255, 255, 255);
    }


    .custom-btn:focus {
        background-color: rgba(200, 200, 200, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
        outline: none;
    }






    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        /* Background color */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        /* Ensures it is on top */
    }

    .loader {
        border: 4px solid #f3f3f3;
        /* Light grey */
        border-top: 4px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #main-content {
        display: none;
        /* Content initially hidden hoga */
    }

    .cke_notification_warning {
        display: none !important;
    }
</style>

<!-- My profile -->

<div id="preloader">
    <div class="loader"></div>
</div>

<div class="container p-4 main-content" id="main-content">
    <h2>Settings</h2>
    <br>
    <div class="d-flex align-items-center">
        <span><i class="bi bi-person-fill border rounded" style="font-size: 40px; padding: 4px 8px"></i></span>
        <h5 class="ml-4">My Profile</h5>
    </div>
    <div class="container ml-4 col-md-10">
        <div class="container ml-4">
            <h6><a href="javascript:void(0)" data-toggle="modal" data-target="#mediumModal">My Profile</a></h6>
            <p>
                Your Weconnectt profile should show why customers should choose you.
            </p>
        </div>
        <div class="container ml-4">

            <h6> <a href="javascript:void(0)" id="reviews-link">Reviews</a></h6>
            <p>All your reviews in one place</p>
            <div id="input-container" class="hidden">
                <form method="POST" action="{{ route('professional.send.emails') }}">
                    @csrf
                    <input type="hidden" name="s_email" value="{{ $user->email }}">
                    <label for="r_email" style="color:#7A7F9C;font-weight:500;">Reviewer's Email Address <br>
                        <small>
                            You can also send multiple emails using a comma ' , ' to separate them.
                        </small></label>

                    <div class="form-group d-flex">
                        <input style="color:#7A7F9C;" type="text" id="r_email" name="r_email"
                            class="custom-input-header1 input-sm py-1 flex-grow-1"
                            placeholder="Enter the reviewer's email address for feedback" required>
                        <button type="submit" class="btn btn-primary btn-sm ml-2">Send</button>
                    </div>
                </form>

                <center style="color:#7A7F9C;">OR</center>
                <br>
                <div class="form-group d-flex">
                    <input type="text" style="color:#7A7F9C;"
                        class="custom-input-header1 copy-link-input input-sm py-1 flex-grow-1"
                        value="{{ url('/write/honest/review/for/' . $user->email)}}" id="copy-link-input" readonly>
                    <button type="button" class="btn btn-primary btn-sm ml-2" onclick="copyText()">Copy</button>
                </div>
            </div>

            <script>
                function copyText() {
                    var input = document.getElementById('copy-link-input');
                    input.select();
                    document.execCommand('copy');
                    showSuccessToast('Success!', 'Link copied');
                }

                function showSuccessToast(heading, text) {
                    'use strict';
                    resetToastPosition();
                    $.toast({
                        heading: heading,
                        text: text,
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    });
                }
            </script>

            <script>
                document.getElementById('reviews-link').addEventListener('click', function () {
                    const inputContainer = document.getElementById('input-container');
                    if (inputContainer.classList.contains('hidden')) {
                        inputContainer.classList.remove('hidden');
                        inputContainer.classList.add('visible');
                    } else {
                        inputContainer.classList.remove('visible');
                        inputContainer.classList.add('hidden');
                    }
                });
            </script>


        </div>
















        <div class="container ml-4">
            <h6> <a href="javascript:void(0)" id="photo-link">Photos</a></h6>
            <p>Showcase your work with photos—customers often check past projects or examples.</p>
            <div id="input-container-photo" class="hidden card ">
                <form method="POST" class="p-4" action="{{ route('professional.photo.upload') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_email" value="{{ $user->email }}">

                    <label for="images" style="color:#5A5F7C; font-weight:bold; font-size: 14px;">Portfolio
                        Images</label>
                    <div class="form-group mt-2">
                        <input type="file" id="images" name="images[]" class="input-sm text-white" required multiple
                            style="display: none;" onchange="updateFileName()">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" class="btn btn-primary text-white btn-sm"
                                onclick="document.getElementById('images').click();">
                                Add Photos
                            </button>
                            <div class="d-flex">
                                <button type="button" class=" btn-sm custom-btn" id="prev-page"><i
                                        class="bi bi-arrow-left"></i></button>
                                <button type="button" class="btn-sm custom-btn" id="next-page"
                                    style="margin-left: 10px;"><i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                        <small id="file-names" style="color:#5A5F7C; display: block; margin-top: 5px;"></small>

                        <div class="image-container">
                            <div class="image-row" id="imageRow"></div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-success btn-sm">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal for Image Removal Confirmation -->
            <div class="modal" id="removeImageModal" tabindex="-1" aria-labelledby="removeImageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="removeImageModalLabel">Confirm Removal</h5>
                        </div>
                        <div class="modal-body">

                            <p>Are you sure you want to remove this image from your showcase?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmRemoveButton">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const images = [
                    @foreach($user_images -> reverse() as $image)
            { id: {{ $image-> id }}, path: "{{ asset($image->image_path) }}" },
                @endforeach
        ];

                let currentPage = 1;
                const imagesPerPage = 4;
                let imageToRemove = null; // Variable to store the image that the user wants to remove

                function renderImages() {
                    const imageRow = document.getElementById('imageRow');
                    imageRow.innerHTML = ''; // Clear previous images

                    const start = (currentPage - 1) * imagesPerPage;
                    const end = start + imagesPerPage;
                    const currentImages = images.slice(start, end);

                    currentImages.forEach(image => {
                        const img = document.createElement('img');
                        img.src = image.path; // Assuming 'path' is the correct property
                        img.alt = "Image Description";
                        img.classList.add('responsive-image');
                        img.dataset.id = image.id; // Store the ID in a data attribute for deletion
                        imageRow.appendChild(img);
                    });

                    // Disable prev button on first page and next button on last page
                    document.getElementById('prev-page').disabled = currentPage === 1;
                    document.getElementById('next-page').disabled = currentPage === Math.ceil(images.length / imagesPerPage);

                    // Add click listeners to images
                    addImageClickListeners();
                }

                function addImageClickListeners() {
                    const imageElements = document.querySelectorAll('#imageRow img');

                    imageElements.forEach(img => {
                        img.addEventListener('click', function () {
                            imageToRemove = img; // Store the image element
                            const modal = new bootstrap.Modal(document.getElementById('removeImageModal'));
                            modal.show(); // Show the modal
                        });
                    });
                }

                document.getElementById('next-page').addEventListener('click', () => {
                    currentPage++;
                    renderImages();
                });

                document.getElementById('prev-page').addEventListener('click', () => {
                    currentPage--;
                    renderImages();
                });


                document.getElementById('confirmRemoveButton').addEventListener('click', function () {
                    console.log("Remove button clicked");

                    if (imageToRemove) {
                        const imageId = imageToRemove.dataset.id; // Get the ID from the data attribute
                        console.log("Image ID to remove:", imageId);

                        // Make an AJAX request to delete the image
                        fetch('{{ route("Images_delete") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure to include CSRF token
                            },
                            body: JSON.stringify({ id: imageId }) // Send the image ID to the server
                        })
                            .then(response => {
                                console.log("Response received:", response);
                                if (response.ok) {
                                    // Remove the image element from the DOM
                                    imageRow.removeChild(imageToRemove);
                                    console.log("Image removed from DOM");

                                    // Hide the modal directly
                                    const modalElement = document.getElementById('removeImageModal');
                                    const modal = new bootstrap.Modal(modalElement); // Create a new modal instance
                                    modal.hide(); // Hide the modal
                                    console.log("Modal hidden");

                                    // Refresh the page to see the updated content
                                    location.reload(); // Reload the current page
                                } else {
                                    alert('Failed to remove the image. Please try again.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred. Please try again.');
                            });
                    } else {
                        console.log("No image to remove");
                        // Hide the modal if there's no image to remove
                        const modalElement = document.getElementById('removeImageModal');
                        const modal = new bootstrap.Modal(modalElement); // Create a new modal instance
                        modal.hide(); // Hide the modal
                        console.log("Modal hidden");
                    }
                });






                function updateFileName() {
                    const input = document.getElementById('images');
                    const imageRow = document.getElementById('imageRow');

                    // Loop through each selected file
                    Array.from(input.files).forEach(file => {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = file.name;
                            img.classList.add('responsive-image');
                            imageRow.prepend(img);
                        };

                        reader.readAsDataURL(file);
                    });
                }

                document.getElementById('photo-link').addEventListener('click', function () {
                    const inputContainer = document.getElementById('input-container-photo');
                    if (inputContainer.classList.contains('hidden')) {
                        inputContainer.classList.remove('hidden');
                        inputContainer.classList.add('visible');
                    } else {
                        inputContainer.classList.remove('visible');
                        inputContainer.classList.add('hidden');
                    }
                });

                // Initial render
                renderImages();
            </script>
        </div>

























        <div class="container ml-4 mt-2">
            <h6><a href="javascript:void(0)" data-toggle="modal" data-target="#mediumModal1">Password Update</a></h6>
            <p>You can update your current password</p>
        </div>
    </div>
</div>

<!-- Lead Setting -->
<div class="container p-4">
    <div class="d-flex align-items-center">
        <span><i class="bi bi-bar-chart-fill border rounded" style="font-size: 40px; padding: 4px 8px"></i></span>
        <h5 class="ml-4">Lead Settings</h5>
    </div>
    <div class="container ml-4 col-md-6">
        <div class="container ml-4">
            <h6><a href="javascript:void(0)" data-toggle="modal" data-target="#mediumModal3">My Services</a></h6>
            <p>
                Tell us what services you provide so we can send you the most relevant leads
            </p>
        </div>
        <div class="container ml-4">
            <h6><a href="javascript:void(0)" data-toggle="modal" data-target="#locationModal">My Location</a></h6>
            <p>Tell us what locations you provide your services in</p>
        </div>
    </div>
</div>

<!-- credit & payments -->
<div class="container p-4">
    <div class="d-flex align-items-center">
        <span><i class="bi bi-credit-card-fill border rounded" style="font-size: 40px; padding: 4px 8px"></i></span>
        <h5 class="ml-4">Tokens & Payments</h5>
    </div>
    <div class="container ml-4 col-md-6">
        <div class="container ml-4">
            <h6><a href="{{ url('/professional-dashboard/user/credits/details') }}">Card Payment Details</a></h6>
            <p>
                View card paymnet details & buy tokens to contact more customers
            </p>
        </div>
        <!-- <div class="container ml-4">
      <h6><a href="">Invoices and billing details</a></h6>
      <p>View your invoices and manage your billing details</p>
    </div> -->
        <div class="container ml-4">
            <h6><a href="{{ url('/professional/user/payment/details/get') }}">My Used Tokens Details</a></h6>
            <p>View details of the tokens that have been used for buying user details.</p>
        </div>
    </div>
</div>

<!-- My profile model -->
<div class="modal" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <p class="p-4" type="button" class="btn btn-secondary" data-dismiss="modal"><i
                    class="bi bi-arrow-left-circle-fill"></i> Back</p>

            <div class="modal-body">
                <form action="{{ route('user.professional.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="row">
                        <div class=" col-md-12 mb-4">
                            <label for="file">Profile Image</label> <br>
                            <input type="file" name="profile_image" id="file" class="custom-input-header1 py-2">
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="name">Name</label>

                            <input type="text" id="name" name="name" class="custom-input-header1 py-2"
                                value="{{ $user->name }}" required>

                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="phone_number">Phone Number</label>

                            <input type="text" id="phone_number" name="phone_number" class="custom-input-header1 py-2"
                                value="{{ $user->phone_number }}" required>

                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="editor">About</label>



                            <textarea type="text" name="about" id="editor" class="form-control"
                                required>{!! $user->about !!}</textarea>


                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="website_link">Website Link</label>

                            <input type="text" id="website_link" name="website_link" class="custom-input-header1 py-2"
                                value="{{ $user->website_link }}">

                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="company_name">Company Name</label>

                            <input type="text" id="company_name" name="company_name" class="custom-input-header1 py-2"
                                value="{{ $user->company_name }}" required>

                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="company_size">Company Size</label>

                            <select id="company_size" name="company_size" class="custom-input-header1 py-2">
                                <option value="Self-employed, Sole trader" {{ $user->company_size == 'Self-employed,
                                    Sole trader' ?
                                    'selected' : '' }}>Self-employed, Sole trader</option>
                                <option value="2–10" {{ $user->company_size == '2–10' ? 'selected' : '' }}>2–10</option>
                                <option value="11–50" {{ $user->company_size == '11–50' ? 'selected' : '' }}>11–50
                                </option>
                                <option value="51–200" {{ $user->company_size == '51–200' ? 'selected' : '' }}>51–200
                                </option>
                                <option value="200+" {{ $user->company_size == '200+' ? 'selected' : '' }}>200+</option>
                            </select>


                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
            </div>




            </form>

        </div>
    </div>
</div>

<!-- Password Update  model -->
<div class="modal" id="mediumModal1" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <p class="p-4" type="button" class="btn btn-secondary" data-dismiss="modal"><i
                    class="bi bi-arrow-left-circle-fill"></i> Back</p>

            <div class="modal-body">
                <form id="password-form"
                    action="{{route('professional.settings.update.password', ['id' => $user->id]) }})}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="row">



                        <div class="col-md-12 mb-4">
                            <label for="current_password">Current Password</label>
                            <div class="input-group">
                                <input type="password" id="current_password" name="current_password"
                                    class="custom-input-header1 py-2" required>
                                <span class="toggle-password" data-target="current_password"><i
                                        class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="new_password">New Password</label>
                            <div class="input-group">
                                <input type="password" id="new_password" name="password"
                                    class="custom-input-header1 py-2" required>
                                <span class="toggle-password" data-target="new_password"><i
                                        class="fas fa-eye"></i></span>
                            </div>
                            <div id="password-error" class="error-message"></div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="custom-input-header1 py-2" required>
                                <span class="toggle-password" data-target="confirm_password"><i
                                        class="fas fa-eye"></i></span>
                            </div>
                            <div id="confirm-password-error" class="error-message"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
            </div>




            </form>
        </div>
    </div>
</div>
</div>
<!-- My Services  model -->
<div class="modal border-0" id="mediumModal3" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
    <div class="modal-dialog modal-md border-0" role="document">
        <div class="modal-content border-0">
            <p class="p-4" type="button" class="btn btn-secondary" data-dismiss="modal"><i
                    class="bi bi-arrow-left-circle-fill"></i> Back</p>
            <div class="modal-body border-0">
                <form id="password-form"
                    action="{{ route('professional.settings.update.service', ['id' => $user->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="services" class="form-label">Services</label>

                            <table class="table border-0">
                                <tbody>
                                    @php
                                    // Convert the comma-separated string to an array
                                    $selectedOptions = explode(',', $user->service);
                                    @endphp

                                    @for ($i = 0; $i < count($sub_categories); $i+=2) <tr class="border-0">
                                        <td class="p-2 border-0">
                                            @if (isset($sub_categories[$i]))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="service[]"
                                                    value="{{ $sub_categories[$i]->service_sub_category }}"
                                                    id="service_{{ $sub_categories[$i]->id }}"
                                                    @if(in_array($sub_categories[$i]->service_sub_category,
                                                $selectedOptions)) checked @endif>
                                                <label class="form-check-label"
                                                    for="service_{{ $sub_categories[$i]->id }}">
                                                    {{ $sub_categories[$i]->service_sub_category }}
                                                </label>
                                            </div>
                                            @endif
                                        </td>
                                        <td class="p-2 border-0">
                                            @if (isset($sub_categories[$i+1]))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="service[]"
                                                    value="{{ $sub_categories[$i+1]->service_sub_category }}"
                                                    id="service_{{ $sub_categories[$i+1]->id }}"
                                                    @if(in_array($sub_categories[$i+1]->service_sub_category,
                                                $selectedOptions)) checked @endif>
                                                <label class="form-check-label"
                                                    for="service_{{ $sub_categories[$i+1]->id }}">
                                                    {{ $sub_categories[$i+1]->service_sub_category }}
                                                </label>
                                            </div>
                                            @endif
                                        </td>
                                        </tr>
                                        @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>



<!-- Location Modal  -->


<div class="modal" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <p class="p-4" type="button" class="btn btn-secondary" data-dismiss="modal"><i
                    class="bi bi-arrow-left-circle-fill"></i> Back</p>

            <div class="modal-body">
                <form action="{{ route('professional.location.update', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <input type="radio" class="form-radio" id="option1" name="customer_serve"
                                    value="nationwide" {{ $user->customer_serve === 'nationwide' ? 'checked' : '' }}>
                                <label for="option1" id="label1" class="form-radio-label ml-2">I serve customers
                                    nationwide</label>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <input type="radio" class="form-radio" id="option2" name="customer_serve"
                                    value="postcode" {{ $user->customer_serve === 'postcode' ? 'checked' : '' }}>
                                <label for="option2" id="label2" class="form-radio-label ml-2">I serve customers
                                    within</label>
                            </div>

                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12 col-sm-12">
                                <input type="text" name="postcode" id="postcode"
                                    class="custom-input-header1 py-2 rounded" value="{{ $user->postcode }}"
                                    placeholder="Post code" autocomplete="off">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary ml-auto mr-4">Save changes</button>
                    </div>
                </form>


                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const nationwideRadio = document.getElementById('option1');
                        const postcodeRadio = document.getElementById('option2');
                        const postcodeInput = document.getElementById('postcode');

                        function toggleInputs() {
                            const isNationwide = nationwideRadio.checked;
                            postcodeInput.disabled = isNationwide;

                            if (isNationwide) {
                                postcodeInput.value = '';
                                postcodeInput.disabled = true;
                            }
                        }

                        nationwideRadio.addEventListener('change', toggleInputs);
                        postcodeRadio.addEventListener('change', toggleInputs);

                        // Initialize the inputs state
                        toggleInputs();
                    });
                </script>

            </div>

        </div>




        </form>

    </div>
</div>
</div>
@else
<br><br><br><br><br><br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class=" card col-md-8">
            <div class="card-body">
                <h3 class="card-title">Verify Your Email Address</h3>
                <br>
                <p class="card-text">To complete your registration, we need to verify your email address. Please click
                    the
                    button below to receive the verification email.</p>
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
                    <center><button type="submit" class="btn btn-success ">Send Email</button></center>
                </form>


            </div>
        </div>
    </div>
</div>
@endif


@endif

@endforeach

<script>
    document.querySelectorAll('.toggle-password').forEach(function (element) {
        element.addEventListener('click', function () {
            const target = document.getElementById(this.getAttribute('data-target'));
            const icon = this.querySelector('i');
            if (target.type === 'password') {
                target.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                target.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    document.getElementById('password-form').addEventListener('submit', function (event) {
        // Get the values of the passwords
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        // Regex for a strong password: at least one uppercase letter, one lowercase letter, one number, and one special character, and at least 8 characters long
        const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Clear previous error messages
        document.getElementById('password-error').textContent = '';
        document.getElementById('confirm-password-error').textContent = '';

        let isValid = true;

        // Check if the new password is strong
        if (!strongPasswordRegex.test(newPassword)) {
            document.getElementById('password-error').textContent =
                'Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, a number, and a special character.';
            isValid = false;
        }

        // Check if the passwords match
        if (newPassword !== confirmPassword) {
            document.getElementById('confirm-password-error').textContent = 'Passwords do not match.';
            isValid = false;
        }

        // If the form is not valid, prevent submission
        if (!isValid) {
            event.preventDefault();
        }
    });


    window.addEventListener('load', function () {
        const preloader = document.getElementById('preloader');
        const mainContent = document.getElementById('main-content');

        // Jab page load ho jaaye to preloader hatao aur main content dikhao
        preloader.style.display = 'none';
        mainContent.style.display = 'block';
    });


</script>
<script>
    // Override console.warn to hide the specific CKEditor warning message
    (function () {
        var originalWarn = console.warn;
        console.warn = function (message) {
            // Check if the warning contains the CKEditor version warning
            if (message.includes('CKEditor 4.16.0 version is not secure')) {
                return;  // Skip the warning
            }
            originalWarn.apply(console, arguments);  // Otherwise, show the warning
        };
    })();
</script>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('editor', {
            removeButtons: 'Image,ImageButton'  // This removes the image and image button from the toolbar
        });
    });
</script>
@endsection