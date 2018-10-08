<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('character_notifications')) {
            Schema::connection($connection)->create('character_notifications', function (Blueprint $table) {
                $table->increments('id');
                // ESI
                $table->integer('character_id');
                $table->boolean('is_read')->default(false);
                $table->bigInteger('notification_id');
                $table->integer('sender_id');
                $table->string('sender_type');
                $table->string('text')->nullable();
                $table->dateTimeTz('timestamp');
                $table->string('type');
                
                $table->timestamps();
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
        if ($main && Schema::connection($connection)->hasTable('character_notifications')) {
            Schema::connection($connection)->dropIfExists('character_notifications');
        }
    }
}
