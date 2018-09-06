<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('structures')) {
            Schema::connection($connection)->create('structures', function (Blueprint $table) {
                $table->bigInteger('structure_id');
                $table->string('name');
                $table->integer('owner_id');
                $table->json('position')->nullable();
                $table->integer('solar_system_id');
                $table->integer('type_id')->nullable();
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
        if ($main && Schema::connection($connection)->hasTable('structures')) {
            Schema::connection($connection)->dropIfExists('structures');
        }
    }
}
