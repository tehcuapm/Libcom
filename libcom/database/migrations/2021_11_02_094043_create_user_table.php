<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string("name")->nullable(false);
                $table->string('email', 125)->nullable(false);
                $table->string('password', 224)->nullable(false);
                $table->boolean('public_profile')->default(1);
                $table->dateTime("email_verified_at")->nullable(true);
                $table->dateTime("last_connection")->nullable(true);
                $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
