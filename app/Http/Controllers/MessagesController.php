<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\DashboardLogs;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function all()
    {
        $messages = Messages::where([
            'client_id' => Auth::user()->client_id
        ])
        ->with('items')
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($messages);
    }
    public function get($id)
    {
        $message = Messages::find($id);

        if (!$message) {
            $error = "Message not found";
            return response()->json(['error' => $error], 404);
        }

        return response()->json($message);
    }

    public function view(Request $request, $id)
    {
        $startTime = microtime(true);

        $message = Messages::find($id);

        if (!$message) {
            $error = "Message not found #".$id;
            $duration = microtime(true) - $startTime;
            $this->log('view', $error, $duration);
            return response()->json(['error' => $error], 404);
        }

        $message->viewed = 2;
        $message->save();

        $duration = microtime(true) - $startTime;

        $this->log('update', 'Marked message as viewed #'.$id, $duration);

        return response()->json($message);
    }

    public function viewMultiple(Request $request)
    {
        $startTime = microtime(true);

        $ids = $request->json('ids');

        $messages = Messages::whereIn('id', $ids)->get();

        if ($messages->isEmpty()) {
            $error = "No messages found with the given IDs";
            $duration = microtime(true) - $startTime;
            $this->log('viewMultiple', 'No messages found with the given IDs', $duration);
            return response()->json(['error' => $error], 404);
        }

        foreach ($messages as $message) {
            $message->viewed = 2;
            $message->save();
        }

        $duration = microtime(true) - $startTime;

        $this->log('viewMultiple', 'Marked messages as viewed', $duration);

        return response()->json($messages);
    }

    protected function log($action, $description, $duration)
    {
        $user = Auth::user();
        $log = new DashboardLogs;
        $log->user_id = $user['id'];
        $log->client_id = $user['client_id'];

        $log->context = 'messages';
        $log->action = $action;
        $log->description = $description;
        $log->duration = $duration;
        $log->error = '';

        $log->save();
    }
}