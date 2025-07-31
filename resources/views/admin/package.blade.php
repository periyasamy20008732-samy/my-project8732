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
                <li><a data-bs-toggle="tooltip" title="Pdf"><img src="{{ asset('admin-assets/img/icons/pdf.svg') }}" alt="pdf"></a></li>
                <li><a data-bs-toggle="tooltip" title="Excel"><img src="{{ asset('admin-assets/img/icons/excel.svg') }}" alt="excel"></a></li>
                <li><a data-bs-toggle="tooltip" title="Print"><i data-feather="printer"></i></a></li>
                <li><a data-bs-toggle="tooltip" title="Refresh"><i data-feather="rotate-ccw"></i></a></li>
                <li><a data-bs-toggle="tooltip" title="Collapse" id="collapse-header"><i data-feather="chevron-up"></i></a></li>
            </ul>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-package"><i data-feather="plus-circle" class="me-2"></i>Add New Package</a>
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
                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
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
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="checkbox" class="form-check-input" name="status" value="Active"> Active
                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label" for="maintenanceSwitch">if_webpanel</label>
                                <div class="col-lg-6">
                                    <div class="form-check form-switch">
                                        <input name="if_webpanel" type="checkbox" class="form-check-input" value="1">
                                    </div>
                                </div>
                            </div> 
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Create Package</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
  $(document).ready(function() {
    $('#packageTable').DataTable({
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

    // SweetAlert Delete
    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');
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
                $('#delete-form-' + id).submit();
            }
        });
    });
});
</script>

@if(session('success'))
<script>
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
