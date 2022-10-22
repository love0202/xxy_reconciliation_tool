<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantTianmaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_tianmao', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->default(0)->comment('方案ID');
            $table->integer('file_id')->default(0)->comment('文件ID');
            $table->string('order_number')->default('')->comment('订单号');
            $table->string('order_number_son')->default('')->comment('子订单号');
            $table->string('title')->default('')->comment('标题');
            $table->string('shop_attribute')->default('')->comment('商品属性');
            $table->string('num')->default('')->comment('数量');
            $table->mediumText('merchant_shop_info')->default('')->comment('（商户）商品详情');
            $table->string('express_company')->default('')->comment('（快递）公司');
            $table->string('express_number')->default('')->comment('（快递）单号');

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
        Schema::dropIfExists('merchant_tianmao');
    }
}
