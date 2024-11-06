@extends('Admin.layouts.app')
@section('AdminContent')

<div class="content mt-4">
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Update Service Sub-Category</h4>
                </div>
                <div class="card-body p-2">
                    <form class="needs-validation" novalidate action="{{ route('update.sub.category', $subcategory->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="validationCustom01">Sub-Category Name</label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    placeholder="Enter Sub-Category Name" required autocomplete="off"
                                    name="service_sub_category" value="{{ $subcategory->service_sub_category }}">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="validationCustom01">Parent Category</label>
                                <select class="form-select" id="validationCustom01" required autocomplete="off"
                                    name="service_sub_category_parent">
                                    <option value="">Select Parent Category</option>
                                    @foreach($service_categories as $category)
                                    <option value="{{ $category->service_category }}" {{ $subcategory->service_sub_category_parent == $category->service_category ? 'selected' : '' }}>{{ $category->service_category }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="validationCustom02">Sub-Category Image</label>
                                <input type="file" class="form-control" name="service_sub_category_image"
                                    id="validationCustom02" autocomplete="off" accept="image/*">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                                <!-- <img src="{{ asset($subcategory->service_sub_category_image) }}" alt="Current Image" class="img-fluid mt-2"> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="validationCustom01">Status</label>
                                <select class="form-select" id="validationCustom01" required autocomplete="off"
                                    name="service_sub_category_status">
                                    <option value="" disabled>Select Status</option>
                                    <option value="Active" {{ $subcategory->service_sub_category_status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Disabled" {{ $subcategory->service_sub_category_status == 'Disabled' ? 'selected' : '' }}>Disabled</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="validationCustom099">Available Online</label>
                                <select class="form-select" id="validationCustom099" required autocomplete="off"
                                    name="sub_category_available_online">
                                    <option value="" disabled>Select Option</option>
                                    <option value="1" {{ $subcategory->sub_category_available_online == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $subcategory->sub_category_available_online == '0' ? 'selected' : '' }}>No</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="validationCustom099">View In Main Page</label>
                                <select class="form-select" id="validationCustom099" required autocomplete="off"
                                    name="sub_category_view_index_page">
                                    <option value="" disabled>Select Option</option>
                                    <option value="1" {{ $subcategory->sub_category_view_index_page == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $subcategory->sub_category_view_index_page == '0' ? 'selected' : '' }}>No</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>


                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="validationCustom0888">Icon</label>
                                <input type="text" class="form-control" id="validationCustom0888"
                                    placeholder="Paste Icon class"  value="{{ str_replace('bi bi-', '', $subcategory->sub_category_icon_class) }}" required autocomplete="off" name="sub_category_icon_class" />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">This field is required.</div>
                            </div>
                        </div>

                        <!-- Credits and Questions Section -->
                        <!-- Assuming similar structure as create form -->

           

                        <!-- Script for adding more credit choices dynamically -->
                        <script>
                            document.getElementById('addFields').addEventListener('click', function () {
                                var row = document.createElement('div');
                                row.classList.add('row');

                                var emptyCol = document.createElement('div');
                                emptyCol.classList.add('col-md-5');
                                row.appendChild(emptyCol); // Adding the empty div

                                var choiceCol = document.createElement('div');
                                choiceCol.classList.add('col-md-5');
                                choiceCol.classList.add('mt-2');

                                var choiceInput = document.createElement('input');
                                choiceInput.setAttribute('type', 'text');
                                choiceInput.classList.add('form-control');
                                choiceInput.setAttribute('placeholder', 'Write a choice');
                                choiceInput.setAttribute('name', 'credit_answers[]');
                                choiceCol.appendChild(choiceInput);

                                row.appendChild(choiceCol);

                                var creditsCol = document.createElement('div');
                                creditsCol.classList.add('col-md-1');
                                creditsCol.classList.add('mt-2');

                                var creditsInput = document.createElement('input');
                                creditsInput.setAttribute('type', 'number');
                                creditsInput.classList.add('form-control');
                                creditsInput.setAttribute('placeholder', 'Credits');
                                creditsInput.setAttribute('name', 'credits[]');
                                creditsCol.appendChild(creditsInput);

                                row.appendChild(creditsCol);

                                var addButtonCol = document.createElement('div');
                                addButtonCol.classList.add('col-md-1');
                                addButtonCol.classList.add('mt-2');

                                var removeButton = document.createElement('button');
                                removeButton.setAttribute('type', 'button');
                                removeButton.classList.add('btn');
                                removeButton.classList.add('btn-danger');
                                removeButton.innerHTML = '<i class="bi bi-dash-circle"></i>';
                                removeButton.addEventListener('click', function () {
                                    row.remove();
                                });
                                addButtonCol.appendChild(removeButton);

                                row.appendChild(addButtonCol);

                                document.querySelector('.row:last-of-type').after(row);
                            });
                        </script>

                        <!-- Questions and Answers Section -->
                        <br>
                        <br>
                        <br>
                        <div class="card p-2">
                            <center>
                                <h5 class="pt-2">Define Q&A about Subcategories</h5>
                            </center>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <a class="btn btn-sm btn-purple  add-question-btn"><i class="bi bi-plus-circle"></i> Add Question</a>
                                </div>
                            </div>
                            <div class="questions-container">
                                @foreach($subcategory->questions as $index => $question)
                                <div class="row question">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Question</label>
                                        <input type="text" class="form-control question-input" autocomplete="off" name="questions[]" placeholder="Write a Question" value="{{ $question->question }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            This field is required.
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Choices</label>
                                        <div class="answers-container">
                                            @foreach($question->answers as $answer)
                                            <div class="mb-3">
                                                <input type="text" class="form-control answer-input" autocomplete="off" placeholder="Write a Choice." name="answers[{{ $index }}][]" value="{{ $answer->answer }}">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    This field is required.
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <a class="btn btn-success add-answer-btn"><i class="bi bi-plus-circle"></i> Add Choice</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                // Add Question button click event
                                $('.add-question-btn').click(function () {
                                    var newQuestion = `
                                    <div class="row question">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Question</label>
                                            <input type="text" class="form-control question-input" autocomplete="off" name="questions[]" placeholder="Write a Question" >
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Choices</label>
                                            <div class="answers-container">
                                            
                                            </div>

                                            <a class="btn  btn-success add-answer-btn"><i class="bi bi-plus-circle"></i> Add Choice</a>
                                        </div>
                                    </div>`;
                                    $('.questions-container').append(newQuestion);
                                });

                                // Add Answer button click event within a question
                                $('.questions-container').on('click', '.add-answer-btn', function () {
                                    var newAnswer = `
                                        <div class="mb-3">
                                            <input type="text" class="form-control answer-input" autocomplete="off" placeholder="Write an Choice." name="answers[${$(this).closest('.row.question').index()}][]">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>`;
                                    $(this).closest('.row.question').find('.answers-container').append(newAnswer);
                                });
                            });
                        </script>

                        <div class="mb-1 float-end">
                            <button class="btn btn-primary" type="submit">Update Sub-Category</button>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Icons</h5>
                            <button class="btn btn-success btn-sm" id="toggle-btn">Show List</button>
                        </div>

                        <div class="row  collapse icons-list-demo" id="bootstrap-icons"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            var iconList = document.getElementById('bootstrap-icons');

            // Toggle the collapse class
            iconList.classList.toggle('collapse');

            // Change the button text accordingly
            if (iconList.classList.contains('collapse')) {
                this.innerText = 'Show List';
            } else {
                this.innerText = 'Hide List';
            }
        });
        </script>


    <div>
</div> <!-- content -->

@endsection