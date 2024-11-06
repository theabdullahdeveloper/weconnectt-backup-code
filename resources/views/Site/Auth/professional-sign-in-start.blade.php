@extends('Site.layouts.app')
@section('SiteContent')

<style>
  .custom-input-header1 {
    width: 100%;

}

.custom-input-header2 {
    margin-left: -10%;
    width: 100%;

}

.custom-input-header1,
.custom-input-header2 {
    padding: 15px;
    border: solid 1px #a5a4a46c;
    --bs-border-opacity: .5;
}

.custom-input-header1::placeholder,
.custom-input-header2::placeholder {
    color: #a5a4a4;
}

.custom-input-header1:focus,
.custom-input-header2:focus {j
    border: none;
    border-bottom: solid 2px #2E7BF1;
    outline: none;
}
</style>

<!-- //// Header  /////  -->

<div class="container-fluid   mb-4 pt-4 pb-4" style="margin-top: 70px;  background-color: #F9F9FA;">
  <div class="row col-md-11 m-auto " id="join_them">
      <div class="col-md-4 mt-3">
      <img src="{{ asset('Site/Images/join-as-a-pro-top.jpg') }}"
        alt="Marketing Image" class="rounded-lg shadow-lg img-fluid" />
    </div>
    <div class="col-md-8 col-12">
      <header class="bg-zinc-100 dark:bg-zinc-700 py-12">
        <div class="container">
          <div class="row">
            <div class="col">
              <h1 class="text-3xl font-bold  mb-3">Join Weconnectt And Elevate <br>Your Business</h1>
              <p class="mb-5 mt-2" style="font-size:22px; color:#858484;">
              Your Next Client Is Already Waiting For Your Services
              </p>


              <div id="categoryDropdown" class="dropdown ml-2 row ">
                
                <div class="col-lg-7 col-md-7 col-sm-12 col-12 mb-8">
                <form action="{{ route('category.prof.store') }}" method="POST">
                  @csrf
                    <!-- Search Input with Dropdown -->
<input name="category" type="text" id="searchInput" placeholder="What service do you provide?"
    class="px-2 py-2 rounded-end custom-input-header1 mt-2" autocomplete="off" 
    oninput="updateDropdown(categories, this.value)" aria-haspopup="true" aria-expanded="false">

<!-- Dropdown Menu -->
<div class="dropdown-menu text-muted" id="categoryList" style="width:93%; border:none; margin-top:10px"></div>
                  
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-8 mt-2">
                  <button type="submit "class="btn btn-primary px-2 py-2 rounded-end w-100">Get started</button>
                </div>
                </form>
              </div>
              <script>
    // Convert categories from server-side to JavaScript object
    const categories = @json($categories);

    // Function to select a category and update the input
    function selectCategoryAndUpdateInput(category) {
        document.getElementById('searchInput').value = category;  // Set input value
        document.getElementById('categoryList').classList.remove('show');  // Hide dropdown
    }

    // Function to update the dropdown based on input
    function updateDropdown(categories, input) {
        const dropdownMenu = document.getElementById('categoryList');
        dropdownMenu.innerHTML = '';  // Clear previous dropdown items

        // Filter categories based on user input
        const filteredCategories = categories.filter(category =>
            category.service_sub_category.toLowerCase().includes(input.toLowerCase())
        );

        // Add each filtered category as a dropdown item
        filteredCategories.forEach(category => {
            const dropdownItem = document.createElement('a');
            dropdownItem.classList.add('dropdown-item');
            dropdownItem.href = '#';  // Set href attribute
            dropdownItem.textContent = category.service_sub_category;  // Set item text

            // Add click event to update input when item is selected
            dropdownItem.addEventListener('click', () => {
                selectCategoryAndUpdateInput(category.service_sub_category);
            });

            dropdownMenu.appendChild(dropdownItem);  // Append to dropdown
        });

        // Show or hide dropdown based on filtered results
        if (filteredCategories.length > 0) {
            dropdownMenu.classList.add('show');  // Show dropdown
        } else {
            dropdownMenu.classList.remove('show');  // Hide dropdown if no results
        }
    }
</script>



              <div class="container mt-4">
                <h6 class="mt-4">Popular Services</h6>
                <div class="row g-2">
@php
    // Fetch 24 random active categories
    $randomlycategories = App\Models\ServiceSubCategory::where('service_sub_category_status', 'Active')
                                              ->inRandomOrder()
                                              ->take(24)
                                              ->get();
@endphp

@if($randomlycategories->isNotEmpty()) <!-- Check if categories exist -->
    @foreach($randomlycategories as $category)
        <div class="col-md-5 col-12">
            <a href="#" class="popular_services_item" style="color: #4d4c4c9f;"
                onclick="selectCategoryAndUpdateInput('{{ $category->service_sub_category }}')">
                <div class="flex items-center">
                    <i class="{{ $category->sub_category_icon_class }} mr-2"></i>{{ $category->service_sub_category }}
                </div>
            </a>
        </div>
    @endforeach
@else
    <div class="col-md-12 col-12">
        <p style="color: #4d4c4c9f;">No  services available at the moment.Please try again later.</p>
    </div>
@endif





                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

    </div>
    
  </div>
</div>
</div>
<!-- End Header -->

<!-- Starts Sections Why to use -->
<section class="bg-white">
  <div class="container-fluid col-md-11 m-auto bg-white mt-4">
    <div class="row justify-content-center">
      <div class="col-md-4 mb-4">
        <div class="p-2 rounded-lg  text-center">
          <div class="flex flex-col items-center mb-4 text-left">
            <i class="fas fa-search-dollar fa-1.5x mb-4 text-blue-500 border p-3 rounded"></i>
            <h3 class="text-lg font-semibold mb-2">Expand Your Business</h3>
            <ul class="text-sm mb-4 mt-4" style="color: rgb(151, 149, 149); font-weight:500;">
              <li><i class="fas fa-circle fa-xs mr-2 text-gray" style="font-size:7px;"></i> 	Retain 100% of your earnings</li>
              <li><i class="fas fa-circle fa-xs mr-2 text-gray" style="font-size:7px;"></i> 	No commission or hidden fees</li>
              <li><i class="fas fa-circle fa-xs mr-2 text-gray" style="font-size:7px;"></i>   Full access to all leads </li>
            </ul>
            <!-- <button class="btn  px-4 py-2 rounded why-use-btn  hover:bg-blue-100">
              How it works
            </button> -->
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class=" p-2 rounded-lg text-center">
          <div class="flex flex-col items-center mb-4 text-left">
            <i class="fas fa-user-check fa-1.5x mb-4 text-blue-500 border p-3 rounded"></i>
            <h3 class="text-lg font-semibold mb-2"> Secure New Clients</h3>
            <ul class="text-sm mb-4 mt-4" style="color: rgb(151, 149, 149); font-weight:500;">
              <li><i class="fas fa-circle fa-xs mr-2 text-gray" style="font-size:7px;"></i> 	Select the most suitable leads for your business</li>
              <li><i class="fas fa-circle fa-xs mr-2 text-gray" style="font-size:7px;"></i>   Access verified contact details </li>
              <li><i class="fas fa-circle fa-xs mr-2 text-gray" style="font-size:7px;"></i> Reach out via phone or email to secure the job</li>
            </ul>
            <!-- <button class="btn  why-use-btn  px-4 py-2 rounded hover:bg-blue-100">
              See an example lead
            </button> -->
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class=" p-2 rounded-lg  text-center">
          <div class="flex flex-col items-center mb-4 text-left">
            <i class="fas fa-chart-line fa-1.5x mb-4 text-blue-500 border p-3 rounded"></i>
            <h3 class="text-lg font-semibold mb-2">Get Top Quality Leads</h3>
            <ul class="text-sm mb-4 mt-4" style="color: rgb(151, 149, 149); font-weight:500;" ;>
              <li><i class="fas fa-circle fa-xs mr-2 text-gray" style="font-size:7px;"></i>	Access local and nationwide leads</li>
              <li><i class="fas fa-circle fa-xs mr-2 text-gray" style="font-size:7px;"></i>	Review leads at no cost </li>
              <li><i class="fas fa-circle fa-xs mr-2 text-gray" style="font-size:7px;"></i> Receive leads in real time</li>
            </ul>
            <!-- <button class="btn why-use-btn  px-4 py-2 rounded hover:bg-blue-100">
              See more about pricing
            </button> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- End Sections Why to use -->
<div class="container-fluid " style="  background-color: #F9F9FA;">
<h2 class="text-center pt-5">Connect with a Thriving Marketplace</h2>
      <p class="mb-4 text-center" style="font-size:20px; font-weight:600;">Numerous   small businesses have discovered new customers through Weconnectt.</p>
      <center><a  href="#join_them"class="btn btn-primary mb-4 py-2 px-4"
        style="font-size:16px; font-weight:600;box-shadow: 0px 1px 5px #007BFF">Join them</a></center>
        </div>
<!-- Why to join us Section start -->
<div class="container-fluid p-4 py-5 " style="  background-color: #F9F9FA;">
  <div class="row">
   
    <div class="col-md-12  text-center">
      <div class="row g-4">
        
        <div class="col-md-4 mt-2 text-center">
          <div class="p-4 border bg-white rounded">
            <i class="bi bi-telephone-forward-fill fs-3 mb-3 text-primary d-block mx-auto" style="font-size:20px;"></i>
            <h3 class="text-xl fw-bold">£1M+</h3>
            <p>Daily Business done on WeConnectt</p>
          </div>
        </div>
        <div class="col-md-4 mt-2 text-center">
          <div class="p-4 border bg-white rounded">
            <i class="bi bi-bag-fill fs-3 mb-3 text-primary d-block mx-auto" style="font-size:20px;"></i>
            <h3 class="text-xl fw-bold">1,000+</h3>
            <p>Services Offered</p>
          </div>
        </div>
        <div class="col-md-4 mt-2 text-center">
          <div class="p-4 border bg-white rounded">
            <i class="bi bi-people-fill fs-3 mb-3 text-primary d-block mx-auto" style="font-size:20px;"></i>
            <h3 class="text-xl fw-bold">500K+</h3>
            <p>Small businesses</p>
          </div>
        </div>
      </div>
    </div>
     
  </div>
</div>


<!-- Why to join us Section End -->

<!-- Success Stories Section Start -->
<div class="container-fluid col-md-11 m-auto py-4">
  <div style="padding: 20px;margin-bottom: 100px;">
    <h2 style="font-size: 48px ;text-align:center;">
    Weconnectt Customer Success Stories            
    </h2>
    <p style="font-size: 20px ;text-align:center; font-weight:500;"> Discover what other small businesses are saying <br>about their experiences with WeConnectt    </p>
  </div>
  <div class="row justify-content-center align-items-center gx-4">
    <div class="col-md-4">
      <div class="card bg-white rounded-lg shadow-lg align-items-center pt-4">
        <div class="ratio ratio-16x9" style="position: relative;">
          <center><img src="{{ asset('Site/Images/Tyron-Wesley.jpg') }}" 
            alt="Image Customers" style="border-radius: 50% !important; width:30%;"/></center>
          <!-- <button class="btn rounded-pil bi bi-play-circle-fill" style="position: absolute;bottom:-10%;right: -15%;color:rgb(111, 178, 253);font-size: 40px;"></button> -->
        </div>
        <div class="card-body">
          <p class="text-center text-lg mb-2 align-items-center">
            “ 84% of our clients are contacted through Weconnectt. Weconnectt makes it easy to get in touch with potential clients just with a click of a button ”
          </p>
          <hr class="border-warning" style="border-width:5px;" />
          <div class="text-center mt-2">
            <p class="fw-bold">Tyron Wesley</p>
            <p class="text-sm text-muted">Elegant Cleaning Solutions             </p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-white rounded-lg shadow-lg align-items-center pt-4">
        <div class="ratio ratio-16x9" style="position: relative;">
           <center><img src="{{ asset('Site/Images/Lillie-Gareth.jpg') }}"
            alt="Image Customers" style="border-radius: 50% !important; width:30%;"/></center>
          <!-- <button class="btn rounded-pil bi bi-play-circle-fill" style="position: absolute;bottom:-10%;right: -15%;color:rgb(255, 253, 127);font-size: 40px;"></button> -->
        </div>
        <div class="card-body">
          <p class="text-center text-lg mb-2">
            “I have used varies other platform to gain leads but Weconnectt by far has the best leads. Always securing bookings from <br>their leads”
          </p>
           <hr class="border-warning" style="border-width:5px;" />
          <div class="text-center mt-2">
            <p class="fw-bold">Lillie Gareth</p>
            <p class="text-sm text-muted">Beauty Cinematography </p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-white rounded-lg shadow-lg align-items-center pt-4">

        <div class="ratio ratio-1x1" style="position: relative;">
        <center><img src="{{ asset('Site/Images/Ash-Logan.jpg') }}"
            alt="Image Customers" style="border-radius: 50% !important; width:30%;"/></center>
          <!-- <button class="btn rounded-pil bi bi-play-circle-fill" style="position: absolute;bottom:-10%;right: -15%;color:aquamarine;font-size: 40px;"></button> -->
        </div>
        <div class="card-body">
          <p class="text-center text-lg mb-2">
            “ Various potential clients try to reach us on Weconnectt. Weconnectt gives the power to decide which leads we want to interact with and talk to ”
          </p>
           <hr class="border-warning" style="border-width:5px;" />
          <div class="text-center mt-2">
            <p class="fw-bold">Ash Logan  </p>
            <p class="text-sm text-muted">Three Trips Solutions</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Clients  -->

<div class="wrap pb-4">
  
</div>

<!-- End Clients  -->
<!-- Success Stories Section End -->


@endsection
@section('Sitefooter')
@include('Site.layouts.footer')
@endsection