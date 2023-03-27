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
                'key' => $key,
                'value' => $formattedValues
            );
        }

        return $results;
    }
    public function get($key)
    {

        $values = WebsiteTexts::where('key', $key)->get();
        
        $formattedValues = array();
        
        foreach ($values as $value) {
            $formattedValues[$value->language] = $value->value;
        }
        
        return response()->json([
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
        $imagePath = "texts/" . Auth::user()->client_id;
        $startTime = microtime(true);
    
        $data = $request->all();
    
        $mobile = $request->file('mobile');
        $desktop = $request->file('desktop');
    
        $websiteImage = WebsiteImages::find($data['id']);

        $oldMobile = $websiteImage->mobile;
        $oldDesktop = $websiteImage->desktop;
    
        // Delete the old images
        if(file_exists(storage_path('app/public/'.$oldMobile))) {
            unlink(storage_path('app/public/'.$oldMobile));
        }
        if(file_exists(storage_path('app/public/'.$oldDesktop))) {
            unlink(storage_path('app/public/'.$oldDesktop));
        }

        $mobile = $mobile->store($imagePath, 'public');
        $desktop = $desktop->store($imagePath, 'public');

    
        // Update the image data in the database
        $websiteImage->update([
            'mobile' => $mobile,
            'desktop' => $desktop,
            'alt' => $data['alt'],
        ]);
    
        $duration = microtime(true) - $startTime;
    
        $this->log('update', 'Updated image #'.$websiteImage->id, $duration);
    
        return response()->json($websiteImage);
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