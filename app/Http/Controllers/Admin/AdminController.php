<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminLoginPage()
    {
        return view('backend.admin.login');
    }

    public function adminLogin(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email' ,
            'password' => 'required'
        ]);
    
        // Attempt to retrieve the admin user with the provided email
        $admin = Admin::where('email', $request->email )->first();

        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                // Redirect the user to the admin dashboard
                session()->put('adminId', $admin->id);
                return redirect('/admin/dashboard')->with(session()->flash('success', 'Login successful'));
            } else {
               
                return redirect()->back()->with(session()->flash('error', 'Invalid Password!'));
            }
        } else {
            return redirect()->back()->with(session()->flash('error', 'Invalid User'));
        }
    

    }


    public function showDashboard()
    {
        return view('backend.home.index');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/admin/login')->with(session()->flash('success','You are successfully logout'));
    }
}
