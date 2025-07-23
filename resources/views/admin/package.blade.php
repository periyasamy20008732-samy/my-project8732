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
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Package</a>
            </div>
        </div>

        <div class="card table-list-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew">
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
                        <tbody>
                            @foreach($package as $packages)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $packages->package_name }}</td>
                                <td>{{ $packages->validity_date }}</td>
                                <td>{{ $packages->price }}</td>
                                <td>
                                    <span class="badge badge-linesuccess">{{ $packages->status }}</span>
                                </td>
                               {{--  <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $packages->id }}">
                                            <img src="{{ asset('admin-assets/img/icons/edit.svg') }}" alt="Edit">
                                        </a>

								<form action="{{ route('admin.package.destroy', $packages->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this package?')">
								@csrf
								@method('DELETE')
								<button type="submit" style="border: none; background: transparent; padding: 0;">
									<img src="{{ asset('admin-assets/img/icons/delete.svg') }}" alt="Delete">
								</button>
							</form>
                                    </div>
                                </td> --}}


								<td class="action-table-data">
    <div class="edit-delete-action d-flex">
        <!-- Edit Button -->
        <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $packages->id }}" class="me-2">
            <img src="{{ asset('admin-assets/img/icons/edit.svg') }}" alt="Edit">
        </a>

        <!-- Delete Button with SweetAlert -->
        <form id="delete-form-{{ $packages->id }}" action="{{ route('admin.package.destroy', $packages->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="delete-btn" data-id="{{ $packages->id }}" style="border: none; background: transparent; padding: 0;">
                <img src="{{ asset('admin-assets/img/icons/delete.svg') }}" alt="Delete">
            </button>
        </form>
    </div>
</td>
                            </tr>

                            <!-- Edit Modal for each package -->
                            <div class="modal fade" id="editModal{{ $packages->id }}">
                                <div class="modal-dialog modal-dialog-centered custom-modal-two">
                                    <div class="modal-content">
                                        <div class="page-wrapper-new p-0">
                                            <div class="content">
                                                <div class="modal-header border-0 custom-modal-header">
                                                    <div class="page-title">
                                                        <h4>Edit Package</h4>
                                                    </div>
                                                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body custom-modal-body">
                                                    <form method="POST" action="{{ route('admin.package.update', $packages->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label class="form-label">Package Name</label>
                                                            <input type="text" class="form-control" name="package_name" value="{{ $packages->package_name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Validity Date</label>
                                                            <input type="date" class="form-control" name="validity_date" value="{{ $packages->validity_date }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Price</label>
                                                            <input type="text" class="form-control" name="price" value="{{ $packages->price }}" required>
                                                        </div>

                                                          <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                         <input name="if_google_map" type="checkbox" class="form-check-input" role="switch" id="flexSwitchCheckDefault" value="1" {{ isset($packages->status) && $packages->status == 'Active' ? 'checked' : '' }}>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Unit Modal -->
<div class="modal fade" id="add-units">
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
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="package_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Validity</label>
                                <input type="date" class="form-control" name="validity_date" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" required>
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
