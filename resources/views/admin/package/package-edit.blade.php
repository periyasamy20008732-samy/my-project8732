@extends('admin.layouts.app')
@extends('admin.package.package-view')
@section('content')

		<!-- Edit Unit -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Unit</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="units.html">
									<div class="mb-3">
										<label class="form-label">Name</label>
										<input type="text" class="form-control" value="Piece">
									</div>
									<div class="mb-3">
										<label class="form-label">Short Name</label>
										<input type="text" class="form-control" value="PC">
									</div>
									<div class="mb-0">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" id="user3" class="check" checked="">
											<label for="user3" class="checktoggle"></label>
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


           <!-- jQuery -->
	<script src="{{asset('admin-assets/js/jquery-3.7.1.min.js')}}"></script>

	<!-- Feather Icon JS -->
	<script src="{{asset('admin-assets/js/feather.min.js')}}"></script>

	<!-- Slimscroll JS -->
	<script src="{{asset('admin-assets/js/jquery.slimscroll.min.js')}}"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{asset('admin-assets/js/bootstrap.bundle.min.js')}}"></script>

	<!-- Chart JS -->
	<script src="{{asset('admin-assets/plugins/apexchart/apexcharts.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/apexchart/chart-data.js')}}"></script>

	<!-- Sweetalert 2 -->
	<script src="{{asset('admin-assets/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/sweetalert/sweetalerts.min.js')}}"></script>

	<!-- Custom JS -->
	<script src="{{asset('admin-assets/js/theme-script.js')}}"></script>	
		<script src="{{asset('admin-assets/js/script.js')}}"></script>