<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use App\Models\Messages;
use App\Models\MessageItems;

class EmailController extends Controller
{
    public function send(Request $request, $api_key)
    {
        $data = $request->all();

        $user = Users::where('api_key', $api_key)->firstOrFail();

        $message = Messages::create([
            'client_id' => $user->client_id,
            'email' => $data['email'],
            'viewed_at' => null
        ]);

        foreach($data as $key => $value) {
            $messageItem[] = MessageItems::create([
                'message_id' => $message->id,
                'key' => $key,
                'value' => $value
            ]);
        }

        $data['now'] = date('d/m/Y H:i:s');

        Mail::send('emails.notification', ['data' => $data], function ($message) use ($data) {
            $message->from('notifications@mercurio.marketing', 'Mercurio Marketing');
            $message->to($data['email']);
            $message->subject('Nova Mensagem - Landing Page');
        });

        return view('emails.notification', ['data' => $data]);
    }
}