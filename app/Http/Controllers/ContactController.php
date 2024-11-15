<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    // Handle the contact form submission and send email
    public function sendContactForm(Request $request)
    {
        // Validate the request
        $data = [
            'email'=> $request->email,
            'msg'=> $request->msg,
        ];
        Mail::to('foram@gmail.com')->send(new ContactFormMail($data));
        return redirect()->back();
    }

}

