<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('kycs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->string('dbType');
            $table->string('id_number');
            $table->string('dob');
            $table->string('phone_number');
            $table->string('whatsapp_number');
            $table->string('street_address');
            $table->string('city');
            $table->string('district');
            $table->string('province');
            $table->string('country');
            $table->string('postal_code');
            $table->string('id_front_image')->nullable();
            $table->string('id_back_image')->nullable();
            $table->string('selfie_image');
            $table->string('status')->default(0);
            $table->timestamps();
        });
        

    }
    public function down()
    {
        Schema::dropIfExists('kycs');
    }
}
