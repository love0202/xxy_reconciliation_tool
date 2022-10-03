<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->default(0)->comment('方案ID');
            $table->integer('file_id')->default(0)->comment('文件ID');
            $table->string('order_number')->default('')->comment('单号');
            $table->string('express_weight')->default('')->comment('（快递）重量');
            $table->string('merchant_weight')->default('')->comment('（商户）重量');
            $table->string('merchant_shop_info')->default('')->comment('（商户）商品详情');
            $table->string('merchant_shop_member')->default('')->comment('（商户）买家会员名');

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
        Schema::dropIfExists('express');
    }
}
