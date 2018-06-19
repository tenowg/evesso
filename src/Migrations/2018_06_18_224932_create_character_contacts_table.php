<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('character_contacts')) {
            Schema::connection($connection)->create('character_contacts', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('character_id');
                $table->integer('contact_id');
                $table->enum('contact_type', [
                    'character',
                    'corporation',
                    'alliance',
                    'faction'
                ]);
                $table->boolean('is_blocked')->nullable();
                $table->boolean('is_watched')->nullable();
                $table->json('label_ids')->nullable();
                $table->float('standing', null, 5);
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
        if ($main && Schema::connection($connection)->hasTable('character_contacts')) {
            Schema::connection($connection)->dropIfExists('character_contacts');
        }
    }
}
