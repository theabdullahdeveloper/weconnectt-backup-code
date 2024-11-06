@extends('Admin.layouts.app')
@section('AdminContent')
<link rel="stylesheet" href="{{ asset('Site/css/styles.css') }}">
@foreach($themedata  as $themedata)
<div class="content mt-4">
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Theme Settings</h4>

                </div>
                <div class="card-body p-2">
                <form class="needs-validation" novalidate action="{{ route('update.themesettings') }}" method="POST" enctype="multipart/form-data">
    @csrf
<input type="hidden" value="{{$themedata->id}}" name="id">
    <div class="mb-3">
        <label class="form-label" for="validationFavicon">Favicon</label>
        <input type="file" class="form-control" id="validationFavicon" 
         autocomplete="off" name="favicon">
        <div class="valid-feedback">Looks good!</div>
        <div class="invalid-feedback">This field is required.</div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="validationLogo">Logo</label>
        <input type="file" class="form-control" id="validationLogo" 
         autocomplete="off" name="logo">
        <div class="valid-feedback">Looks good!</div>
        <div class="invalid-feedback">This field is required.</div>
    </div>
    <div class="row">

    <div class="mb-3 col-md-4">
    <label class="form-label" for="validationFacebook">Facebook Link</label>
    <div class="input-group">
        <span class="input-group-text"><i class="ri-facebook-fill"></i></span>
        <input type="url" class="form-control" id="validationFacebook" value="{{$themedata->facebook_link}}"  autocomplete="off" name="facebook_link">
        <div class="valid-feedback">Looks good!</div>
        <div class="invalid-feedback">This field is required.</div>
    </div>
</div>

<div class="mb-3 col-md-4">
    <label class="form-label" for="validationTwitter">Twitter Link</label>
    <div class="input-group">
        <span class="input-group-text"><i class="ri-twitter-fill"></i></span>
        <input type="url" class="form-control" id="validationTwitter" value="{{$themedata->twitter_link}}"  autocomplete="off" name="twitter_link">
        <div class="valid-feedback">Looks good!</div>
        <div class="invalid-feedback">This field is required.</div>
    </div>
</div>

<div class="mb-3 col-md-4">
    <label class="form-label" for="validationLinkedIn">LinkedIn Link</label>
    <div class="input-group">
        <span class="input-group-text"><i class="ri-linkedin-fill"></i></span>
        <input type="url" class="form-control" id="validationLinkedIn" value="{{$themedata->linkedin_link}}"  autocomplete="off" name="linkedin_link">
        <div class="valid-feedback">Looks good!</div>
        <div class="invalid-feedback">This field is required.</div>
    </div>
</div>
</div>



<div class="row">

<div class="mb-3 col-md-6">
<label class="form-label" for="validationTwitter3">Company Email</label>

    
    <input type="email" class="form-control" id="validationTwitter3" value="{{$themedata->c_email}}"  autocomplete="off" name="c_email">
    <div class="valid-feedback">Looks good!</div>
    <div class="invalid-feedback">This field is required.</div>

</div>

<div class="mb-3 col-md-6">
<label class="form-label" for="validationTwitter2">Company Number</label>

    
    <input type="text" class="form-control" id="validationTwitter2" value="{{$themedata->c_no}}"  autocomplete="off" name="c_no">
    <div class="valid-feedback">Looks good!</div>
    <div class="invalid-feedback">This field is required.</div>

</div>


</div>

<div class="mb-3">
        <label class="form-label" for="validationLinkedIn">Header Links</label>
        <textarea  class="form-control" id="validationLinkedIn"  autocomplete="off" name="header_Links">{{$themedata->header_Links}}</textarea>
        <div class="valid-feedback">Looks good!</div>
        <div class="invalid-feedback">This field is required.</div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="validationLinkedIn">Footer Copyright</label>
        <textarea  class="form-control" id="validationLinkedIn" required autocomplete="off" name="footer_copyright">{{$themedata->footer_copyright}}</textarea>
        <div class="valid-feedback">Looks good!</div>
        <div class="invalid-feedback">This field is required.</div>
    </div>

    <div class="mb-1 float-end">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>


                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    <div>

</div> <!-- content -->

    <div class="content mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Theme Settings</h4>
                    </div>
                   
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Favicon
                                <img src="{{ asset($themedata->favicon) }}" alt="Favicon" style="max-width: 50px;">
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Logo
                                <img src="{{ asset($themedata->logo) }}" alt="Logo" style="max-width: 100px;">
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Facebook Link
                                <a href="{{ $themedata->facebook_link }}" target="_blank" class="text-decoration-none fw-bold">
                                    <i class="ri-facebook-fill me-1"></i> Facebook
                                </a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Twitter Link
                                <a href="{{ $themedata->twitter_link }}" target="_blank" class="text-decoration-none fw-bold">
                                    <i class="ri-twitter-fill me-1"></i> Twitter
                                </a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                LinkedIn Link
                                <a href="{{ $themedata->linkedin_link }}" target="_blank" class="text-decoration-none fw-bold">
                                    <i class="ri-linkedin-fill me-1"></i> LinkedIn
                                </a>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                               Company Email
                                <p class="mb-0 fw-bold">{{$themedata->c_email}}</p>
                            </li>


                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Company Number
                                <p class="mb-0 fw-bold">{{$themedata->c_no}}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Footer Copyright
                                <p class="mb-0 fw-bold">{{ $themedata->footer_copyright }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

 <br><br>

@endsection