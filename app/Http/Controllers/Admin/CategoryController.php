<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('backend.category.add');
    }

    public function storeCategory(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_replace(' ','-',strtolower($request->name));
        $category->status = $request->status;
        $category->save();
        return redirect()->back()->with(session()->flash('success', 'Category is Created Succesfully!'));


    }

    public function manageCategory(){
        
        $categories = Category::get();
        return view('backend.category.manage', compact('categories'));
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('backend.category.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        

        $this->validate($request,[
            'name'=>'required',
            'status'=>'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = str_replace(' ','-',strtolower($request->name));
        $category->status = $request->status;
        $category->save();
        return redirect('/category/manage')->with(session()->flash('success', 'Category is updated Succesfully!'));

        
    }

    public function activeCategory($id)
    {
        $category = Category::find($id);
        $category->status = 1;
        $category->save();
        return redirect()->back()->with(session()->flash('success', 'Status changed to Active'));
    }

    public function inactiveCategory($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        return redirect()->back()->with(session()->flash('success', 'Status changed to Inactive'));
    }

    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with(session()->flash('success', 'Category is deleted Succesfully'));
    }

    
}
