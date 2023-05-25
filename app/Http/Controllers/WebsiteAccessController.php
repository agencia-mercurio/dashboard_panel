<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteAccess;
use Illuminate\Support\Facades\Auth;

class WebsiteAccessController extends Controller
{
    public function all()
    {
        $messages = WebsiteAccess::where([
            'client_id' => Auth::user()->client_id
        ])
        ->orderBy('created_at', 'desc')
        ->with('events')
        ->get();

        return response()->json($messages);
    }
}