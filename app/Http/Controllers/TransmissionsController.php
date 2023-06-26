<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\OPTransmissions;

class TransmissionsController extends Controller
{
    public function all()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.adiau.cloud/transmissions/online',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => 'status=public',
            CURLOPT_HTTPHEADER => array(
            'token: 559a57d20d1a34b485435b93069b7495',
            'client: 360',
            'Content-Type: application/x-www-form-urlencoded'
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

            if (!$response['status'] && !$response['message'] == 'Empty list') {
                $response = [];
            } else {
                $response = $response['data'] ?? [];
                $response = $this->storeTransmissions($response);
                return response()->json($response);
            }    

        return response()->json($response);
    }
    private function storeTransmissions($transmissions)
    {

        $optransmissionsIds = OPTransmissions::all()->pluck('external_id')->toArray();
        $transmissionsIds = [];
        
        
        foreach ($transmissions as $transmission) {
            $transmission['external_id'] = (int) $transmission['id'];
            
            if(!in_array($transmission['external_id'], $optransmissionsIds)) {
                OPTransmissions::create($transmission);
            }
            $transmissionsIds[] = $transmission['external_id'];
        }

        if (sizeof($optransmissionsIds) > 0) {
            $idsToDelete = array_diff($optransmissionsIds, $transmissionsIds);
            OPTransmissions::whereIn('external_id', $idsToDelete)->delete();
        }

        $optransmissions = OPTransmissions::all();

        return $optransmissions;
    }
    public function get($id) {
        $transmission = OPTransmissions::find($id);

        if (!$transmission) {
            $error = "Transmission not found";
            return response()->json(['error' => $error], 404);
        }

        return response()->json($transmission);
    }
    public function update(int $id, Request $request) {
        $data = $request->all();

        $transmission = OPTransmissions::find($id);
        
        $transmission->login  = $data['login'];
        $transmission->password  = $data['password'];
        $transmission->room_password  = $data['room_password'];

        $transmission->save();
        
        return response()->json($transmission);
    }
}