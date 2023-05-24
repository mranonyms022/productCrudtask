<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('category.index',compact('category'));
    }
    public function ManageCategory(Request $request)
    {
        $category = '';
        if($request->id)
        {
            $category = Category::where('id',$request->id)->first();
        }
        else{
            $category = new Category;
        }
        $category->name = $request->name;
        $category->added_by = auth()->user()->id;
        if($request->has('icon'))
        {
            $fileName = time() . '.' . $request->icon->extension();

            $request->icon->move(public_path('cate_icons'), $fileName);
            $category->icon = $fileName;
        }
        $category->save();
        if($category){
            session()->flash("success", 'Category Added Successfully');
            return redirect('manage-category');
        }else{
            session()->flash("error", 'Something went wrong');
            return redirect('manage-category');
        }


    }
//  for getting data of category update

    public  function EditCategoryData($id)
    {
        $cateory = Category::find(Crypt::decrypt($id));
        return $cateory;

    }

    public function deleteCategory($id)
    {
        $category = Category::find(Crypt::decrypt($id))->delete();
        if($category)
        {
            return "Category Deleted SuccessFully";
        }
        else{
            return 'error';
        }
    }
}
