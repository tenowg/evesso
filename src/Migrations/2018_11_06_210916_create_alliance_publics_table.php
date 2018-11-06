<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlliancePublicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('alliance_publics')) {
            Schema::connection($connection)->create('alliance_publics', function (Blueprint $table) {
                $table->integer('alliance_id');
                $table->integer('creator_id');
                $table->dateTimeTz('date_founded');
                $table->integer('executor_corporation_id')->nullable();
                $table->integer('faction_id')->nullable();
                $table->string('name');
                $table->string('ticker');
                $table->timestamps();

                $table->primary('alliance_id');
            });
        };
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
        if ($main && Schema::connection($connection)->hasTable('alliance_publics')) {
            Schema::connection($connection)->dropIfExists('alliance_publics');
        }
    }
}
