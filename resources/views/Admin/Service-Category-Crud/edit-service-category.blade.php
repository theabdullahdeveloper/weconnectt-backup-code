@extends('Admin.layouts.app')
@section('AdminContent')

<div class="content mt-4">
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Edit a Service Category</h4>

                </div>
                <div class="card-body p-2">
               
                <form class="needs-validation" novalidate action="{{ route('update.category')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach($e_service_category as $e_category)
                        <input type="hidden" name="id" id="" value="{{ $e_category->id }}">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Category Name</label>
                            <input type="text" class="form-control" value="{{ $e_category->service_category }}"
                                name="service_category" id="validationCustom01" placeholder="Enter Category Name"
                                required autocomplete="off">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label" for="validationCustom02">Select New Category Image</label>
                            <input type="file" class="form-control" name="service_category_image"
                                id="validationCustom02" autocomplete="off" accept="image/*">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="validationCustom03">Status</label>
                            <select class="form-select" id="validationCustom03" required autocomplete="off"
                                name="service_category_status">
                                <option value="" disabled>Select Status</option>
                                <option value="Active" {{ $e_category->service_category_status == 'Active' ? 'selected'
                                    : '' }}>Active</option>
                                <option value="Disabled" {{ $e_category->service_category_status == 'Disabled' ?
                                    'selected' : '' }}>Disabled</option>
                            </select>

                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="validationCustom04">Available Online ( Remotely )</label>
                            <select class="form-select" id="validationCustom04" required autocomplete="off"
                                name="available_online">
                                <option value="" disabled selected>Select Option</option>
                                <option value="1" {{ $e_category->available_online == '1' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="0" {{ $e_category->available_online == '0' ? 'selected' : '' }}>No
                                </option>

                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>

                        <div class=" mb-1 float-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                        @endforeach
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    <div>

</div> <!-- content -->

@endsection