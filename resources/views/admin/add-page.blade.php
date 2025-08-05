@extends('admin.layouts.app')

@section('content')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Page information</h4>
                        <h6>Add page</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <div class="page-btn">
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary"><i
                                    data-feather="arrow-left" class="me-2"></i>Back to
                                List</a>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
            </div>
            <!-- /product list -->



            <form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">

                @csrf

                <div class="card">
                    <div class="card-body">
                        <div class="new-employee-field">
                            <div class="card-title-head">
                                <h6><span><i data-feather="info" class="feather-edit"></i></span>Add Page</h6>
                            </div>

                            <div class="row">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label"> Title: </label>
                                    <div class="col-sm-9">
                                        <input name="title" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label"> Where to list this page: </label>
                                    <div class="col-sm-9">

                                        <select name="option" class="form-control">

                                            <option value="page">Page</option>
                                            <option value="info">Information</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Description: </label>
                                    <div class="col-sm-9">

                                        <textarea name="details" id="summernote"> </textarea>
                                        <script>
                                            $('#summernote').summernote({
                                                // height: 800, // set editor height
                                                minHeight: 800, // set minimum height of editor
                                                maxHeight: null, // set maximum height of editor
                                                focus: true // set focus to editable area after initializing summernote
                                            });
                                        </script>



                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Show in app menu? </label>
                                    <div class="col-sm-9">

                                        <div class="form-check form-switch">
                                            <input name="showapp_menu" class="form-check-input" value="1" type="checkbox"
                                                role="switch" id="flexSwitchCheckDefault">
                                        </div>

                                        <input type="text" name="status" value="1" hidden>

                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
                <!-- /product list -->

                <div class="text-end mb-3">
                    <button type="button" class="btn btn-cancel me-2" onClick="window.location.reload();">Cancel</button>
                    <button type="submit" class="btn btn-submit">Add</button>
                </div>
            </form>
        </div>
    </div>

@endsection