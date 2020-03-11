<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\UpdateProfileRequest;

class UsersController extends Controller
{
    public function index(){

        
        $users = User::all();

        return view('users.index',[
            'users' => $users,
        ]);
    }

    public function makeAdmin($id){

        $user = User::find($id);

        $user->role ='admin';

        $user->save();

        session()->flash('flash_message','ユーザー認証に成功しました');

        return redirect(route('users.index'));


    }

    public function edit(){
        //ログインしているユーザーのモデルインスタンス
        $user = Auth::user();

        return view('users.edit',[
            'user' => $user
        ]);
    }

    public function update(UpdateProfileRequest $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->about = $request->about;
        $user->save();

        session()->flash('flash_message','プロフィールが更新されました。');


        return redirect(route('users.index'));
    }


}