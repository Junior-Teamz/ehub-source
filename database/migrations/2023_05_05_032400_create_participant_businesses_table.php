<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participant_id');
            $table->foreign('participant_id')->references('id')->on('participant_users')->onDelete('cascade');
            $table->unsignedBigInteger('business_type_id')->nullable();
            $table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->string('nib')->nullable();
            $table->integer('nib_created_at')->nullable();
            $table->string('community')->nullable();
            $table->string('platforms')->nullable();
            $table->string('ig_account')->nullable();
            $table->string('fb_account')->nullable();
            $table->string('tiktok_account')->nullable();
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
        Schema::dropIfExists('participant_businesses');
    }
}
