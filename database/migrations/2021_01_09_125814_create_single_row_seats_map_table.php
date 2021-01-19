<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingleRowSeatsMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('single_row_seats_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seat_id');
            $table->unsignedBigInteger('sub_row_location_id');
            $table->unsignedBigInteger('plane_type_id');
            $table->unsignedBigInteger('seat_location_id');
            $table->timestamps();
            $table->foreign('seat_id')
                ->references('id')
                ->on('seats')
                ->onDelete('cascade');
            $table->foreign('sub_row_location_id')
                ->references('id')
                ->on('sub_row_locations')
                ->onDelete('cascade');
            $table->foreign('plane_type_id')
                ->references('id')
                ->on('plane_types')
                ->onDelete('cascade');
            $table->foreign('seat_location_id')
                ->references('id')
                ->on('seat_locations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('single_row_seats_map');
    }
}
