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
            'password' => 'user',
        ]);

        $files = Storage::disk('public')->files();
        foreach ($files as $file) {
            $image = Image::create([
                'path' => $file,
            ]);
            \App\Models\Portfolio::create([
                'image_id' => $image->id,
                'title' => $faker->title(),
                'description' => $faker->text(200),
            ]);
            \App\Models\Service::create([
                'image_id' => $image->id,
                'title' => $faker->title(),
                'description' => $faker->text(200),
                'price' => $faker->numberBetween(1000, 10000),
            ]);
        }
        $inquiry = \App\Models\Inquiry::create([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $faker->phoneNumber(),
            'company' => $faker->company(),
            'message' => 'помогите помогите',
        ]);
        $chat = \App\Models\Chat::create([
            'user_id' => $user->id,
        ]);
        for ($i = 0; $i < 5; $i++) {
            \App\Models\Massage::create([
                'user_id' => $user->id,
                'chat_id' => $chat->id,
                'content' => $faker->text(25),
            ]);
        }
    }
}
