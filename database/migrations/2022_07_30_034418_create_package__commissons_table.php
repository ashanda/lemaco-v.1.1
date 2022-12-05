<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageCommissonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('package__commissons', function (Blueprint $table) {
        $table->increments('id')->primary();
        $table->integer('uid');
        $table->integer('package_id');
        $table->float('package_commission');
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
        Schema::dropIfExists('package__commissons');
    }
}
