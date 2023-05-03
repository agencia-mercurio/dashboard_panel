<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\Models\WebsiteTexts;
use App\Models\WebsiteAccess;
use App\Models\WebsiteAccessEvents;
use App\Models\Users;

class ApiController extends Controller
{
    public function texts($api_key) {

        $results = [];

        $user = Users::where('api_key', $api_key)->firstOrFail();

        $texts = WebsiteTexts::where([
            'client_id' => $user->client_id, 
            'active' => 1
        ])->get();

        foreach($texts as $text) {
            $results[$text->key][$text->language] = $text->value;
        }

        return $results;
    }
    public function access($api_key, Request $request) {
        $user = Users::where('api_key', $api_key)->firstOrFail();

        $access = json_encode($request->all()['access']);
        $token = $request->all()['token'];

        $access = WebsiteAccess::create([
            'client_id' => $user->client_id,
            'uuid' => $token,
            'access' => $access
        ]);
    }

    public function access_event(Request $request) {
        $wae = WebsiteAccessEvents::create($request->all());

        return $wae;
    }

    public function getImage($client_id, $filename)
    {
        $path = Storage::disk('public')->path("images/$client_id/$filename");
        $file = File::get($path);
        $type = File::mimeType($path);
        
        if (!file_exists($path)) {
            return null;
        }
        
        return (new Response($file, 200))->header('Content-Type', $type);
    }
}