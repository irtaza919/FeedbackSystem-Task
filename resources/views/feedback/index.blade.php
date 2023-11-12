@extends("layouts.app")
@section('name') Feedback @endsection
@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Feedback</h4>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"> Feedback</a></li>
        </ol>
    </div>
</div>
<!-- END PAGE HEADER -->
@endsection
@section('content')
<!-- Add Feedback Modal -->
<div class="modal fade" id="add_feedback_modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-name" id="createBookingModalLabel">Create Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form class="needs-validation row" id="add_feedback_form" novalidate="">
                @csrf
                <input name="id" type="text" hidden>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" placeholder="Title" required="">
                            <div class="invalid-feedback"> Title is Required.</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <input name="category" type="text" class="form-control" placeholder="Enter Category" required="">
                            <div class="invalid-feedback"> Category is Required.</div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Vote Count</label>
                            <input name="vote_count" type="text" class="form-control" placeholder="Vote Count" required="">
                            <div class="invalid-feedback"> Vote Count is Required.</div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">User id</label>
                            <input name="user_id" type="text" class="form-control" placeholder="User id" required="">
                            <div class="invalid-feedback"> User id is Required.</div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Product Id</label>
                            <input name="product_id" type="text" class="form-control" placeholder="Product Id" required="">
                            <div class="invalid-feedback"> Product Id is Required.</div>
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
//feedback
$("#add_feedback_form").submit(function(e) {
    e.preventDefault();
    var form = document.forms["add_feedback_form"];
    if (form.checkValidity() === true) {
        var id = document.forms["add_feedback_form"]["id"].value;
        var title = document.forms["add_feedback_form"]["title"].value;
        var category = document.forms["add_feedback_form"]["category"].value;
        var vote_count = document.forms["add_feedback_form"]["vote_count"].value;
        var user_id = document.forms["add_feedback_form"]["user_id"].value;
        var product_id = document.forms["add_feedback_form"]["product_id"].value;

        $.ajax({
            type: "POST",
            url: "{{route('feedback.store')}}",
            data: {
                id: id,
                title: title,
                category: category,
                vote_count: vote_count,
                user_id: user_id,
                product_id: product_id,
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status == "200") {
                    $("#add_feedback_modal").modal("hide");
                    document.forms["add_feedback_form"].reset();
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
    } else {
        console.log("Not ok");
    }
});
</script>

<script>
// feedback ReadById
function feedback_read_by_id(id) {
    $.ajax({
        type: "GET",
        url: "{{ route('feedback.readbyid', ['id' => '']) }}/" + id,
        dataType: "json",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            document.forms["add_feedback_form"]["id"].value = response.id;
            document.forms["add_feedback_form"]["title"].value = response.title;
            document.forms["add_feedback_form"]["category"].value = response.category;
            document.forms["add_feedback_form"]["vote_count"].value = response.vote_count;
            document.forms["add_feedback_form"]["user_id"].value = response.user_id;
            document.forms["add_feedback_form"]["product_id"].value = response.product_id;
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
            Feedback
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item mr-1 mt-2">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add_feedback_modal"><i class="fas fa-plus-circle"></i> Add New</button>
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
                    <th>Category</th>
                    <th>Vote Count</th>
                    <th>User</th>
                    <th>Product</th>
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
            url: "{{route('feedback.read')}}",
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
            data: "category"
        },{
            data: "vote_count"
        },{
            data: "user_id"
        },{
            data: "product_id"
        },  {
            "defaultContent": '<a class="fa-solid fa-pen table-action-buttons edit-action-button" id="edit_feedback" data-bs-toggle="modal" data-bs-target="#add_feedback_modal" ></a>'
        }, ],
        "order": [
            [0, "desc"]
        ],


    });
    $('div.head-label').html('<h3 class="card-name mb-0">feedback</h3>');
    $("#example tbody").on("click", "#edit_feedback", function() {
        var data = dataTable.row($(this).parentsUntil("tr")).data();
        feedback_read_by_id(data.id);
        $('.addEditText').text("Edit");
    });
});
</script>
</div>@endsection
