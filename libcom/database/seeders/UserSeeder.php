<?php

namespace Database\Seeders;

use App\Helpers\UserHelper;
use App\Http\Interfaces\PanierInterface;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private $panier;

    public function __construct(PanierInterface $panier)
    {
        $this->panier = $panier;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate(); //truncate permet de vider la base de données
        DB::table("avatars_users")->truncate();
        $this->panier->clearAll();

        $admin = User::factory()->create(["password" => Hash::make("password"), "email" => "admin@gmail.com"]);
        $admin->assignRole("admin");
        UserHelper::initUserAvatars($admin);
        if (Config::get("constants.options.verify")) {

            $admin->markEmailAsVerified();

        }
        User::factory()->count(50)->create();

    }
}

