@extends('admin.layouts.app')
@section('content')

<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content settings-content">
            <div class="page-header settings-pg-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Settings</h4>
                        <h6>Manage your settings on portal</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh">
                            <i data-feather="rotate-ccw" class="feather-rotate-ccw"></i>
                        </a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header">
                            <i data-feather="chevron-up" class="feather-chevron-up"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="settings-wrapper d-flex">
                        <div class="settings-page-wrap w-50">
                            <div class="setting-title">
                                <h4>Tax Rates</h4>
                            </div>

                            <div class="page-header bank-settings justify-content-end">
                                <div class="page-btn">
                                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-tax">
                                        <i data-feather="plus-circle" class="me-2"></i>Add New Tax Rate
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card table-list-card">
                                        <div class="card-body">
                                            <div class="table-top">
                                                <div class="search-set">
                                                    <div class="search-input d-flex align-items-center"><input type="text" class="form-control" placeholder="Search...">
                                                        <a href="javascript:void(0);" class="btn btn-searchset ms-2">
                                                            <i data-feather="search" class="feather-search"></i>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table datanew"  id="projects_table">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Tax rates%</th>
                                                            <th>Created On</th>
                                                            <th class="no-sort text-end">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="projects-table-body">


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- row -->
                        </div> <!-- settings-page-wrap -->
                    </div> <!-- settings-wrapper -->
                </div>
            </div> <!-- row -->
        </div> <!-- content -->
    </div> <!-- page-wrapper -->
</div>
<!-- /Main Wrapper -->

<!-- Add Tax Rates Modal -->
<div class="modal fade" id="add-tax">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Add Tax Rates</h4>
                        </div>
                        <div class="status-toggle modal-status d-flex align-items-center ms-auto me-2">
                            <input type="checkbox" id="user1" class="check" checked>
                            <label for="user1" class="checktoggle"></label>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="tax-rates.html">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Name <span>*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Tax Rate % <span>*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Tax Rates Modal -->
<div class="modal fade" id="edit-tax">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Tax Rates</h4>
                        </div>
                        <div class="status-toggle modal-status d-flex align-items-center ms-auto me-2">
                            <input type="checkbox" id="user4" class="check" checked>
                            <label for="user4" class="checktoggle"></label>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="tax-rates.html">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Name <span>*</span></label>
                                    <input type="text" class="form-control" value="VAT">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Tax Rate % <span>*</span></label>
                                    <input type="text" class="form-control" value="16">
                                </div>
                            </div>
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal " tabindex="-1" role="dialog" id="view-modal">
  <div class="modal-dialog" role="gpuy447yoa">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Project Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <b>Name:</b>
        <p id="name-info"></p>
        <b>Description:</b>
        <p id="description-info"></p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>


@endsection
