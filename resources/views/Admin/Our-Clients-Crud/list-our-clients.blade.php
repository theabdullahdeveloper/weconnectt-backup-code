@extends('Admin.layouts.app')
@section('AdminContent')
<link rel="stylesheet" href="{{ asset('Site/css/styles.css') }}">
 
<div class="content mt-4">
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">List New Client</h4>

                </div>
                <div class="card-body p-2">
                    <form class="needs-validation" novalidate action="{{ route('post.ourclient') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Logo</label>
                            <input type="file" class="form-control" id="validationCustom01"
                                required autocomplete="off" name="logo">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Alt text</label>
                            <input type="text" class="form-control" id="validationCustom01"
                                required autocomplete="off" name="alt">
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
    <!-- Clients  -->
    <div class="content mt-4">
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Our Clients {{$OurClients_count}}  </h4>
    <div class="wrap">

        <ul class="clients">
        @foreach($OurClients as $OurClient)
    <li>
        <img src="{{ asset('Ourclients/logos/' . $OurClient->logo) }}" alt="{{$OurClient->alt}}">
         <!-- Delete  -->
         <a class="badge bg-danger p-1 mx-2 my-auto deleteButton" style="cursor: pointer;"
                                        data-bs-toggle="modal" data-bs-target="#confirmationModal"
                                        data-category="{{ $OurClient->id }}"
                                        data-delete-url="{{ url('/admin/delete/new/our-client/' . $OurClient->id) }}">
                                        <i class="bi bi-trash-fill" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="danger-tooltip" data-bs-title="Delete"></i>
                                    </a>
    </li>
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
@endforeach

        </ul>
    </div>
    </div>    
</div>   
 </div>    
</div>   
 </div>
 <br><br>

@endsection