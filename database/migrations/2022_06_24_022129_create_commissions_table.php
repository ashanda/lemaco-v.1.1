<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->integer('uid');
            $table->integer('parent_uid');
            $table->integer('package_id');
            $table->string('package_type');
            $table->string('package_commission')->nullable();
            $table->string('level_commission')->nullable();
            $table->string('binary_commission_left')->nullable();
            $table->string('binary_commission_right')->nullable();
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
        Schema::dropIfExists('commissions');
    }
}
