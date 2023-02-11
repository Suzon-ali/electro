<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userRegisterPage()
    {
        $categories = Category::where('status','1')->get();
        return view('frontend.home.auth.register' , compact('categories'));
    }

    public function userLoginPage()
    {
        $categories = Category::where('status','1')->get();
        return view('frontend.home.auth.login' , compact('categories'));
    }

    public function userRegister(Request $request)
    {

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
            
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/login')->with(session()->flash('success', 'Registration succesfull, you can now login!'));


    }

    public function userLogin(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email' ,
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
       

        if($user){
           if( Hash::check($request->password,$user->password)){
            session()->put('userId', $user->id);
            return redirect('/')->with(session()->flash('success', 'Login successful'));
           }else{
            return redirect()->back()->with(session()->flash('error', 'password is not correct'));
           }
        }else{
            return redirect()->back()->with(session()->flash('error', 'Invalid user'));
        }

    }

    public function userLogout()
    {
        session()->flush();
        return redirect('/')->with(session()->flash('success','You are successfully logout'));
    }

   
}
