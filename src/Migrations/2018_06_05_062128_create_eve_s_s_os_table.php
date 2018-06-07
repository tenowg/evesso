<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEveSSOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        Schema::connection($connection)->create('eve_ssos', function (Blueprint $table) {
            $table->string('name');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->integer('expires');
            $table->integer('character_id');
            $table->string('character_owner_hash');
            $table->json('scopes');
            $table->string('avatar')->nullable();
            $table->timestamps();

            $table->primary('character_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('eve-sso.database');
        Schema::connection($connection)->dropIfExists('eve_ssos');
    }
}
