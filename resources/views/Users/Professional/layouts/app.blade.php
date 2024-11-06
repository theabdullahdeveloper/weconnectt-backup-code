<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeConnectt</title>
    <link rel="shortcut icon" href="{{ asset($theme->favicon) }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('User/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
    <link href="{{ asset('Admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet">
</head>

<body>

    <div class="main wrapper">
        @include('Users.Professional.layouts.navbar')
        @yield('UserContent')
    </div> <!-- / Main -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <!-- jQuery Toast -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

 <!--   <script>-->
 <!--       $(document).ready(function () {-->
 <!--           @if(session('success'))-->
 <!--               showSuccessToast('Success', '{{ session('success') }}', 'success');-->
 <!--           @endif-->
            
 <!--           @if(session('error'))-->
 <!--               showDangerToast('Error', '{{ session('error') }}', 'error');-->
 <!--           @endif-->
            
 <!--            @if($errors->any())-->
 <!--       @foreach ($errors->all() as $error)-->
 <!--           showDangerToast('Error', '{{ $error }}', 'error');-->
 <!--       @endforeach-->
 <!--   @endif-->
 <!--       });-->

 <!--       (function($) {-->
 <!--           showSuccessToast = function(heading, text) {-->
 <!--               'use strict';-->
 <!--               resetToastPosition();-->
 <!--               $.toast({-->
 <!--                   heading: heading,-->
 <!--                   text: text,-->
 <!--                   showHideTransition: 'slide',-->
 <!--                   icon: 'success',-->
 <!--                   loaderBg: '#f96868',-->
 <!--                   position: 'top-right'-->
 <!--               })-->
 <!--           };-->

 <!--showDangerToast = function(heading, text) {-->
 <!--           'use strict';-->
 <!--           resetToastPosition();-->
 <!--           $.toast({-->
 <!--               heading: heading,-->
 <!--               text: text,-->
 <!--               showHideTransition: 'fade',-->
 <!--               icon: 'error',-->
 <!--               loaderBg: '#f2a654',-->
 <!--               position: 'top-right'-->
 <!--           });-->
 <!--       };-->
            // Define other toast functions similarly...

 <!--           resetToastPosition = function() {-->
 <!--               $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center');-->
 <!--               $(".jq-toast-wrap").css({-->
 <!--                   "top": "",-->
 <!--                   "left": "",-->
 <!--                   "bottom": "",-->
 <!--                   "right": ""-->
 <!--               });-->
 <!--           }-->
 <!--       })(jQuery);-->
 <!--   </script>-->
 
 
 
 
 
 
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        @if(session('success'))
            showSuccessAlert('Success', '{{ session('success') }}');
        @endif

        @if(session('error'))
            showErrorAlert('Error', '{{ session('error') }}');
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $error)
                showErrorAlert('Error', '{{ $error }}');
            @endforeach
        @endif
    });

    // Define the alert functions using SweetAlert
    function showSuccessAlert(title, text) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Okay'
        });
    }

    function showErrorAlert(title, text) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'error',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Okay'
        });
    }
</script>

</body>

</html>
