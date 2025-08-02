@extends('admin.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>Customers</h4>
                    <h6>Manage your Customers</h6>
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
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-customer"><i data-feather="plus-circle" class="me-2"></i>Add New Customer</a>
            </div>
        </div>

        <div class="card table-list-card">
            <div class="card-body">
                <div class="table-responsive">
                         <table class="table" id="customerTable">
                        <thead>
                            <tr>
                                <th>#</th>
                
                               <th>Customer Name</th>
								<th>Customer Code</th>
								<th>Email</th>
								<th>Phone</th>

								<th class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Customer Modal -->
<div class="modal fade" id="add-customer">
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

                        <form action="{{ route('admin.customer.store') }}" method="POST">
                            @csrf
                                  <div class="modal-title-head people-cust-avatar">
										<h6>Avatar</h6>
									</div>
									<div class="new-employee-field">
										<div class="profile-pic-upload">
											<div class="profile-pic">
												<span><i data-feather="plus-circle" class="plus-down-add"></i> Add Image</span>
											</div>
											<div class="mb-3">
												<div class="image-upload mb-0">
													<input type="file">
													<div class="image-uploads">
														<h4>Change Image</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Customer Name</label>
												<input type="text" class="form-control" name="customer_name">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="text" class="form-control" name="customer_code">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="input-blocks">
												<label class="mb-2">Phone</label>
												<input class="form-control form-control-lg group_formcontrol" name="phone" type="text">
											</div>
										</div>
										<div class="col-lg-12 pe-0">
											<div class="mb-3">
												<label class="form-label">Address</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 pe-0">
											<div class="mb-3">
												<label class="form-label">City</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 pe-0">
											<div class="mb-3">
												<label class="form-label">Country</label>
												<select class="select">
													<option>Choose</option>
													<option>United Kingdom</option>
													<option>United State</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3 input-blocks">
												<label class="form-label">Descriptions</label>
												<textarea class="form-control mb-1"></textarea>
												<p>Maximum 60 Characters</p>
											</div>											
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

  <!-- Edit Customer -->
		
            <div class="modal fade" id="edit-customer">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Customer</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="customers.html">
									<div class="modal-title-head people-cust-avatar">
										<h6>Avatar</h6>
									</div>
									<div class="new-employee-field">
										<div class="profile-pic-upload">
											<div class="profile-pic people-profile-pic">                                                
												<img src="assets/img/profiles/profile.png" alt="Img">
												<a href="#"><i data-feather="x-square" class="x-square-add"></i></a>                                          
											</div>
											<div class="mb-3">
												<div class="image-upload mb-0">
													<input type="file">
													<div class="image-uploads">
														<h4>Change Image</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Customer Name</label>
												<input type="text" class="form-control" value="Thomas">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" value="thomas@example.com">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="input-blocks">
												<label class="mb-2">Phone</label>
												<input class="form-control form-control-lg group_formcontrol" id="phone2" name="phone2" type="text">
											</div>
										</div>
										<div class="col-lg-12 pe-0">
											<div class="mb-3">
												<label class="form-label">Address</label>
												<input type="text" class="form-control" value="Budapester Strasse 2027259 ">
											</div>
										</div>
										<div class="col-lg-6 pe-0">
											<div class="mb-3">
												<label class="form-label">City</label>											
												<select class="select">
													<option>Varrel</option>
													<option>Varrel</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 pe-0">
											<div class="mb-3">
												<label class="form-label">Country</label>
												<select class="select">
													<option>Germany</option>
													<option>United State</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-0 input-blocks">
												<label class="form-label">Descriptions</label>
												<textarea class="form-control mb-1"></textarea>
												<p>Maximum 60 Characters</p>
											</div>											
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
		<!-- /Edit Customer -->

@push('scripts')
<script>
  $(document).ready(function() {
    $('#customerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.customer.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'customer_name', name: 'customer_name' },
            { data: 'mobile', name: 'mobile' },
            { data: 'city', name: 'city' },
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
