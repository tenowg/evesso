<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        Schema::connection($connection)->create('corporation_contracts', function (Blueprint $table) {
            $table->integer('corporation_id');
            $table->integer('acceptor_id');
            $table->integer('assignee_id');
            $table->enum('availability', ['public', 'personal', 'corporation', 'alliance']);
            $table->double('buyout', null, 2)->nullable();
            $table->double('collateral', null, 2)->nullable();
            $table->integer('contract_id');
            $table->dateTimeTz('date_accepted')->nullable();
            $table->dateTimeTz('date_completed')->nullable();
            $table->dateTimeTz('date_expired');
            $table->dateTimeTz('date_issued');
            $table->integer('days_to_complete')->nullable();
            $table->bigInteger('end_location_id')->nullable();
            $table->boolean('for_corporation');
            $table->integer('issuer_corporation_id');
            $table->integer('issuer_id');
            $table->double('price', null, 2)->nullable();
            $table->double('reward', null, 2)->nullable();
            $table->bigInteger('start_location_id')->nullable();
            $table->enum('status', [
                    'outstanding',
                    'in_progress',
                    'finished_issuer',
                    'finished_contractor',
                    'finished',
                    'cancelled',
                    'rejected',
                    'failed',
                    'deleted',
                    'reversed'
                ]);
            $table->string('title')->nullable();
            $table->enum('type', ['unknown', 'item_exchange', 'auction', 'courier', 'loan']);
            $table->double('volume', null, 4)->nullable();
            $table->timestamps();

            $table->primary('contract_id');
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
        Schema::connection($connection)->dropIfExists('corporation_contracts');
    }
}
