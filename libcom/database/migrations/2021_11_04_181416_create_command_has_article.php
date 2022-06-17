<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandHasArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {

                $table->id();
                $table->foreignId('address_id')->nullable(true)->constrained("addresses")->nullOnDelete();
                $table->dateTime('order_date');
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
                $table->timestamps();

            });
        }
        if (!Schema::hasTable('orders_articles')) {

            Schema::create('orders_articles', function (Blueprint $table) {
                $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
                $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
                $table->unsignedMediumInteger('quantity');
                $table->primary(['order_id', 'article_id']);
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('address');
        Schema::dropIfExists('order_has_article');
    }
}
