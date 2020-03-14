<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Contacts\ContactRequest;
use App\Contact;

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

    }
}
