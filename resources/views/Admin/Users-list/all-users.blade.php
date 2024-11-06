@extends('Admin.layouts.app')
@section('AdminContent')

<div class="content mt-4">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="header-title">Users</h4>
                        </div>
                        <div class="col-sm-6 float-end">
                            <h3 class="header-title float-end">Total : {{ $User_count }} </h3>
                        </div>


                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto">
                    <table id="alternative-page-datatable" class="table  table-responsive nowrap w-100">
                        <thead>
                            <center>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>PFP</th>
                                    <th>Name</th>
                                    <th>Account Type</th>
                                    <th>Service</th>
                                    <th>Email</th>

                                    

                                </tr>
                            </center>
                        </thead>


                        <tbody>
                            @php
                            $serialNumber = 1;
                            @endphp
                            @foreach($User as $Users)
                            <tr>
                                <center>
                                  
                                    <td>{{ $serialNumber }}</td>
                                    <td>
                                        <div style="width:30px;height:30px;border-radius:50%;">
                                        @if($Users->profile_image)
                                        <img style="border-radius:50%;object-fit:cover;"class="img-fluid" src="/{{ $Users->profile_image }}" alt="{{ $Users->name }}">
                                        @else 
                                        <img style="border-radius:50%;object-fit:cover;"class="img-fluid" src="{{ asset('userplaceimage.jpg') }}" alt="{{ $Users->name }}">
                                        @endif 
                                    </div>
                                    </td>
                                    <td>{{ $Users->name }}</td>
                                    <td><span class="bg-primary-subtle badge text-primary">{{ $Users->role }}</span></td>
                                    <td style="word-wrap: break-word; white-space: normal;">{{ $Users->service }}</td>
                                    <td>{{ $Users->email }}</td>


                                </center>
                            </tr>
                            @php
                            $serialNumber++;
                            @endphp
                            @endforeach


                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->

</div> <!-- content -->




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
                <b style="font-size:1rem;">Are you sure you want to delete the <span id="categoryNameToDelete"></span>
                    ?</b>
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


@endsection