<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master__data', function (Blueprint $table) {
            $table->id();
            $table->float('direct_sales');
            $table->float('in_direct_level_1');
            $table->float('in_direct_level_2');
            $table->float('in_direct_level_3');
            $table->float('in_direct_level_4');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master__data');
    }
}
