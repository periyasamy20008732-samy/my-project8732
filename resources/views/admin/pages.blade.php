@extends('admin.layouts.app')

@section('content')



    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Pages</h4>
                        <h6>Manage your Pages</h6>
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
                    <a href="{{ route('admin.addpage') }}" class="btn btn-added"><i data-feather="plus-circle"
                            class="me-2"></i>Add New page</a>
                </div>
            </div>

            <div class="card table-list-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="pagesTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Option</th>
                                    <th>Show in app menu</th>
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




    @push('scripts')
        <script>
            $(document).ready(function () {
                // Initialize DataTable
                const table = $('#pagesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.pages.index') }}",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'option',
                        name: 'option'
                    },

                    {
                        data: 'showappmenu',
                        name: 'showapp_menu',
                        orderable: false,
                        searchable: false
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
                $('#pagesTable').on('draw.dt', function () {
                    feather.replace();
                });



                // Delete button handler
                $(document).on('click', '.delete-btn', function () {
                    const id = $(this).data('id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This page will be deleted!",
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