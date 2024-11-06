@extends('Admin.layouts.app')
@section('AdminContent')

<div class="content mt-4">
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Update {{ $subcategory->service_sub_category }} Credits Details</h4>
                </div>
                <div class="card-body p-2">
                    <form class="needs-validation" novalidate action="{{ route('update.sub.category.credits', $subcategory->service_sub_category) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Credits Question</label>
                                <input type="text" class="form-control" name="credit_question" value="{{ $credits->first()->credit_question ?? '' }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">This field is required.</div>
                            </div>
                        </div>

                        <div class="credits-Questions">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Choice</label>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Credits</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label">Remove</label>
                                </div>
                            </div>
                            @foreach($credits as $credit)
                            <div class="row mb-3">
                                <input type="hidden" name="credit_ids[]" value="{{ $credit->id }}">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="credit_answers[]" value="{{ $credit->credit_answer }}" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" name="credits[]" value="{{ $credit->credits }}" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger removeFields"><i class="bi bi-x-circle"></i></button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-success" id="addFields"><i class="bi bi-plus-circle"></i> Add Choice</button>
                        
                        <script>
                            document.querySelectorAll('.removeFields').forEach(button => {
                                button.addEventListener('click', function () {
                                    this.closest('.row').remove();
                                });
                            });

                            document.getElementById('addFields').addEventListener('click', function () {
                                var row = document.createElement('div');
                                row.classList.add('row', 'mb-3');
                                row.innerHTML = `
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="credit_answers[]" placeholder="Choice" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" class="form-control" name="credits[]" placeholder="Credits" required>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger removeFields"><i class="bi bi-x-circle"></i></button>
                                    </div>
                                `;
                                document.querySelector('.credits-Questions').appendChild(row);
                                
                                row.querySelector('.removeFields').addEventListener('click', function () {
                                    row.remove();
                                });
                            });
                        </script>

                        <div class="mb-1 float-end">
                            <button class="btn btn-primary" type="submit">Update Credits Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
