@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="content">
		<div class="page-header">
			<div class="add-item d-flex">
				<div class="page-title">
					<h4>Units</h4>
					<h6>Manage your Units</h6>
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
						data-feather="plus-circle" class="me-2"></i>Add Units</a>
			</div>
		</div>

		<div class="card table-list-card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="packageTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Unit Name</th>
								<th>Unit Value</th>
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
							<h4>Tax Details</h4>
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
<div class="modal fade" id="add-package">
	<div class="modal-dialog modal-dialog-centered custom-modal-two">
		<div class="modal-content">
			<div class="page-wrapper-new p-0">
				<div class="content">
					<div class="modal-header border-0 custom-modal-header">
						<div class="page-title">
							<h4>Create Unit</h4>
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

						<form action="{{ route('admin.unit.store') }}" method="POST">
							@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Tax</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<div class="mb-3">
										<label>Unit Name</label>
										<input type="text" name="unit_name" class="form-control" required />
									</div>
									<div class="mb-3">
										<label>Rate (%)</label>
										<input type="number" name="unit_value" class="form-control" required min="0" />
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Add Tax</button>
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
<div class="modal fade" id="edit-package">
	<div class="modal-dialog modal-dialog-centered custom-modal-two">
		<div class="modal-content">
			<div class="page-wrapper-new p-0">
				<div class="content">
					<div class="modal-header border-0 custom-modal-header">
						<div class="page-title">
							<h4>Edit Tax</h4>
						</div>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body custom-modal-body">

						<form method="POST" id="editPackageForm" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Tax</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<div class="mb-3">
										<label>Name</label>
										<input type="text" name="tax_name" id="edit_tax_name" class="form-control"
											required />
									</div>
									<div class="mb-3">
										<label>Name</label>
										<input type="date" name="validity_date" id="edit_validity_date"
											class="form-control" required />
									</div>
									<div class="mb-3">
										<label>Rate (%)</label>
										<input type="number" name="tax" id="edit_tax" class="form-control" required
											min="0" />
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Add Tax</button>
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
        const table = $('#packageTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.unit.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'unit_name', name: 'un it_name' },
                { data: 'unit_value', name: 'unit_value' },
              //  { data: 'description', name: 'description' },
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
                url: `/admin/unit/${packageId}`,
                type: 'GET',
                success: function (data) {
                    $('#view_unit_name').text(data.unit_name ?? '');
                    $('#view_unit_value').text(data.unit_value ?? '');
                   // $('#view_tax').text(data.tax ?? '');
                    $('#view_status').text(data.status == 1 ? 'Active' : 'Inactive');
                   /* $('#view_if_android').text(data.if_android == 1 ? 'Yes' : 'No');
                    $('#view_if_webpanel').text(data.if_webpanel == 1 ? 'Yes' : 'No');
                    $('#view_if_ios').text(data.if_ios == 1 ? 'Yes' : 'No');
                    $('#view_if_windows').text(data.if_windows == 1 ? 'Yes' : 'No');
                    $('#view_if_customerapp').text(data.if_customerapp == 1 ? 'Yes' : 'No');
                    $('#view_if_deliveryapp').text(data.if_deliveryapp == 1 ? 'Yes' : 'No');
                    $('#view_if_exicutiveapp').text(data.if_exicutiveapp == 1 ? 'Yes' : 'No');*/
                  
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

            $.get(`/admin/unit/${id}`, function (data) {
                $('#edit_id').val(data.id);
                $('#edit_unit_name').val(data.unit_name);
                $('#edit_unit_value').val(data.unit_value);
               // $('#edit_tax').val(data.tax);
                $('#edit_status').prop('checked', data.status === 1 || data.status === '1'); 
            //     $('#edit_if_webpanel').prop('checked', data.if_webpanel === 1 || data.if_webpanel === '1'); 
            //     $('#edit_if_android').prop('checked', data.if_android === 1 || data.if_android === '1'); 
            //     $('#edit_if_ios').prop('checked', data.if_ios === 1 || data.if_ios === '1'); 
            //     $('#edit_if_windows').prop('checked', data.if_windows === 1 || data.if_windows === '1'); 
            //     $('#edit_if_customerapp').prop('checked', data.if_customerapp === 1 || data.if_customerapp === '1'); 
            //     $('#edit_if_deliveryapp').prop('checked', data.if_deliveryapp === 1 || data.if_deliveryapp === '1'); 
            //     $('#edit_if_exicutiveapp').prop('checked', data.if_exicutiveapp === 1 || data.if_exicutiveapp === '1'); 
            //    // $('#edit_if_multistore').prop('checked', data.if_multistore === 1 || data.if_multistore === '1'); 
                $('#editPackageForm').attr('action', `/admin/tax/${data.id}`);
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