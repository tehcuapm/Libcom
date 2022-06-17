<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            FileSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            ArticleSeeder::class,
            OrderSeeder::class,
        ]);
        Schema::enableForeignKeyConstraints();


    }
}
