<?php

namespace Database\Seeders;

use App\Models\Avatar;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::query()->truncate();
        Avatar::query()->truncate();

        $products = array_map(function ($item) {
            return "storage/" . $item;

        }, Storage::disk("public")->files("assets/products"));
        $avatars = array_map(function ($item) {
            return "storage/" . $item;
        }, Storage::disk("public")->files("assets/avatars"));
        foreach ($products as $file) {
            $name = basename($file);

            Image::query()->create(["name" => $name, "path_file" => $file]);
        }
        foreach ($avatars as $file) {
            $name = basename($file);

            Avatar::query()->create(["name" => $name, "path_file" => $file]);
        }
    }
}
