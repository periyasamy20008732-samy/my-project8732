<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Meta SEO Tags (Dynamic from Settings) -->
    <metaname="description" content="{{ $settings->meta_description ?? 'POS - Bootstrap Admin Template' }}">
        <meta name="keywords" content="{{ $settings->meta_keywords ?? 'admin, pos, bootstrap, responsive, business' }}">
        <meta name="author" content="{{ $settings->meta_author ?? 'Dreamguys - Bootstrap Admin Template' }}">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />


        <!-- Title (Dynamic from Settings) -->
        <title>{{ $settings->site_title ?? 'Green Biller' }}</title>

        <!-- Favicon (Optional, if set in settings) -->
        @if(!empty($settings->fav_icon))
        <link rel="icon" href="{{ asset('storage/core/' . $settings->fav_icon) }}" type="image/png">
        @else
        <link rel="icon" href="{{ asset('logo1.jpeg') }}" type="image/png">
        @endif

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}">

        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap-datetimepicker.min.css') }}">

        <!-- Animation CSS -->
        <link rel="stylesheet" href="{{ asset('admin-assets/css/animate.css') }}">

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}">

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/all.min.css') }}">

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">






        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        {{--
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        --}}
</head>