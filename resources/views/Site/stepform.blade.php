
    <!-- SUB CATEGORY  -->
    @foreach($sub_categories->groupBy('service_sub_category_parent') as $parentName => $subCategories)
    @if($subCategories->contains('sub_category_view_index_page', 1))
    <div class="container-fluid col-11 category" style="margin:auto !important;">
        <br>
        <br>
        <br>
        <br>
        <div class="row p-2">
            <div class="col-md-6">
                <h2 class="category-heading"><strong>{{ $parentName }}</strong></h2>
            </div>
            <div class="col-md-6 text-md-end d-flex justify-content-end mt-3">
                <h5><a href="#" class="view-btn ">View All</a></h5>
            </div>
        </div>

        <div class="row p-2  category-cards">
            @foreach($subCategories as $subCategory)
            <div class="col-md-4 col-12 mt-2">
                <a style="color:#111637; cursor:pointer;" data-toggle="modal"
                    data-target="#Modal{{ $subCategory->service_sub_category }}"
                    data-subcategory="{{ $subCategory->service_sub_category }}">
                    <div class="card c-card">
                        <div class="">
                            <img src="{{ $subCategory->service_sub_category_image }}" class="card-img-top image-zoom"
                                alt="sub category Image">
                            @if($subCategory->sub_category_available_online == 1)
                            <span class="badge p-2 text-white"
                                style="position:absolute; top:3%; right:3%; font-weight:500 !important; background-color:#4287F2; font-size:14px; border-radius:15px;">Available
                                Online</span>
                            @endif
                        </div>
                        <h5 class="card-title p-2 pt-3">{{ $subCategory->service_sub_category }}</h5>
                    </div>
                </a>
                <!-- Modal -->
                <div class="modal fade" id="Modal{{ $subCategory->service_sub_category }}" tabindex="-1" role="dialog"
                    aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel{{ $subCategory->service_sub_category }}">{{
                                    $subCategory->service_sub_category }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                            <form id="stepForm{{ $subCategory->service_sub_category }}" action="" method="POST" class="needs-validation">
    @csrf
    @foreach($subCategory->questions as $key => $question)
    <div class="step" @if($key !==0) style="display: none;" @endif>
        <section>
            <br>
            <center>
                <h4>{{ $question->question }}</h4>
            </center>
            <br>
            @foreach($question->answers as $answer)
            <div class="form-check  step-check-feild">
                <input class="step-check-input" type="radio" name="answer_{{ $question->id }}"
                    id="ans_{{ $question->id }}_{{ $answer->id }}" value="{{ $answer->answer }}"
                    onclick="toggleOtherInput('{{ $question->id }}', this)">
                <label class="check-label" for="ans_{{ $question->id }}_{{ $answer->id }}">
                    {{ $answer->answer }}
                </label>
            </div>
            @endforeach
            <div class="form-check  step-check-feild">
                <input class="step-check-input" type="radio" name="answer_{{ $question->id }}"
                    id="ans_{{ $question->id }}_other" value="other" onclick="toggleOtherInput('{{ $question->id }}', this)">
                <label class="check-label" for="ans_{{ $question->id }}_other">Other</label>
                <input type="text" class="custom-input-header1 other-input" name="other_{{ $question->id }}"
                    id="other_{{ $question->id }}" style="display: none;" placeholder="Please specify">
            </div>
        </section>
        <div class="modal-footer d-flex">
            @if($key !== 0)
            <button class="btn prevBtn" type="button">Back</button>
            @endif
            <button class="btn btn-primary nextBtn ml-auto" type="button">Continue</button>
        </div>
    </div>
    @endforeach
    <!-- Additional step for input email -->
    <div class="step" style="display: none;">
        <section class="p-4">
            <br>
            <center>
                <h4>What email address would you like quotes sent to?</h4>
            </center>
            <br>
            <div class="form-group mb-4">
                <input type="email" class="custom-input-header1" name="email" id="email" required
                    placeholder="Email Address">
            </div>
            <div class="d-flex mt-4">
                @if($key !== 0)
                <button class="btn prevBtn" type="button">Back</button>
                @endif
                <button class="btn btn-primary  ml-auto" type="button">Continue</button>
            </div>
        </section>
    </div>
</form>

<script>
    function toggleOtherInput(questionId, selected) {
        var otherInput = document.getElementById('other_' + questionId);
        if (selected.value === 'other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    }
</script>



                            </div>
                            <!-- Modal Footer -->

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-primary">
                    <br>
                    Are you sure you want to cancel?
                    <br>
                    <br>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss=".modal">Quit</button>
                    <button type="button" class="btn btn-primary" id="confirmCancel">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modals = document.querySelectorAll('.modal');
            var previousModal = null;

            modals.forEach(function (modal) {
                var currentStep = 0;
                var steps = modal.querySelectorAll('.step');
                var prevBtns = modal.querySelectorAll('.prevBtn');
                var nextBtns = modal.querySelectorAll('.nextBtn');

                // Show the initial step
                showStep(currentStep);

                // Event listeners for Previous and Next buttons
                prevBtns.forEach(function (btn) {
                    btn.addEventListener("click", function () {
                        navigate(-1);
                    });
                });

                nextBtns.forEach(function (btn) {
                    btn.addEventListener("click", function () {
                        navigate(1);
                    });
                });

                // Function to navigate between steps
                function navigate(stepChange) {
                    var newStep = currentStep + stepChange;
                    if (newStep >= 0 && newStep < steps.length) {
                        steps[currentStep].style.display = "none";
                        steps[newStep].style.display = "block";
                        currentStep = newStep;
                    }
                }

                // Function to show a step
                function showStep(stepIndex) {
                    if (stepIndex >= 0 && stepIndex < steps.length) {
                        steps.forEach(function (step, index) {
                            if (index === stepIndex) {
                                step.style.display = "block";
                            } else {
                                step.style.display = "none";
                            }
                        });
                    }
                }

                // Event listener for modal close button
                var modalCloseButtons = modal.querySelectorAll('[data-dismiss="modal"]');
                modalCloseButtons.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        previousModal = modal;
                        $('#confirmationModal').modal('show');
                    });
                });
            });

            // Event listener for confirmation modal
            var confirmCancelBtn = document.getElementById('confirmCancel');
            var noButton = document.querySelector('#confirmationModal .modal-footer .btn-secondary');

            confirmCancelBtn.addEventListener('click', function () {
                $('#confirmationModal').modal('hide');
                location.reload();
            });

            noButton.addEventListener('click', function () {
                $('#confirmationModal').modal('hide');
                if (previousModal) {
                    $(previousModal).modal('show');
                    previousModal = null; // Reset the previousModal variable
                }
            });
        });
    </script>

    <!-- /SUB CATEGORY  -->