<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{public function index()
    {
        if (hasPermission('location_read')) {
            $data["location"]=Location::all();return view("Location.index",$data);
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try 
        {
          if (hasPermission('location_read'))
          {
            $location=Location::all();
            $json_data["data"] = $location;
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
          if (hasPermission('location_write'))
          {
            if($request->id==""){
                $location = new Location;
                $location->title=$request->title;
                $location->save();
                }
                else{
                    $location =Location::find($request->id);
                    $location->title=$request->title;
                    $location->save();
                }
                return response()->json(["status"=>"200"]);
          } 
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}
      
        

    }
    public function readById(Location $location,$id)
    {
        try 
        {
          if (hasPermission('location_read'))
          {
            $data = Location::find($id);
            return response()->json($data);
          } 
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}
        
    }
}
