@extends('Admin.layouts.app')
@section('AdminContent')

    <div class="content mt-4">
        <div class="container">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Create a Service Category</h4>

                    </div>
                    <div class="card-body p-2">
                        <form class="needs-validation" novalidate action="{{ route('store.category') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Category Name</label>
                                <input type="text" class="form-control" name="service_category" id="validationCustom01" placeholder="Enter Category Name"
                                    required autocomplete="off">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom02">Category Image</label>
                                <input type="file"  class="form-control" name="service_category_image" id="validationCustom02" required autocomplete="off" accept="image/*" >
                                <div class="valid-feedback"  >
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03">Status</label>
                                <select class="form-select" id="validationCustom03" required autocomplete="off" name="service_category_status">
                                <option value="" disabled selected>Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Disabled">Disabled</option>
                            
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
                                <select class="form-select" id="validationCustom04" required autocomplete="off" name="available_online">
                                <option value="" disabled selected>Select Option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                            
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>

                            <div class=" mb-1 float-end">
                                <button class="btn btn-primary" type="submit">Create Category</button>
                            </div>

                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        <div>

    </div> <!-- content -->

@endsection