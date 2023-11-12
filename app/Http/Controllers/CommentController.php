<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{public function index()
    {
        if (hasPermission('comment_read')) {
            $data["comment"]=Comment::all();
            return view("comment.index",$data);
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try
        {
          if (hasPermission('feedback_read'))
          {
            $feedback=Comment::all();
            $json_data["data"] = $feedback;
            return json_encode($json_data);
          }
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}


    }
    public function store(Request $request)
    {

        try
        {
          if (hasPermission('feedback_write'))
          {
            if($request->id==""){
                $feedback = new Comment;
                $feedback->title=urldecode($request->title);
                $feedback->description=$request->description;
                $feedback->user_id=$request->user_id;
                $feedback->feedback_id=$request->feedback_id;

                // $feedback->created_by=getUserID();
                $feedback->save();
                }
                else{
                    $feedback =Comment::find($request->id);
                    $feedback->title=urldecode($request->title);
                    $feedback->description=$request->description;
                    $feedback->user_id=$request->user_id;
                    $feedback->feedback_id=$request->feedback_id;
                    // $feedback->updated_by=getUserID();
                    $feedback->save();
                }
                return response()->json(["status"=>"200"]);
          }
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}



    }
    public function readById(Comment $feedback,$id)
    {
            try
        {
          if (hasPermission('feedback_read'))
          {
            $data = Comment::find($id);
            return response()->json($data);
          }
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}

    }
}
