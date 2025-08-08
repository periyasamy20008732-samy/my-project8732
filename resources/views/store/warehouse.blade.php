@extends('store.layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="add-item d-flex">
				<div class="page-title">
					<h4>Warehouse</h4>
					<h6>Manage your Warehouse</h6>
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
				<a href="{{ route('store.store.index') }}" class="btn btn-added"><i data-feather="plus-circle"
						class="me-2"></i>Add Store</a>
			</div>
			<div class="page-btn">
				<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-brand"><i
						data-feather="plus-circle" class="me-2"></i>Add New Warehouse</a>
			</div>
		</div>

		<div class="card table-list-card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="brandTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Warehouse Name</th>
								<th>Warehouse Type</th>
								<th>Description</th>
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
<div class="modal fade" id="view-brand">
	<div class="modal-dialog modal-dialog-centered custom-modal-two">
		<div class="modal-content">
			<div class="page-wrapper-new p-0">
				<div class="content">
					<div class="modal-header border-0 custom-modal-header">
						<div class="page-title">
							<h4>Tax Details</h4>
						</div>
						<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
					</div>
					<div class="modal-body custom-modal-body">
						<div class="row">
							<div class="col-lg-12">
								<h5>Tax Status: <span id="view_status"> </h5> <br>
								<table class="table table-bordered table-striped">
									<tbody>
										<tr>
											<th style="width: 40%;"><strong>Tax Name</strong></th>
											<td><span id="view_tax_name"></span></td>
										</tr>
										<tr>
											<th><strong>Validity Date</strong></th>
											<td><span id="view_validity_date"></span></td>
										</tr>
										<tr>
											<th><strong>Tax</strong></th>
											<td><span id="view_tax"></span></td>
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
<div class="modal fade" id="add-brand">
	<div class="modal-dialog modal-dialog-centered custom-modal-two">
		<div class="modal-content">
			<div class="page-wrapper-new p-0">
				<div class="content">
					<div class="modal-header border-0 custom-modal-header">
						<div class="page-title">
							<h4>Create Warehouse</h4>
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

						<form action="{{ route('store.warehouse.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="">
								<div class="mb-3 ">
									<label class="form-label">Store</label>
									<select name="store_id" class="form-control">
										<option value="">Select Store</option>
										@foreach($store as $stores)
										<option value="{{ $stores->id }}">{{ $stores->store_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="mb-3">
								<label class="form-label">Warehouse Type</label>
								<input type="text" class="form-control" name="warehouse_type">
							</div>
							<div class="mb-3">
								<label class="form-label">Warehouse Name</label>
								<input type="text" class="form-control" name="warehouse_name">
							</div>
							<div class="col-lg-12">
								<div class="mb-3 input-blocks">
									<label class="form-label">Warehouse Addresss</label>
									<textarea name="address" class="form-control mb-1" maxlength="60"></textarea>
									<p>Maximum 60 Characters</p>
								</div>
							</div>
							<div class="modal-footer-btn">
								<button type="button" class="btn btn-cancel me-2"
									data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-submit">Create Warehouse</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Edit Customer -->
<div class="modal fade" id="edit-brand">
	<div class="modal-dialog modal-dialog-centered custom-modal-two">
		<div class="modal-content">
			<div class="page-wrapper-new p-0">
				<div class="content">
					<div class="modal-header border-0 custom-modal-header">
						<div class="page-title">
							<h4>Edit Warehouse</h4>
						</div>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body custom-modal-body">

						<form method="POST" id="editBrandForm" enctype="multipart/form-data">
							@csrf
							@method('PUT')

							<div class="">
								<div class="mb-3 ">
									<label class="form-label">Store</label>
									<select name="store_id" id="edit_store_id" class="form-control">
										<option value="">Select Store</option>
										@foreach($store as $stores)
										<option value="{{ $stores->id }}">{{ $stores->store_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="mb-3">
								<label class="form-label">Warehouse Type</label>
								<input type="text" class="form-control" name="warehouse_type" id="edit_warehouse_type">
							</div>
							<div class="mb-3">
								<label class="form-label">Warehouse Name</label>
								<input type="text" class="form-control" name="warehouse_name" id="edit_warehouse_name">
							</div>
							<div class="col-lg-12">
								<div class="mb-3 input-blocks">
									<label class="form-label">Warehouse Address</label>
									<textarea name="address" id="edit_address" class="form-control mb-1"
										maxlength="60"></textarea>
									<p>Maximum 60 Characters</p>
								</div>
							</div>
							<div class="modal-footer-btn">
								<button type="button" class="btn btn-cancel me-2"
									data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-submit">Submit</button>
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
        const table = $('#brandTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('store.warehouse.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'warehouse_name', name: 'warehouse_name' },
                { data: 'warehouse_type', name: 'warehouse_type' },
                { data: 'address', name: 'address' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        // Redraw feather icons after DataTable refresh
        $('#brandTable').on('draw.dt', function () {
            feather.replace();
        });

        // View button handler
        $(document).on('click', '.view-btn', function () {
            const packageId = $(this).data('id');

            $.ajax({
                url: `/store/warehouse/${packageId}`,
                type: 'GET',
                success: function (data) {
                    $('#view_warehouse_name').text(data.warehouse_name ?? '');
                    $('#view_warehouse_type').text(data.warehouse_type ?? '');
                    $('#view_status').text(data.status == 1 ? 'Active' : 'Inactive');
                    $('#view-brand').modal('show');
                },
                error: function (xhr) {
                    console.error("Error loading package", xhr.responseText);
                }
            });
        });

        // Edit button handler
        $(document).on('click', '.edit-btn', function () {
            const id = $(this).data('id');

            $.get(`/store/warehouse/${id}`, function (data) {
                $('#edit_id').val(data.id);
                $('#edit_store_id').val(data.store_id);
                $('#edit_warehouse_type').val(data.warehouse_type);
                $('#edit_warehouse_name').val(data.warehouse_name);
                $('#edit_address').val(data.address);
                $('#edit_status').prop('checked', data.status === 1 || data.status === '1'); 
                $('#editBrandForm').attr('action', `/store/warehouse/${data.id}`);
                $('#edit-brand').modal('show');
            });
        });

        // Delete button handler
        $(document).on('click', '.delete-btn', function () {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This warehouse will be deleted!",
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


<script>
	// ADD IMAGE PREVIEW (Add Customer Modal)
    function previewImage1(input) {
        const file = input.files[0];
        const preview = document.getElementById('preview1');
        const placeholder = document.getElementById('placeholder1');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            placeholder.style.display = 'block';
        }
    }

    // EDIT IMAGE PREVIEW (Edit Customer Modal)
    function previewImage(input) {
        const file = input.files[0];
        const preview = document.getElementById('edit_brand_image');
        const placeholder = document.getElementById('placeholder2');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            placeholder.style.display = 'block';
        }
    }
</script>
@endpush


@endsection