<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeConnectt</title>
    <link rel="shortcut icon" href="{{ asset($theme->favicon) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-toast-styles/dist/jquery.toast.min.css">
    <link href="https://cdn.jsdelivr.net/npm/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet">
    <!-- Custom CSS  -->
    <link rel="stylesheet" href="{{ asset('User/css/styles.css') }}">
    <!-- Icons css -->
    <link href="{{ asset('Admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="main wrapper">

        @include('Users.GetService.layouts.navbar')


        @yield('GetServiceUserContent')



    </div> <!-- / Main -->

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
<script>
    $(document).ready(function() {
        @if(session('success'))
        showSuccessToast('Success', '{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
        showDangerToast('Error', '{{ session('error') }}', 'error');
        @endif
    });

    (function($) {
        showSuccessToast = function(heading, text) {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: heading,
                text: text,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-right'
            })
        };
        
        showInfoToast = function(heading, text) {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: heading,
                text: text,
                showHideTransition: 'slide',
                icon: 'info',
                loaderBg: '#46c35f',
                position: 'top-right'
            })
        };
        
        showWarningToast = function(heading, text) {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: heading,
                text: text,
                showHideTransition: 'slide',
                icon: 'warning',
                loaderBg: '#57c7d4',
                position: 'top-right'
            })
        };
        
        showDangerToast = function(heading, text) {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: heading,
                text: text,
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'top-right'
            })
        };
        
        showToastPosition = function(position) {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Positioning',
                text: 'Specify the custom position object or use one of the predefined ones',
                position: String(position),
                icon: 'info',
                stack: false,
                loaderBg: '#f96868'
            })
        }
        
        showToastInCustomPosition = function() {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Custom positioning',
                text: 'Specify the custom position object or use one of the predefined ones',
                icon: 'info',
                position: {
                    left: 120,
                    top: 120
                },
                stack: false,
                loaderBg: '#f96868'
            })
        }
        
        resetToastPosition = function() {
            $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
            $(".jq-toast-wrap").css({
                "top": "",
                "left": "",
                "bottom": "",
                "right": ""
            }); //to remove previous position style
        }
    })(jQuery);
</script>
</body>

</html>