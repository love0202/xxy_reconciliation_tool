<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->default(0)->comment('方案ID');
            $table->integer('theme')->default(1)->comment('主题 0无 1商户 2快递 3重量');
            $table->integer('merchant_type')->default(0)->comment('商户类型 0无 1淘宝 2天猫 3拼多多 4旺店通');
            $table->integer('express_type')->default(0)->comment('快递类型 0无 1韵达 2邮政 3圆通');
            $table->integer('status')->default(0)->comment('状态 0未导入 1已导入');
            $table->text('file_json')->nullable();
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
        Schema::dropIfExists('file');
    }
}
