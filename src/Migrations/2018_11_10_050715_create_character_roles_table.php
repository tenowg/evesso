<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('character_roles')) {
            Schema::connection($connection)->create('character_roles', function (Blueprint $table) {
                $table->integer('character_id');
                $table->json('roles')->default('[]');
                $table->json('roles_at_base')->default('[]');
                $table->json('roles_at_hq')->default('[]');
                $table->json('roles_at_other')->default('[]');
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
        if ($main && Schema::connection($connection)->hasTable('character_balances')) {
            Schema::connection($connection)->dropIfExists('character_balances');
        }
        Schema::dropIfExists('character_roles');
    }
}
