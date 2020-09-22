<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemReviewImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_review_imgs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_item_id')->comment('订单item编号');
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->string('url')->nullable()->comment('评论的图片');
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
        Schema::dropIfExists('order_item_review_imgs');
    }
}
