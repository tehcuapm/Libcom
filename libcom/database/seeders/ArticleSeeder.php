<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::query()->truncate();
        DB::table("images_articles")->truncate();
        $articles = Article::factory()->count(50)->create();
        $images = Image::all();
        $articles->each(function (Article $a) use ($images) {
            $a->images()->save($images->random(1)->first());

        });


    }
}
