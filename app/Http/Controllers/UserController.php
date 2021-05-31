<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getLogin(Request $request){
        $this->data['page_title'] = 'Admin Login';
        return view('admin.login', ['data' =>$this->data]);
    }

    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect('dashboard')->with('success_message', 'Logged In!');
        }else{
            return back()->with('error_message', 'Incorrect credentials');
        }
    }

    public function getDashboard(Request $request){
        $this->data['page_title'] = 'Dashboard';
        return view('admin.dashboard', ['data' => $this->data]);
    }

    public function getUsers(Request $request){
        $users = User::all();
        $this->data['page_title'] = 'Users List';
        $return_data['users'] = $users;
        return view('users', ['data' => array_merge($this->data, $return_data)]);
    }
}
