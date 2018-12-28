<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterFleetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('character_fleets')) {
            Schema::connection($connection)->create('character_fleets', function (Blueprint $table) {
                $table->integer('character_id');
                $table->bigInteger('fleet_id');
                $table->enum('role', ['fleet_commander', 'squad_commander', 'squad_member', 'wing_commander']);
                $table->bigInteger('squad_id');
                $table->bigInteger('wing_id');
                $table->timestamps();

                $table->primary('character_id');
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
        Schema::dropIfExists('character_fleets');
    }
}
