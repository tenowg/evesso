<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('inv_types')) {
            Schema::connection($connection)->create('inv_types', function (Blueprint $table) {
                $table->integer('type_id');
                $table->float('capacity', 8, 2)->nullable();
                $table->mediumText('description');
                $table->json('dogma_attributes')->default('[]');
                $table->json('dogma_affects')->default('[]');
                $table->integer('graphic_id')->nullable();
                $table->integer('group_id');
                $table->integer('icon_id')->nullable();
                $table->integer('market_group_id')->nullable();
                $table->float('mass', 8, 2)->nullable();
                $table->string('name');
                $table->float('packaged_volume', 8, 2)->nullable();
                $table->integer('portion_size')->nullable();
                $table->boolean('published');
                $table->float('radius', 8, 2)->nullable();
                $table->float('volume', 8, 2)->nullable();
                $table->timestamps();

                $table->primary('type_id');
            });
        };
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
        if ($main && Schema::connection($connection)->hasTable('inv_types')) {
            Schema::connection($connection)->dropIfExists('inv_types');
        }
    }
}
