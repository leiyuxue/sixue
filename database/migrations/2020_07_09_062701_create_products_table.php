<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('商品名称');
            $table->text('description')->comment('商品详情');
            $table->string('img')->comment('商品封面');
            $table->boolean('on_sale')->default(true)->comment('商品是否上架');
            $table->float('rating')->default(5)->comment('商品平均评分');
            $table->unsignedInteger('review_count')->default(0)->comment('商品评价总数');
            $table->unsignedInteger('sold_count')->default(0)->comment('商品总销量');
            $table->decimal('price',10,2)->comment('商品sku最低价格');
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
        Schema::dropIfExists('products');
    }
}
