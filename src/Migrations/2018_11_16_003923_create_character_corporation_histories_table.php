<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterCorporationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('character_corporation_histories')) {
            Schema::connection($connection)->create('character_corporation_histories', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('character_id');
                $table->integer('corporation_id');
                $table->boolean('is_deleted')->nullable();
                $table->integer('record_id');
                $table->dateTimeTz('start_date');
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
        $connection = config('eve-sso.database');
        $main = config('eve-sso.main_host');
        if ($main && Schema::connection($connection)->hasTable('character_corporation_histories')) {
            Schema::connection($connection)->dropIfExists('character_corporation_histories');
        }
    }
}
