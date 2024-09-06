<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->string('username')->nullable();
            $table->string('id_card')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('born_place')->nullable();
            $table->date('born_date')->nullable();
            $table->text('photo')->nullable();
            $table->text('photo_url')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('sector')->nullable();
            $table->string('village')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('address')->nullable();
            $table->string('marital_status')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
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
