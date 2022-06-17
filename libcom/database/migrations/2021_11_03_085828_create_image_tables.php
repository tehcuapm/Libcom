<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable("images")) {
            Schema::create('images', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('path_file');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable("avatars")) {
            Schema::create('avatars', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('path_file');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable("images_articles")) {
            Schema::create('images_articles', function (Blueprint $table) {
                $table->foreignId("article_id")->constrained("articles")->cascadeOnDelete();
                $table->foreignId("image_id")->nullable(true)->constrained("images")->nullOnDelete();

            });
        }
        if (!Schema::hasTable("avatars_users")) {
            Schema::create('avatars_users', function (Blueprint $table) {
                $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
                $table->foreignId("avatar_id")->constrained("avatars")->cascadeOnDelete();
            });
        }
        Schema::table("users", function (Blueprint $table) {
            $table->foreignId("current_avatar")->nullable(true)->constrained("avatars")->onDelete('set null');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
        Schema::dropIfExists('avatars');
        Schema::dropIfExists('images_articles');
        Schema::dropIfExists('avatars_users');

    }
}
