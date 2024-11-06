@extends('Admin.layouts.app')
@section('AdminContent')
<link rel="stylesheet" href="{{ asset('Site/css/styles.css') }}">
 
<div class="content mt-4">
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Testimonials</h4>

                </div>
                <div class="card-body p-2">
                    <form class="needs-validation" novalidate action="{{ route('post.testimonial') }}" method="POST" enctype="multipart/form-data">
                        @csrf

<div class="row">
    
                        <div class="mb-3 col-md-4">
                            <div class="d-flex justify-content-between">
            <label class="form-label" for="validationCustom01">Testimonial picture</label>
            <i class="bi bi-question-circle" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-custom-class="info-tooltip" title="For a good user interface, please upload a square image"></i>
        </div>
                            <input type="file"  class="form-control @error('picture') is-invalid @enderror" id="validationCustom01"
                                required autocomplete="off" name="picture">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                @error('picture')
                    {{ $message }}
                @else
                    This field is required.
                @enderror
            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="validationCustom01">Name</label>
                            <input type="text" class="form-control" id="validationCustom01"
                                required autocomplete="off" name="name">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="validationCustom01">Profession</label>
                            <input type="text" class="form-control" id="validationCustom01"
                                required autocomplete="off" name="profession">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="validationCustom01">Review</label>
                            <textarea  class="form-control" id="validationCustom01"
                                required autocomplete="off" name="review"></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                        </div>
                        <div class=" mb-1 float-end">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>

                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    <div>

</div>

<!-- content -->

    <div class="content mt-4 mb-4">
    <div class="container ">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">All Testimonials {{$Testimonials_count}}  </h4>

<div class="row justify-content-evenly">
  
        @foreach($Testimonials as $Testimonial)
 

<div class="card col-md-3 p-2">
        <div class="col-md-12 ratio ratio-1x1">
            <img src="{{ asset('Testimonials/pictures/' . $Testimonial->picture) }}" class="card-img-top" style="object-fit:cover;" alt="Testimonial Picture">
        </div>
        <div class="col-md-12 tets pt-2">
            <h3>{{$Testimonial->name}}</h3> <strong><p>{{$Testimonial->profession}}</p>
</strong>

        <p class="description"></p>
        <a href="#" class="read-more-link">Read more</a>
        <span class="more-content" style="display: none;">{{$Testimonial->review}}</span>


                <!-- Delete  -->
                <a class="badge bg-danger p-1 mx-2 my-auto deleteButton" style="cursor: pointer;"
                    data-bs-toggle="modal" data-bs-target="#confirmationModal"
                    data-category="{{ $Testimonial->id }}"
                    data-delete-url="{{ url('/admin/delete/new/testimonial/' . $Testimonial->id) }}">
                    <i class="bi bi-trash-fill" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="danger-tooltip" data-bs-title="Delete"></i>
                </a>
                <!-- Other content here -->
        
        </div>
  
    <!-- Modal -->
   <!-- Modal Delete -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center fw-bold">
                <i class="bi bi-question-octagon-fill text-warning" style="font-size:10rem;"></i>
                <br>
                <b style="font-size:1rem;">Are you sure you want to delete? <span style="display:none;" id="categoryNameToDelete"></span>
                  </b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>

</div>
<script>
    var deleteButtons = document.querySelectorAll('.deleteButton');
    var categoryNameToDelete = document.getElementById('categoryNameToDelete');
    var confirmDeleteButton = document.getElementById('confirmDeleteButton');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var category = this.getAttribute('data-category');
            var deleteUrl = this.getAttribute('data-delete-url');

            categoryNameToDelete.textContent = category;
            confirmDeleteButton.setAttribute('href', deleteUrl);
        });
    });
</script>


</div>
@endforeach
</div>
    </div>
    </div>    
</div>   
 </div>    
</div>   
 </div>
<br><br>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var testimonials = document.querySelectorAll('.tets');

        testimonials.forEach(function(testimonial) {
            var description = testimonial.querySelector('.description');
            var content = description.textContent.trim();
            var words = content.split(' ');

            if (words.length > 10) {
                var truncatedContent = words.slice(0, 10).join(' ');
                description.textContent = truncatedContent + '...';
                var moreContent = testimonial.querySelector('.more-content');
                moreContent.textContent = content;
                var readMoreLink = testimonial.querySelector('.read-more-link');
                readMoreLink.style.display = 'inline';
            }
        });

        var readMoreLinks = document.querySelectorAll('.read-more-link');

        readMoreLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var moreContent = this.nextElementSibling;

                if (moreContent.style.display === 'none' || moreContent.style.display === '') {
                    moreContent.style.display = 'inline';
                    this.textContent = 'Read less';
                } else {
                    moreContent.style.display = 'none';
                    this.textContent = 'Read more';
                }
            });
        });
    });
</script>
@endsection