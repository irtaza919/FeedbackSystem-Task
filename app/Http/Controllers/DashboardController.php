<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Roles;
use App\Models\ComponentPermissions;
use App\Models\User;
use App\Models\Product;
use App\Models\Comment;
use App\Http\Controllers\baseController;
use App\Helpers;
use App\Models\Feedback;
use Auth;


class DashboardController extends Controller
{
    public function index(){
        if (Auth::user()->role_id == 2) {
            return view('Dashboard.index');
        }else if(Auth::user()->role_id == 1){
            return redirect()->route('home');
            // return view('frontend.index');
        }
    }
     
    public function home(){
        $data['products'] = Product::all();

        return view('frontend.index', $data);
        
    }
   
    public function reply(Request $request,$id){
         $data['feedback'] = Feedback::with('user')->find($id);
         return view('reply.index',$data);
        
    }

    public function read_comments(Request $request){
        $data = Comment::with('user')->where('feedback_id',$request->feedback_id)->orderby('id','desc')->get();
        return $data;
    }

    public function store_comments(Request $request){
        $feedback = new Comment;
        $feedback->title=urldecode($request->comment);
        $feedback->description=urldecode($request->comment);
        $user_id = Auth::user()->id;
        $feedback->user_id=$user_id;
        $feedback->feedback_id=$request->feedback_id;
        $feedback->save();
        return response()->json(["status" => "200", "data" => $request->feedback_id]);
        // return response()->json(["status"=>"200"]);
    }
    public function getUsers(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', "%$search%")->get();
        return response()->json($users);
    } 

    public function feedbacks($id){
        $product['products'] = Product::find($id);
        return view('feedback_user.index',$product);
       
    }

    public function store_feedback(Request $request){
        $feedback = new Feedback();
        $feedback->title=$request->title;
        $feedback->category=$request->category;
        $feedback->vote_count=1;
        $user_id = Auth::user()->id;
        $feedback->user_id=$user_id;
        $feedback->product_id=$request->product_id;
        $feedback->save();
        return response()->json(["status" => "200", "data" => $request->product_id]);
        // return response()->json(["status"=>"200"]);
    }

    public function read_feedbacks(Request $request){
        // return $request;
        $data['data'] = Feedback::with('user')->where('product_id',$request->product_id)->orderby('id','desc')->paginate(10);
        return $data;
    }

    public function give_vote_feedbacks(Request $request){
        $data = Feedback::find($request->id);
        $vote_count = $data->vote_count +1;
        $data->vote_count=$vote_count;
        $data->save();
        return response()->json(["status" => "200"]);
    }
    
}
// ['product' => $product]