<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('contact_name')->comment('收件人姓名');
            $table->string('contact_phone')->comment('收件人电话');
            $table->string('province')->comment('收货地址省');
            $table->string('city')->comment('收货地址市');
            $table->string('district')->comment('收货地址区');
            $table->string('address')->comment('收货地址详细地址');
            $table->string('tag')->comment('收货地址标签，家庭/公司。。');
            $table->dateTime('last_used_at')->comment('最后使用时间');
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
        Schema::dropIfExists('user_addresses');
    }
}
