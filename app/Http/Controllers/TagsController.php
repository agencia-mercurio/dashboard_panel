<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Tags;
use App\Models\TagsItems;

class TagsController extends Controller
{
    public function all()
    {
        return Tags::where([
                'client_id' => Auth::user()->client_id
            ])->get();
    }
    public function create(Request $request)
    {
        $data = $request->all();
        
        $tag = Tags::create([
            "client_id"          => Auth::user()->client_id,
            "label"    => $data['label'],
            "icon"    => $data['icon'],
            "color"       => $data['color'],
            "active"    => 1
        ]);

        return response()->json($tag);
    }
    public function link(Request $request) {
        $data = $request->all();
        
        $tagItem = TagsItems::create([
            "client_id"          => Auth::user()->client_id,
            "entity"    => $data['entity'],
            "entity_id"    => $data['entity_id'],
            "tag_id"       => $data['tag_id'],
        ]);

        return response()->json($tagItem);
    }
}