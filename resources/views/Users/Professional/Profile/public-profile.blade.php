<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="
    @if($user->profile_image)
        /{{ $user->profile_image }}
    @else
        https://ui-avatars.com/api/?name={{ urlencode($user->company_name ?? 'N') }}&background=455AC7&color=fff&size=128&rounded=true
    @endif">
    <title>{{ $user->company_name ?? 'N/A' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-toast-styles/dist/jquery.toast.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-toast-plugin/dist/jquery.toast.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('Site/css/styles.css') }}">
    <link href="{{ asset('Admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<style>
    .about {
        color: #cbcbcd;
        text-decoration: none;
    }

    .about:active {
        color: #1955b7;
        /* Change color to blue when active */
        text-decoration: underline;
    }

    .about:hover {
        color: #1955b7;
        text-decoration: none;
    }

    .reviews:hover {
        color: #1955b7;
        text-decoration: none;
    }

    .reviews {
        color: #cbcbcd;
        text-decoration: none;
    }

    .reviews:active {
        color: #1955b7;
        /* Change color to blue when active */
        text-decoration: underline;
    }

    .rating_circle {
        width: 100px;
        height: 100px;
        border-radius: 70px;
        border: 1px none;
        font-size: 35px;
        color: #111637;
    }

    @media (max-width: 576px) {

        /* Media query for phones */
        .R_text {

            font-size: 16px;
        }

        .rating_circle {
            width: 70px;
            height: 70px;
            font-size: 20px;
        }

    }

    .rating_text {
        margin-top: 38px;
    }



    .dark {
        background-color: #F7BF53;
    }

    .text_sec {
        color: #111637;
    }

    .R_name {
        font-size: medium;
        color: #111637;
        font-weight: 600;
    }

    .R_date {
        font-size: medium;
        color: #979797;
        font-weight: 600;
    }

    .R_texts {
        color: #979797;
        font-weight: 600;
    }

    .badge-service {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 500;
        color: #111637;
        background-color: #F1F3F5;
        border: 1px solid #E0E0E0;
        margin-bottom: 8px;
    }

    .badge-service:hover {
        background-color: #DDE2E7;
        border-color: #B0B7C3;
        color: #111637;
        cursor: default;
    }

    .d-flex.flex-wrap.gap-2>.badge-service {
        margin-right: 8px;
        margin-bottom: 8px;
    }

    .image-container {
        width: 100%;
        max-width: 1000px;
        overflow: hidden;
        margin: auto;
    }

    .image-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .responsive-image {
        object-fit: cover;
        width: 170px;
        height: 170px;
        display: block;
        border-radius: 5px;
    }



    .custom-btn {
        background-color: transparent;
        border-radius: 50%;
        border: 1px solid #111637;
        width: 40px;
        height: 40px;
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
</style>

<body>

    <div class="container p-4">
        <div class="row justify-content-center py-5 ">
            <div class="col-12 col-md-4 P_div">
                <br>
                <div class="" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden;">

                    @if($user->profile_image)
                    <img src="/{{ $user->profile_image }}" alt="{{ $user->name }}"
                        style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                    @php

                    $initial = $user->company_name ? strtoupper(substr($user->company_name, 0, 1)) : 'N/A';
                    @endphp
                    <div class="rounded-circle d-flex justify-content-center align-items-center mt-2"
                        style="width: 100%; height: 100%; background-color: #455AC7; color: white; font-weight: bolder; font-size:32px;">
                        {{ $initial }}
                    </div>
                    @endif
                </div>

                <!-- Company name -->
                <h3 class="text-3xl font-weight-500 mt-4 ">{{ $user->company_name ?? 'N/A'}}</h3>

                <!-- Display stars based on the average rating -->
                <div>
                    @for ($i = 0; $i < floor($average_rating); $i++) <i class="bi bi-star-fill" style="color: #F7BF53;">
                        </i>
                        @endfor

                        @if (fmod($average_rating, 1) > 0)
                        <i class="bi bi-star-half" style="color: #F7BF53;"></i>
                        @endif

                        @for ($i = ceil($average_rating); $i < 5; $i++) <i class="bi bi-star" style="color: #F7BF53;">
                            </i>
                            @endfor
                            ({{ $reviews->count() }})
                </div>

                <!-- Location -->
                <h6 class="mt-2"><i class="bi bi-pin-map-fill"></i> Location:
                    @if($user->postcode ?? 'N/A')<span class="font-weight-bold" style="text-transform: uppercase;">{{
                        $user->postcode ?? 'N/A' }}</span>
                    @else
                    <span class="font-weight-bold">Nationwide</span>
                    @endif
                </h6>

                <!-- Services -->
                @php
                $services = explode(',', $user->service);
                @endphp
                <div class="d-flex flex-wrap gap-2 mt-3">
                    @foreach($services as $service)
                    <span class="badge badge-service">{{ $service }}</span>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-8 mt-4">

                <br>
                <hr style="font-size: 15px; color: #E6E7EC;">
                <br>
                <div style="text-align: left;">
                    <div style="display: flex; align-items: center;">
                        <h5 id="about" class="text-xl font-weight-500">About</h5>
                    </div>

                    @if(!empty($user->about))
                    <p class="text_sec mt-2 ">{!! $user->about !!}</p>
                    @else
                    <p class="text_sec mt-2">[ Not yet about {{ $user->company_name }}. ]</p>
                    @endif

                </div>
                <br><br>

                <div style="text-align: left;">
                    <div>
                        <h5 id="reviews" class="text-xlg font-weight-500">Overview</h5>
                        <br>

                        <div class="form-group mt-2">
                            <input type="file" id="images" name="images[]" class="input-sm text-white" required multiple
                                style="display: none;" onchange="updateFileName()">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="text-xl font-weight-500">Photos ({{ $user_images->count() }})</h5>


                                <!-- Pagination arrows -->
                                <div class="d-flex">
                                    <button type="button" class=" btn-sm custom-btn" id="prev-page"><i
                                            class="bi bi-arrow-left"></i></button>
                                    <button type="button" class="btn-sm custom-btn" id="next-page"
                                        style="margin-left: 10px;"><i class="bi bi-arrow-right"></i></button>

                                </div>
                            </div>
                            <div class="image-container">
                                <div class="image-row" id="imageRow"></div>
                            </div>
                        </div>

                        <script>
                            const images = [
                                @foreach($user_images -> reverse() as $image)
            "{{ asset($image->image_path) }}",
                                @endforeach
                            ];

                            let currentPage = 1;
                            const imagesPerPage = 4;

                            function renderImages() {
                                const imageRow = document.getElementById('imageRow');
                                imageRow.innerHTML = ''; // Clear previous images

                                const start = (currentPage - 1) * imagesPerPage;
                                const end = start + imagesPerPage;
                                const currentImages = images.slice(start, end);

                                currentImages.forEach(src => {
                                    const anchor = document.createElement('a');
                                    anchor.href = src;
                                    anchor.target = '_blank';  // Opens image in a new tab

                                    const img = document.createElement('img');
                                    img.src = src;
                                    img.alt = "Image Description";
                                    img.classList.add('responsive-image');

                                    anchor.appendChild(img);
                                    imageRow.appendChild(anchor);
                                });

                                // Disable prev button on first page and next button on last page
                                document.getElementById('prev-page').disabled = currentPage === 1;
                                document.getElementById('next-page').disabled = currentPage === Math.ceil(images.length / imagesPerPage);
                            }

                            document.getElementById('next-page').addEventListener('click', () => {
                                currentPage++;
                                renderImages();
                            });

                            document.getElementById('prev-page').addEventListener('click', () => {
                                currentPage--;
                                renderImages();
                            });

                            function updateFileName() {
                                const input = document.getElementById('images');
                                const imageRow = document.getElementById('imageRow');

                                // Loop through each selected file
                                Array.from(input.files).forEach(file => {
                                    const reader = new FileReader();

                                    reader.onload = function (e) {
                                        const anchor = document.createElement('a');
                                        anchor.href = e.target.result;
                                        anchor.target = '_blank';  // Opens new uploaded images in a new tab too

                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.alt = file.name;
                                        img.classList.add('responsive-image');

                                        anchor.appendChild(img);
                                        imageRow.prepend(anchor);  // Add new image at the beginning of the list
                                    };

                                    reader.readAsDataURL(file);
                                });
                            }

                            // Initial render
                            renderImages();
                        </script>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mt-5">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-3 col-3">
                                                <h4 class="R_text">Rating</h4>
                                                <br>
                                                <button class="rating_circle" disabled>{{ number_format($average_rating,
                                                    1) }}</button>
                                            </div>
                                            <div class="col-md-7 col-sm-7 col-7  mt-4">
                                                @foreach([5, 4, 3, 2, 1] as $rating)
                                                @php
                                                $percentage = $reviews_count > 0 ? ($rating_distribution[$rating] /
                                                $reviews_count) * 100 : 0;
                                                @endphp
                                                <div class="progress mt-3" style="height:10px">
                                                    <div class="progress-bar dark"
                                                        style="width:{{ $percentage }}%;height:12px">
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>

                                            <div class="col-md-1 col-sm-1 col-1">
                                                <div style="margin-bottom:35px;"></div>
                                                @foreach([5, 4, 3, 2, 1] as $rating)
                                                <div class="row">
                                                    <h6 class="" style="font-size:15px;">{{ $rating }}</h6>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <br> <br>

                        <h5 id="reviews" class="text-xl font-weight-500">Reviews ({{ $reviews_count }})</h5>
                    </div>
                    <br>
                    @foreach($reviews->reverse() as $review)
                    <div class="row mb-4">
                        <div class="col-md-6 col-sm-6 col-6">
                            <span class="R_name">{{ $review->feedbacker_name }}</span>
                            <br>
                            @for ($i = 0; $i < $review->rating; $i++)
                                <i class="bi bi-star-fill" style="color: #F7BF53;"></i>
                                @endfor
                                @for ($i = $review->rating; $i < 5; $i++) <i class="bi bi-star" style="color: #F7BF53;">
                                    </i>
                                    @endfor
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 ml-auto text-right">
                            <span class="R_date">{{ $review->date }}</span>
                        </div>
                        <p class="text_sec mt-2 px-3 R_texts">{{ $review->feedback }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

    @include('Site.layouts.footer')
</body>

</html>