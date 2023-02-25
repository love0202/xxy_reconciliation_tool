<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantPinduoduoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_pinduoduo', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->default(0)->comment('方案ID');
            $table->integer('file_id')->default(0)->comment('文件ID');
            $table->integer('type')->default(0)->comment('快递类型 0无 1韵达 2邮政 3圆通');
            $table->string('merchant_number')->default('')->comment('（商户）单号');
            $table->mediumText('merchant_shop_info')->nullable()->comment('（商户）商品详情');
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
        Schema::dropIfExists('merchant_pinduoduo');
    }
}
