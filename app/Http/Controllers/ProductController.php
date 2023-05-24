<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('product.index',compact('product'));
    }
    public function StoreOrUpdate(Request $request)
    {
        $product = '';
        if($request->id)
        {
            $product = Product::where('id',$request->id)->first();
        }else{
             $product = new Product;
        }
        if($request->has('icon'))
        {
            $fileName = time() . '.' . $request->icon->extension();

            $request->icon->move(public_path('products_image'), $fileName);
            $product->image = $fileName;
        }
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = json_encode($request->category);
        $product->user_id = auth()->user()->id;
        $product->save();
        if($product)
        {
            session()->flash("success", 'Product Added Successfully');
            return redirect('manage-product');
        } else {
            session()->flash("error", 'Something went wrong');
            return redirect('manage-product');
        }
    }

    public function GetDetails($id)
    {
        $product = Product::find(Crypt::decrypt($id));
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::find(Crypt::decrypt($id))->delete();
       if($product)
       {
        return "Product Deteled Successfully";
       }
       else{
        return "error";
       }

    }
}
