@extends('store.layouts.app')

@section('content')

<!--ADD Category Model-->
<div class="modal fade" id="add-category">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Create Category</h4>
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

                        <form action="{{ route('store.item.add_cate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" name="category_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category
                                    Blug</label>
                                <input type="text" class="form-control" name="slug">
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 input-blocks">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control mb-1" maxlength="60"></textarea>
                                    <p>Maximum 60 Characters</p>
                                </div>
                            </div>
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Create
                                    Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--END Category Add-->

<!-- ADD Brand Model-->
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

                        <form action="{{ route('store.item.add_brand') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="brand_name">
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
<!-- END Brand Model-->

<div class="modal fade" id="add-unit">
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

                        <form action="{{ route('store.item.add_unit') }}" method="POST">
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


<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>New Product</h4>
                    <h6>Create new product</h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li>
                    <div class="page-btn">
                        <a href="{{ route('store.items.index') }}" class="btn btn-secondary"><i
                                data-feather="arrow-left" class="me-2"></i>Back to Product</a>
                    </div>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                            data-feather="chevron-up" class="feather-chevron-up"></i></a>
                </li>
            </ul>
        </div>

        <!-- /add -->

        <form id="add_form" method="POST" action="{{ route('store.items.store') }}" enctype="multipart/form-data">

            @csrf
            <div class="card">
                <div class="card-body add-product pb-0">
                    <div class="accordion-card-one accordion" id="accordionExample">
                        <div class="accordion-item">
                            <div class="accordion-header" id="headingOne">
                                <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-controls="collapseOne">
                                    <div class="addproduct-icon">
                                        <h5><i data-feather="info" class="add-info"></i><span>Product Information</span>
                                        </h5>
                                        <a href="javascript:void(0);"><i data-feather="chevron-down"
                                                class="chevron-down-add"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="input-blocks add-product list">
                                                <label>Item Code</label>
                                                <input type="text" class="form-control list" name="Item_code"
                                                    placeholder="Enter Item Code">
                                                <button type="submit" class="btn btn-primaryadd">Generate Code</button>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="mb-3 add-product">
                                                <label class="form-label">Store</label>
                                                <select id="store_id" name="store_id" class="form-control">
                                                    <option value="">Select Store</option>
                                                    @foreach($stores as $store)
                                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="mb-3 add-product">
                                                <label class="form-label">Warehouse</label>
                                                <select id="warehouse_id" class="form-control mt-2" name="Warehouse">
                                                    <option value="">Select Warehouse</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="mb-3 add-product">
                                                <label class="form-label">Item Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Item Name"
                                                    name="item_name">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="mb-3 add-product">
                                                <label class="form-label">Slug</label>
                                                <input type="text" class="form-control" placeholder="Enter Item Slug"
                                                    name="slug">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="input-blocks add-product list">
                                                <label>SKU</label>
                                                <input type="text" class="form-control list" name="SKU"
                                                    placeholder="Enter SKU">
                                                <button type="submit" class="btn btn-primaryadd">Generate Code</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="addservice-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <div class="add-newplus">
                                                        <label class="form-label">Category</label>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#add-category"><i data-feather="plus-circle"
                                                                class="plus-down-add"></i><span>Add New</span></a>
                                                    </div>
                                                    <select name="category_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name
                                                            }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <label class="form-label">Sub Category</label>
                                                    <select class="form-control">
                                                        <option>Select Choose</option>
                                                        <option>Lenovo</option>
                                                        <option>Electronics</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <label class="form-label">HSN Code</label>
                                                    <input type="text" class="form-control" placeholder="Enter HSN Code"
                                                        name="HSN_code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="add-product-new">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <div class="add-newplus">
                                                        <label class="form-label">Brand</label>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#add-brand"><i data-feather="plus-circle"
                                                                class="plus-down-add"></i><span>Add New</span></a>
                                                    </div>
                                                    <select name="brand_id" class="form-control">
                                                        <option value="">Select Brand</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <div class="add-newplus">
                                                        <label class="form-label">Unit</label>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#add-unit"><i data-feather="plus-circle"
                                                                class="plus-down-add"></i><span>Add New</span></a>
                                                    </div>
                                                    <select name="Unit" class="form-control">
                                                        <option value="">Select Unit</option>
                                                        @foreach($units as $unit)
                                                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <label class="form-label">Seller Points</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Seller Points" name="seller_point">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="input-blocks add-product">
                                                <label>Discount Type</label>
                                                <select class="form-control" name="Discount_type">
                                                    <option>Choose</option>
                                                    <option>Percentage</option>
                                                    <option>Cash</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="input-blocks add-product">
                                                <label>Discount</label>
                                                <input type="text" class="form-control" name="Discount"
                                                    placeholder="Enter Discount">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="input-blocks">
                                                <label>Expire Date</label>
                                                <div class="input-groupicon calender-input">
                                                    <input type="date" class="form-control" placeholder="Choose Date"
                                                        name="expiredate">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="input-blocks add-product">
                                                <label>Barcode</label>
                                                <input type="text" class="form-control" name="Barcode"
                                                    placeholder="Enter Barcode">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="input-blocks add-product">
                                                <label>Alert Quantity</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Alert Quantity" name="Alert_Quantity">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editor -->
                                    <div class="col-lg-12">
                                        <div class="input-blocks summer-description-box transfer mb-3">
                                            <label>Description</label>
                                            <textarea class="form-control h-100" rows="5" name="Description"
                                                placeholder="Enter Item Description........."></textarea>
                                            <p class="mt-1">Maximum 60 Characters</p>
                                        </div>
                                    </div>
                                    <!-- /Editor -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-card-one accordion" id="accordionExample2">
                        <div class="accordion-item">
                            <div class="accordion-header" id="headingTwo">
                                <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                    aria-controls="collapseTwo">
                                    <div class="text-editor add-list">
                                        <div class="addproduct-icon list icon">
                                            <h5><i data-feather="life-buoy" class="add-info"></i><span>Pricing &
                                                    Stocks</span></h5>
                                            <a href="javascript:void(0);"><i data-feather="chevron-down"
                                                    class="chevron-down-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Quantity</label>
                                                        <input type="text" class="form-control" name="quantity"
                                                            placeholder="Enter Quantity">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Price</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Price of the item without tax" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>MRP</label>
                                                        <input type="text" class="form-control" placeholder="Enter MRP"
                                                            name="MRP">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Purchase Price</label>
                                                        <input type="text" placeholder="Enter Purchase Price"
                                                            name="Purchase_price" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Tax Type</label>
                                                        <select class="form-control" name="Tax_type">
                                                            <option>Choose</option>
                                                            <option value="12">Percentage</option>
                                                            <option value="23">Cash</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Tax Rate</label>
                                                        <input type="text" placeholder="Enter Tax Rate" name="Tax_rate">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Sales Price</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Sales Price" name="Sales_Price">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Opening Stock</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Opening Stock" name="Opening_Stock">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Profit margin</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Profit Margin" name="Profit_margin">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-card-one accordion" id="accordionExample3">
                                                <div class="accordion-item">
                                                    <div class="accordion-header" id="headingThree">
                                                        <div class="accordion-button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree"
                                                            aria-controls="collapseThree">
                                                            <div class="addproduct-icon list">
                                                                <h5><i data-feather="image"
                                                                        class="add-info"></i><span>Images</span></h5>
                                                                <a href="javascript:void(0);"><i
                                                                        data-feather="chevron-down"
                                                                        class="chevron-down-add"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapseThree" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingThree"
                                                        data-bs-parent="#accordionExample3">
                                                        <div class="accordion-body">
                                                            <div class="text-editor add-list add">
                                                                <div class="col-lg-12">
                                                                    <div class="add-choosen">
                                                                        <div class="input-blocks">
                                                                            <div class="image-upload">

                                                                                <input type="file" name="images[]"
                                                                                    multiple class="form-control">

                                                                                <div class="image-uploads">
                                                                                    <i data-feather="plus-circle"
                                                                                        class="plus-down-add me-0"></i>
                                                                                    <h4>Add Images</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="btn-addproduct mb-4">
                    <button type="button" class="btn btn-cancel me-2">Cancel</button>
                    <button type="submit" class="btn btn-submit">Save Item</button>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>



@push('scripts')
<script>
    $(document).ready(function () {
        // Initialize DataTable
        const table = $('#brandTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('store.items.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'item_image', name: 'item_image' },
                { data: 'SKU', name: 'SKU' },
                { data: 'category_id', name: 'category_id' },
                { data: 'brand_id', name: 'brand_id' },
                { data: 'Purchase_price', name: 'Purchase_price' },
                { data: 'Unit', name: 'Unit' },
                { data: 'quantity', name: 'quantity' },
                { data: 'user_id', name: 'user_id' },
             //   { data: 'status', name: 'status', orderable: false, searchable: false },
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
                url: `/store/items/${packageId}`,
                type: 'GET',
                success: function (data) {
                    $('#view_tax_name').text(data.tax_name ?? '');
                    $('#view_validity_date').text(data.validity_date ?? '');
                    $('#view_tax').text(data.tax ?? '');
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

            $.get(`/store/items/${id}`, function (data) {
                $('#edit_id').val(data.id);
                $('#edit_tax_name').val(data.tax_name);
                $('#edit_validity_date').val(data.validity_date);
                $('#edit_tax').val(data.tax);
                $('#edit_status').prop('checked', data.status === 1 || data.status === '1'); 
            //     $('#edit_if_webpanel').prop('checked', data.if_webpanel === 1 || data.if_webpanel === '1'); 
            //     $('#edit_if_android').prop('checked', data.if_android === 1 || data.if_android === '1'); 
            //     $('#edit_if_ios').prop('checked', data.if_ios === 1 || data.if_ios === '1'); 
            //     $('#edit_if_windows').prop('checked', data.if_windows === 1 || data.if_windows === '1'); 
            //     $('#edit_if_customerapp').prop('checked', data.if_customerapp === 1 || data.if_customerapp === '1'); 
            //     $('#edit_if_deliveryapp').prop('checked', data.if_deliveryapp === 1 || data.if_deliveryapp === '1'); 
            //     $('#edit_if_exicutiveapp').prop('checked', data.if_exicutiveapp === 1 || data.if_exicutiveapp === '1'); 
            //    // $('#edit_if_multistore').prop('checked', data.if_multistore === 1 || data.if_multistore === '1'); 
                $('#editPackageForm').attr('action', `/store/items/${data.id}`);
                $('#edit-package').modal('show');
            });
        });

        // Delete button handler
        $(document).on('click', '.delete-btn', function () {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This Item will be deleted!",
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
    document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.querySelector('.image-upload input[type="file"]');
    const addChoosen = document.querySelector('.add-choosen');

    imageInput.addEventListener("change", function () {
        const files = this.files;
        if (!files.length) return;

        [...files].forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageWrapper = document.createElement('div');
                imageWrapper.classList.add('phone-img');

                imageWrapper.innerHTML = `
                    <img src="${e.target.result}" alt="image" width="100px" height="100px">
                    <a href="javascript:void(0);">
                        <i data-feather="x" class="x-square-add remove-product"></i>
                    </a>
                `;

                addChoosen.appendChild(imageWrapper);

                // Reinitialize feather icons
                if (window.feather) {
                    feather.replace();
                }

                // Remove image on click
                imageWrapper.querySelector('.remove-product').addEventListener('click', function () {
                    imageWrapper.remove();
                });
            };
            reader.readAsDataURL(file);
        });

        // Clear input so reselecting same files again works
        this.value = "";
    });
});
</script>

<script>
    $(document).ready(function () {
    $('#store_id').on('change', function () {
        var store_id = $(this).val();
        $('#warehouse_id').html('<option value="">Loading...</option>');

        if (store_id !== '') {
            $.ajax({
                url: "{{ route('store.item.get_warehouse') }}", // ✅ fixed route name
                type: "GET",
                data: { store_id: store_id },
                success: function (response) {
                    $('#warehouse_id').html('<option value="">Select Warehouse</option>');
                    $.each(response, function (key, warehouse) {
                        $('#warehouse_id').append('<option value="' + warehouse.id + '">' + warehouse.warehouse_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    alert('Something went wrong!');
                }
            });
        } else {
            $('#warehouse_id').html('<option value="">Select Warehouse</option>');
        }
    });
});
</script>





@endpush


@endsection