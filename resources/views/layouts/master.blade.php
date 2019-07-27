<!doctype html>
<html lang="">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="ThormaWeb AdminTheme">
    <meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" type="image/x-icon"
          href="{{ asset('vendor/thormaweb/admin-theme/images/favicon.png') }}">

    <!-- Google icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/thormaweb/admin-theme/css/bootstrap.min.css') }}">

    <!-- Propeller css -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/thormaweb/admin-theme/css/propeller.min.css') }}">

    <!-- Propeller admin theme css-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/thormaweb/admin-theme/css/propeller-admin.css') }}">

    <!-- Propeller theme css-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/thormaweb/admin-theme/css/propeller-theme.css') }}">

    <!-- DateTime Picker css-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/thormaweb/admin-theme/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/thormaweb/admin-theme/css/pmd-datetimepicker.css') }}">

    <!-- Select2 css-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/thormaweb/admin-theme/css/select2.min.css') }}">

    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/thormaweb/admin-theme/css/select2-bootstrap.css') }}">

    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/thormaweb/admin-theme/css/pmd-select2.css') }}">

    <!-- Theme Color's -->
    <style>
        .navbar-inverse,
        .bg-fill-darkblue {
            border-color: {{ config('admin-theme.colors.shadow') }};
        }

        .navbar-inverse,
        .bg-fill-darkblue,
        .pmd-sidebar-left .nav > li > a:focus,
        .pmd-sidebar .pmd-sidebar-nav li .dropdown-menu li a:focus,
        .navbar-header i,
        .pmd-sidebar-left .nav > li.pmd-user-info > a,
        .nav h2.typo-fill-secondary,
        .pmd-sidebar .pmd-sidebar-nav .dropdown-menu,
        .pmd-sidebar .pmd-sidebar-nav li a {

            background: {{ config('admin-theme.colors.primary') }};
            color: {{ config('admin-theme.colors.primary_fonts') }};
        }

        .pmd-sidebar-left .nav > li > a:hover,
        .pmd-sidebar-left .nav > li > a:active,
        .pmd-sidebar-left .nav > li > a.active,
        .pmd-sidebar .pmd-sidebar-nav li .dropdown-menu li a:hover,
        .pmd-sidebar .pmd-sidebar-nav li .dropdown-menu li a.active,
        .pmd-sidebar-left .nav > li.pmd-user-info > a:hover {
            background-color: {{ config('admin-theme.colors.secondary') }};
            color: {{ config('admin-theme.colors.secondary_fonts') }};
        }
    </style>

    @stack('css')
</head>

<body class="body-custom">

    @yield('master-content')

    <!-- Scripts Starts -->

    <script src="{{ asset('vendor/thormaweb/admin-theme/js/jquery-1.12.2.min.js') }}"></script>
    <script src="{{ asset('vendor/thormaweb/admin-theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/thormaweb/admin-theme/js/propeller.min.js') }}"></script>

    <!-- DateTime Picker -->
    <script src="{{ asset('vendor/thormaweb/admin-theme/js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('vendor/thormaweb/admin-theme/js/bootstrap-datetimepicker.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('vendor/thormaweb/admin-theme/js/select2.full.js') }}"></script>
    <script src="{{ asset('vendor/thormaweb/admin-theme/js/pmd-select2.js') }}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            <!-- Select Multiple Tags -->
            $(".select-tags").select2({
                tags: false,
                theme: "bootstrap",
                allowClear: true
            })
            <!-- Simple Selectbox -->
            $(".select-simple").select2({
                theme: "bootstrap",
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
            <!-- Selectbox with search -->
            $(".select-with-search").select2({
                theme: "bootstrap",
                allowClear: true
            });
            <!-- Select & Add Multiple Tags -->
            $(".select-add-tags").select2({
                tags: true,
                theme: "bootstrap",
                allowClear: true
            })
        });
    </script>

    @stack('scripts')

    <!-- Scripts Ends -->
    @livewireAssets()


</body>
</html>