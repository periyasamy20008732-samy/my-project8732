@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>Packages</h4>
                    <h6>Manage your Packages</h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li><a data-bs-toggle="tooltip" title="Pdf"><img src="{{ asset('admin-assets/img/icons/pdf.svg') }}"
                            alt="pdf"></a></li>
                <li><a data-bs-toggle="tooltip" title="Excel"><img src="{{ asset('admin-assets/img/icons/excel.svg') }}"
                            alt="excel"></a></li>
                <li><a data-bs-toggle="tooltip" title="Print"><i data-feather="printer"></i></a></li>
                <li><a href="javascript:void(0);" data-bs-toggle="tooltip" title="Refresh"
                        onclick="location.reload();"><i data-feather="rotate-ccw"></i></a></li>
                <li><a data-bs-toggle="tooltip" title="Collapse" id="collapse-header"><i
                            data-feather="chevron-up"></i></a></li>
            </ul>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-package"><i
                        data-feather="plus-circle" class="me-2"></i>Add New Package</a>
            </div>
        </div>

        <div class="card table-list-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="packageTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package Name</th>
                                <th>Validity Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="view-package">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Package Details</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                    </div>
                    {{-- <div class="modal-body custom-modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table>
                                    <tr>
                                        <th><strong>Package Name:</strong></th>
                                        <th><span id="view_package_name"></span></th>
                                    </tr>
                                    <tr>
                                        <th><strong>Package Name:</strong></th>
                                        <th><span id="view_package_name"></span></th>
                                    </tr>
                                </table>
                                <div class="mb-3">
                                </div>
                                <div class="mb-3"><strong>Validity Date:</strong> <span id="view_validity_date"></span>
                                </div>
                                <div class="mb-3"><strong>Price:</strong> <span id="view_price"></span></div>
                                <div class="mb-3"><strong>Status:</strong> <span id="view_status"></span></div>

                                <div class="mb-3"><strong>Web Panel:</strong> <span id="view_if_webpanel"></span></div>
                                <div class="mb-3"><strong>Android:</strong> <span id="view_if_android"></span></div>
                                <div class="mb-3"><strong>IOS:</strong> <span id="view_if_ios"></span></div>
                                <div class="mb-3"><strong>Windows:</strong> <span id="view_if_windows"></span></div>
                                <div class="mb-3"><strong>Customer App:</strong> <span id="view_if_customerapp"></span>
                                </div>
                                <div class="mb-3"><strong>Delivery App:</strong> <span id="view_if_deliveryapp"></span>
                                </div>
                                <div class="mb-3"><strong>Exicutive App:</strong> <span
                                        id="view_if_exicutiveapp"></span></div>
                            </div>
                        </div>
                        <div class="modal-footer-btn">
                            <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div> --}}
                    <div class="modal-body custom-modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>Package Status: <span id="view_status"> </h5> <br>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 40%;"><strong>Package Name</strong></th>
                                            <td><span id="view_package_name"></span></td>
                                        </tr>
                                        <tr>
                                            <th><strong>Validity Date</strong></th>
                                            <td><span id="view_validity_date"></span></td>
                                        </tr>
                                        <tr>
                                            <th><strong>Price</strong></th>
                                            <td><span id="view_price"></span></td>
                                        </tr>
                                        <tr>
                                            <th><strong>Web Panel</strong></th>
                                            <td><span id="view_if_webpanel"></span></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 40%;"><strong>Android</strong></th>
                                            <td><span id="view_if_android"></span></td>
                                        </tr>
                                        <tr>
                                            <th><strong>IOS</strong></th>
                                            <td><span id="view_if_ios"></span></td>
                                        </tr>
                                        <tr>
                                            <th><strong>Windows</strong></th>
                                            <td><span id="view_if_windows"></span></td>
                                        </tr>
                                        <tr>
                                            <th><strong>Customer App</strong></th>
                                            <td><span id="view_if_customerapp"></span></td>
                                        </tr>
                                        <tr>
                                            <th><strong>Delivery App</strong></th>
                                            <td><span id="view_if_deliveryapp"></span></td>
                                        </tr>
                                        <tr>
                                            <th><strong>Exicutive App</strong></th>
                                            <td><span id="view_if_exicutiveapp"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- End View Modal -->

<!-- Add Package Modal -->
<div class="modal fade" id="add-package">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Create Package</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('admin.package.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Package Name</label>
                                <input type="text" class="form-control" name="package_name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Validity Date</label>
                                <input type="date" class="form-control" name="validity_date" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" required>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Status</span>
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox" name="status" id="user2" class="check" value="1">
                                    <label for="user2" class="checktoggle"></label>
                                </div>
                            </div>


                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Web Panel</span>
                                    <input type="hidden" name="if_ios" value="0">
                                    <input type="checkbox" name="if_webpanel" id="if_webpanel" class="check" value="1">
                                    <label for="if_webpanel" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Android</span>
                                    <input type="hidden" name="if_ios" value="0">
                                    <input type="checkbox" name="if_android" id="if_android" class="check" value="1">
                                    <label for="if_android" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">IOS</span>
                                    <input type="hidden" name="if_ios" value="0">
                                    <input type="checkbox" name="if_ios" id="if_ios" class="check" value="1">
                                    <label for="if_ios" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Windows</span>
                                    <input type="hidden" name="if_windows" value="0">
                                    <input type="checkbox" name="if_windows" id="if_windows" class="check" value="1">
                                    <label for="if_windows" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Customer App</span>
                                    <input type="hidden" name="if_customerapp" value="0">
                                    <input type="checkbox" name="if_customerapp" id="if_customerapp" class="check"
                                        value="1">
                                    <label for="if_customerapp" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Delivery App</span>
                                    <input type="hidden" name="if_deliveryapp" value="0">
                                    <input type="checkbox" name="if_deliveryapp" id="if_deliveryapp" class="check"
                                        value="1">
                                    <label for="if_deliveryapp" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Exicutive App</span>
                                    <input type="hidden" name="if_exicutiveapp" value="0">
                                    <input type="checkbox" name="if_exicutiveapp" id="if_exicutiveapp" class="check"
                                        value="1">
                                    <label for="if_exicutiveapp" class="checktoggle"></label>
                                </div>
                            </div>

                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Create Package</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Customer -->
<div class="modal fade" id="edit-package">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Package</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">

                        <form method="POST" id="editPackageForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Package Name</label>
                                <input type="text" class="form-control" name="package_name" id="edit_package_name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Validity Date</label>
                                <input type="date" class="form-control" name="validity_date" id="edit_validity_date"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" id="edit_price" required>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Status</span>
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox" name="status" id="edit_status" class="check" value="1">
                                    <label for="edit_status" class="checktoggle"></label>
                                </div>
                            </div>


                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Web Panel</span>
                                    <input type="hidden" name="if_webpanel" value="0">
                                    <input type="checkbox" name="if_webpanel" id="edit_if_webpanel" class="check"
                                        value="1">
                                    <label for="edit_if_webpanel" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Android</span>
                                    <input type="hidden" name="if_android" value="0">
                                    <input type="checkbox" name="if_android" id="edit_if_android" class="check"
                                        value="1">
                                    <label for="edit_if_android" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">IOS</span>
                                    <input type="hidden" name="if_ios" value="0">
                                    <input type="checkbox" name="if_ios" id="edit_if_ios" class="check" value="1">
                                    <label for="edit_if_ios" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Windows</span>
                                    <input type="hidden" name="if_windows" value="0">
                                    <input type="checkbox" name="if_windows" id="edit_if_windows" class="check"
                                        value="1">
                                    <label for="edit_if_windows" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Customer App</span>
                                    <input type="hidden" name="if_customerapp" value="0">
                                    <input type="checkbox" name="if_customerapp" id="edit_if_customerapp" class="check"
                                        value="1">
                                    <label for="edit_if_customerapp" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Delivery App</span>
                                    <input type="hidden" name="if_deliveryapp" value="0">
                                    <input type="checkbox" name="if_deliveryapp" id="edit_if_deliveryapp" class="check"
                                        value="1">
                                    <label for="edit_if_deliveryapp" class="checktoggle"></label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Exicutive App</span>
                                    <input type="hidden" name="if_exicutiveapp" value="0">
                                    <input type="checkbox" name="if_exicutiveapp" id="edit_if_exicutiveapp"
                                        class="check" value="1">
                                    <label for="edit_if_exicutiveapp" class="checktoggle"></label>
                                </div>
                            </div>
                            {{-- <input name="maintenance_mode" type="checkbox" class="form-check-input" value="1" {{
                                isset($settings->app_maintenance_mode) &&
                            $settings->app_maintenance_mode == 1 ?
                            'checked' : '' }}> --}}
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Create Package</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Edit Customer Modal -->

@push('scripts')
<script>
    $(document).ready(function () {
        // Initialize DataTable
        const table = $('#packageTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.package.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'package_name', name: 'package_name' },
                { data: 'validity_date', name: 'validity_date' },
                { data: 'price', name: 'price' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Redraw feather icons after DataTable refresh
        $('#packageTable').on('draw.dt', function () {
            feather.replace();
        });

        // View button handler
        $(document).on('click', '.view-btn', function () {
            const packageId = $(this).data('id');

            $.ajax({
                url: `/admin/package/${packageId}`,
                type: 'GET',
                success: function (data) {
                    $('#view_package_name').text(data.package_name ?? '');
                    $('#view_validity_date').text(data.validity_date ?? '');
                    $('#view_price').text(data.price ?? '');
                    $('#view_status').text(data.status == 1 ? 'Active' : 'Inactive');
                    $('#view_if_android').text(data.if_android == 1 ? 'Yes' : 'No');
                    $('#view_if_webpanel').text(data.if_webpanel == 1 ? 'Yes' : 'No');
                    $('#view_if_ios').text(data.if_ios == 1 ? 'Yes' : 'No');
                    $('#view_if_windows').text(data.if_windows == 1 ? 'Yes' : 'No');
                    $('#view_if_customerapp').text(data.if_customerapp == 1 ? 'Yes' : 'No');
                    $('#view_if_deliveryapp').text(data.if_deliveryapp == 1 ? 'Yes' : 'No');
                    $('#view_if_exicutiveapp').text(data.if_exicutiveapp == 1 ? 'Yes' : 'No');
                  
                    $('#view-package').modal('show');
                },
                error: function (xhr) {
                    console.error("Error loading package", xhr.responseText);
                }
            });
        });

        // Edit button handler
        $(document).on('click', '.edit-btn', function () {
            const id = $(this).data('id');

            $.get(`/admin/package/${id}`, function (data) {
                $('#edit_id').val(data.id);
                $('#edit_package_name').val(data.package_name);
                $('#edit_validity_date').val(data.validity_date);
                $('#edit_price').val(data.price);
                $('#edit_status').prop('checked', data.status === 1 || data.status === '1'); 
                $('#edit_if_webpanel').prop('checked', data.if_webpanel === 1 || data.if_webpanel === '1'); 
                $('#edit_if_android').prop('checked', data.if_android === 1 || data.if_android === '1'); 
                $('#edit_if_ios').prop('checked', data.if_ios === 1 || data.if_ios === '1'); 
                $('#edit_if_windows').prop('checked', data.if_windows === 1 || data.if_windows === '1'); 
                $('#edit_if_customerapp').prop('checked', data.if_customerapp === 1 || data.if_customerapp === '1'); 
                $('#edit_if_deliveryapp').prop('checked', data.if_deliveryapp === 1 || data.if_deliveryapp === '1'); 
                $('#edit_if_exicutiveapp').prop('checked', data.if_exicutiveapp === 1 || data.if_exicutiveapp === '1'); 
               // $('#edit_if_multistore').prop('checked', data.if_multistore === 1 || data.if_multistore === '1'); 
                $('#editPackageForm').attr('action', `/admin/package/${data.id}`);
                $('#edit-package').modal('show');
            });
        });

        // Delete button handler
        $(document).on('click', '.delete-btn', function () {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This package will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + id).submit();
                }
            });
        });

        // SweetAlert flash success message
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush


@endsection