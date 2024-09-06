<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParticipantUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participant_users', function (Blueprint $table) {
            $table->unsignedBigInteger('state_code')->after('gender')->nullable();
            $table->foreign('state_code')->references('state_code')->on('states')->onDelete('CASCADE');
            $table->unsignedBigInteger('city_code')->after('state_code')->nullable();
            $table->foreign('city_code')->references('city_code')->on('cities')->onDelete('CASCADE');
            $table->unsignedBigInteger('sector_code')->after('city_code')->nullable();
            $table->foreign('sector_code')->references('sector_code')->on('sectors')->onDelete('CASCADE');
            $table->unsignedBigInteger('village_code')->after('sector_code')->nullable();
            $table->foreign('village_code')->references('village_code')->on('villages')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participant_users', function (Blueprint $table) {
            $table->dropForeign('participant_users_state_code_foreign');
            $table->dropColumn('state_code');
            $table->dropForeign('participant_users_city_code_foreign');
            $table->dropColumn('city_code');
            $table->dropForeign('participant_users_sector_code_foreign');
            $table->dropColumn('sector_code');
            $table->dropForeign('participant_users_village_code_foreign');
            $table->dropColumn('village_code');
        });
    }
}
