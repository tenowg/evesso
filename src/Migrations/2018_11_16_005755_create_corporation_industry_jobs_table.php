<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporationIndustryJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('corporation_industry_jobs')) {
            Schema::connection($connection)->create('corporation_industry_jobs', function (Blueprint $table) {
                $table->integer('activity_id');
                $table->integer('corporation_id');
                $table->bigInteger('blueprint_id');
                $table->bigInteger('blueprint_location_id');
                $table->integer('blueprint_type_id');
                $table->integer('completed_character_id')->nullable();
                $table->dateTimeTz('completed_date')->nullable();
                $table->double('cost', null, 2)->nullable();
                $table->integer('duration');
                $table->dateTimeTz('end_date');
                $table->bigInteger('facility_id');
                $table->integer('installer_id');
                $table->integer('job_id');
                $table->integer('licensed_runs')->nullable();
                $table->bigInteger('output_location_id');
                $table->dateTimeTz('pause_date')->nullable();
                $table->float('probability', null, 6)->nullable();
                $table->integer('product_type_id')->nullable();
                $table->integer('runs');
                $table->dateTimeTz('start_date');
                $table->bigInteger('location_id');
                $table->string('status');
                $table->integer('successful_runs')->nullable();
                $table->timestamps();

                $table->primary('job_id');
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
        if ($main && Schema::connection($connection)->hasTable('corporation_industry_jobs')) {
            Schema::connection($connection)->dropIfExists('corporation_industry_jobs');
        }
    }
}
