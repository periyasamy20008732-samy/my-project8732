@extends('store.layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="add-item d-flex">
				<div class="page-title">
					<h4>Store</h4>
					<h6>Manage your WStore</h6>
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
				<a href="{{ route('store.warehouse.index') }}" class="btn btn-added"><i data-feather="plus-circle"
						class="me-2"></i>Add Warhouse</a>
			</div>
			<div class="page-btn">
				<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-brand"><i
						data-feather="plus-circle" class="me-2"></i>Add Store</a>
			</div>
		</div>

		<div class="card table-list-card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="brandTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Logo</th>
								<th>Store Code</th>
								<th>Store Name</th>
								<th>Store Website</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Country</th>
								<th>State</th>
								<th>City</th>
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
<div class="modal fade" id="add-brand">
	<div class="modal-dialog modal-dialog-centered custom-modal-two">
		<div class="modal-content">
			<div class="page-wrapper-new p-0">
				<div class="content">
					<div class="modal-header border-0 custom-modal-header">
						<div class="page-title">
							<h4>Create Store</h4>
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

						<form action="{{ route('store.store.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Store Name *</label>
										<input type="text" class="form-control" name="store_name" required>
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Store Website *</label>
										<input type="text" class="form-control" name="store_website" required>
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">GST No</label>
										<input type="text" class="form-control" name="gst_no">
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Website</label>
										<input type="email" class="form-control" name="website">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Country</label>
										<select id="edit_country" name="country" class="form-control">
											<option value="">Select Country</option>
											@foreach($countries as $country)
											<option value="{{ $country->name }}">{{ $country->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Mobile *</label>
										<input type="number" class="form-control" name="mobile" id="edit_mobile"
											maxlength="12" minlength="12">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Email *</label>
										<input type="email" class="form-control" name="email">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">City</label>
										<input type="text" class="form-control" name="city">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">State</label>
										<input type="text" class="form-control" name="state">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Pincode</label>
										<input type="number" class="form-control" name="postcode">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3 input-blocks">
										<label class="form-label">Address</label>
										<textarea name="address" class="form-control mb-1" maxlength="60"></textarea>
										<p>Maximum 60 Characters</p>
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Store logo</label>
										<input type="file" class="form-control" name="store_logo">
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Signature</label>
										<input type="file" class="form-control" name="signature">
									</div>
								</div>

								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Create</button>
								</div>
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
							<h4>Edit Brand</h4>
						</div>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
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

						<form method="POST" id="editBrandForm" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<!-- image Upload -->
							<div class="row">
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Store Name *</label>
										<input type="text" class="form-control" id="edit_store_name" name="store_name"
											required>
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Store Website *</label>
										<input type="email" class="form-control" id="edit_store_website"
											name="store_website" required>
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">GST No</label>
										<input type="text" class="form-control" id="edit_gst_no" name="gst_no">
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Website</label>
										<input type="email" class="form-control" id="edit_website" name="website">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Country</label>
										<select id="edit_country" name="country" class="form-control">
											<option value="">Select Country</option>
											@foreach($countries as $country)
											<option value="{{ $country->name }}">{{ $country->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Mobile *</label>
										<input type="text" class="form-control" id="edit_mobile" name="mobile">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Email *</label>
										<input type="email" class="form-control" id="edit_email" name="email">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">City</label>
										<input type="text" class="form-control" id="edit_city" name="city">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">State</label>
										<input type="text" class="form-control" id="edit_state" name="state">
									</div>
								</div>
								<div class="col-lg-4 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Pincode</label>
										<input type="number" class="form-control" id="edit_postcode" name="postcode">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3 input-blocks">
										<label class="form-label">Address</label>
										<textarea name="address" class="form-control mb-1" maxlength="60"
											id="edit_address"></textarea>
										<p>Maximum 60 Characters</p>
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Store logo</label>
										<input type="file" class="form-control" name="store_logo">
									</div>
								</div>
								<div class="col-lg-6 pe-0">
									<div class="mb-3 input-blocks">
										<label class="form-label">Signature</label>
										<input type="file" class="form-control" name="signature">
									</div>
								</div>

								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Create</button>
								</div>
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
            ajax: "{{ route('store.store.index') }}",
            columns: [
				 { data: 'DT_RowIndex', name: 'DT_RowIndex' },
				 {
					data: 'store_logo',
					name: 'store_logo',
					render: function (data, type, row) {
						if (data) {
							return `<img src="${window.location.origin}/${data}" width="50" height="50" alt="Brand Image">`;
						} else {
							return 'No Image';
						}
					},
					orderable: false,
					searchable: false
				},
                { data: 'store_code', name: 'store_code' },
                { data: 'store_name', name: 'store_name' },
                { data: 'store_website', name: 'store_website' },
                { data: 'mobile', name: 'mobile' },
                { data: 'email', name: 'email' },
                { data: 'country', name: 'country' },
                { data: 'state', name: 'state' },
                { data: 'city', name: 'city' },
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
                url: `/store/store/${packageId}`,
                type: 'GET',
                success: function (data) {
                    $('#view_brand_name').text(data.brand_name ?? '');
                    $('#view_brand_code').text(data.brand_code ?? '');
                   // $('#view_tax').text(data.tax ?? '');
                    $('#view_status').text(data.status == 1 ? 'Active' : 'Inactive');
                if (data.brand_image) {
                    $('#view_brand_image').attr('src', '/' + data.brand_image).show();
                } else {
                    $('#view_brand_image').hide();
                }
                  
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

            $.get(`/store/store/${id}`, function (data) {
                $('#edit_id').val(data.id);
                $('#edit_store_name').val(data.store_name);
                $('#edit_store_website').val(data.store_website);
               // $('#edit_status').prop('checked', data.status === 1 || data.status === '1'); 
                $('#edit_email').val(data.email);
                $('#edit_mobile').val(data.mobile);
                $('#edit_website').val(data.website);
                $('#edit_country').val(data.country);
                $('#edit_state').val(data.state);
                $('#edit_city').val(data.city);
                $('#edit_address').val(data.address);
                $('#edit_postcode').val(data.postcode);
                $('#edit_gst_no').val(data.gst_no);
                $('#editBrandForm').attr('action', `/store/store/${data.id}`);
                $('#edit-brand').modal('show');
            });
        });

        // Delete button handler
        $(document).on('click', '.delete-btn', function () {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This brand will be deleted!",
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