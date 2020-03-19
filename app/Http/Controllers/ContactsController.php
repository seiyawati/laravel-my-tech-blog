<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Contacts\ContactRequest;
use App\Contact;
use App\Mail\ContactSendmail;

class ContactsController extends Controller
{
    public function index(){
        return view('contacts.index');
    }
    
    //入力内容確認を保存し、確認画面へ
    public function confirm(ContactRequest $request){
        $inputs = new Contact();

        $inputs->name = $request->name;

        $inputs->email = $request->email;

        $inputs->body = $request->body;

        $inputs->save();
        return view('contacts.confirm',[
            'inputs' => $inputs,
        ]);
    }

    //入力内容の送信
    public function complete(ContactRequest $request){

        //フォームから受け取ったactionを除いたinputの値を取得
        $action = $request->input('action');

        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        //actionの値で分岐する
        if($action !== 'submit'){
            return redirect()->route('contact.index')->withInput($inputs);
        }else{
            //入力されたメールアドレスにメールを送信
            //送信先を指定して、mailableクラスでの処理による内容を送信する。
            \Mail::to($inputs['email'])->send(new ContactSendmail($inputs));

            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();

            //送信完了のページを表示
            return view('contacts.complete');
        }
    }
}
