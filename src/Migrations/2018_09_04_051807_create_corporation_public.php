<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationPublic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('corporation_public')) {
            Schema::connection($connection)->create('corporation_public', function (Blueprint $table) {
                $table->integer('corporation_id');
                $table->integer('alliance_id')->nullable();
                $table->integer('ceo_id');
                $table->integer('creator_id');
                $table->dateTimeTz('date_founded')->nullable();
                $table->mediumText('description')->nullable();
                $table->integer('faction_id')->nullable();
                $table->integer('home_station_id')->nullable();
                $table->integer('member_count');
                $table->string('name');
                $table->bigInteger('shares')->nullable();
                $table->float('tax_rate', 8, 3);
                $table->string('ticker');
                $table->string('url')->nullable();

                $table->timestamps();

                $table->primary('corporation_id');
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
        if ($main && Schema::connection($connection)->hasTable('corporation_public')) {
            Schema::connection($connection)->dropIfExists('corporation_public');
        }
    }
}
