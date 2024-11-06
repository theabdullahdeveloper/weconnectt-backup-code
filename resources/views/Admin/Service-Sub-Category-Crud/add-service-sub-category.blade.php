@extends('Admin.layouts.app') @section('AdminContent')

<div class="content mt-4">
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Create a Service Sub-Category</h4>
                </div>
                <div class="card-body p-2">
                    <form class="needs-validation" novalidate action="{{ route('store.sub.category') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="validationCustom01">Sub-Category Name</label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    placeholder="Enter Sub-Category Name" required autocomplete="off"
                                    name="service_sub_category" pattern="[A-Za-z\s]+" />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">This field is required. Only letters are allowed</div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="validationCustom01">Parent Category</label>
                                <select class="form-select" id="validationCustom01" required autocomplete="off"
                                    name="service_sub_category_parent">
                                    <option value="">Select Parent Category</option>
                                    @foreach($active_service_categories as $category)
                                    <option value="{{ $category->service_category }}">
                                        {{ $category->service_category }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">This field is required.</div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="validationCustom02">Sub-Category Image</label>
                                <input type="file" class="form-control" name="service_sub_category_image"
                                    id="validationCustom02" required autocomplete="off" accept="image/*" />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">This field is required.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="validationCustom01">Status</label>
                                <select class="form-select" id="validationCustom01" required autocomplete="off"
                                    name="service_sub_category_status">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Disabled">Disabled</option>
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">This field is required.</div>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="validationCustom099">Available Online</label>
                                <select class="form-select" id="validationCustom099" required autocomplete="off"
                                    name="sub_category_available_online">
                                    <option value="" disabled selected>Select Option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">This field is required.</div>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="validationCustom099">View In Main Page</label>
                                <select class="form-select" id="validationCustom099" required autocomplete="off"
                                    name="sub_category_view_index_page">
                                    <option value="" disabled selected>Select Option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">This field is required.</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="validationCustom0888">Icon</label>
                                <input type="text" class="form-control" id="validationCustom0888"
                                    placeholder="Paste Icon class" required autocomplete="off" name="sub_category_icon_class" />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">This field is required.</div>
                            </div>
                        </div>
                        <div class="credits-Questions">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="form-label">Credits Question</label>
                                    <input type="text" class="form-control" autocomplete="off" name="credit_question"
                                        placeholder="How soon do you need your requirements fulfilled?" required />
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label">Choice</label>
                                    <input type="text" class="form-control" autocomplete="off" name="credit_answers[]"
                                        placeholder="Urgently" required />
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label">Credits</label>
                                    <input type="number" class="form-control" autocomplete="off" name="credits[]"
                                        placeholder="15" required />
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                <div class="col-md-1 col-lg-1">
                                    <label class="form-label"> Add</label>
                                    <button type="button" class="btn btn-success form-control" id="addFields">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <script>
                        document
                            .getElementById("addFields")
                            .addEventListener("click", function() {
                                var row = document.createElement("div");
                                row.classList.add("row");

                                var emptyCol = document.createElement("div");
                                emptyCol.classList.add("col-md-5");
                                row.appendChild(emptyCol); // Adding the empty div

                                var choiceCol = document.createElement("div");
                                choiceCol.classList.add("col-md-5");
                                choiceCol.classList.add("mt-2");

                                var choiceInput = document.createElement("input");
                                choiceInput.setAttribute("type", "text");
                                choiceInput.classList.add("form-control");
                                choiceInput.setAttribute("autocomplete", "off");
                                choiceInput.setAttribute("placeholder", "Choice");
                                choiceInput.setAttribute("name", "credit_answers[]");
                                choiceInput.required = true;
                                choiceCol.appendChild(choiceInput);

                                row.appendChild(choiceCol);

                                var creditsCol = document.createElement("div");
                                creditsCol.classList.add("col-md-1");
                                creditsCol.classList.add("mt-2");

                                var creditsInput = document.createElement("input");
                                creditsInput.setAttribute("type", "number");
                                creditsInput.classList.add("form-control");
                                creditsInput.setAttribute("autocomplete", "off");
                                creditsInput.setAttribute("placeholder", "Credits");
                                creditsInput.setAttribute("name", "credits[]");
                                creditsInput.required = true;
                                creditsCol.appendChild(creditsInput);

                                row.appendChild(creditsCol);

                                var addButtonCol = document.createElement("div");
                                addButtonCol.classList.add("col-md-1");
                                addButtonCol.classList.add("mt-2");

                                var removeLabel = document.createElement("label");
                                removeLabel.classList.add("form-label");
                                removeLabel.innerHTML = "&nbsp; ";
                                addButtonCol.appendChild(removeLabel);

                                var removeButton = document.createElement("button");
                                removeButton.setAttribute("type", "button");
                                removeButton.classList.add("btn", "btn-danger");
                                removeButton.innerHTML = '<i class="bi bi-x-circle"></i>';
                                removeButton.addEventListener("click", function() {
                                    row.remove();
                                });
                                addButtonCol.appendChild(removeButton);

                                row.appendChild(addButtonCol);

                                document.querySelector(".row:last-of-type").after(row);
                            });
                        </script>
                        <br />
                        <br />
                        <br />
                        <div class="card p-2">
                            <center>
                                <h5 class="pt-2">Define Q&A about Subcategories</h5>
                            </center>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <a class="btn btn-sm btn-purple add-question-btn"><i class="bi bi-plus-circle"></i>
                                        Add Question</a>
                                </div>
                            </div>
                            <div class="questions-container">
                                <div class="row question">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Question</label>
                                        <input type="text" class="form-control question-input" autocomplete="off"
                                            name="questions[]" placeholder="Write a Question" required />
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Choices</label>
                                        <div class="answers-container">
                                            <div class="mb-3">
                                                <input type="text" class="form-control answer-input" autocomplete="off"
                                                    placeholder="Write a Choice." name="answers[0][]" required />
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">
                                                    This field is required.
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-success add-answer-btn"><i class="bi bi-plus-circle"></i> Add
                                            Choice</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                        <script>
                        $(document).ready(function() {
                            // Add Question button click event
                            $(".add-question-btn").click(function() {
                                var newQuestion = `
                <div class="row question">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Question</label>
                        <input type="text" class="form-control question-input" autocomplete="off" name="questions[]" placeholder="Write a Question" required>
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
                            <div class="mb-3">
                                <input type="text" class="form-control answer-input" autocomplete="off" placeholder="Write a Choice." required name="answers[${
                                  $(".question").length
                                }][]">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-success add-answer-btn"><i class="bi bi-plus-circle"></i> Add Choice</a>
                    </div>
                </div>`;
                                $(".questions-container").append(newQuestion);
                            });

                            // Add Answer button click event within a question using event delegation
                            $(".questions-container").on(
                                "click",
                                ".add-answer-btn",
                                function() {
                                    var newAnswer = `
                    <div class="mb-3">
                        <input type="text" class="form-control answer-input" autocomplete="off"  required placeholder="Write a Choice." name="answers[${$(
                          this
                        )
                          .closest(".row.question")
                          .index()}][]">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>`;
                                    $(this)
                                        .closest(".row.question")
                                        .find(".answers-container")
                                        .append(newAnswer);
                                }
                            );
                        });
                        </script>

                        <div class="mb-1 float-end">
                            <button class="btn btn-primary" type="submit">
                                Create Sub-Category
                            </button>
                        </div>
                    </form>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
        <!-- end col-->



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




    </div>



</div>
@endsection