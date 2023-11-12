@extends("layouts.app")
@section('name') Product @endsection
@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Product</h4>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"> Product</a></li>
        </ol>
    </div>
</div>
<!-- END PAGE HEADER -->
@endsection
@section('content')
<!-- Add Product Modal -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-name" id="createBookingModalLabel">Create Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form class="needs-validation row" id="add_product_form" novalidate="">
                @csrf
                <input name="id" type="text" hidden>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" placeholder="Title" required="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Price</label>
                            <input name="price" type="text" class="form-control" placeholder="Enter Price" required="">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <input name="img" id="img" type="file" class=""
                                placeholder="Select Image">
                            <div class="invalid-feedback">Image is Required.</div>
                        </div>
                    </div>



                    <div class="modal-footer justify-content-between mt-3 ml-2">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <b-button variant="primary" v-if="!load" class="btn-lg " disabled>
                            <b-spinner small type="grow"></b-spinner>
                        </b-button>
                        <button type="submit" class="btn btn-lg btn-primary  " id="">Save </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
//product
$("#add_product_form").submit(function(e) {
    e.preventDefault();
    var form = document.forms["add_product_form"];
    if (form.checkValidity() === true) {
        var id = document.forms["add_product_form"]["id"].value;
        var title = document.forms["add_product_form"]["title"].value;
        var price = document.forms["add_product_form"]["price"].value;
        var file = $('#img')[0].files;
        if (file.length > 0) {
            var formData = new FormData();
            formData.append('image', file[0]);
            formData.append('id', id);
            formData.append('price', price);
            formData.append('title', title);
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
            type: "POST",
            url: "{{route('product.store')}}",
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == "200") {
                    $("#add_product_modal").modal("hide");
                    document.forms["add_product_form"].reset();
                    toastr.success("Record Save Successfully");
                    dataTable.ajax.reload();
                } else {
                    toastr.error("Operation Failed");
                }
            },
            error: function(e, f, g) {
                toastr.error("Error: " + e.responseJSON.message);
            }
        });

        }


    } else {
        console.log("Not ok");
    }
});
</script>

<script>
// product ReadById
function product_read_by_id(id) {
    $.ajax({
        type: "GET",
        url: "{{ route('product.readbyid', ['id' => '']) }}/" + id,
        dataType: "json",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            document.forms["add_product_form"]["id"].value = response.id;
            document.forms["add_product_form"]["title"].value = response.title;
            document.forms["add_product_form"]["price"].value = response.price;

        },
        error: function(e, f, g) {
            console.log(e, f, g);
        }
    });
}
</script>
<div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;display: table-row;">

        <h3 class="card-name">
            <i class="icofont-hat-alt mr-1"></i>
            Product
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item mr-1 mt-2">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add_product_modal"><i class="fas fa-plus-circle"></i> Add New</button>
                </li>

            </ul>
        </div>
    </div>
    <div class="card-body table-responsive ">
        <table class=" responsive datatables-basic table border-top  table" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<script>
var dataTable;
$(document).ready(function() {
    dataTable = $("#example").DataTable({
        "ajax": {
            url: "{{route('product.read')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}"
            }
        },
        "columns": [{
            data: "id"
        }, {
            data: "title"
        }, {
            data: "price"
        }, {
                        render: function(data, type, row) {
                            return '<img src="{{ asset('assets/') }}/' + row.image +
                                '" alt="Product Image" width="100" />';
                        }
                    },
 {
            "defaultContent": '<a class="fa-solid fa-pen table-action-buttons edit-action-button" id="edit_product" data-bs-toggle="modal" data-bs-target="#add_product_modal" ></a>'
        }, ],
        "order": [
            [0, "desc"]
        ],


    });
    $('div.head-label').html('<h3 class="card-name mb-0">product</h3>');
    $("#example tbody").on("click", "#edit_product", function() {
        var data = dataTable.row($(this).parentsUntil("tr")).data();
        product_read_by_id(data.id);
        $('.addEditText').text("Edit");
    });
});
</script>
</div>@endsection
