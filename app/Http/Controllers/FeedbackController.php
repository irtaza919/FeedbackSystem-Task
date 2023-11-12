<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{public function index()
    {
        if (hasPermission('feedback_read')) {
            $data["feedback"]=Feedback::all();
            return view("feedback.index",$data);
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
            $feedback=Feedback::all();
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
                $feedback = new Feedback;
                $feedback->title=$request->title;
                $feedback->category=$request->category;
                $feedback->vote_count=$request->vote_count;
                $feedback->user_id=$request->user_id;
                $feedback->product_id=$request->product_id;

                // $feedback->created_by=getUserID();
                $feedback->save();
                }
                else{
                    $feedback =Feedback::find($request->id);
                    $feedback->title=$request->title;
                    $feedback->category=$request->category;
                    $feedback->vote_count=$request->vote_count;
                    $feedback->user_id=$request->user_id;
                    $feedback->product_id=$request->product_id;
                    // $feedback->updated_by=getUserID();
                    $feedback->save();
                }
                return response()->json(["status"=>"200"]);
          }
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}



    }
    public function readById(Feedback $feedback,$id)
    {
            try
        {
          if (hasPermission('feedback_read'))
          {
            $data = Feedback::find($id);
            return response()->json($data);
          }
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}

    }
}
