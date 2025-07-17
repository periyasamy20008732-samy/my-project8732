
@extends('admin.layouts.app')
@section('content')
  

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Customer List</h4>
								<h6>Manage your Customer</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Customer</a>
						</div>
					</div>
					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body">
							<div class="table-top">
								<div class="search-set">
									<div class="search-input">
										<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
									</div>
								</div>
								<div class="search-path">
									<div class="d-flex align-items-center">
										<a class="btn btn-filter" id="filter_search">
											<i data-feather="filter" class="filter-icon"></i>
											<span><img src="assets/img/icons/closes.svg" alt="img"></span>
										</a>
										
									</div>
								</div>
								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
									<select class="select">
										<option>Sort by Date</option>
										<option>Newest</option>
										<option>Oldest</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
							<div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="user" class="info-img"></i>
												<select class="select">
													<option>Choose Customer Name</option>
													<option>Benjamin</option>
													<option>Ellen</option>
													<option>Freda</option>
													<option>Kaitlin</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="globe" class="info-img"></i>
												<select class="select">
													<option>Choose Country</option>
													<option>India</option>
													<option>USA</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12 ms-auto">
											<div class="input-blocks">
												<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Filter -->
							<div class="table-responsive">
								<table class="table  datanew">
									<thead>
										<tr>
											<th class="no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select-all">
													<span class="checkmarks"></span>
												</label>
											</th>
											<th>Customer  Name</th>
											<th>Code</th>
											
											<th>Email</th>
											<th>Phone</th>
											<th>Country</th>
											<th class="no-sort">Action</th>
										</tr>
									</thead>
									<tbody>
									  @foreach($customer as $customers) 
										<tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-23.jpg" alt="product">
													</a>
													<a href="javascript:void(0);">{{  $customers->customer_name }}</a>
												</div>
											</td>
											<td>
												201
											</td>
											<td>{{ $customers->email }}</td>
											<td>{{ $customers->id }}</td>
											<td>{{ $customers->country->name??'' }}</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2"   href="{{ route('admin.customers.edit', $customers->id) }}"data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
														
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	
										 @endforeach
                                     
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!-- Add Customer -->
		<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Customer</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								{{-- <form action="customers.html"> --}}
									<form action="{{ route(name: 'admin.customers.store') }}" method="POST">
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
												<input type="text"  name="name" value="{{ old('name') }}"class="form-control">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" name="email" class="form-control">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="input-blocks">
												<label class="mb-2">Phone</label>
												<input class="form-control form-control-lg group_formcontrol" id="phone" name="phone" type="text">
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
		<!-- /Add Customer -->

        <!-- Edit Customer -->
		<div class="modal fade" id="edit-units">
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
								
							
								@foreach($customer as $customers)
    <form action="{{ route('admin.customers.update', $customers->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

										 
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
												<input type="text" class="form-control" name="name" value="{{ $customers->name }}">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" value="{{ $customers->email }}">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="input-blocks">
												<label class="mb-2">Phone</label>
												<input class="form-control form-control-lg group_formcontrol" id="phone" name="phone2" type="text">
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
									@endforeach
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Edit Customer -->
		<div class="customizer-links" id="setdata">
			<ul class="sticky-sidebar">
				<li class="sidebar-icons">
					<a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left"
						data-bs-original-title="Theme">
						<i data-feather="settings" class="feather-five"></i>
					</a>
				</li>
			</ul>
		</div>

</html>