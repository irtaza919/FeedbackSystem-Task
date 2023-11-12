<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
     public function index()
    {
        if (hasPermission('auction_read')) {
            $data["auction"]=Auction::all();return view("Auction.index",$data);
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try 
        {
          if (hasPermission('auction_read'))
          {
            $auction=Auction::all();
            $json_data["data"] = $auction;
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
          if (hasPermission('auction_write'))
          {
            if($request->id==""){
                $auction = new Auction;
                $auction->description=$request->description;
                $auction->start_date=$request->start_date;
                $auction->end_date=$request->end_date;
                $auction->status=$request->status;
                $auction->property_id=$request->property_id;
                $auction->save();
                }
                else{
                    $auction =Auction::find($request->id);
                    $auction->description=$request->description;
                    $auction->start_date=$request->start_date;
                    $auction->end_date=$request->end_date;
                    $auction->status=$request->status;
                    $auction->property_id=$request->property_id;
                    $auction->save();
                }
                return response()->json(["status"=>"200"]);
          } 
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}
      
        

    }
    public function readById(Auction $auction,$id)
    {
        try 
        {
          if (hasPermission('auction_read'))
          {
            $data = Auction::find($id);
            return response()->json($data);
          } 
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}
        
    }
}
