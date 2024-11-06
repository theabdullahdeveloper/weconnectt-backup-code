@extends('Admin.layouts.app')
@section('AdminContent')

<div class="content mt-4">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="header-title">Service Categories</h4>
                        </div>
                        <div class="col-sm-6 float-end">
                            <h3 class="header-title float-end">Total : {{ $service_categories_count }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="alternative-page-datatable" class="table  dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Service Category Name</th>
                                <th>Status</th>
                                <th>Available Online</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $serialNumber = 1;
                            @endphp
                            @foreach($service_categories as $category)
                            <tr>


                                <td>{{ $serialNumber }}</td>
                                <td>{{ $category->service_category }}</td>
                                <td>
    <span class="badge {{ $category->service_category_status == 'Active' ? 'bg-success' : 'bg-danger' }}-subtle text-{{ $category->service_category_status == 'Active' ? 'success' : 'danger' }}">
        {{ $category->service_category_status }}
    </span>
</td>
<td>
    <span class="badge {{ $category->available_online == 1 ? 'bg-success' : 'bg-danger' }}-subtle text-{{ $category->available_online == 1 ? 'success' : 'danger' }}">
        {{ $category->available_online == 1 ? 'Yes' : 'No' }}
    </span>
</td>

                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <!-- Manage -->
                                    <a class="badge bg-warning p-1"
                                        href="{{ url('/admin/manage/service/category/' . $category->service_category) }}"
                                        style="margin-right:5px; cursor:pointer;" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-custom-class="warning-tooltip" title="Manage">
                                        <i class="bi bi-back"></i>
                                    </a>

                                    <!-- Edit  -->
                                    <a class="badge bg-success p-1"
                                        href="{{ url('/admin/edit/service/category/' . $category->service_category) }}"
                                        style="margin-right:5px; cursor:pointer;" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-custom-class="success-tooltip"
                                        data-bs-title="Edit"><i class="bi bi-pencil-square"></i></a>

                                    <!-- View  -->
                                    <a href="{{ url('/admin/view/service/category/' .  $category->service_category) }}"
                                        class="badge bg-purple p-1" style="margin-right:5px; cursor:pointer;"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="purple-tooltip" data-bs-title="View"><i
                                            class="bi bi-eye-fill"></i></a>

                                    <!-- Delete  -->
                                    <a class="badge bg-danger p-1 deleteButton" style="cursor: pointer;"
                                        data-bs-toggle="modal" data-bs-target="#confirmationModal"
                                        data-category="{{ $category->service_category }}"
                                        data-delete-url="{{ url('/admin/delete/service/category/' . $category->service_category) }}">
                                        <i class="bi bi-trash-fill" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="danger-tooltip" data-bs-title="Delete"></i>
                                    </a>
                                </td>
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
                <b style="font-size:1rem;">Are you sure you want to delete the <span id="categoryNameToDelete"></span> category and all its linked subcategories? This action will delete all associated data.</b>



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