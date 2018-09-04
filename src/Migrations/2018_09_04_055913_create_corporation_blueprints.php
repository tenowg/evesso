<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationBlueprints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('corporation_blueprints')) {
            Schema::connection($connection)->create('corporation_blueprints', function (Blueprint $table) {
                $table->integer('corporation_id');
                $table->bigInteger('item_id');
                $table->string('location_flag');
                $table->bigInteger('location_id');
                $table->integer('material_efficiency');
                $table->integer('quantity');
                $table->integer('runs');
                $table->integer('time_efficiency');
                $table->integer('type_id');
                $table->timestamps();

                $table->primary('item_id');
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
        if ($main && Schema::connection($connection)->hasTable('corporation_blueprints')) {
            Schema::connection($connection)->dropIfExists('corporation_blueprints');
        }
    }
}
