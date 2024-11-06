@extends('Admin.layouts.app')
@section('AdminContent')

<div class="content mt-4">

    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Manage Service Category View In Index Page</h4>

                </div>
                <div class="card-body p-2">
                    <form class="needs-validation" novalidate action="{{ route('store.manage.category') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mt-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Category Name</label>
                                @foreach($m_service_category as $m_category)
                                <input type="text" class="form-control" value="{{ $m_category->service_category }}"
                                    name="service_category" readonly>
                                @endforeach
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="">You want to view this category in swipper
                                    section?</label>
                                <select class="form-select" id="" autocomplete="off" name="view_swipper">
                                    <option value="" disabled selected>Select Option</option>
                                    <option value="1" {{ $m_category->view_swipper == '1' ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0" {{ $m_category->view_swipper == '0' ? 'selected' : '' }}>No
                                    </option>

                                </select>

                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="categoryView">You want to view this category in category
                                    icons section?</label>
                                <select class="form-select" id="categoryView" autocomplete="off" name="view_icon_line">
                                    <option value="" selected disabled>Select Option</option>
                                    <option value="1" {{ $m_category->view_icon_line == '1' ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0" {{ $m_category->view_icon_line == '0' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label d-flex align-items-center">Icon Color Scheme
                                    <i class="bi bi-question-circle ms-auto" data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Please only use Hex Codes, such as '#ffffff' for white."></i>
                                </label>


                                <input type="color" class="form-control" value="{{ $m_category->icon_color }}" name="icon_color" placeholder="#ffffff"
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>

                            </div>
                            





                            <div id="iconClassInput" class="col-md-4">

                                <label class="form-label" for="validationCustom01">Icon</label>
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        value="{{ str_replace('bi bi-', '', $m_category->icon_class) }}"
                                        name="icon_class" id="validationCustom01" placeholder="Enter Icon Class"
                                        autocomplete="off" required>
                                    <button class="float-end btn btn-success btn-sm ms-1" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        Append List &nbsp; &nbsp; <i class="bi bi-arrow-down-circle-fill"></i>
                                    </button>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>
                        </div>






                        <div class=" mb-1 float-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>

                    </form>


                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">

                                    <h4 class="header-title p-1">Icons List</h4>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="collapse show" id="collapseExample">

                                <div class="row">
                                    <div class="col">


                                        <div class="row icons-list-demo" id="bootstrap-icons"></div>

                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div> <!-- content -->
        <script>
    // Select the elements
    const categoryViewSelect = document.getElementById('categoryView');
    const iconColorInput = document.querySelector('input[name="icon_color"]');

    // Function to update input field based on dropdown selection
    function updateIconColorInput() {
        if (categoryViewSelect.value === '1') { // If "Yes" is selected
            iconColorInput.disabled = false; // Enable the input field
            iconColorInput.required = true; // Make it required
        } else { // If "No" is selected
            iconColorInput.value = ''; // Empty the value
            iconColorInput.disabled = true; // Disable the input field
            iconColorInput.required = false; // Make it not required
        }
    }

    // Call the function on page load
    updateIconColorInput();

    // Add event listener to the select dropdown
    categoryViewSelect.addEventListener('change', updateIconColorInput);
</script>


        @endsection