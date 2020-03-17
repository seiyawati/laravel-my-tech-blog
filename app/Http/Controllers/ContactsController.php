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

    public function complete(ContactRequest $request){
        $action = $request->input('action');

        $inputs = $request->except('action');

        if($action !== 'submit'){
            return redirect()->route('contact.index')->withInput($inputs);
        }else{
            \Mail::to($inputs['email'])->send(new ContactSendmail($inputs));

            $request->session()->regenerateToken();

            return view('contacts.complete');
        }
    }
}
