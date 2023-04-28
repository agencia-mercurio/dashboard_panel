<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\WebsiteTexts;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function home() {
        
        $results = DB::select('select * from users where id = :id', ['id' => 1]);

        $user = Users::where('api_key', '803572d6-d988-11ed-afa1-0242ac120002')->firstOrFail();

        $texts = WebsiteTexts::where([
            'client_id' => $user->client_id, 
            'active' => 1
        ])->get();

        foreach($texts as $text) {
            $results[$text->key][$text->language] = $text->value;
        }

        
        return view('home');
    }
}