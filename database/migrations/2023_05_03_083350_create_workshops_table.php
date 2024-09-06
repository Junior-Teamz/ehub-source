<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('state_code')->on('states')->onDelete('cascade');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('city_code')->on('cities')->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->string('organizer')->nullable();
            $table->text('organizer_image')->nullable();
            $table->string('material_links')->nullable();
            $table->string('place')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('quota')->nullable();
            $table->integer('registrant_total')->nullable();
            $table->integer('registrant_accepted')->nullable();
            $table->enum('status', ['finish', 'publish', 'unpublish'])->nullable();
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
        Schema::dropIfExists('workshops');
    }
}
