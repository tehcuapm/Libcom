<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.Level 50
     *
     * @return void
     */
    public function run()
    {
        Order::query()->truncate();
        DB::table('orders_articles')->truncate();

        $orders = Order::factory()->count(50)->create();
        $articles = Article::all();
        $orders->each(function (Order $o) use ($articles) {
            $o->articles()->attach(
                $articles->random(rand(1, 5))->pluck('id')->toArray(),
                ['quantity' => rand(1, 3)]
            );
        });

    }
}
