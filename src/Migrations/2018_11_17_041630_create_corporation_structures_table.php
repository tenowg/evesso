<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('corporation_structures')) {
            Schema::connection($connection)->create('corporation_structures', function (Blueprint $table) {
                $table->integer('corporation_id');
                $table->dateTimeTz('fuel_expires')->nullable();
                $table->dateTimeTz('next_reinforce_apply')->nullable();
                $table->integer('next_reinforce_hour')->nullable();
                $table->integer('next_reinforce_weekday')->nullable();
                $table->integer('profile_id');
                $table->integer('reinforce_hour');
                $table->integer('reinforce_weekday');
                $table->json('services')->default('[]');
                $table->string('state');
                $table->dateTimeTz('state_timer_end')->nullable();
                $table->dateTimeTz('state_timer_start')->nullable();
                $table->bigInteger('structure_id');
                $table->integer('system_id');
                $table->integer('type_id');
                $table->dateTimeTz('unanchors_at')->nullable();
                $table->timestamps();

                $table->primary('structure_id');
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
        if ($main && Schema::connection($connection)->hasTable('corporation_structures')) {
            Schema::connection($connection)->dropIfExists('corporation_structures');
        }
    }
}
