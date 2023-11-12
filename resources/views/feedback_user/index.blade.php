@extends("layout_user.layout")
@section('name') Comments @endsection
@section('page-header')
 <!-- PAGE HEADER --> <div class="page-header mt-5-7"> <div class="page-leftheader">
<!-- <h4 class="page-title mb-0">Comments</h4> -->
</div>
</div>
<!-- END PAGE HEADER -->
@endsection
@section('content')
<h1>{{$products['title']}}</h1>
<img src="{{ asset('assets/' . $products['image']) }}" alt="" height="300px">
<form id="add_feedback_form" method="post">
    <input type="number" name="id" hidden>
    <input type="number" name="product_id" value="{{$products['id']}}" hidden>
    @csrf
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
              <label for="title" class="form-label"> Title</label>
              <input type="text" autocomplete="off" id="title" name="title" class="form-control">
              <div class="invalid-feedback">Please Enter Title Here</div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
              <label for="category" class="form-label"> Category</label>
              <input type="text" autocomplete="off" id="category" name="category" class="form-control">
              <div class="invalid-feedback">Please Enter Category Here</div>
            </div>
        </div>
        <div class="col-md-2 mt-6" style="align-item: center;">
            <input type="submit" value="Submit Feedback" class="btn btn-danger">
        </div>
    </div>
    
</form>
<h1 class="mt-5">Feedbacks List</h1>
<div id="feedbacklist"></div>
<script>
    var productData = @json($products);
    var product_id = productData.id;
     function readfeedbacks(page = "") {
    $.ajax({
        url: "{{route('read_feedbacks')}}",
        type: "POST",
        data: {
            page: page,
            product_id:product_id,
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            feedbacklist = response.data.data;
            $("#feedbacklist").empty();
            var html = "";
            html = html +'<table class=" responsive  table border-top  table-sm" id="example">';
            html = html +'<thead>';
                html = html +'<tr>';
                    html = html +' <th>User</th>';
                    html = html +' <th>Title</th>';
                    html = html +'<th>Category</th>';
                    html = html +'<th>Vote Count</th>';
                    html = html +'<th>Action</th>';
                    html = html +'</tr>';
                    html = html +'</thead>';
                    html = html +'<tbody>';
                    for (var i = 0; i < feedbacklist.length; i++) {
                            html = html + "<tr>";
                            html = html +'<td><img src="/img/users/avatar.jpg" alt="User Profile Image" style="width: 40px; height: 40px; border-radius: 50px; margin-right: 10px;"><strong>' + feedbacklist[i].user.name + '</strong></td>';
                            html = html +'<td>' + feedbacklist[i].title + '</td>';
                            html = html +'<td>' + feedbacklist[i].category + '</td>';
                            html = html +'<td>' + feedbacklist[i].vote_count + '</td>';
                            html = html +'<td style="padding:10px"><a href="{{route("comments", ["id" => ""]) }}/'+feedbacklist[i].id+'" class="btn btn-danger">Comments</a><button class="btn btn-success" onclick="votefeedback('+feedbacklist[i].id+')">Give Vote<span class="fa-solid fa-people-roof ml-2"></span></button></td>';
                            html = html + "</tr>";
                        }
                    html = html +'</tbody> </table>';
                    html = html + makepaginationthroughajax(response.data);
                        
                    $("#feedbacklist").empty();
                    $("#feedbacklist").append(html);
        },
        error: function(e, f, g) {

            toastr.error("Error: " + e.responseJSON.message);
        }
    });
}
readfeedbacks();


function votefeedback(id){
    // alert(id);
    $.ajax({
        url: "{{route('give_vote_feedbacks')}}",
        type: "POST",
        data: {
            id: id,
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            if (response.status == "200") {
                        // getcomments(response.data);
                        readfeedbacks();
                        // document.forms["add_feedback_form"].reset();
                    } else {
                        toastr.error("Operation Failed");
                    }
        },
        error: function(e, f, g) {

            toastr.error("Error: " + e.responseJSON.message);
        }
    });
}
</script>
<script>
    $("#add_feedback_form").submit(function (e) {
        e.preventDefault();
        var form = document.forms["add_feedback_form"];
        if (form.checkValidity() === true) {
            var id = document.forms["add_feedback_form"]["id"].value;
            var product_id = document.forms["add_feedback_form"]["product_id"].value;
            var title = document.forms["add_feedback_form"]["title"].value;
            var category = document.forms["add_feedback_form"]["category"].value;
            
            $.ajax({
                type: "POST",
                url: "{{route('store_feedback')}}",
                data: {
                    id: id,
                    product_id: product_id,
                    title: title,
                    category: category,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.status == "200") {
                        // getcomments(response.data);
                        readfeedbacks();
                        document.forms["add_feedback_form"].reset();
                    } else {
                        toastr.error("Operation Failed");
                    }
                },
                error: function (e, f, g) {
                    toastr.error("Error: " + e.responseJSON.message);
                }
            });
        } else {
            console.log("Not ok");
        }
    });
</script>
<script>
    function makepaginationthroughajax(data) {
    var pagelinks = data.links;
    // console.log(data);
    var current_page = data.current_page;
    var last_page = data.last_page;
    if (last_page == 1) {
        return "";
    }
    var html = "";
    html = html + '<nav aria-label="Page navigation">';
    html = html + '<ul class="pagination">';
    if (current_page > 1) {
        html =
            html +
            ' <li class="page-item " onclick="readfeedbacks(' +
            (current_page - 1) +
            ')">';
        html = html + '    <a class="page-link " href="#" >&laquo; Previous</a>';
        html = html + " </li>";
    } else {
        html = html + ' <li class="page-item disabled" >';
        html = html + '    <a class="page-link " href="#" >&laquo; Previous</a>';
        html = html + " </li>";
    }

    for (var i = 1; i < pagelinks.length - 1; i++) {
        if (current_page == pagelinks[i].label) {
            html = html + ' <li class="page-item active">';
            html = html + '    <a class="page-link " >' + pagelinks[i].label + "</a>";
            html = html + " </li>";
        } else {
            html =
                html +
                ' <li class="page-item" onclick="readfeedbacks(' +
                pagelinks[i].label +
                ')">';
            html =
                html +
                '    <a class="page-link " href="#">' +
                pagelinks[i].label +
                "</a>";
            html = html + " </li>";
        }
    }
    if (last_page > current_page) {
        html =
            html +
            ' <li class="page-item " onclick="readfeedbacks(' +
            (current_page + 1) +
            ')">';
        html = html + '    <a class="page-link " href="#" >Next &raquo;</a>';
        html = html + " </li>";
    } else {
        html = html + ' <li class="page-item disabled" >';
        html = html + '    <a class="page-link " href="#" >Next &raquo;</a>';
        html = html + " </li>";
    }
    html = html + "                </ul>";
    html = html + "         </nav>";
    return html;
   }
</script>
</div>@endsection