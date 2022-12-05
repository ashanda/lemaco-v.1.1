<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->string('package_cat_id');
            $table->string('package_id');
            $table->float('package_value');
            $table->float('package_double_value');
            $table->float('package_triple_value');
            $table->float('package_max_revenue');
            $table->dateTime('package_commission_update_at')->nullable();
            $table->dateTime('package_level_commission_at')->nullable();
            $table->dateTime('package_binary_commsion_at')->nullable();
            $table->float('total')->default(0);
            $table->string('currency_type');
            $table->string('network');
            $table->string('deposite_ss');
            $table->string('status')->default(2);
            $table->string('current_status')->default(2);
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
        Schema::dropIfExists('user__packages');
    }
}
