<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('character_stats')) {
            Schema::connection($connection)->create('character_stats', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('character_id');
                $table->json('character')->default('[]');
                $table->json('combat')->default('[]');
                $table->json('industry')->default('[]');
                $table->json('inventory')->default('[]');
                $table->json('isk')->default('[]');
                $table->json('market')->default('[]');
                $table->json('mining')->default('[]');
                $table->json('module')->default('[]');
                $table->json('orbital')->default('[]');
                $table->json('pve')->default('[]');
                $table->json('social')->default('[]');
                $table->json('travel')->default('[]');
                $table->integer('year');
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
        if ($main && Schema::connection($connection)->hasTable('character_stats')) {
            Schema::connection($connection)->dropIfExists('character_stats');
        }
    }
}
