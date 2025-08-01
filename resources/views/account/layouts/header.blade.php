<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(!empty($settings->fav_icon))
        <link rel="icon" href="{{ asset('storage/core/' . $settings->fav_icon) }}" type="image/png">
    @else
        <link rel="icon" href="{{ asset('admin-assets/img/logo.png') }}" type="image/png">
    @endif

    <title>{{ $settings->site_title ?? 'Green Biller' }} | Account</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('account-assets/css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">