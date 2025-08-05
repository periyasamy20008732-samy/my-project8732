@extends('admin.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Business Type</h4>
                        <h6>Manage your Business Type</h6>
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
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-bussiness-type"><i
                            data-feather="plus-circle" class="me-2"></i>Add New Bussiness Type</a>
                </div>
            </div>

            <div class="card table-list-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="bussinessTypeTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
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
    <div class="modal fade" id="add-bussiness-type">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header">
                            <div class="page-title">
                                <h4>Create Business Type</h4>
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

                            <form action="{{ route('admin.business-types.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="hidden" id="edit_id" name="id">
                                    <input type="text" class="form-control" name="name" required>
                                </div>


                                <div class="mb-0">
                                    <div
                                        class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                        <span class="status-label">Status</span>
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" id="user2" class="check" value="1">
                                        <label for="user2" class="checktoggle"></label>
                                    </div>
                                </div>


                                <div class="modal-footer-btn">
                                    <button type="button" class="btn btn-cancel me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit  -->
    <div class="modal fade" id="edit-business-types">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header">
                            <div class="page-title">
                                <h4>Edit Business Types</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">

                            <form method="POST" id="editBusinessTypeForm" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="edit_name" required>
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
                                    <button type="submit" class="btn btn-submit">Update</button>
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
                const table = $('#bussinessTypeTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.business-types.index') }}",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                    ]
                });

                // Redraw feather icons after DataTable refresh
                $('#bussinessTypeTable').on('draw.dt', function () {
                    feather.replace();
                });


                // Edit button handler
                $(document).on('click', '.edit-btn', function () {
                    const id = $(this).data('id');

                    $.get(`/admin/business-types/${id}`, function (data) {
                        $('#edit_id').val(data.id);
                        $('#edit_name').val(data.name);
                        $('#edit_status').prop('checked', data.status === 1 || data.status === '1');
                        $('#editBusinessTypeForm').attr('action', `/admin/business-types/${data.id}`);
                        $('#edit-business-types').modal('show');
                    });
                });

                // Delete button handler
                $(document).on('click', '.delete-btn', function () {
                    const id = $(this).data('id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This Bussiness Type will be deleted!",
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
                        text: '{{ session('
                    success ') }}',
                        timer: 2000,
                        showConfirmButton: false
                    });
                @endif
                                                                                                                                });
        </script>
    @endpush


@endsection