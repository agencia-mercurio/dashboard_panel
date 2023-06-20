<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\Models\WebsiteTexts;
use App\Models\WebsiteImages;
use App\Models\WebsiteAccess;
use App\Models\WebsiteAccessEvents;
use App\Models\Users;
use App\Models\OPTransmissions;

class ApiController extends Controller
{
    public function texts($api_key) {

        $results = [];

        $user = Users::where('api_key', $api_key)->firstOrFail();

        $texts = WebsiteTexts::where([
            'client_id' => $user->client_id
        ])->get();

        foreach($texts as $text) {
            $results[$text->key][$text->language] = $text->value;
        }

        return $results;
    }
    public function images($api_key) {

        $results = [];

        $user = Users::where('api_key', $api_key)->firstOrFail();

        $images = WebsiteImages::where([
            'client_id' => $user->client_id, 
            'active' => 1
        ])->get();

        $baseUrl = url('/') . '/';

        foreach($images as $image) {
            $results[$image->key] = [
                'desktop'   => $baseUrl . $image->desktop,
                'mobile'    => $baseUrl . $image->mobile,
                'alt'       => $image->alt
            ];
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
    public function opTransmission(Request $request) {
        if (!$request->all()['login'] || !$request->all()['password']) {
            return response()->json([
                'status' => false,
                'error' => 'Missing parameters!'
            ]);
        }
        $login = $request->all()['login'];
        $password = $request->all()['password'];

        $transmission = OPTransmissions::where([
            'login' => $login,
            'password' => $password
        ])->first();

        if (!$transmission) {
            return response()->json([
                'status' => false,
                'error' => 'No transmission found!'
            ]);
        }

        $id = $transmission->external_id;
        $room_password = $transmission->room_password;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.adiau.cloud/transmissions/stream',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query(array(
                'transmission' => $id,
                'password' => $room_password,
            )),
            CURLOPT_HTTPHEADER => array(
                'token: 559a57d20d1a34b485435b93069b7495',
                'client: 360',
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        curl_close($curl);
        
        if(curl_errno($curl)){
            $response = 'Request Error:' . curl_error($curl);
        }
        else{
            $response = curl_exec($curl);
        }

        $response = json_decode($response, true);


        if (!isset($response['data'])) {
            $response = [];
        } else {
            $response = $response['data'];
        }

        if(sizeof($response) == 0) {
            return response()->json([
                'status' => false,
                'error' => 'No cameras found!'
            ]);
        }


        return response()->json([
            'status' => true,
            'cameras' => $response
        ]);
    }
}