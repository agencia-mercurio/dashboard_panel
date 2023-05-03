<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::create([
            'permissions_id' => '1',
            'client_id' => '1',
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'type' => 'client',
            'role' => 'user',
            'password' => '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',
            'api_key' => '803572d6-d988-11ed-afa1-0242ac120002'
        ]);
    }
}