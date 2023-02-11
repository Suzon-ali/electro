<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function addType()
    {
        return view('backend.type.add');
    }

    public function storeType(Request $request)
    {
        $this->validate($request,[
            'type_name'=>'required',
        ]);

        $type = new Type();
        $type->type_name = $request->type_name;
        $type->slug = str_replace(' ','-',strtolower($request->type_name));
        $type->save();
        return redirect()->back()->with(session()->flash('success' ,'Type is added succesfully'));

    }

    public function manageType()
    {
        $types =Type::get();
        return view('backend.type.manage', compact('types'));
    }

    public function editType($id)
    {
        $type = Type::find($id);
        return view('backend.type.edit', compact('type'));

    }

    public function updateType(Request $request, $id)
    {
        $type = Type::find($id);
        $type->type_name = $request->type_name;
        $type->slug = str_replace(' ','-',strtolower($request->type_name));
        $type->save();
        return redirect('/type/manage')->with(session()->flash('success' ,'Type is updated succesfully'));

    }

    public function deleteType($id){
        $type = Type::find($id);
        $type->delete();
        return redirect()->back()->with(session()->flash('success' ,'Type is updated succesfully'));

    }



}
