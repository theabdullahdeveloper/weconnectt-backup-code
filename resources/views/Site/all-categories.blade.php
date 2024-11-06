@extends('Site.layouts.app')
@section('SiteContent')

<!-- CATEGORY SECTION -->
<style>
.c2 {
    margin-top: 10% !important;
    /* Adjust margin-top for phone screens */
}

@media (max-width: 992px) {
    .c2 {
        margin-top: 20% !important;
        /* Adjust margin-top for phone screens */
    }
}

@media (max-width: 576px) {
    .c2 {
        margin-top: 25% !important;
        /* Adjust margin-top for phone screens */
    }

    .ws {
        display: none;
    }
}

.custom-input-header1 {
    width: 100%;

}

.custom-input-header1 {
    padding: 15px;
    border: solid 1px #a5a4a46c;
    --bs-border-opacity: .5;
}

.custom-input-header1::placeholder{
    color: #a5a4a4;
}

.custom-input-header1:focus {
    border: none !important;
    border-bottom: solid 2px #2E7BF1;
}
</style>
<div class="container-fluid c2">
     <h1 class="text-center mb-5" ><b><u>Services</u></b></h1>
    <div class="row d-flex justify-content-between">
        <div class="col-lg-8 col-md-8 col-sm-5 ws">
           
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="input-group mb-3">
                <input type="text" id="searchInput" class="custom-input-header1 py-1 mr-2"
                    placeholder="Search Service ....." oninput="searchCategories()">
            </div>
        </div>
    </div>

    <div id="categoryContainer" class="row justify-content-center">
        @foreach($categories as $category)
        <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
            <div class="card c-card">
                <a href="{{ url('/all/sub-services/' . $category->service_category) }}" style="color:#111637;">
                    <img src="/{{ $category->service_category_image }}" class="card-img-top image-zoom"
                        alt="{{ $category->service_category }}">
                    @if($category->available_online == 1)
                    <span class="badge p-2 text-white"
                        style="position:absolute; top:4%; right:4%; font-weight:500 !important; background-color:#4287F2; font-size:14px; border-radius:15px;">Available
                        Online</span>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->service_category }}</h5>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- /CATEGORY SECTION -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    var searchInput = document.getElementById('searchInput');
    var subServiceCards = document.querySelectorAll('.c-card');

    searchInput.addEventListener('input', function() {
        var filter = searchInput.value.toLowerCase();
        subServiceCards.forEach(function(card) {
            var subServiceName = card.querySelector('.card-title').textContent.toLowerCase();
            var categoryContainer = card.closest('.col-lg-4');
            if (subServiceName.includes(filter)) {
                categoryContainer.style.display = 'block';
            } else {
                categoryContainer.style.display = 'none';
            }
        });
    });
});
</script>
@endsection

@section('Sitefooter')
@include('Site.layouts.footer')
@endsection