@extends("layouts.app")
@section('title')
Roles
@endsection

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Roles</h4>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"> Roles</a></li>
        </ol>
    </div>
</div>
<!-- END PAGE HEADER -->
@endsection
<!-- Add Roles Modal -->

<div class="modal fade" id="add_roles_modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBookingModalLabel">Create Roles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form class="needs-validation row" id="add_roles_form" novalidate="">
                @csrf
                <input name="id" type="text" hidden>
                <div class="modal-body">
                   
                    <div class="col-md-12">
                            <div class="form-group">
                            <label class="form-label">Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Title" required="">
                        <div class="invalid-feedback"> Se requiere título.</div>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <input name="description" type="text" class="form-control" placeholder="Description" required="">
                        <div class="invalid-feedback"> Description Es requerido.</div>
                    </div>



                <div class="modal-footer justify-content-between mt-3 ml-2">
                    <button type="button" class="btn  btn-danger " data-bs-dismiss="modal">Close</button>
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
<div class="modal fade" id="assign_module_Modal" tabindex="-1" role="dialog" aria-labelledby="createBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBookingModalLabel">Manage Permissions for <span id="rolenameformodule"></span> Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form name="add_component_permission" id="add_component_permission">
                        <input class="btn " name="role_id" value="" hidden />

                        <div class="col-12">
                            <!-- Permission table -->
                            <div class="table-responsive">
                                <table class="table table-flush-spacing" id="assign_premission_table">

                                </table>
                            </div>
                            <!-- Permission table -->
                        </div>
                        <div class="modal-footer justify-content-between mt-3 ml-2">
                    <button type="button" class="btn  btn-danger " data-bs-dismiss="modal">Close</button>
                    <b-button variant="primary" v-if="!load" class="btn-lg " disabled>
                        <b-spinner small type="grow"></b-spinner>
                    </b-button>

                    <button type="button" class="btn btn-lg btn-primary  "  onclick="assignpermission()" id="">Save </button>
                </div>
                </div>

                    </form>
        </div>
    </div>
</div>
@section("content")

<!-- Assign Module End -->


<script>
//Roles
$("#add_roles_form").submit(function(e) {
    e.preventDefault();
    var form = document.forms["add_roles_form"];
    if (form.checkValidity() === true) {
        var id = document.forms["add_roles_form"]["id"].value;
        var title = document.forms["add_roles_form"]["title"].value;
        var description = document.forms["add_roles_form"]["description"].value;

        $.ajax({
            type: "GET",
            url: "{{route('roles/store')}}",
            data: {
                id: id,
                title: title,
                description: description,
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status == "200") {
                    $("#add_roles_modal").modal("hide");
                    document.forms["add_roles_form"].reset();
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
// Roles ReadById 
function roles_read_by_id(id) {
    $.ajax({
        type: "GET",
        url: "{{url('roles/readbyid/')}}/" + id,
        dataType: "json",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            document.forms["add_roles_form"]["id"].value = response.id;
            document.forms["add_roles_form"]["title"].value = response.title;
            document.forms["add_roles_form"]["description"].value = response.description;
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
            <i class="fas fa-people-roof mr-1"></i>
             Roles
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item mr-1 mt-2">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add_roles_modal"><i class="fas fa-plus-circle"></i> Add New</button>
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
                    <th>Action
</th>
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
            url: "{{route('roles/read')}}",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            }
        },
        "columns": [{
            data: "id"
        }, {
            data: "title"
        }, {
            data: "description"
        }, {
            "defaultContent": '<a id="edit_roles" data-bs-toggle="modal" data-bs-target="#add_roles_modal" class="fa-solid fa-pen table-action-buttons edit-action-button"></a><a  id="assign_module" data-bs-toggle="modal" data-bs-target="#assign_module_Modal" class="table-action-buttons edit-action-button ml-3 fa fa-key" >  </a>'
        }, ],
        "order": [
            [0, "desc"]
        ]

    });
    $('div.head-label').html('<h3 class="card-title mb-0">Roles</h3>');
    $("#example tbody").on("click", "#edit_roles", function() {
        var data = dataTable.row($(this).parentsUntil("tr")).data();
        roles_read_by_id(data.id);
        $('.addEditText').text("Edit");
    });
    $('#example tbody').on('click', '#assign_module', function() {
        var data = dataTable.row($(this).parentsUntil('tr')).data();
        // alert( JSON.stringify(data) );
        assign_module_permissions(data.id, data.title);
    });
});
</script>
<script>
function getpermissionArray() {
    var myTab = document.getElementById('assign_premission_table');
    var arrValues = new Array();
    // loop through each row of the table.
    for (row = 1; row < myTab.rows.length; row++) {
        var row_value = "";
        if (myTab.rows.item(row).getAttribute('RolePermission') == 'custom-row') {
            // loop through each cell in a row.
            for (c = 0; c < myTab.rows[row].cells.length; c++) {
                var element = myTab.rows.item(row).cells[c];
                if (element.childNodes[0].getAttribute('RolePermission') == 'custom-role') {
                    if (myTab.rows[row].cells.length - 1 == c) {
                        row_value = row_value + '"' + element.childNodes[0].name + '":"' + element.childNodes[0].value + '"';
                    } else {
                        row_value = row_value + '"' + element.childNodes[0].name + '":"' + element.childNodes[0].value + '",';
                    }
                }
            }
            arrValues.push("{" + row_value + "}");
        }
    }
    var ItemsArray = '{"data": [' + arrValues + ']}';
    // The final output.
    //document.getElementById('output').innerHTML = ItemsArray;
    //alert(ItemsArray);
    return ItemsArray;
    //console.log (arrValues);   // you can see the array values in your browsers console window. Thanks :-) 
}
</script>
</div>@endsection