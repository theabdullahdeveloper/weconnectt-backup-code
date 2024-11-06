@extends('Site.layouts.app')
@section('SiteContent')



<!-- //// Header  /////  -->

<style>
/* HEAder  */



.header-heading {
    margin-top: 12%;
    margin-left: 11%;
    font-size: 44px;
    line-height: 1.2;
    /* font-weight: bold !important; */

    color: #111637;
}

.header-heading-description {
    color: #a5a4a4;
    font-size: 24px;
    margin-left: 11%;
}

.header-row {
    margin-left: -2%;
}

.custom-input-header1 {
    width: 100%;

}

.custom-input-header2 {
    margin-left: -10%;
    width: 100%;

}

.custom-input-header1,
.custom-input-header2 {
    padding: 15px;
    border: solid 1px #a5a4a46c;
    --bs-border-opacity: .5;
}

.custom-input-header1::placeholder,
.custom-input-header2::placeholder {
    color: #a5a4a4;
}

.custom-input-header1:focus,
.custom-input-header2:focus {
    border: none;
    border-bottom: solid 2px #2E7BF1;
    outline: none;
}



.custom-btn-header {
    background-color: #FFDB00;
    color: #2E7BF1;
    border: none;
    margin-left: -40px !important;
    padding: 15px;
    padding-right: 25px;
    padding-left: 25px;
    border-radius: 7px;
    font-weight: bolder;
    transition: all ease 0.3s;
    box-shadow: 0 0 3px #FFDB00;
}

.custom-btn-header:focus {
    border: none;
    /* border-bottom: solid 2px #2E7BF1; */
    outline: none;
    transform: scale(1.01) !important;
}

.custom-btn-header:hover {
    border: none;
    /* border-bottom: solid 2px #2E7BF1; */
    outline: none;
    color: #2E7BF1;
    transform: scale(1.01) !important;
}

.header-tags {
    margin-left: 13%;
    margin-top: 20px;
    color: #a5a4a4;
    font-weight: 500;

    margin-bottom: 12%;
}


@media (max-width: 768px) {
    .custom-btn-header {
        margin-left: 25% !important;
        width: 50%;
        margin-top: 15px;

    }

    .custom-input-header2 {
        display: none;
    }

    .header-heading-description {
        margin-left: 2%;
        /* margin-top: 10%; */
    }

    .header-heading {
        margin-left: 2%;
        margin-top: 35%;
    }

    .header-tags {
        margin-left: -1%;
    }

}

.custom-parent-header {
    font-size: 0.875em;
    font-weight: bold;
    color: #6c757d;
    background-color: #f8f9fa;
}

.item-drp {
    cursor: pointer;
}

.item-drp:hover {
    background-color: #E9ECEF;
}


#text-anim div {
    display: inline-block;
}
</style>
<div class="header m-4">
    <h2 class="header-heading">
        <span id="text-anim">Discover the<br>Ideal professional for you</span>
    </h2>
    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
        animation_text_1("#text-anim");
    });

    function animation_text_1(element) {
        var newText = "";
        var theText = document.querySelector(element);

        for (let i = 0; i < theText.childNodes.length; i++) {
            if (theText.childNodes[i].nodeName === "BR") {
                newText += "<br>";
            } else {
                let innerText = theText.childNodes[i].textContent || theText.childNodes[i].innerText;
                for (let j = 0; j < innerText.length; j++) {
                    newText += "<div>";
                    newText += (innerText[j] == " ") ? "&nbsp;" : innerText[j];
                    newText += "</div>";
                }
            }
        }

        theText.innerHTML = newText;

        // Infinite animation using gsap
        gsap.fromTo(element + " div", {
            opacity: 0,
            y: 90
        }, {
            duration: 2,
            opacity: 1,
            y: 0,
            stagger: 0.03,
            ease: "elastic(1.2, 0.5)",

        });
    }
    </script>
    <p class="header-heading-description" style="color:#0078C9;">Get Quotes From The Professionals</p>
    <div class="header-row">
        <div class="row">
            <div class="input-group inputs d-flex justify-content-center">
                <div class="col-sm-12 col-md-4" style="position: relative;">
                    <input type="text" class="custom-input-header1" id="serviceSearch"
                        placeholder="Which Service Do You Require" autocomplete="off">
                    <ul class="list-group custom-dropdown" id="searchResults"
                        style="position: absolute; z-index: 1000; width: 94%; display: none; max-height: fit-content; overflow-y: auto;">
                    </ul>
                    <small class="text-danger" id="error"></small>
                </div>
                <div class="col-sm-4 col-md-3">
                    <input type="text" class="custom-input-header2" placeholder="Postal Code">
                </div>
                <div class="col-sm-12 col-md-2">
                    <button type="button" class="btn  custom-btn-header" id="getServiceBtn">Get Service</button>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
        $(document).ready(function() {
            var subCategories = @json($sub_categories);
            var searchResults = $('#searchResults');
            var selectedSubCategory = null;

            $('#serviceSearch').on('input', function() {
                var query = $(this).val().toLowerCase();
                searchResults.empty();

                if (query.length > 0) {
                    var matchedSubCategories = subCategories.filter(function(subCategory) {
                        return subCategory.service_sub_category.toLowerCase().includes(query) ||
                            subCategory.service_sub_category_parent.toLowerCase().includes(
                                query);
                    });

                    if (matchedSubCategories.length > 0) {
                        var groupedByParent = matchedSubCategories.reduce(function(result,
                            subCategory) {
                            (result[subCategory.service_sub_category_parent] = result[
                                subCategory.service_sub_category_parent] || []).push(
                                subCategory);
                            return result;
                        }, {});

                        searchResults.show();
                        $.each(groupedByParent, function(parentName, subCategories) {
                            subCategories.forEach(function(subCategory, index) {
                                if (index === 0) {
                                    // Add parent name as a small header before the first subcategory
                                    searchResults.append(
                                        '<li class="list-group-item custom-parent-header">' +
                                        parentName + '</li>');
                                }
                                searchResults.append(
                                    '<li class="list-group-item custom-list-group-item item-drp" data-id="' +
                                    subCategory.id + '">' + subCategory
                                    .service_sub_category + '</li>');
                            });
                        });
                    } else {
                        searchResults.hide();
                    }
                } else {
                    searchResults.hide();
                }
            });

            // Event delegation to handle dynamic elements
            $(document).on('click', '.list-group-item.custom-list-group-item', function() {
                var selectedId = $(this).data('id');
                selectedSubCategory = subCategories.find(function(subCategory) {
                    return subCategory.id == selectedId;
                });
                if (selectedSubCategory) {
                    $('#serviceSearch').val(selectedSubCategory.service_sub_category);
                    searchResults.hide();
                }
            });

            $('#getServiceBtn').on('click', function() {
                // Clear any previous error message
                $('#error').text(''); // Clear any existing error messages

                if (selectedSubCategory) {
                    $('#Modal' + selectedSubCategory.service_sub_category.replace(/\s+/g, '_')).modal(
                        'show');
                } else {
                    // Set error message in the specified paragraph
                    $('#error').text('Please select a service.'); // Display error message
                }
            });

            // Hide search results when clicking outside
            $(document).click(function(event) {
                if (!$(event.target).closest('#serviceSearch').length && !$(event.target).closest(
                        '#searchResults').length) {
                    searchResults.hide();
                }
            });

            // Show search results when the input is focused
            $('#serviceSearch').on('focus', function() {
                if (searchResults.children().length > 0) {
                    searchResults.show();
                }
            });
        });
        </script>


    </div>
</div>
<!-- //// End  Header  /////  -->

<br><br><br>
<!-- Slider -->

<div class="swiper mySwiper mb-4">
    <div class="swiper-wrapper">
        @php
        $counter = 0;
        @endphp

        @foreach($categories as $category)
        @if($category->view_swipper == '1')
        @if($counter % 2 == 0)

        <div class="swiper-slide">
            @else
            <div class="swiper-slide lower-category">
                @endif
                <div class="slider-item">
                    <a href="{{ url('/all/sub-services/' . $category->service_category) }}" style="color:#111637">
                        <div class="content" style="height:300px; width:100%;position:relative;">
                            <img src="{{ $category->service_category_image }}" alt="{{ $category->service_category }}"
                                class="image-zoom" style="width:100%;
                                ">
                            @if($category->available_online == 1)
                            <span class="badge p-2 text-white"
                                style="position:absolute; top:4%; right:4%; font-weight:500 !important; background-color:#4287F2; font-size:14px; border-radius:15px;">Available
                                Online</span>
                            @endif

                        </div>
                        <h5 class="slider-caption mt-2" style="text-align:left;">{{ $category->service_category }}</h5>
                    </a>


                </div>
            </div>

            @php
            $counter++;
            @endphp

            @endif
            @endforeach


        </div>


    </div>
    <!-- End Slider -->

    <br><br><br>


    <!-- Testimonis -->
    <style>
    #testimonial-area {
        /* background-color:#F8F9FA; */
        margin-top: 5%;
    }

    .testi-wrap {
        position: relative;
        height: 725px;
        margin-top: -80px;
    }

    .client-single {
        margin-top: 20px;
        text-align: center;
        position: absolute;
        -webkit-transition: all 1s ease;
        transition: all 1s ease;
    }

    .client-info,
    .client-comment {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    .client-single {
        &.inactive {

            .client-comment,
            .client-info {
                display: none;
            }

            .client-comment,
            .client-info {
                opacity: 0;
                visibility: hidden;
            }
        }

        &.position-1 {
            left: 5%;

            transform: scale(0.7);
        }

        &.position-2 {
            right: 1%;

            transform: scale(0.7);
        }

        &.position-3 {
            left: -5%;
            top: 130px;
            transform: scale(0.6);
        }

        &.position-4 {
            right: -5%;
            top: 130px;
            transform: scale(0.6);
        }

        &.position-5 {
            left: -9%;
            top: 260px;
        }

        &.position-6 {
            right: -9%;
            top: 260px;
        }

        &.position-7 {
            left: -5%;
            top: 390px;
        }

        &.position-8 {
            right: -5%;
            top: 390px;
        }

        &.position-9 {
            left: 5%;
            top: 520px;
            transform: scale(0.5);
        }

        &.position-10 {
            right: 1%;
            top: 520px;
            transform: scale(0.5);
        }


        &.active {
            top: 10%;
            left: 50%;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            z-index: 10;
            width: 70%;

            .client-comment,
            .client-info {
                -webkit-transition-delay: 0.6s;
                transition-delay: 0.6s;
            }
        }

        &:not(.active) {
            -webkit-transform: scale(0.55);
            transform: scale(0.55);
            z-index: 99;
        }

        &.active .client-img {
            width: 160px;
            height: 160px;
            margin: 0 auto 24px;
            position: relative;

            &:before {
                border-radius: 100%;
                content: '';
                background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(157, 91, 254)), to(rgb(56, 144, 254)));
                background-image: linear-gradient(180deg, rgb(157, 91, 254) 0%, rgb(56, 144, 254) 100%);
                padding: 5px;
                width: 160px;
                height: 160px;
                top: -4px;
                left: 0px;
                position: absolute;
                z-index: -1;
            }
        }

        .client-img img {
            width: 150px;
            border-radius: 50%;
            border: 8px solid #d1e9ff;
            cursor: pointer;
        }

        &.active .client-img img {
            max-width: 160px;
            margin: 0 auto 24px;
            border: 0;
        }
    }

    .client-comment {
        padding: 0 30px;

        h3 {
            font-size: 22px;
            line-height: 32px;
            color: #505b6d;
        }

        span i {
            font-size: 60px;
            color: #0078C9;
            margin: 40px 0 24px;
            display: inline-block;
        }
    }

    .client-info {
        h3 {
            color: #111637;
            font-weight: 600;
            margin-bottom: 4px;
        }

        p {
            color: #0078C9;
            text-transform: uppercase;
        }
    }

    /* Responsive Adjustments for Different Screen Sizes */



    @media (max-width: 768px) {




        .client-comment h3 {
            font-size: 18px;
            line-height: 28px;
        }
    }

    @media (max-width: 480px) {


        .client-single:not(.active) {
            transform: scale(0.25);
        }

        .client-comment h3 {
            font-size: 14px;
            line-height: 26px;
        }

        .client-info h3 {
            font-size: 16px;
        }

        .client-info p {
            font-size: 12px;
        }

        .client-img img {
            width: 80px;
        }


    }
    </style>
    <center>
        <h1>
            <strong>Testimonials</strong>
        </h1>
    </center>
    <section id="testimonial-area">

        <div class="container">

            <div class="testi-wrap">
                @foreach($Testimonials as $key => $Testimonial)
                <div class="client-single {{ $key === 0 ? 'active' : 'inactive' }} position-{{ $key + 1 }}"
                    data-position="position-{{ $key + 1 }}">
                    <div class="client-img">
                        <img src="{{ asset('Testimonials/pictures/' . $Testimonial->picture) }}"
                            alt="{{ $Testimonial->name }}" style="object-fit:cover;">
                    </div>
                    <div class="client-comment">
                        <h3>{{ $Testimonial->review }}</h3>
                        <span><i class="fa fa-quote-left"></i></span>
                    </div>
                    <div class="client-info">
                        <h3>{{ $Testimonial->name }}</h3>
                        <p>{{ $Testimonial->profession }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
    $(document).ready(function() {

        $('.client-single').on('click', function(event) {
            event.preventDefault();

            var active = $(this).hasClass('active');

            var parent = $(this).parents('.testi-wrap');

            if (!active) {
                var activeBlock = parent.find('.client-single.active');

                var currentPos = $(this).attr('data-position');

                var newPos = activeBlock.attr('data-position');

                activeBlock.removeClass('active').removeClass(newPos).addClass('inactive').addClass(
                    currentPos);
                activeBlock.attr('data-position', currentPos);

                $(this).addClass('active').removeClass('inactive').removeClass(currentPos).addClass(
                    newPos);
                $(this).attr('data-position', newPos);

            }
        });

    }(jQuery));
    </script>



    <!-- End Testimonis  -->




    <!-- Link Icons -->

    <div class="link-icons-section container">
        <center>
            <h1 class="icon-heading">
                <strong>Explore</strong>
            </h1>
        </center>
        <div class="container">
            <div class="row">
                @foreach($categories->reverse() as $i_category)
                @if($i_category->view_icon_line == 1)
                <div class="col-6 col-sm-4 col-md-2 icon_sec">
                    <center class="icon-tag"
                        onmouseover="this.querySelector('.icon-section i').style.backgroundColor='{{ $i_category->icon_color }}'; this.querySelector('.icon-section i').style.color='#ffffff'; this.querySelector('.icon-section i').style.boxShadow='0 0 5px 1px {{ $i_category->icon_color }}'; this.querySelector('.icon-section i').style.outline='none'; this.querySelector('.icon-section i').style.border='none'; this.querySelector('.icon-section i').style.border='none';this.querySelector('.icon-caption').style.textDecoration='underline {{ $i_category->icon_color }}';"
                        onmouseout="this.querySelector('.icon-section i').style.backgroundColor='#FFFFFF'; this.querySelector('.icon-section i').style.color='{{ $i_category->icon_color }}'; this.querySelector('.icon-section i').style.textDecoration='none'; this.querySelector('.icon-section i').style.boxShadow='none'; this.querySelector('.icon-section i').style.border='solid 1px #dbdbdb'; this.querySelector('.icon-caption').style.textDecoration='none';">
                        <a href="{{ url('/all/sub-services/' .  $i_category->service_category ) }}"
                            style="text-decoration: none;">
                            <div class="justify-content-center icon-section mt-4">
                                <i class="{{ $i_category->icon_class }}" style="color: {{ $i_category->icon_color }}; font-size: 20px; border: solid 1px #dbdbdb;  padding-left: 18px;
                                padding-right: 18px;
                                padding-top: 15px;
                                padding-bottom: 15px;; border-radius: 15px;"></i>
                            </div>
                            <div class="text-center mt-4">
                                <br>
                                <h5 class="icon-caption" style="color: #111637; font-size: 16px;">{{
                                    $i_category->service_category }}</h5>
                            </div>
                        </a>
                    </center>

                </div>
                @endif
                @endforeach



                <div class="col-6 col-sm-4 col-md-2 icon_sec">
                    <center class="icon-tag6">
                        <a href="{{ url('/all/services') }}">
                            <div class="justify-content-center icon6 mt-4">
                                <i class="bi bi-three-dots"></i>
                            </div>
                            <div class="text-center mt-4">
                                <br>
                                <h5 class="icon6-caption">Other <br> Services</h5>
                            </div>
                        </a>
                    </center>
                </div>




            </div>
        </div>

    </div>

    <!-- End Icons -->


    <!-- Clients  -->




    <br><br><br>
    <br>

    <!-- End Clients  -->












    <!-- SUB CATEGORY  -->
    @foreach($sub_categories->groupBy('service_sub_category_parent') as $parentName => $subCategories)
    @if($subCategories->contains('sub_category_view_index_page', 1))
    <div class="container-fluid col-11 category" style="margin:auto !important;">
        <br>
        <br>
        <br>
        <br>
        <div class="row p-2">
            <div class="col-md-6">
                <h2 class="category-heading"><strong>{{ $parentName }}</strong></h2>
            </div>
            <div class="col-md-6 text-md-end d-flex justify-content-end mt-3">
                <h5><a href="{{ url('/all/sub-services/' .  $parentName ) }}" class="view-btn ">View All</a></h5>
            </div>
        </div>

        <div class="row p-2  category-cards">
            @foreach($subCategories as $subCategory)
            <div class="container col-md-4 col-12 mt-2">
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
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <button type="button" class="close ml-auto mr-4 mt-4" data-dismiss="modal"
                                aria-label="Close">
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
                                            <button class="btn btn-primary nextBtn ml-auto"
                                                type="button">Continue</button>
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
                                                <input class="step-check-input" type="radio"
                                                    name="user_answer_about_credit"
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
                                            <input type="text" class="custom-input-header1" name="otp_code"
                                                id="otp_code" required placeholder="OTP Code">
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
                                            <input type="hidden" name="email_verified" id="hidden_email_verified"
                                                value="">
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
                                                <input type="password"
                                                    class="custom-input-header1 input-req mt-2 password" id="password"
                                                    name="password" placeholder="Password" autocomplete="off" required>
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
                                                    id="confirmPassword" placeholder="Confirm Password"
                                                    autocomplete="off" required>
                                            </div>

                                            <div class="small text-danger error-message" id="errorMessage"></div>

                                            <div class="d-flex mt-4">
                                                <button class="btn btn-primary ml-auto accountSubmitBtn"
                                                    id="submitButton" type="button">Submit</button>
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
    @endif
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
    <br>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var modals = document.querySelectorAll('.modal');
        var previousModal = null;

        modals.forEach(function(modal) {
            var currentStep = 0;
            var steps = modal.querySelectorAll('.step');
            var prevBtns = modal.querySelectorAll('.prevBtn');
            var nextBtns = modal.querySelectorAll('.nextBtn');
            showStep(currentStep);
            prevBtns.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    navigate(-1);
                });
            });
            nextBtns.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    var radioButtons = steps[currentStep].querySelectorAll(
                        'input[type="radio"]');
                    var errorDiv = steps[currentStep].querySelector('.requireError');

                    if (radioButtons.length >
                        0
                    ) {
                        var selected = Array.from(radioButtons).some(function(radio) {
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
                    steps.forEach(function(step, index) {
                        if (index === stepIndex) {
                            step.style.display = "block";
                        } else {
                            step.style.display = "none";
                        }
                    });
                }
            }
            var modalCloseButtons = modal.querySelectorAll('[data-dismiss="modal"]');
            modalCloseButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    previousModal = modal;
                    $('#confirmationModal').modal('show');
                });
            });
        });
        var confirmCancelBtn = document.getElementById('confirmCancel');
        var noButton = document.querySelector('#confirmationModal .modal-footer .no_btn');
        confirmCancelBtn.addEventListener('click', function() {
            $('#confirmationModal').modal('hide');
            location.reload();
        });
        noButton.addEventListener('click', function() {
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
        emailInput.addEventListener('input', function() {
            clearError(emailInput);
            validateEmail();
        });
        postcodeInput.addEventListener('input', function() {
            clearError(postcodeInput);
            if (postcodeInput.value !== "") {
                clearError(postcodeInput);
            }
        });
        cityInput.addEventListener('input', function() {
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
            success: function(response) {
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
            error: function() {
                Swal.fire('Error', 'There was an error checking the email.', 'error');
                checkEmailButton.prop("disabled", false).text("Continue");
            },
            complete: function() {
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
            success: function(response) {
                if (response.status === 'success') {

                } else {
                    Swal.fire('Error', 'There was an error sending the OTP.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Unable to send OTP at this moment.', 'error');
            }
        });
    }
    $('#verifyOtpButton').on('click', function() {
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
            success: function(response) {
                if (response.status === 'success') {
                    $('#hidden_email_verified').val(1);
                    $('.account_creation_step').show();
                    $('.otp_step').hide();
                } else {
                    $('#otpErrorMessage').text('Invalid OTP. Please try again.');
                }
            },
            error: function() {
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

        // Validate password strength
        if (!validatePassword(password)) {
            errorMessage =
                'Password must be at least 8 characters, contain a capital letter, a small letter, a number, and a special character.';
        }

        // Check if passwords match
        if (password !== confirmPassword) {
            errorMessage = 'Passwords do not match.';
        }

        $('#errorMessage').text(errorMessage);
        return !errorMessage;
    }

    function submitRegistrationForm() {
        $('#errorMessage').text(''); // Clear previous error messages

        // Check if passwords match before submitting
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
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.reload();
                    });
                    accSubmitButton.prop("disabled", false).text("Submit");
                    $form.trigger('reset');
                } else if (response.status === 'error') {
                    Swal.fire('Error', response.message, 'error');
                    accSubmitButton.prop("disabled", false).text("Submit");
                }
            },
            error: function(xhr) {
                var errorMessage = xhr.responseJSON?.message ||
                    'There was an error processing your request. Please try again later.';
                Swal.fire('Error', errorMessage, 'error');
                accSubmitButton.prop("disabled", false).text("Submit");
            },
            complete: function() {
                accSubmitButton.prop("disabled", false).text("Submit");
            }
        });
    }

    // Real-time validation for password strength
    $('#password').on('input', function() {
        displayPasswordStrengthMessage();
        checkPasswordMatch();
    });

    // Real-time validation for password match
    $('#confirmPassword').on('input', checkPasswordMatch);

    // Submit form handler
    $('#submitButton').on('click', function() {
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
        postTimeInputs.forEach(function(input) {
            input.value = currentDate + " " + currentTime;
        });
    }
    setInterval(updateTime, 1000);
    </script>


    <!-- /SUB CATEGORY  -->



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    @endsection
    @section('Sitefooter')
    @include('Site.layouts.footer')
    @endsection