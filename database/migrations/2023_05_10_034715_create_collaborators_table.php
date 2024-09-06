<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->text('logo_url')->nullable();
            $table->text('cover_url')->nullable();
            $table->string('name')->nullable();
            $table->string('director_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('state_code')->on('states')->onDelete('SET NULL');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('city_code')->on('cities')->onDelete('SET NULL');
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('collaborators');
    }
}
