<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DirectCommssionPrecentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_commssion_precentages', function (Blueprint $table) {
            $table->id();
            $table->float('first_time_direct');
            $table->float('first_time_direct_01');
            $table->float('first_time_direct_02');
            $table->float('first_time_direct_03');
            $table->float('secound_time_direct');
            $table->float('secound_time_direct_01');
            $table->float('secound_time_direct_02');
            $table->float('secound_time_direct_03');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
