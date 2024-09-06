<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourneyLogosTable extends Migration
{
    public function up()
    {
        Schema::create('journey_logos', function (Blueprint $table) {
            $table->id();
            $table->string('logo_name');
            $table->string('url_logo');
            $table->boolean('status')->default(0); // 'status' column as a boolean with default value 0
            $table->string('website')->nullable(); // 'website' column as a nullable string
            $table->timestamps();
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('section_id');

            $table->foreign('page_id')->references('id')->on('journey_pages');
            $table->foreign('section_id')->references('id')->on('journey_sections');
        });
    }

    public function down()
    {
        Schema::dropIfExists('journey_logos');
    }
}
