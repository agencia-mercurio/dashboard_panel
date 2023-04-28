<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\WebsiteTexts;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function home() {

        DB::enableQueryLog();
        
        $results = DB::select('select * from users where id = :api_key', ['api_key' => '803572d6-d988-11ed-afa1-0242ac120002']);
        $results = DB::select('select * from website_texts where client_id = :client_id', ['client_id' => '1']);

        // $user = Users::where('api_key', '803572d6-d988-11ed-afa1-0242ac120002')->firstOrFail();

        // $texts = WebsiteTexts::where([
        //     'client_id' => $user->client_id, 
        //     'active' => 1
        // ])->get();

        // foreach($texts as $text) {
        //     $results[$text->key][$text->language] = $text->value;
        // }

        // var_dump(DB::getQueryLog());exit;
        
        return view('home');
    }
}