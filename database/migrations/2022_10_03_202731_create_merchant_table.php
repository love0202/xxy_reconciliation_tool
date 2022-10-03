<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->default(0)->comment('方案ID');
            $table->integer('file_id')->default(0)->comment('文件ID');
            $table->string('order_number')->default('')->comment('订单号');
            $table->string('order_number_son')->default('')->comment('子订单号');
            $table->string('title')->default('')->comment('标题');
            $table->string('num')->default('')->comment('数量');
            $table->string('shop_attribute')->default('')->comment('商品属性');
            $table->string('express_order_number')->default('')->comment('物流单号');
            $table->string('express_company')->default('')->comment('物流公司');
            $table->string('shop_info')->default('')->comment('商品详情');

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
        Schema::dropIfExists('merchant');
    }
}
