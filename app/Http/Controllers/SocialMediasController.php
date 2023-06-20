<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\SocialMedias;

class SocialMediasController extends Controller
{
    public function all()
    {
        return SocialMedias::where([
                'entity' => 'client',
                'id_entity' => Auth::user()->client_id
            ])->get();
    }
    public function save(Request $request)
    {
        $socialMedias = [];

        $data = $request->all();
        foreach($data as $item) {
            $item['updated_at'] = now();
            unset($item['created_at']);
            $socialMedias[] = SocialMedias::where('id', $item['id'])->update($item);
        }

        return $socialMedias;
    }
}