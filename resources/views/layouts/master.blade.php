<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Samba Bikes">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Samba Bikes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
    <!-- Page Title  -->
    <title>Panel | Samba Bikes</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=3.1.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=3.1.0') }}">
     <!-- FontAwesome Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/libs/fontawesome-icons.css') }}">

    <!-- add library -->
    @if(isset($css_library))
    {!! $css_library !!}
    @endif

    <style type="text/css">
        .nk-sidebar.is-compact:not(:hover) .logo-img-small {
            max-height: 20px;
        }
    </style>

    @yield('css')

</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
                <!-- sidebar @s -->
                @include('layouts.sidebar')
                <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('layouts.header')
                <!-- main header @e -->
                <!-- content @s -->
                @yield('content')
                <!-- content @e -->
                <!-- footer @s -->
                @include('layouts.footer')
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js?ver=3.1.0') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=3.1.0') }}"></script>
    <script src="{{ asset('assets/js/apps/moment.js') }}"></script>
    <script src="{{ asset('/assets/js/libs/blockui.min.js') }}" type="text/javascript"></script>

    <!-- add library -->
    @if(isset($js_library))
    {!! $js_library !!}
    @endif

    <script type="text/javascript">
        const token = $("meta[name='csrf-token']").attr("content");
        
        // Check if the user is offline
        if (!navigator.onLine) {
            // User is offline, show SweetAlert notification
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You are currently offline. Please check your internet connection and try again.',
            });
        }

        window.addEventListener('online', () => {
            Swal.fire({
                icon: 'success',
                title: 'Great!',
                text: 'You are back online. Welcome back!',
            });
        });

        function blockUI() {
            $.blockUI({
                message: `<i class="spinner-border" role="status"></i><br>
                                <span class="text-semibold display-block">Loading...</span> `,
                overlayCSS: {
                    backgroundColor: '#1b2024',
                    opacity: 0.8,
                    zIndex: 1200,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    color: '#fff',
                    padding: 0,
                    zIndex: 1201,
                    backgroundColor: 'transparent'
                }
            });
        }

        function unBlockUI() {
            $.unblockUI();
        }
    </script>

    <!-- custom js -->
    @if(isset($js))
    <script src="{{ asset($js) }}"></script>
    @endif

</body>
