<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantWangdiantongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_wangdiantong', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->default(0)->comment('方案ID');
            $table->integer('file_id')->default(0)->comment('文件ID');
            $table->string('express_company')->default('')->comment('（快递）公司');
            $table->string('express_number')->default('')->comment('（快递）单号');
            $table->string('express_weight')->default('')->comment('（快递）重量');

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
        Schema::dropIfExists('merchant_wangdiantong');
    }
}
