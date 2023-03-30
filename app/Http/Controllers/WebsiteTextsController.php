<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteTexts;
use App\Models\DashboardLogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class WebsiteTextsController extends Controller
{
    public function all() {
        $keys = WebsiteTexts::distinct('key')->pluck('key');

        $results = array();

        foreach ($keys as $key) {
            $values = WebsiteTexts::where('key', $key)->get();
            
            $formattedValues = array();
            
            foreach ($values as $value) {
                $formattedValues[$value->language] = $value->value;
            }
            
            $results[] = array(
                'label' => $values[0]->label,
                'key' => $key,
                'value' => $formattedValues
            );
        }

        return $results;
    }
    public function get($key)
    {

        $values = WebsiteTexts::where('key', $key)->get();
        $label = $values[0]->label;
        
        $formattedValues = array();
        
        foreach ($values as $value) {
            $formattedValues[$value->language] = $value->value;
        }
        
        return response()->json([
            'label' => $label,
            'key' => $key,
            'value' => $formattedValues
        ]);
    }

    public function create(Request $request)
    {
        $startTime = microtime(true);

        $data = $request->json()->all();

        $websiteImage = WebsiteTexts::create($data);

        $duration = microtime(true) - $startTime;

        $this->log('create', 'Created image #'.$image->id, $duration);

        return response()->json($image);
    }

    public function update(Request $request)
    {
        $startTime = microtime(true);
    
        $data = $request->json()->all();
        $languages = $data['values'];
        $key = $data['key'];
        $label = $data['label'];

        foreach ($languages as $language => $value) {
            $websiteText = WebsiteTexts::where('key', $key)->where('language', $language)->first();
            $websiteText->value = $value;
            $websiteText->save();
        }
    
        $duration = microtime(true) - $startTime;
    
        $this->log('update', 'Updated Text #'.$key, $duration);
    
        return response()->json([
            'label' => $label,
            'key' => $key,
            'values' => $data['values']
        ]);
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