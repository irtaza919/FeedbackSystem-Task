@extends("layouts.app")
@section('name') Comments @endsection
@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Comments</h4>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"> Comments</a></li>
        </ol>
    </div>
</div>
<!-- END PAGE HEADER -->
@endsection
@section('content')
<!-- Add Comments Modal -->
<div class="modal fade" id="add_comment_modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-name" id="createBookingModalLabel">Create Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form class="needs-validation row" id="add_comment_form" novalidate="">
                @csrf
                <input name="id" type="text" hidden>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <textarea style="width:100%;" class="tinymce_textarea" cols="20" name="title" id="title"
                                    placeholder="Write a comment..."
                                    aria-label="Write a comment..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <input name="description" type="text" class="form-control" placeholder="Enter Description" required="">
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">User id</label>
                            <input name="user_id" type="text" class="form-control" placeholder="User id" required="">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Feedback Id</label>
                            <input name="feedback_id" type="text" class="form-control" placeholder="Feedback Id" required="">
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
//comment
$("#add_comment_form").submit(function(e) {
    e.preventDefault();
    var form = document.forms["add_comment_form"];
    if (form.checkValidity() === true) {
        var id = document.forms["add_comment_form"]["id"].value;
        var description = document.forms["add_comment_form"]["description"].value;
        var user_id = document.forms["add_comment_form"]["user_id"].value;
        var feedback_id = document.forms["add_comment_form"]["feedback_id"].value;
        var title = encodeURIComponent(tinymce.get("title").getContent());

        $.ajax({
            type: "POST",
            url: "{{route('comment.store')}}",
            data: {
                id: id,
                title: title,
                description: description,
                user_id: user_id,
                feedback_id: feedback_id,
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status == "200") {
                    $("#add_comment_modal").modal("hide");
                    document.forms["add_comment_form"].reset();
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
// comment ReadById
function comment_read_by_id(id) {
    $.ajax({
        type: "GET",
        url: "{{ route('comment.readbyid', ['id' => '']) }}/" + id,
        dataType: "json",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            document.forms["add_comment_form"]["id"].value = response.id;
            document.forms["add_comment_form"]["title"].value = response.title;
            document.forms["add_comment_form"]["description"].value = response.Description;
            document.forms["add_comment_form"]["user_id"].value = response.user_id;
            document.forms["add_comment_form"]["feedback_id"].value = response.feedback_id;
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
            Comments
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item mr-1 mt-2">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add_comment_modal"><i class="fas fa-plus-circle"></i> Add New</button>
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
                    <th>Description</th>
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
            url: "{{route('comment.read')}}",
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
            data: "Description"
        },{
            data: "user_id"
        },{
            data: "feedback_id"
        },  {
            "defaultContent": '<a class="fa-solid fa-pen table-action-buttons edit-action-button" id="edit_comment" data-bs-toggle="modal" data-bs-target="#add_comment_modal" ></a>'
        }, ],
        "order": [
            [0, "desc"]
        ],


    });
    $('div.head-label').html('<h3 class="card-name mb-0">comment</h3>');
    $("#example tbody").on("click", "#edit_comment", function() {
        var data = dataTable.row($(this).parentsUntil("tr")).data();
        comment_read_by_id(data.id);
        $('.addEditText').text("Edit");
    });
});
</script>
</div>@endsection
