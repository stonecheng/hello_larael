<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials,$request->has('remember'))) {
            //��¼�ɹ������ز�����TODO��������Ϣ��ʾ������
            session()->flash('success','��ӭ������');
            return redirect()->route('users.show',[Auth::user()]);
        } else {
            //��¼ʧ�ܺ����ز�����TODO��������Ϣ��ʾ������
            session()->flash('danger','�ܱ�Ǹ��������������벻ƥ��');
            return redirect()->back();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success','���ѳɹ��˳���');
        return redirect('login');
    }
}
