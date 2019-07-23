<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

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
        //验证输入
        $this->validate($request,[
           'name' => 'required|max:50',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|confirmed|min:3',
        ]);

        //写入数据库
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>bcrypt($request->password),
        ]);
        Auth::login($user);
        session()->flash('success','欢迎注册，快来开始您的旅行吧！');
        return redirect()->route('users.show',[$user]);
    }

    //返回编辑用户资料页面
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    //更新用户资料
    public function update(User $user,Request $request)
    {
        //验证输入
        $this->validate($request,[
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6',
        ]);

        //把输入的内容存到data中
        $data = [];
        $data['name'] = $request->name;
        //若有密码则写入，如果没有则防止写入空置
        if ($request->password){
            $data['password'] = bcrypt($request->password);
        }
        //调用update方法进行更新
        $user->update($data);

        session()->flash('success','个人资料更新成功！');

        return redirect()->route('users.show',$user);

    }
}
