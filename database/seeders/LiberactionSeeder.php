<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebsiteTexts;

class LiberactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(['pt', 'en'] as $language) {
            $json = file_get_contents('C:\Users\leona\OneDrive\Área de Trabalho\Agência Mercúrio\dashboard_panel\jsons\liberaction\texts.'. $language .'.json');

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
    }
}