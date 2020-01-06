<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('event_information', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('event_id');
        $table->string('place_name', 100)->nullable();
        $table->string('place_address', 255)->nullable();
        $table->string('place_city', 50)->nullable();
        $table->string('place_state', 50)->nullable();
        $table->string('place_zip_code', 10)->nullable();
        $table->string('place_country', 50)->nullable();
        $table->string('place_phone', 20)->nullable();
        $table->string('organizers', 100)->nullable();
        $table->date('event_start_date')->nullable();
        $table->date('event_end_date')->nullable();
        $table->time('event_start_time')->nullable();
        $table->time('event_end_time')->nullable();
        $table->timestamps();
        
        $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_information');
    }
}
