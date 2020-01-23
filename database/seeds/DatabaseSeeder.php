<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'editor'],
            ['name' => 'user']
        ]);

        DB::table('categories')->insert([
            ['name' => 'uncategorized', 'image' => 'images/no-image.png']
        ]);

        DB::table('sub_categories')->insert([
            ['name' => 'uncategorized', 'category_id' => 1]
        ]);
    }
}
