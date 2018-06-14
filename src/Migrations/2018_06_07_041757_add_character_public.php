<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCharacterPublic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('character_public')) {
            Schema::connection($connection)->create('character_public', function (Blueprint $table) {
                $table->integer('character_id');
                $table->integer('alliance_id')->nullable();
                $table->integer('ancestry_id')->nullable();;
                $table->dateTimeTz('birthday');
                $table->integer('bloodline_id');
                $table->integer('corporation_id');
                $table->longText('description')->nullable();
                $table->integer('faction_id')->nullable();
                $table->string('gender');
                $table->string('name');
                $table->integer('race_id');
                $table->float('security_status', 8, 5);
                $table->json('titles')->default('[]');
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
        $connection = config('eve-sso.database');
        $main = config('eve-sso.main_host');
        if ($main && Schema::connection($connection)->hasTable('character_public')) {
            Schema::connection($connection)->dropIfExists('character_public');
        }
    }
}
