@extends('layouts.app')
@section('title')
Users
@endsection

@section('content')

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Users</h4>
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa-solid fa-chart-tree-map mr-2 fs-12"></i>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"> Users</a></li>
        </ol>
    </div>
</div>
<!-- END PAGE HEADER -->
@endsection
<div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;display: table-row;">
        <h3 class="card-title">
        <i class="fas fa-users-viewfinder mr-1"></i>
        
Manage Users
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item mr-1 mt-2">
                    <button class="btn btn-sm btn-primary" onclick="OpenUserModal()"><i class="fas fa-plus-circle"></i> Add New</button>
                </li>

            </ul>
        </div>
    </div>

    <div class="card-body table-responsive ">
        <table class=" responsive datatables-basic table border-top  table" id="example">
            <thead>
                <tr>
                <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <script>
    var dataTable;
    $(document).ready(function() {
        dataTable = $("#example").DataTable({
            "ajax": {
                url: "{{route('user.read')}}",
                type: "get",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            "columns": [{
                    data: "id"
                }, {
                    data: "name"
                },
                {
                    data: "email"
                },
                {
                    data: "phone"
                },
                {
                    data: "role.description"
                },
               
                 {"targets": 1,"data": "id",
                    "render": function(data, type, row, meta) {
                      return '<button class="fa-solid fa-pen table-action-buttons edit-action-button" onclick="editUser('+row.id+')" > </button><button class="fa-solid fa-trash table-action-buttons edit-action-button ml-2" onclick="User_delete('+row.id+')"></button>';
                    }
                },           
               
            ],
            "order": [
                [0, "desc"]
            ]
        });
    });

    function OpenUserModal(id) {
        $('#createUser').modal('toggle');
        $('#createUserModalLabel').text('Create User');
        $('#User_save_btn').text('Save User');
        document.forms["UserForm"].reset();
        // $('.needs-validation').removeClass('was-validated');


        
    }
    function editUser(id){
        $.ajax({
            type: "get",
            url: "{{url('/user/readById/')}}/" + id,
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status == "200") {
                    document.forms["UserForm"].reset();

            document.forms["UserForm"]["id"].value = response.data.id;
            document.forms["UserForm"]["name"].value = response.data.name;
            document.forms["UserForm"]["email"].value = response.data.email;
            document.forms["UserForm"]["phone"].value = response.data.phone;
            document.forms["UserForm"]["role_id"].value = response.data.role_id;

            $('#createUser').modal('toggle');
            $('#createUserModalLabel').text('Modify User');
            $('#User_save_btn').text('Save User');
        } else {
            responseInJS(response);
        }
            },
            error: function(e, f, g) {
                console.log(e, f, g);
            }
            });

    }

    
$(document).ready(function() {
  $('#UserForm').submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    var formData = $(this).serialize(); // Serialize the form data
    var form = document.forms["UserForm"];
    if (form.checkValidity() === true) {
    // Make an AJAX POST request
    $.ajax({
      url: "{{ route('user.store') }}",
      type: 'POST',
      data: formData,
      success: function(response) {
        console.log(response);
        if (response.status == "200") 
        {
                            $('#createUser').modal('toggle');
                            document.forms["UserForm"].reset();
                            toastr.success("Record Save Successfully");
                            dataTable.ajax.reload();
        } 
        else {responseInJS(response);}
      },
      error: function(error) {
        toastr.error("Error: " + error.responseJSON.message);
        console.log(error); // Handle any errors
      }
    });}
  });
});


function User_delete(id) {
                    $.ajax({
                        url: "{{url('/user/delete')}}/" + id,
                        type: "POST",
                        data: {
                            _token: "{{csrf_token()}}"
                        },
                        success: function(response) {
                            if (response.status == "200") {
                            dataTable.ajax.reload();

                                toastr.success("User Deleted Successfully");

                            } else {
                                responseInJS(response);
                            }
                        },
                        error: function(respose) {
                            toastr.error("Error: " + e.responseJSON.message);
                        }
                    });
                }
    </script>
</div>



<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create User
</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form id ="UserForm" class="needs-validation" novalidate>
                @csrf
                <input type="text" name="id" placeholder="" class="form-control" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Name </label>
                                <input type="text" name="name" placeholder="Name" class="form-control" required>
                                <div class="invalid-feedback">Name is Required.</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Email </label>
                                <input type="email" name="email" placeholder="Email" class="form-control" required>
                                <div class="invalid-feedback">Email is Required</div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Phone Number </label>
                                <input type="text" name="phone" placeholder="Phone Number" class="form-control" required>
                                <div class="invalid-feedback">Phone Number is Required</div>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Password. </label>
                                <input type="text" name="password" placeholder="Password." class="form-control" >
                                <div class="invalid-feedback">Password is required.</div>

                            </div>

                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                                <label> Role   </label>
                                <select id="role_id" name="role_id" class="form-control" required>
                                    @foreach($roles as $i)
                                    <option value="{{$i->id}}">{{$i->description}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Role  is Required.</div>
                        </div>
                        </div>

                <div class="modal-footer justify-content-between mt-3 ml-2">
                    <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Close</button>
                    <b-button variant="primary" v-if="!load" class="btn-lg " disabled>
                        <b-spinner small type="grow"></b-spinner>
                    </b-button>
                    <button type="submit"  class="btn btn-lg btn-primary  " id="User_save_btn">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection