@extends("layout_user.layout")
@section('name') Comments @endsection
@section('page-header')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
    <div class="page-leftheader">
        <!-- <h4 class="page-title mb-0">Comments</h4> -->
    </div>
</div>
<!-- END PAGE HEADER -->
</head>
@endsection
@section('content')

<div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;display: table-row;">
        <div class="row">
            <div class="col-2">
                <img src="/img/users/avatar.jpg" alt="User Profile Image" style="width: 80px; height: 80px; border-radius: 50px; margin-right: 10px;">
            </div>
            <div class="col-10 mt-5">
                <h1 style="font-weight: bold">{{$feedback->user->name}}</h1>
                
            </div>
        </div>
        <h3 class="card-name mt-4">
            <i class=" mr-1"></i>
            {{$feedback['title']}}
        </h3>
    </div>
    <div class="card-body table-responsive ">
        <div class="row">
            <div class="col-12" style="text-align:center;">
                <h4 class="card-name mt-2">
                    <i class=" mr-1"></i>
                    Comments
                </h4>

                <form id="add_comment_form" method="post">
                    <input type="number" name="id" hidden>
                    <input type="number" name="feedback_id" value="{{$feedback['id']}}" hidden>
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <!-- Modified: Removed the "@" sign -->
                                <textarea style="width:100%;" class="tinymce_textarea" cols="20" name="comment" id="comment"
                                    placeholder="Write a comment..."
                                    aria-label="Write a comment..."></textarea>
                                <div id="userList"></div>
                            </div>
                        </div>
                        <!-- Added a "Submit" button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="commentlist"></div>
    </div>
</div>

<script>
    var feedbackData = @json($feedback);
    var feedback_id = feedbackData.id;

    function getcomments(feedback_id) {
        var html = '';
        $.ajax({
            type: "post",
            url: "/read_comments",
            dataType: 'json',
            data: {
                feedback_id: feedback_id,
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                for (var i = 0; i < response.length; i++) {
                    html = html + '';
                    html = html + '<div class="row mt-3">';
                    html = html + '<div class="col" style="background-color: #f0f0f0; border-radius: ';
                    html = html + '10px; padding: 10px;">';
                    html = html + '<div style="display: flex; align-items: center;">';
                    // Modified: Display the user profile image
                    html = html + '<img src="/img/users/avatar.jpg" alt="User Profile Image" style="width: 40px; height: 40px; border-radius: 50px; margin-right: 10px;">';
                    html = html + ' <span style="font-weight: bold; margin-left: 20px;">' + response[i].user.name + '</span>';
                    html = html + ' </div>';
                    html = html + '<p class="mt-2">' + response[i].Description + '.</p>';
                    html = html + '<div style="display: flex; align-items: center; margin-top: 10px;">';
                    html = html + '  <a href="#" style="margin-right: 20px;">Like</a>';
                    html = html + ' <a href="#">Reply</a>';
                    html = html + '</div>';
                    html = html + '</div>';
                    html = html + '</div>';
                    html = html + '</div>';
                }
                $('#commentlist').empty();
                $('#commentlist').append(html);
            },
            error: function(e, f, g) {
                toastr.warning("Not Found");
                console.log(e, f, g);
            }
        });
    }

    getcomments(feedback_id);

    $("#add_comment_form").submit(function(e) {
        e.preventDefault();
        var form = document.forms["add_comment_form"];
        if (form.checkValidity() === true) {
            var id = document.forms["add_comment_form"]["id"].value;
            var feedback_id = document.forms["add_comment_form"]["feedback_id"].value;
            var comment = encodeURIComponent(tinymce.get("comment").getContent());
            $.ajax({
                type: "POST",
                url: "{{route('store_comments')}}",
                data: {
                    id: id,
                    feedback_id: feedback_id,
                    comment: comment,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == "200") {
                        getcomments(response.data);
                        document.forms["add_comment_form"].reset();
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
</div>
@endsection