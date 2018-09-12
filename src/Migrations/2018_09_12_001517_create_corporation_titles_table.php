<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('corporation_titles')) {
            Schema::connection($connection)->create('corporation_titles', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('corporation_id');
                $table->json('grantable_roles')->default('[]');
                $table->json('grantable_roles_at_base')->default('[]');
                $table->json('grantable_roles_at_hq')->default('[]');
                $table->json('grantable_roles_at_other')->default('[]');
                $table->string('name');
                $table->json('roles')->default('[]');
                $table->json('roles_at_base')->default('[]');
                $table->json('roles_at_hq')->default('[]');
                $table->json('roles_at_other')->default('[]');
                $table->integer('title_id');
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
        if ($main && Schema::connection($connection)->hasTable('corporation_titles')) {
            Schema::connection($connection)->dropIfExists('corporation_titles');
        }
    }
}
