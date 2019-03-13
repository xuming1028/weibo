<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    //创建登陆界面
    public function create()
    {
        return view('sessions.create');
    }

    //d登陆
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))){
        // 登录成功后的相关操作
             session()->flash('success', '欢迎回来！');
             return redirect()->route('users.show', [Auth::user()]);
        } else {
        // 登录失败后的相关操作
             session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
             return redirect()->back()->withInput();
        }
    }
    //退出
    public function destory(){
        Auth::logout();
        session()->flash('success','你以成功退出');
        return redirect('login');
    }
}
