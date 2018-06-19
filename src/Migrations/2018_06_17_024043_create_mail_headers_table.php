<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('mail_headers')) {
            Schema::connection($connection)->create('mail_headers', function (Blueprint $table) {
                $table->integer('character_id');
                $table->integer('from');
                $table->boolean('is_read');
                $table->json('labels');
                $table->integer('mail_id');
                $table->json('recipients');
                $table->string('subject');
                $table->dateTimeTz('timestamp');
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
        if ($main && Schema::connection($connection)->hasTable('mail_headers')) {
            Schema::connection($connection)->dropIfExists('mail_headers');
        }
    }
}
