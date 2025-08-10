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
        \App\Models\Portfolio::create([
            'image_id' => Image::create([
                'path' => 'IMG_9813.jpg',
            ])->id,
            'title' => 'Фасад здания катка',
            'description' => 'Проектирование и монтаж фасада с утеплением и облицовкой. Адрес: ул. Фаворского, СПб.',
            'client' => 'Администрация Калининского района',
            'completed_at' => '4 месяца',
            'notes' => 'Состав работ по проекту фасада здания. Проектирование, составление раскладок фасадных материалов. Монтаж подконструкции с утеплением по существующим несущим стенам. Монтаж сэндвич-профиля с утеплением и подконструкцией по существующему каркасу. Монтаж фасадных облицовок по подконструкции (металлические линеарные панели и профлист). Монтаж трёхслойных сэндвич-панелей. Монтаж фасонных элементов. Составление исполнительной документации.'
        ]);
        \App\Models\Portfolio::create([
            'image_id' => Image::create([
                'path' => 'IMG_0017.jpg',
            ])->id,
            'title' => 'Фасад здания катка Василеостровского района',
            'description' => 'Проектирование и монтаж фасада с облицовкой и утеплением. Адрес: Средний пр. В.О., д. 87, корп. 2, лит. А.',
            'client' => 'Администрация Васильевского района',
            'completed_at' => '2.5 месяца',
            'notes' => 'Состав работ по фасаду катка В.О. Проектирование, составление раскладок фасадных материалов. Монтаж подконструкции по существующей ограждающей конструкции. Монтаж фасадной облицовки по подконструкции (металлические кассеты). Монтаж фасонных элементов. Составление исполнительной документации.'
        ]);
        \App\Models\Portfolio::create([
            'image_id' => Image::create([
                'path' => 'IMG_130167.jpg',
            ])->id,
            'title' => 'Фасад строительного центра',
            'description' => 'Проектирование и монтаж фасада с облицовкой и утеплением. Адрес: 12-13 км шоссе Кола, 3.',
            'client' => 'СТД «Петрович»',
            'completed_at' => '2.5 месяца',
            'notes' => 'Состав работ по фасаду строительного центра. Проектирование, составление раскладок фасадных материалов. Монтаж подконструкции по существующей ограждающей конструкции. Монтаж фасадной облицовки по подконструкции (металлические кассеты). Монтаж фасонных элементов. Составление исполнительной документации.'
        ]);
        \App\Models\Portfolio::create([
            'image_id' => Image::create([
                'path' => '_Fjord_Plaza_.jpg',
            ])->id,
            'title' => 'Фасад торгового центра Fjord Plaza',
            'description' => 'Проектирование и монтаж фасада с облицовкой и утеплением. Адрес: Завеличенская ул., 23, д. Борисовичи, Псковская обл.',
            'client' => 'ТЦ «Fjord Plaza»',
            'completed_at' => '3 месяца',
            'notes' => 'Состав работ по фасаду торгового центра. Проектирование, составление раскладок фасадных материалов. Монтаж подконструкции по существующей ограждающей конструкции. Монтаж фасадной облицовки по подконструкции (металлические кассеты). Монтаж фасонных элементов. Составление исполнительной документации.'
        ]);





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
