<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourneyPagesTable extends Migration
{
    public function up()
    {
        Schema::create('journey_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('journey_pages');
    }
}
