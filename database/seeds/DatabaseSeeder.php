<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // DB::table('roles')->insert([
        //     ['name' => 'admin'],
        //     ['name' => 'editor'],
        //     ['name' => 'user']
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'admin',
        //     'email' => 'admin' . '@gmail.com',
        //     'email_verified_at' => $faker->dateTime($max = 'now', $timezone = null),
        //     'password' => bcrypt('password'),
        //     'role_id' => 1,
        //     'status' => 'inactive',
        //     'phone' => $faker->phoneNumber,
        //     'profile' => 'images/avatar_profile_user_music_headphones_shirt_cool-512.png',
        //     'password_type' => 1,
        //     'created_at' => $faker->dateTime($max = 'now', $timezone = null),
        //     'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
        // ]);

        // DB::table('categories')->insert([
        //     ['name' => 'uncategorized', 'image' => 'images/no-image.png']
        // ]);

        // DB::table('sub_categories')->insert([
        //     ['name' => 'uncategorized', 'category_id' => 1]
        // ]);

        $i = 0;
        while ($i < 20) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => $faker->dateTime($max = 'now', $timezone = null),
                'password' => bcrypt('password'),
                'role_id' => 1,
                'status' => 'inactive',
                'phone' => $faker->phoneNumber,
                'profile' => 'images/avatar_profile_user_music_headphones_shirt_cool-512.png',
                'password_type' => 1,
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
            ]);
            $i++;
        }
    }
}
