<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $user = User::where('email', $credentials['email'])->first();
        if(!empty($user) && Hash::check($credentials['password'], $user->password)){
            Auth::loginUsingId($user->id);
            return redirect('dashboard')->with('success_message', 'Logged In!');
        }else{
            return back()->with('error_message', 'Incorrect credentials');
        }
    }

    public function getDashboard(){
        $this->data['page_title'] = 'Dashboard';
        return view('admin.dashboard', ['data' => $this->data]);
    }

    public function getUsers(Request $request){
        $users = User::all();
        $this->data['page_title'] = 'Users List';
        $return_data['users'] = $users;
        return view('users', ['data' => array_merge($this->data, $return_data)]);
    }

    public function logOut(){
        Auth::logout();
        return redirect('login')->with('success_message', 'Logged Out Successfully');
    }

    public function listCategories(Request $request){
        $this->data['page_title'] = 'Categories List';
        $return_data = [];
        $return_data['current_categories'] = Category::all();
        return view('categories', ['data' => array_merge($this->data, $return_data)]);
    }

    public function AddCategories(Request $request){
        $cat = Category::saveCategory($request->only('category'));
        return json_encode(['status' => 200, 'msg' => 'Added new Category']);
    }

    public function deleteCategory($id){
        Category::where('_id', $id)->delete();
        return redirect('list_categories')->with(['status' => 200, 'msg' => 'Category deleted Successfully']);
    }
}
