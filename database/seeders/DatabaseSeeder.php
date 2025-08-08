<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Image;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $admin = \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => $faker->phoneNumber(),
            'role' => 'admin',
            'password' => 'admin',
        ]);

        $user = \App\Models\User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'phone' => $faker->phoneNumber(),
            'company' => $faker->company(),
            'password' => 'user',
        ]);

        $coatings = [
            'Кирпич' => 1500,
            'Штукатурка' => 1200,
            'Сайдинг' => 1000,
            'Керамогранит' => 1800,
        ];
        foreach ($coatings as $name => $price) {
            \App\Models\Service::create([
                'name' => $name,
                'price' => $price,
                'type' => 'coatings',
            ]);
        }
        $insulationOptions = [
            ['name' => 'Минеральная вата 50 мм', 'price' => 300],
            ['name' => 'Минеральная вата 100 мм', 'price' => 500],
            ['name' => 'Минеральная вата 150 мм', 'price' => 700],
            ['name' => 'Минеральная вата 200 мм', 'price' => 900],
        ];
        foreach ($insulationOptions as $value) {
            \App\Models\Service::create([
                'name' => $value['name'],
                'price' => $value['price'],
                'type' => 'insulationOptions',
            ]);
        }
        $files = Storage::disk('public')->files();

        for ($i = 0; $i < 3; $i++) {
            foreach ($files as $file) {
                $image = Image::create([
                    'path' => $file,
                ]);
                \App\Models\Portfolio::create([
                    'image_id' => $image->id,
                    'title' => $faker->title(),
                    'description' => $faker->text(200),
                    'client' => $faker->company(),
                    'completed_at' => $faker->date(),
                    'notes' => $faker->text(2000),
                ]);
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $chat = \App\Models\Chat::create([
                'user_id' => $user->id,
            ]);
            $message = \App\Models\Message::create([
                'user_id' => $user->id,
                'chat_id' => $chat->id,
                'content' => $faker->text(25),
            ]);
            \App\Models\ViewedMessage::create([
                'user_id' => $user->id,
                'chat_id' => $chat->id,
                'message_id' => $message->id,
            ]);
        }
        \App\Models\GuestQuery::create([
            'name' => $faker->name(),
            'email' => $faker->email(),
            'phone' => $faker->phoneNumber(),
            'company' => $faker->company(),
            'description' => $faker->text(200),
            'content' => $faker->text(2000),
        ]);
        \App\Models\Contact::create([
            'name' => 'mail',
            'description' => 'ksm@mail.ru',
            'link' => 'ksm@mail.ru',
        ]);
        \App\Models\Contact::create([
            'name' => 'vk',
            'description' => 'КСМ',
            'link' => 'https://vk.com/ksm',
        ]);
        \App\Models\Contact::create([
            'name' => 'phone',
            'description' => '+7 911 613 71 27',
            'link' => '+79116137127',
        ]);
    }
}
