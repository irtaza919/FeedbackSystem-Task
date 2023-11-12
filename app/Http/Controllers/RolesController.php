<?php
  namespace App\Http\Controllers;
  use Illuminate\Http\Request;
  use Crypt;
  use App\Models\Roles;
  use App\Models\ComponentPermissions;
  use App\Models\Users;
  use App\Http\Controllers\baseController;
  use App\Helpers;
  class RolesController extends Controller
  {
      public function index()
      {
          // if (hasPermission('role_read')) {
              $data["roles"]=Roles::all();return view("Roles.index",$data);
          // } else {
          //     abort(403);
          // }
      }
      public function read()
      {
          try 
          {
            // if (hasPermission('role_read'))
            // {
              $roles=Roles::all();
              $json_data["data"] = $roles;
              return json_encode($json_data);
            // } 
            // else { throw new \Exception("Unauthorized");}
          }
          catch (\Exception $e) { return  custom_exception($e);}
        
              
      }
      public function store(Request $request)
      {
            
          try 
          {
            // if (hasPermission('role_write'))
            // {
              if($request->id==""){
                  $roles = new Roles;
                  $roles->title=$request->title;
                  $roles->description=$request->description;
                  $roles->save();
                  }
                  else{
                      $roles =Roles::find($request->id);
                      $roles->title=$request->title;
                      $roles->description=$request->description;
                      $roles->save();
                  }
                  return response()->json(["status"=>"200"]);
            // } 
            // else { throw new \Exception("Unauthorized");}
          }
          catch (\Exception $e) { return  custom_exception($e);}
        
          

      }
      public function readById(Roles $roles,$id)
      {
          try 
          {
            if (hasPermission('role_read'))
            {
              $data = Roles::find($id);
              return response()->json($data);
            } 
            else { throw new \Exception("Unauthorized");}
          }
          catch (\Exception $e) { return  custom_exception($e);}
          
      }
  }
        