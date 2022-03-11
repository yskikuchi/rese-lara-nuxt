<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Mail;

class AdminMailController extends Controller
{
    public function index($userId)
    {
        $user = User::where('id', $userId)->first();
        return view('admin.emails.form', compact('user'));
    }
    public function send(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'main' => $request->main,
        ];
        Mail::send('admin.emails.mail', $data, function($message) use ($request){
            $message->to($request->email, $request->name)
            ->subject('This is a test mail');
        });
        return redirect()->route('admin.dashboard');
    }
}
