<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     * 中间件过滤未登录用户访问
     * except方法中的是控制器方法是允许未登录用户访问的
     */
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['show','create','store','index']
        ]);

        $this->middleware('guest',[
           'only' => ['create']
        ]);
    }

    //返回所有用户
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

    //返回用户注册页面
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
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    //更新用户资料
    public function update(User $user,Request $request)
    {
        $this->authorize('update',$user);
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

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success','成功删除用户！');
        return back();
    }
}
