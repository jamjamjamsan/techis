<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //usersテーブルからデータを取得


        $users = User::orderBy('updated_at', 'desc')->paginate(10);

        return view('user.list', [
            'users' => $users,
        ]);
    }

    public function edit(Request $request)
    {
        //usersテーブルからデータを取得
        $user = User::find($request->id);

        return view('user.edit', [
            'user' => $user,
        ]);
    }


    public function update(Request $request)
    {
        //既存のレコードを取得して、編集してから保存する
        //dd($request);

        $request->validate(
            [
                'name' => 'required',
                'email' => 'email',
            ],
            [
                'name.required' => '名前の入力は必須です。',
                'email.email' => 'メールアドレスの入力は必須です。'
            ]
        );

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect('/user');
    }

    public function delete(Request $request)
    {

        //既存のレコードを取得して、削除する
        $users =  User::find($request->id);
        $users->delete();

        return redirect('/user');
    }
}
