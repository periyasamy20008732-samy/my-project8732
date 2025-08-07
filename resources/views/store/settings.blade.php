@extends('admin.layouts.app')

@section('content')

 @foreach($setting as $settings)
<form method="POST"   action="{{ route('admin.settings.update',$settings->id) }}" enctype="multipart/form-data">
  @csrf
 @method('PUT')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Settings</h4>
                        <h6>Manage your settings on portal</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
                    </li>
                    <!-- <li>
                        <div class="page-btn">
                            <a href="list-listeners" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>Back to Listener List</a>
                        </div>
                    </li> -->

                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>


                </ul>
                <div class="page-btn">
                    <button type="submit" name="update" class="btn btn-added"><i data-feather="plus-circle" class="me-2"  ></i>Update</button>
                </div>
            </div>
            <div class="row">







                <div class="row">
                    <div class="col-xl-2 col-sm-4 col-5 d-flex">
                        <div class="card flex-fill">

                            <div class="card-body">
                                <div class="nav flex-column nav-pills mb-3">
                                    <a href="#v-pills-home" data-bs-toggle="pill" class="nav-link show active">General</a>
                                    <a href="#v-pills-seo" data-bs-toggle="pill" class="nav-link">SEO</a>
                                    <a href="#v-pills-logo" data-bs-toggle="pill" class="nav-link">Logo </a>                                 
                                    <a href="#v-pills-api" data-bs-toggle="pill" class="nav-link">App Connection API </a>
                                    <a href="#v-pills-google" data-bs-toggle="pill" class="nav-link ">Google API</a>
                                    <a href="#v-pills-notification" data-bs-toggle="pill" class="nav-link ">Notification API</a>
                                    <a href="#v-pills-smtp" data-bs-toggle="pill" class="nav-link ">SMTP Settings </a>
                                    <a href="#v-pills-sms" data-bs-toggle="pill" class="nav-link ">SMS / OTP </a>
                                    <a href="#v-pills-payment" data-bs-toggle="pill" class="nav-link ">Payment Gateway </a>
                                    <a href="#v-pills-agora" data-bs-toggle="pill" class="nav-link ">Calling API</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10 col-sm-8 col-6 d-flex">
                        <div class="card flex-fill default-cover mb-4">

                            <div class="card-body">
                           
                                <div class="tab-content">


                                    <div id="v-pills-home" class="tab-pane fade active show">

                                        <div class="setting-title">
                                            <h4>General Settings</h4>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> App Name
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="site_title" type="text" class="form-control"  value="{{ $settings->site_title }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Web Version
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="version" type="text" class="form-control" value="{{ $settings->version }}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> App Description
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="site_description" type="text" class="form-control" value="{{ $settings->site_description }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> App Url
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="siteurl" type="text" class="form-control" value="{{ $settings->siteurl }}">
                                                <code>Dont uses '/' at the end </code>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> App Email
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="site_email" type="text" class="form-control" value="{{ $settings->site_email }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Contact / Whatsapp no
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="whatsapp_no" type="text" class="form-control" value="{{ $settings->whatsapp_no }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Address
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea name="address" class="form-control" cols="30" rows="5">{{ $settings->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="maintenanceSwitch">Maintenance Mode ON/OFF</label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="maintenance_mode" type="checkbox" class="form-check-input" value="1" {{ isset($settings->app_maintenance_mode) && $settings->app_maintenance_mode == 1 ? 'checked' : '' }}>
                                                 </div>
                                                </div>
                                            </div> 
                                        </div>

                                    <div id="v-pills-seo" class="tab-pane fade">
                                        <div class="setting-title">
                                            <h4>SEO Settings</h4>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Meta Keyword
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="meta_keyword" type="text" class="form-control" value="{{ $settings->meta_keyword }}">
                                                <code>Uses ',' separate keywords </code>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01" > Meta Details
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea name="meta_details" class="form-control" cols="30" rows="10">{{ $settings->meta_details }}</textarea>
                                            </div>
                                        </div>


                                    </div>
                                    <div id="v-pills-logo" class="tab-pane fade">
    <form action="{{ route('admin.settings.update', $settings->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="setting-title">
            <h4>Logo Settings</h4>
        </div>
        <div class="appearance-settings">

            {{-- Logo Icon --}}
            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-4">
                    <div class="setting-info mb-4">
                        <h6>Logo icon</h6>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12 col-md-8">
                    <div class="theme-type-images d-flex align-items-center mb-4">
                        <div class="theme-image">
                            <div class="theme-image-set">
                                <img src="{{ asset('storage/core/' . ($settings->min_logo ?? 'default.png')) }}" width="150px" height="150px" alt="" class="logo-pre">
                            </div>
                            <span>For better size is 450px x 450px.</span>
                        </div>
                         <div class="theme-image">
                            <div class="profile-pic-upload mb-0">
                                <div class="new-employee-field">
                                    <div class="mb-0"> 
                                        <div class="image-upload mb-0">
                                            <input type="file" name="min_logo">
                                            <div class="image-uploads">
                                                <h4>Browse</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="theme-image">
                            <button name="upload_min" type="submit" class="btn btn-success btn-sm">
                                <i data-feather="upload"></i> Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Fav Icon --}}
            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-4">
                    <div class="setting-info mb-4">
                        <h6>Fav icon</h6>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12 col-md-8">
                    <div class="theme-type-images d-flex align-items-center mb-4">
                        <div class="theme-image">
                            <div class="theme-image-set">
                                <img src="{{ asset('storage/core/' . ($settings->fav_icon ?? 'default.png')) }}" width="150px" height="150px" alt="" class="logo-pre">
                            </div>
                            <span>For better size is 512px x 512px.</span>
                        </div>
                        <div class="theme-image">
                            <div class="profile-pic-upload mb-0">
                                <div class="new-employee-field">
                                    <div class="mb-0"> 
                                        <div class="image-upload mb-0">
                                            <input type="file" name="fav_icon">
                                            <div class="image-uploads">
                                                <h4>Browse</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="theme-image">
                            <button name="upload_fav" type="submit" class="btn btn-success btn-sm">
                                <i data-feather="upload"></i> Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Logo --}}
            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-4">
                    <div class="setting-info mb-4">
                        <h6>Logo</h6>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12 col-md-8">
                    <div class="theme-type-images d-flex align-items-center mb-4">
                        <div class="theme-image">
                            <div class="theme-image-set">
                                <img src="{{ asset('storage/core/' . ($settings->logo ?? 'default.png')) }}" width="150px" height="150px" alt="" class="logo-pre">
                            </div>
                            <span>For better size is 512px x 512px.</span>
                        </div>
                         <div class="theme-image">
                            <div class="profile-pic-upload mb-0">
                                <div class="new-employee-field">
                                    <div class="mb-0"> 
                                        <div class="image-upload mb-0">
                                            <input type="file" name="logo">
                                            <div class="image-uploads">
                                                <h4>Browse</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="theme-image">
                    
                            <button name="upload_logo" type="submit" class="btn btn-success btn-sm">
                                <i data-feather="upload"></i> Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- App Logo --}}
            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-4">
                    <div class="setting-info mb-4">
                        <h6>App Logo</h6>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12 col-md-8">
                    <div class="theme-type-images d-flex align-items-center mb-4">
                        <div class="theme-image">
                            <div class="theme-image-set">
                                <img src="{{ asset('storage/core/' . ($settings->app_logo ?? 'default.png')) }}" width="150px" height="150px" alt="" class="logo-pre">
                            </div>
                            <span>For better size is 100px x 80px.</span>
                        </div>
                        <div class="theme-image">
                            <div class="profile-pic-upload mb-0">
                                <div class="new-employee-field">
                                    <div class="mb-0"> 
                                        <div class="image-upload mb-0">
                                            <input type="file" name="app_logo">
                                            <div class="image-uploads">
                                                <h4>Browse</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="theme-image">
                            <button name="upload_app_logo" type="submit" class="btn btn-success">
                                <i data-feather="upload"></i> Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Web Logo --}}
            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-4">
                    <div class="setting-info mb-4">
                        <h6>Web Logo</h6>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12 col-md-8">
                    <div class="theme-type-images d-flex align-items-center mb-4">
                        <div class="theme-image">
                            <div class="theme-image-set">
                                <img src="{{ asset('storage/core/' . ($settings->web_logo ?? 'default.png')) }}" width="150px" height="150px" alt="" class="logo-pre">
                            </div>
                            <span>For better size is 100px x 80px.</span>
                        </div>
                        <div class="theme-image">
                            <div class="profile-pic-upload mb-0">
                                <div class="new-employee-field">
                                    <div class="mb-0"> 
                                        <div class="image-upload mb-0">
                                            <input type="file" name="web_logo">
                                            <div class="image-uploads">
                                                <h4>Browse</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="theme-image">
                            <button name="upload_web_logo" type="submit" class="btn btn-success">
                                <i data-feather="upload"></i> Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
                                    <div id="v-pills-api" class="tab-pane fade">

                                        <div class="setting-title">
                                            <h4>API Connection</h4>
                                        </div>
                                        

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> App Connection API Key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="token" type="text" class="form-control"  disabled>
                                            </div>
                                        </div>



                                    </div>
                                    <div id="v-pills-google" class="tab-pane fade ">

                                        <div class="setting-title">
                                            <h4>Google API</h4>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Google Map ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_google_map" type="checkbox" class="form-check-input" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_googlemap) && $settings->if_googlemap == 1 ? 'checked' : '' }}>
                                                    <code>It will show otp on verification screen</code>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Google Map API Key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="google_map_API" type="text" value="{{ $settings->google_map_API}}" class="form-control">
                                            </div>
                                        </div>


                                    </div>
                                    <div id="v-pills-notification" class="tab-pane fade ">

                                        <div class="setting-title">
                                            <h4>Notification API Settings</h4>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Firebase Notification ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_firebase" class="form-check-input" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_firebase) && $settings->if_firebase == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Firebase API Key
                                            </label>
                                            <div class="col-lg-6">
                                            </div> 
                                             <input name="firebase_API" type="text" class="form-control" value="{{ $settings->firebase_API }}">

                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Firebase config
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea name="firebase_config" class="form-control" id="" cols="30" rows="10">{{ $settings->firebase_config }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Onesignal Notification ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_onesignal" class="form-check-input" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault"  value="1" {{ isset($settings->if_onesignal) && $settings->if_onesignal == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
    <label class="col-lg-4 col-form-label">OneSignal App ID</label>
    <div class="col-lg-6">
        <input name="onesignal_id" type="text" class="form-control" value="{{ $settings->onesignal_id }}" >
    </div>
</div>

<div class="mb-3 row">
    <label class="col-lg-4 col-form-label">OneSignal Rest API Key</label>
    <div class="col-lg-6">
        <input name="onesignal_key" type="text" class="form-control" value="{{ $settings->onesignal_key }}" >
    </div>
</div>

                                    </div>
                                    
                                    <div id="v-pills-smtp" class="tab-pane fade ">
                                        <div class="setting-title">
                                            <h4>Email Settings</h4>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> SMTP ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_smtp" class="form-check-input"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_smtp) && $settings->if_smtp == 1 ? 'checked' : '' }}>

                                                    <code>It will show otp on verification screen</code>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> SMTP Host
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="smtp_host" type="text" class="form-control" value="{{ $settings->smtp_host}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> SMTP Port
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="smtp_port" type="text" class="form-control" value="{{ $settings->smtp_port}}" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> SMTP Username
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="smtp_username" type="email" class="form-control" value="{{ $settings->smtp_username}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01" > SMTP Password
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="smtp_password" type="password" class="form-control" value="{{ $settings->smtp_password}}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Send Grid ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_sendgrid" class="form-check-input" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_sendgrid) && $settings->if_sendgrid == 1 ? 'checked' : '' }}>

                                                    <code>It will show otp on verification screen</code>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="mb-3 row">

                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Send Grid API
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="sendgrid_API" type="text" class="form-control" value="{{ $settings->sendgrid_API}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div id="v-pills-sms" class="tab-pane fade ">

                                        <div class="setting-title">
                                            <h4>SMS Settings</h4>
                                        </div>

                                        <code>For the better perfomance please enable any one of the sms Api once</code>
                                        <br>
                                        <br>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Test OTP Mode ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_testotp" class="form-check-input" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_testotp) && $settings->if_testotp == 1 ? 'checked' : '' }}>

                                                    <code>It will show otp on verification screen</code>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Msg91 ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_msg91" class="form-check-input"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_msg91) && $settings->if_msg91 == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Msg91 API Key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="msg91_apikey" type="text" class="form-control" value="{{ $settings->msg91_apikey }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Textlocal ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_textlocal" class="form-check-input"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_textlocal) && $settings->if_textlocal == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Textlocal API Key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="textlocal_apikey" type="text" class="form-control" value={{ $settings->textlocal_apikey }}>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Greensms ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_greensms" class="form-check-input"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_greensms) && $settings->if_greensms == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Access Tokeny
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="greensms_accessToken" type="text" class="form-control" value="{{ $settings->greensms_accessToken }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Access Tokeny Key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="greensms_accessTokenKey" type="text" class="form-control" value="{{ $settings->greensms_accessTokenKey }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> SMS Sender ID
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="sms_senderid" type="text" class="form-control" value="{{ $settings->sms_senderid }}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> SMS Entity ID
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="sms_entityId" type="text" class="form-control" value="{{ $settings->sms_entityId }}">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> SMS Template ID
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="sms_dltid" type="text" class="form-control" value="{{ $settings->sms_dltid }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> SMS Content
                                            </label>

                                            <div class="col-lg-6">
                                                
                                                <br>
                                                <textarea name="sms_msg" id="" cols="30" rows="5" class="form-control">{{ $settings->sms_msg }}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="v-pills-payment" class="tab-pane fade ">

                                        <div class="setting-title">
                                            <h4>Payment Gateway Settings</h4>
                                        </div>

                                        <h4 class="card-title"> Razorpay Payment Gateway <i class="flaticon-381-fast-forward"></i> </h4>

                                        <br>
                                        <br>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Razorpay ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="razorpay_status" class="form-check-input"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->razorpay_status) && $settings->razorpay_status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> API Key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="razo_key_id" type="text" class="form-control" value="{{ $settings->razo_key_id }}" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> API Secret Key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="razo_key_secret" type="text" class="form-control" value="{{ $settings->razo_key_secret }}">
                                            </div>
                                        </div>

                                        <br>
                                        <br>

                                        <h4 class="card-title"> CCAvenue Payment Gateway <i class="flaticon-381-fast-forward"></i> </h4>

                                        <br>
                                        <br>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> CCAvenue ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="ccavenue_status" class="form-check-input" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->ccavenue_status) && $settings->ccavenue_status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Test Mode ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="ccavenue_testmode" class="form-check-input"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->ccavenue_testmode) && $settings->ccavenue_testmode == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Merchant id
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="ccavenue_merchant_id" type="text" class="form-control" value="{{ $settings->ccavenue_merchant_id }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Access Code
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="ccavenue_access_code" type="text" class="form-control" value="{{ $settings->ccavenue_access_code }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Working key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="ccavenue_working_key" type="text" class="form-control" value="{{ $settings->ccavenue_working_key }}">
                                            </div>
                                        </div>


                                        <br>

                                        <h4 class="card-title"> Phonepe Payment Gateway <i class="flaticon-381-fast-forward"></i> </h4>

                                        <br>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Phonepe ON/OFF
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_phonepe" class="form-check-input"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_phonepe) && $settings->if_phonepe == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Test Mode ON/OFF
                                            </label>
                                            <div class="col-lg-6">

                                                <select name="phonepe_mode" class="form-control">
                                                    <option value="SANDBOX" >SANDBOX</option>
                                                    <option value="PRODUCTION">LIVE</option>
                                                </select>


                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Merchant id
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="phonepe_merchantId" type="text" class="form-control" value="{{ $settings->phonepe_merchantId }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Saltkey </label>
                                            <div class="col-lg-6">
                                                <input name="phonepe_saltkey" type="text" class="form-control" value="{{ $settings->phonepe_saltkey }}" >
                                            </div>
                                        </div>




                                    </div>
                                    <div id="v-pills-notification" class="tab-pane fade ">

                                        <div class="setting-title">
                                            <h4>Push Notification</h4>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Sender id
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="onesignal_id" type="text" class="form-control" value="{{ $settings->onesignal_id }}" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> API Key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="onesignal_key" type="text" class="form-control" value="{{ $settings->onesignal_key }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div id="v-pills-agora" class="tab-pane fade">


                                        <div class="setting-title">
                                            <h4>Calling API Settings</h4>
                                        </div>

                                        <code>Please enable any one of the api</code>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Agora ON/OFF </label>

                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_agora" class="form-check-input" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_smtp) && $settings->if_smtp == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Agora API Key
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="agora_appid" type="text" class="form-control" value="{{ $settings->agora_appid }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Zigo Cloud ON/OFF </label>
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch">
                                                    <input name="if_zigocloud" class="form-check-input"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($settings->if_zigocloud) && $settings->if_zigocloud == 1 ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Zigo Cloud API Id
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="zigocloud_app_id" type="text" class="form-control" value="{{ $settings->zigocloud_app_id }}">
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom01"> Zigo Cloud Sign in Id
                                            </label>
                                            <div class="col-lg-6">
                                                <input name="zigocloud_app_signin" type="text" class="form-control"  value="{{ $settings->zigocloud_app_signin }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>






            </div>
        </div>
    </div>
</form>



@push('scripts')
<script>
    // Script for delete confirmation
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@push('scripts')
@if(session('success'))
<script>
    // Script for success alert
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif
@endpush


@endsection
@endforeach