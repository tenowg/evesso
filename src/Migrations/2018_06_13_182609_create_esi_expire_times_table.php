<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsiExpireTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        Schema::connection($connection)->create('esi_expire_times', function (Blueprint $table) {
            $table->string('esi_name');
            $table->integer('expires')->default(-100);
            $table->string('etag')->default('');
            $table->timestamps();

            $table->primary('esi_name');
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
        Schema::connection($connection)->dropIfExists('esi_expire_times');
    }
}
