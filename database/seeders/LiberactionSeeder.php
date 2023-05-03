<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebsiteTexts;
use App\Models\WebsiteImages;
use Illuminate\Support\Facades\Storage;

class LiberactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(['pt', 'en'] as $language) {
            $json = file_get_contents("database/seeders/texts/liberaction/$language.json");

            $object = json_decode($json);
            
            $keys = (array) $object;
            
            $res = array();
            
            foreach ($keys as $key => $value) {
            
                $prefix = $key;
                if (is_object($value)) {
                    foreach ($value as $_k => $k) {
                        if (is_object($k)) {
                            foreach ($k as $_j => $j) {
                                if(is_array($j)) {
                                    $res[$prefix . '.' . $_k . '.' . $_j] = json_encode($j);
                                } else {
                                    $res[$prefix . '.' . $_k . '.' . $_j] = $j;
                                }
                            }
                        } else {
                            $res[$prefix . '.' . $_k] = $k;
            
                        }
                    }
                } else {
                    $res[$prefix] = $value;
                }
            }
            
            
            foreach ($res as $key => $value) {
                WebsiteTexts::create([
                    'client_id' => 1,
                    'key' => $key,
                    'label' => $key,
                    'value' => $value,
                    'language' => $language,
                    'active' => 1
                ]);
            }
        }


        $images = file_get_contents("database/seeders/images/liberaction.json");
        $imagesObject = json_decode($images);
        $imagesKeys = (array) $imagesObject;

        foreach ($imagesKeys as $key => $value) {

            $image = $imagesObject->$key;

            $file = file_get_contents($image->value);
            $filename = basename($image->value);
            $path = "images/1/$filename";
            Storage::disk('public')->put($path, $file);

            WebsiteImages::create([
                'client_id' => 1,
                'key' => $key,
                'label' => $key,
                'desktop' => $path,
                'mobile' => $path,
                'dimensions' => $image->dimensions,
                'alt' => '',
                'active' => 1
            ]);
        }

    }
}