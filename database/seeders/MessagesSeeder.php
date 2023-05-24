<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Messages;
use App\Models\MessageItems;
use Faker\Factory as Faker;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach(range(1, 25) as $number) {

            $message = Messages::create([
                'client_id' => 1,
                'email'     => $faker->email,
                'viewed_at' => $faker->randomElement([now(), null])
            ]);

            $items = ['name', 'phoneNumber', 'email', 'paragraph'];

            foreach ($items as $item) {

                MessageItems::create([
                    'message_id'    => $message->id,
                    'key'           => $item,
                    'value'         => $faker->$item,
                ]);
            }

            MessageItems::where(['key' => 'phoneNumber'])->update(['key' => 'phone']);
            MessageItems::where(['key' => 'paragraph'])->update(['key' => 'message']);
        }

    }
}