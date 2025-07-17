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