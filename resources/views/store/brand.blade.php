@extends('store.layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="add-item d-flex">
				<div class="page-title">
					<h4>Brand</h4>
					<h6>Manage your Brands</h6>
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
				<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-brand"><i
						data-feather="plus-circle" class="me-2"></i>Add New Brand</a>
			</div>
		</div>

		<div class="card table-list-card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="brandTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Brand Name</th>
								<th>Brand Code</th>
								<th>Logo</th>
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
							<h4>Create Brand</h4>
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

						<form action="{{ route('store.brand.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="mb-3">
								<label class="form-label">Brand</label>
								<input type="text" class="form-control" name="brand_name">
							</div>
							<label class="form-label">Logo</label>
							<div class="new-employee-field">
								<div class="profile-pic-upload" style="text-align: center;">
									<div class="profile-pic" onclick="document.getElementById('image-input1').click();"
										style="width: 120px; height: 120px;  border: 2px dashed #ccc; display: flex; align-items: center; justify-content: center; overflow: hidden; background-color: #f0f0f0; cursor: pointer; position: relative;">
										<img id="preview1" src="#" alt="Preview"
											style="width: 100%; height: 100%; object-fit: cover; display: none;">
										<span id="placeholder1"
											style="font-size: 14px; color: #555; text-align: center;">
											<i data-feather="plus-circle" class="plus-down-add"
												style="display: block; font-size: 20px;"></i>
											Add Image
										</span>
									</div>
									<div class="mb-3">
										<div class="image-upload mb-0">
											<input type="file" id="image-input1" name="brand_image" accept="image/*"
												style="display: none;" onchange="previewImage1(this)">
											<div class="image-uploads">
												<h4 onclick="document.getElementById('image-input1').click();">
													Upload
													Image</h4>
											</div>
										</div>
									</div>
								</div>
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
							<div class="modal-footer-btn">
								<button type="button" class="btn btn-cancel me-2"
									data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-submit">Create Brand</button>
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

						<form method="POST" id="editBrandForm" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<!-- image Upload -->

							<div class="mb-3">
								<label class="form-label">Brand</label>
								<input type="text" class="form-control" id="edit_brand_name" name="brand_name">
							</div>
							<div class="new-employee-field">
								<div class="profile-pic-upload" style="text-align: center;">
									<div class="profile-pic" onclick="document.getElementById('image-input2').click();"
										style="width: 120px; height: 120px;  border: 2px dashed #ccc; display: flex; align-items: center; justify-content: center; overflow: hidden; background-color: #f0f0f0; cursor: pointer; position: relative;">
										<img id="edit_brand_image" src="#" alt="Preview"
											style="width: 100%; height: 100%; object-fit: cover; display: none;">
										<span id="placeholder2"
											style="font-size: 14px; color: #555; text-align: center;">
											<i data-feather="plus-circle" class="plus-down-add"
												style="display: block; font-size: 20px;"></i>
											Add Image
										</span>
									</div>
									<div class="mb-3">
										<div class="image-upload mb-0">
											<input type="file" id="image-input2" name="edit_brand_name" accept="image/*"
												style="display: none;" onchange="previewImage(this)">
											<div class="image-uploads">
												<h4 onclick="document.getElementById('image-input2').click();">Change
													Image</h4>
											</div>
										</div>
									</div>
								</div>
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
            ajax: "{{ route('store.brand.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'brand_name', name: 'brand_name' },
                { data: 'brand_code', name: 'brand_code' },
            {
            data: 'brand_image',
            name: 'brand_image',
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
              //  { data: 'description', name: 'description' },
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
                url: `/store/brand/${packageId}`,
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

            $.get(`/store/brand/${id}`, function (data) {
                $('#edit_id').val(data.id);
                $('#edit_brand_name').val(data.brand_name);
                $('#edit_brand_code').val(data.brand_code);
               // $('#edit_status').prop('checked', data.status === 1 || data.status === '1'); 
                $('#edit_status').prop('checked', data.status === 1 || data.status === '1'); 

					if (data.brand_image) {
					$('#edit_brand_image').attr('src', '/' + data.brand_image).show();
					$('#placeholder2').hide();
				} else {
					$('#edit_brand_image').hide();
					$('#placeholder2').show();
				}
                $('#editBrandForm').attr('action', `/store/brand/${data.id}`);
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