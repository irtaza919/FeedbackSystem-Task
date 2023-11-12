<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{public function index()
    {
        if (hasPermission('product_read')) {
            $data["product"]=Product::all();
            return view("product.index",$data);
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try
        {
          if (hasPermission('product_read'))
          {
            $product=Product::all();
            $json_data["data"] = $product;
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
          if (hasPermission('product_write'))
          {
            if($request->id==""){
                $product = new Product;
                $product->title=$request->title;
                $product->price=$request->price;
                if($request->hasFile('image')){
                    // return response()->json(["status" => "900"]);

                    $file =$request->file('image');
                    $extension =$file->getclientOriginalExtension();
                    $filename = $request->title.'.'.$extension;
                    $file->move('assets',$filename);
                    $product->image =$filename;
                }

                // $product->created_by=getUserID();
                $product->save();
                }
                else{
                    $product =Product::find($request->id);
                    $product->title=$request->title;
                    $product->price=$request->price;
                    if($request->hasFile('image')){
                        // return response()->json(["status" => "900"]);

                        $file =$request->file('image');
                        $extension =$file->getclientOriginalExtension();
                        $filename = $request->title.'.'.$extension;
                        $file->move('assets',$filename);
                        $product->image =$filename;
                    }
                    // $product->updated_by=getUserID();
                    $product->save();
                }
                return response()->json(["status"=>"200"]);
          }
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}



    }
    public function readById(Product $product,$id)
    {
            try
        {
          if (hasPermission('product_read'))
          {
            $data = Product::find($id);
            return response()->json($data);
          }
          else { throw new \Exception("Unauthorized");}
        }
        catch (\Exception $e) { return  custom_exception($e);}

    }
}
