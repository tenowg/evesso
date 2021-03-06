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
        if (!Schema::connection($connection)->hasTable('esi_expire_times')) {
            Schema::connection($connection)->create('esi_expire_times', function (Blueprint $table) {
                $table->string('esi_name');
                $table->integer('expires')->default(-100);
                $table->string('etag')->nullable();
                $table->timestamps();

                $table->primary('esi_name');
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
        if ($main && Schema::connection($connection)->hasTable('esi_expire_times')) {
            Schema::connection($connection)->dropIfExists('esi_expire_times');
        }
    }
}
