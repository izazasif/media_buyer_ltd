<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {   
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'body' => 'required|string',
            'country' => 'required|string|max:255',
        ]);

        Mail::to('Info@mediabuyer-jo.com')->send(new ContactMail(
            $request->name,
            $request->email,
            $request->phone,
            $request->body,
            $request->country,
        ));

        return response()->json(['message' => 'Email sent successfully!'], 200);
    }
}
