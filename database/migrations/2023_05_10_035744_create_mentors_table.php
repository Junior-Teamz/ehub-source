<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('collaborator_id')->nullable();
            $table->foreign('collaborator_id')->references('id')->on('collaborators')->onDelete('SET NULL');
            $table->text('avatar_url')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fullname')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('expertise')->nullable();
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
        Schema::dropIfExists('mentors');
    }
}
