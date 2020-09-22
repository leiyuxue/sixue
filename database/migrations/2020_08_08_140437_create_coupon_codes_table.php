<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('优惠卷名称');
            $table->string('type')->comment('优惠卷类型');
            $table->string('code')->unique()->comment('优惠码');
            $table->decimal('value')->comment('优惠值');
            $table->decimal('min_price',10,2)->comment('允许使用的最低价格');
            $table->unsignedInteger('amount')->comment('发放总数量');
            $table->unsignedInteger('used')->default(0)->comment('使用的总数量');
            $table->dateTime('use_start_time')->nullable()->comment('使用起始时间');
            $table->dateTime('use_end_time')->nullable()->comment('使用结束时间');
            $table->boolean('enable')->default(0)->comment('是否启用');
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
        Schema::dropIfExists('coupon_codes');
    }
}
