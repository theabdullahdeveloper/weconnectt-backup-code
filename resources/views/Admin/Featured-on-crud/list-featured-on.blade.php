@extends('Admin.layouts.app')
@section('AdminContent')
<link rel="stylesheet" href="{{ asset('Site/css/styles.css') }}">

<div class="content mt-4">
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Featured by</h4>

                </div>
                <div class="card-body p-2">
                    <form class="needs-validation" novalidate action="{{ route('post.featuredbylogo') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Logo</label>
                            <input type="file" class="form-control" id="validationCustom01" required autocomplete="off"
                                name="logo">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Alt text</label>
                            <input type="text" class="form-control" id="validationCustom01" required autocomplete="off"
                                name="alt">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
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

        </div> <!-- content -->
        <!-- featured by  -->
        <div class="content mt-4">
            <div class="container">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="header-title">Featured by {{$FeaturedOn_count}} Companies</h4>
                        </div>
                        <div class="gap-4 card-body d-flex flex-wrap align-items-center">
                            @foreach($FeaturedOn as $Featuredby)
                                <div class=" d-flex flex-column align-items-center m-2">
                                    <img style=" width: 150px;" src="{{ asset('Featuredon/Featuredbylogo/' . $Featuredby->logo) }}" alt="{{$Featuredby->alt}}">
                                    <a class="badge bg-danger p-1 mt-2 deleteButton" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-category="{{ $Featuredby->id }}" data-delete-url="{{ url('/admin/delete/new/featured-on/featured-by/' . $Featuredby->id) }}">
                                        <i class="bi bi-trash-fill" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="danger-tooltip" data-bs-title="Delete"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
        
                    <!-- Modal Delete -->
                    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center fw-bold">
                                    <i class="bi bi-question-octagon-fill text-warning" style="font-size:10rem;"></i>
                                    <br>
                                    <b style="font-size:1rem;">Are you sure you want to delete? <span id="categoryNameToDelete" style="display:none;"> Featured By</span></b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="#" id="confirmDeleteButton" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <script>
                        document.querySelectorAll('.deleteButton').forEach(function(button) {
                            button.addEventListener('click', function() {
                                var category = this.getAttribute('data-category');
                                var deleteUrl = this.getAttribute('data-delete-url');
                                document.getElementById('categoryNameToDelete').textContent = category;
                                document.getElementById('confirmDeleteButton').setAttribute('href', deleteUrl);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        
        <br><br>

        @endsection