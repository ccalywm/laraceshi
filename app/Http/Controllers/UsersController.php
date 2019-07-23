<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }
    
    //显示用户个人中心
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }
    
    //处理用户注册表单
    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required|max:50',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|confirmed|min:3',
        ]);


    }
}
