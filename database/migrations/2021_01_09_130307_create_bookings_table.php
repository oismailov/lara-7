<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('row_number');
            $table->unsignedBigInteger('map_id');
            $table->unsignedBigInteger('plane_id');
            $table->timestamps();
            $table->foreign('map_id')
                ->references('id')
                ->on('single_row_seats_map')
                ->onDelete('cascade');
            $table->foreign('plane_id')
                ->references('id')
                ->on('planes')
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
        Schema::dropIfExists('bookings');
    }
}
