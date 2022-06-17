<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string("name", 45)->nullable(false);
                $table->string('pres_picture')->nullable();


            });
        }
        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->string("title")->nullable(false);
                $table->string("speech")->nullable(false);
                $table->integer('stock')->nullable(false);
                $table->integer('price')->nullable(false);
                $table->foreignId('category_id')->nullable(true)->constrained('categories')->onDelete('set null');
                $table->timestamps();
            });
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
    }
}
