<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::query()->truncate();

        User::all()->each(function ($user) {
            Address::factory()->count(5)->create(["user_id" => $user->id]);
        });
    }
}
