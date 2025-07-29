<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Meta SEO Tags (Dynamic from Settings) -->
    <meta name="description" content="{{ $settings->meta_description ?? 'POS - Bootstrap Admin Template' }}">
    <meta name="keywords" content="{{ $settings->meta_keywords ?? 'admin, pos, bootstrap, responsive, business' }}">
    <meta name="author" content="{{ $settings->meta_author ?? 'Dreamguys - Bootstrap Admin Template' }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
   


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">


    <!-- Title (Dynamic from Settings) -->
    <title>{{ $settings->site_title ?? 'Dreams Pos Admin Template' }}</title>

    <!-- Favicon (Optional, if set in settings) -->
    @if(!empty($settings->fav_icon))
        <link rel="icon" href="{{ asset('storage/core/' . $settings->fav_icon) }}" type="image/png">
    @else
        <link rel="icon" href="{{ asset('admin-assets/img/logo.png') }}" type="image/png">
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>
