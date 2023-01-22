    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    {{-- meta tag --}}
    @include('backend._include.metaTag')

    <!-- FAVICONS ICON -->
    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/morrisjs/morris.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/css/main.css" />
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/css/color_skins.css" />
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/toastr/toastr.min.css" />



    {{-- for ajax  csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- extrnal css added by (push(css)) --}}

    @stack('css')


