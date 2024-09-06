<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourneySectionsTable extends Migration
{
    public function up()
    {
        Schema::create('journey_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->unsignedBigInteger('page_id');
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('journey_pages');
        });
    }

    public function down()
    {
        Schema::dropIfExists('journey_sections');
    }
}
