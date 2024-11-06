@extends('Admin.layouts.app')
@section('AdminContent')

<div class="content mt-4">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="header-title">Service Sub-Categories</h4>
                        </div>
                        <div class="col-sm-6 float-end">
                            <h3 class="header-title float-end">Total : {{ $service_sub_categories_count }} </h3>
                        </div>


                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto">
                    <table id="alternative-page-datatable" class="table  table-responsive nowrap w-100">
                        <thead>
                            <center>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Service Sub-Category Name</th>
                                    <th>Parent Category</th>
                                    <th>Status</th>
                                    <th>Available Online</th>
                                    <th>View In Index Page</th>
                                    <th>Action</th>
                                    

                                </tr>
                            </center>
                        </thead>


                        <tbody>
                            @php
                            $serialNumber = 1;
                            @endphp
                            @foreach($service_sub_categories as $sub_category)
                            <tr>
                                <center>
                                    <td>{{ $serialNumber }}</td>
                                    <td>{{ $sub_category->service_sub_category }}</td>
                                    <td>{{ $sub_category->service_sub_category_parent }}</td>
                                    <td>
    <span class="badge {{ $sub_category->service_sub_category_status == 'Active' ? 'bg-success' : 'bg-danger' }}-subtle text-{{ $sub_category->service_sub_category_status == 'Active' ? 'success' : 'danger' }}">
        {{ $sub_category->service_sub_category_status }}
    </span>
</td>
<td>
    <span class="badge {{ $sub_category->sub_category_available_online == 1 ? 'bg-success' : 'bg-danger' }}-subtle text-{{ $sub_category->sub_category_available_online == 1 ? 'success' : 'danger' }}">
        {{ $sub_category->sub_category_available_online == 1 ? 'Yes' : 'No' }}
    </span>
</td>
<td>
    <span class="badge {{ $sub_category->sub_category_view_index_page == 1 ? 'bg-success' : 'bg-danger' }}-subtle text-{{ $sub_category->sub_category_view_index_page == 1 ? 'success' : 'danger' }}">
        {{ $sub_category->sub_category_view_index_page == 1 ? 'Yes' : 'No' }}
    </span>
</td>




                                    <td>

                                        <!-- View  -->
                                        <a href="{{ url('/admin/view/service/sub-category/' .  $sub_category->service_sub_category) }}"
                                            class="badge bg-purple p-1" style="margin-right:5px; cursor:pointer;"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="purple-tooltip" data-bs-title="View"><i
                                                class="bi bi-eye-fill"></i></a>

                                        <!-- Edit  -->
                                        <a id="editButton" class="badge bg-success p-1"
                                            href="{{ url('/admin/edit/service/sub-category/'.  $sub_category->service_sub_category) }}"
                                            style="margin-right:5px; cursor:pointer;" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="success-tooltip"
                                            data-bs-title="Edit">
                                            <i class="bi bi-pencil-square"></i></a>


                                            <a id="editButton" class="badge bg-info p-1"
                                            href="{{ url('/admin/update/service/sub-category/credits/details/'.  $sub_category->service_sub_category) }}"
                                            style="margin-right:5px; cursor:pointer;" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="info-tooltip"
                                            data-bs-title="Edit Credits Details">
                                            <i class="bi bi-pencil-square"></i></a>








                                        <!-- Delete  -->
                                        <a class="badge bg-danger p-1 deleteButton" style="cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#confirmationModal"
                                            data-category="{{ $sub_category->service_sub_category }}"
                                            data-delete-url="{{ url('/admin/delete/service/sub-category/' .  $sub_category->service_sub_category) }}">
                                            <i class="bi bi-trash-fill" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="danger-tooltip" data-bs-title="Delete"></i>
                                        </a>





                                    </td>
                                

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
                <b style="font-size:1rem;">Are you sure you want to delete the <span id="categoryNameToDelete"></span> sub-category along with all its related questions, answers and the sub-category image file?</b>

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