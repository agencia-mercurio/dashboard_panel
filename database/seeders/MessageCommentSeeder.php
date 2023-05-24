<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MessageComment;
use Faker\Factory as Faker;

class MessageCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach(range(1, 25) as $i) {

            foreach(range(1, rand(1,3)) as $j)
                MessageComment::create([
                    'message_id' => $i,
                    'user_id'       => rand(1,1),
                    'comment'    => $faker->paragraph
                ]);
        }
    }
}
