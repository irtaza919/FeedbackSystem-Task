@extends("layouts.app")
@section('title') Location @endsection

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Location</h4>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"> Location</a></li>
        </ol>
    </div>
</div>
<!-- END PAGE HEADER -->
@endsection
@section('content')
<!-- Add Location Modal -->
<div class="modal fade" id="add_location_modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBookingModalLabel">Create Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form class="needs-validation row" id="add_location_form" novalidate="">
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
//location
$("#add_location_form").submit(function(e) {
    e.preventDefault();
    var form = document.forms["add_location_form"];
    if (form.checkValidity() === true) {
        var id = document.forms["add_location_form"]["id"].value;
        var title = document.forms["add_location_form"]["title"].value;

        $.ajax({
            type: "GET",
            url: "{{route('location.store')}}",
            data: {
                id: id,
                title: title,
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status == "200") {
                    $("#add_location_modal").modal("hide");
                    document.forms["add_location_form"].reset();
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
// location ReadById 
function location_read_by_id(id) {
    $.ajax({
        type: "GET",
        url: "{{ route('location.readbyid', ['id' => '']) }}/" + id,
        dataType: "json",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            document.forms["add_location_form"]["id"].value = response.id;
            document.forms["add_location_form"]["title"].value = response.title;
        },
        error: function(e, f, g) {
            console.log(e, f, g);
        }
    });
}
</script>
<div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;display: table-row;">
        
        <h3 class="card-title">
            <i class="fas fa-location-dot mr-1"></i>
            Location
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item mr-1 mt-2">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add_location_modal"><i class="fas fa-plus-circle"></i> Add New</button>
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
            url: "{{route('location.read')}}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            }
        },
        "columns": [{
            data: "id"
        }, {
            data: "title"
        },  {
            "defaultContent": '<a class="fa-solid fa-pen table-action-buttons edit-action-button" id="edit_location" data-bs-toggle="modal" data-bs-target="#add_location_modal" ></a>'
        }, ],
        "order": [
            [0, "desc"]
        ],
       

    });
    $('div.head-label').html('<h3 class="card-title mb-0">location</h3>');
    $("#example tbody").on("click", "#edit_location", function() {
        var data = dataTable.row($(this).parentsUntil("tr")).data();
        location_read_by_id(data.id);
        $('.addEditText').text("Edit");
    });
});
</script>
</div>@endsection