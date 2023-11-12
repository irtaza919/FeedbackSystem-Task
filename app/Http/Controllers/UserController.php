<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\baseController;
use App\Helpers;
class UserController extends Controller
{
    public function index()
    {
        if (hasPermission('users_read')) {
            $data['roles']=Roles::all();
            return view('user.index',$data);
        } else {
            abort(403);
        }
        
    }

    public function getAll(){
        try 
        {
          if (hasPermission('users_read'))
          {
            $users = User::latest()->with('role')->get();
            return response()->json([
                'data' => $users
            ], 200);
          } 
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  baseController::custom_exception($e);}
      
       
    }

    public function store(Request $request)
    {
        try 
        {
          if (hasPermission('users_write'))
          {
            if($request->id=="")
            {
                $this->validate($request, [
                    'name' => 'required|string',
                    'phone' => 'required',
                    'password' => 'required|alpha_num|min:6',
                    'role_id' => 'required',
                    'email' => 'required|email|unique:users'
                ]);
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = bcrypt($request->password);
                $user->role_id=$request->role_id;
                $user->save();

                  if($user->save())
                  {
                          return response()->json(["status" => 200,"message" => "Success"]);
                  }
                  else
                  {
                      throw new \Exception("Internal Server Error"); 
                  }
            } 
            else 
            {

                $this->validate($request, [
                    'name' => 'required|string',
                    'phone' => 'required',
                    'role_id' => 'required',
                    'email' => 'required|email|unique:users,email,'.$request->id
                ]);
              $user =User::find($request->id);

              if (!$user) { throw new \Exception("Not Found"); }

              $user->name = $request->name;
              $user->email = $request->email;
              $user->phone = $request->phone;

                if($request->has('password')){
                    $user->password = bcrypt($request->password);
                }

              $user->role_id=$request->role_id;
              if($user->save())
              {
                return response()->json(["status" => 200,"message" => "Success"]);
              }
              else { throw new \Exception("Internal Server Error"); }
            }
          } 
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  baseController::custom_exception($e);}
              
       
    }

    public function readById($id)
    {
        try 
        {
          if (hasPermission('users_read'))
          {
            $data = User::with('role')->find($id);
            return response()->json(["status" => 200,"message" => "Success","data"=>$data]);
        
          } 
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  baseController::custom_exception($e);}
      
            
        $data = User::with('role')->find($id);
        return response()->json(["status" => 200,"message" => "Success","data"=>$data]);
    }

    public function delete($id){
        try 
        {
          if (hasPermission('users_delete'))
          {
            $user = User::findOrFail($id);

            $user->delete();
    
            return response()->json('ok', 200);
          } 
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  baseController::custom_exception($e);}
      
       
    }

    /////////////////////// User defined Method


    public function profile(){
        return view("profile.index");
    }

    public function postProfile(Request $request){
        $user = auth()->user();
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);

        $user->update($request->all());

        return redirect()->back()->with('success', 'Profile Successfully Updated');
    }

    public function getPassword(){
        return view('profile.password');
    }

    public function postPassword(Request $request){

        $this->validate($request, [
            'newpassword' => 'required|min:6|max:30|confirmed'
        ]);

        $user = auth()->user();

        $user->update([
            'password' => bcrypt($request->newpassword)
        ]);

        return redirect()->back()->with('success', 'Password has been Changed Successfully');
    }

   
}
