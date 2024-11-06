@extends('Admin.layouts.app')
@section('AdminContent')
<link href="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="content mt-4">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="header-title">Edit Terms and Conditions</h4>
                    </div>
                </div>
                <div class="card-body" style="overflow-x:auto">
                    <form action="{{ route('updateTermsAndConditions') }}" method="post" class="needs-validation"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <textarea type="text" name="editor" id="editor" class="form-control"
                            required>{!! $tc->data !!}</textarea>

                        <div class=" mt-4 float-end">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->

</div> <!-- content -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    CKEDITOR.replace('editor', {
        removeButtons: 'Image,ImageButton'  // This removes the image and image button from the toolbar
    });
});
</script>





@endsection