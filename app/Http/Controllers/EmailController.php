<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    public function send(Request $request)
    {
        $toEmail = 'leonardo.de.souza.batisat@gmail.com';

        // $data = $request->all();

        $data = [
            'name' => 'Jane Doe',
            'email' => 'janedoe@mail.com',
            'phone' => '+00 0000-0000',
            'message' => 'Sample message for testing purposes',
            'now' => date('d/m/Y H:i:s')
        ];


        Mail::send('emails.notification', ['data' => $data], function ($message) use ($data, $toEmail) {
            $message->from('notifications@mercurio.marketing', 'Mercurio Marketing');
            $message->to($toEmail);
            $message->subject('Nova Mensagem - Landing Page');
        });
    }
}