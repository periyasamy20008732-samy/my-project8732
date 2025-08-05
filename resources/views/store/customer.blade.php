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
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-customer"><i
                        data-feather="plus-circle" class="me-2"></i>Add New Customer</a>
            </div>
        </div>

        <div class="card table-list-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="customerTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Code</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- View Modal -->
<div class="modal fade" id="view-customer">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Customer Details</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3"><strong>Customer Name:</strong> <span id="view_customer_name"></span>
                                </div>
                                <div class="mb-3"><strong>Email:</strong> <span id="view_customer_email"></span></div>
                                <div class="mb-3"><strong>Phone:</strong> <span id="view_customer_mobile"></span></div>
                                <div class="mb-3"><strong>Country:</strong> <span id="view_customer_country"></span>
                                </div>
                                <div class="mb-3"><strong>City:</strong> <span id="view_customer_city"></span></div>
                                <div class="mb-3"><strong>State:</strong> <span id="view_customer_state"></span></div>
                                <div class="mb-3"><strong>Pincode:</strong> <span id="view_customer_postcode"></span>
                                </div>
                                <div class="mb-3"><strong>Status:</strong> <span id="view_customer_status"></span></div>
                                <div class="mb-3"><strong>Avatar:</strong><br>
                                    <img id="view_customer_avatar" src="#" alt="Avatar"
                                        style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer-btn">
                            <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End View Modal -->



<!-- Add Customer Modal -->
<div class="modal fade" id="add-customer">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Create Customer</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Avatar Upload -->
                            <div class="modal-title-head people-cust-avatar">
                                <h6>Avatar</h6>
                            </div>
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
                                            <input type="file" id="image-input1" name="attachment_1" accept="image/*"
                                                style="display: none;" onchange="previewImage1(this)">
                                            <div class="image-uploads">
                                                <h4 onclick="document.getElementById('image-input1').click();">Upload
                                                    Image</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Info -->
                            <div class="row">
                                <div class="col-lg-6 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" name="customer_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Country</label>
                                        <select id="edit_country" name="country_id" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="mobile" maxlength="12"
                                            minlength="12">
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
                                        <input type="text" class="form-control" name="postcode">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Description</label>
                                        <textarea name="desc ription" class="form-control mb-1"
                                            maxlength="60"></textarea>
                                        <p>Maximum 60 Characters</p>
                                    </div>
                                </div> --}}
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
<!-- Add Customer Modal -->

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
                        <form method="POST" id="editCustomerForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Avatar Upload -->
                            <div class="modal-title-head people-cust-avatar">
                                <h6>Avatar</h6>
                            </div>
                            <div class="new-employee-field">
                                <div class="profile-pic-upload" style="text-align: center;">
                                    <div class="profile-pic" onclick="document.getElementById('image-input2').click();"
                                        style="width: 120px; height: 120px;  border: 2px dashed #ccc; display: flex; align-items: center; justify-content: center; overflow: hidden; background-color: #f0f0f0; cursor: pointer; position: relative;">
                                        <img id="edit_image" src="#" alt="Preview"
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
                                            <input type="file" id="image-input2" name="attachment_2" accept="image/*"
                                                style="display: none;" onchange="previewImage(this)">
                                            <div class="image-uploads">
                                                <h4 onclick="document.getElementById('image-input2').click();">Change
                                                    Image</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Info -->
                            <div class="row">
                                <div class="col-lg-6 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" name="customer_name"
                                            id="edit_customer_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="edit_email">
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Country</label>
                                        <select id="edit_country" name="country_id" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="mobile" id="edit_mobile"
                                            maxlength="12" minlength="12">
                                    </div>
                                </div>

                                <div class="col-lg-4 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" name="city" id="edit_city">
                                    </div>
                                </div>
                                <div class="col-lg-4 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">State</label>
                                        <input type="text" class="form-control" name="state" id="edit_state">
                                    </div>
                                </div>
                                <div class="col-lg-4 pe-0">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Pincode</label>
                                        <input type="text" class="form-control" name="postcode" id="edit_postcode">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="mb-3 input-blocks">
                                        <label class="form-label">Description</label>
                                        <textarea name="desc ription" class="form-control mb-1"
                                            maxlength="60"></textarea>
                                        <p>Maximum 60 Characters</p>
                                    </div>
                                </div> --}}
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


@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    const table = $('#customerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.customer.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: null, name: 'combined_id', render: function(data, type, row) {return `${row.customer_code}${row.id}`;}},
            { data: 'customer_name', name: 'customer_name' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'mobile' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

	 $(document).on('click', '.view-btn', function () {
        let customerId = $(this).data('id');

        $.ajax({
            url: '/admin/customer/' + customerId,
            type: 'GET',
            success: function (data) {
                $('#view_customer_code').text(data.customer_code ?? '');
                $('#view_customer_name').text(data.customer_name ?? '');
                $('#view_customer_email').text(data.email ?? '');
                $('#view_customer_mobile').text(data.mobile ?? '');
                $('#view_customer_country').text(data.country_id ?? '');
                $('#view_customer_city').text(data.city ?? '');
                $('#view_customer_state').text(data.state ?? '');
                $('#view_customer_postcode').text(data.postcode ?? '');
                $('#view_customer_status').text(data.status ?? 'Active');
                if (data.attachment_1) {
                    $('#view_customer_avatar').attr('src', '/' + data.attachment_1).show();
                } else {
                    $('#view_customer_avatar').hide();
                }
                $('#view-customer').modal('show');
            }
        });
    });

 /* $(document).on('click', '.edit-btn', function () {
    const id = $(this).data('id');
    $.get(`/admin/customer/${id}`, function (data) {
        $('#edit_id').val(data.id);
        $('#edit_customer_name').val(data.customer_name);
        $('#edit_email').val(data.email);
        $('#edit_phone').val(data.mobile);
        $('#edit_address').val(data.address);
        $('#edit_city').val(data.city);
        $('#edit_country option').val(data.country);
        $('#edit_description').val(data.description);

        $('#edit_country option').each(function () {
            if ($(this).val().trim().toLowerCase() === data.country.trim().toLowerCase()) {
                $(this).prop('selected', true);
            }
        });

        if (data.attachment_1) {
            $('#edit_image').attr('src', '/' + data.attachment_1).show();
    $('#placeholder2').hide();
} else {
    $('#edit_image').hide();
    $('#placeholder2').show();
}

        // $('#edit_image').val(data.attachment_1);
        $('#editCustomerForm').attr('action', `/admin/customer/${data.id}`);
        $('#edit-customer').modal('show');*/
        $(document).on('click', '.edit-btn', function () {
    const id = $(this).data('id');
    $.get(`/admin/customer/${id}`, function (data) {
        $('#edit_id').val(data.id);
        $('#edit_customer_name').val(data.customer_name);
        $('#edit_email').val(data.email);
        $('#edit_mobile').val(data.mobile);
        $('#edit_city').val(data.city);
        $('#edit_state').val(data.state);
        $('#edit_postcode').val(data.postcode);
       // $('#edit_description').val(data.description);

        // ✅ Correct country selection
        const dbCountry = data.country ? data.country.trim().toLowerCase() : '';
        $('#edit_country option').each(function () {
            const optionVal = $(this).val().trim().toLowerCase();
            if (optionVal === dbCountry) {
                $(this).prop('selected', true);
                return false; // break loop
            }
        });

        // ✅ Show image preview if exists
        if (data.attachment_1) {
            $('#edit_image').attr('src', '/' + data.attachment_1).show();
            $('#placeholder2').hide();
        } else {
            $('#edit_image').hide();
            $('#placeholder2').show();
        }

        $('#editCustomerForm').attr('action', `/admin/customer/${data.id}`);
        $('#edit-customer').modal('show');
    });
});


    $(document).on('click', '.delete-btn', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This customer will be deleted!",
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

@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
@endif
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
        const preview = document.getElementById('edit_image');
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


<script>
    $('#customerTable').on('draw.dt', function () {
    feather.replace();
});
</script>


@endpush