<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('类目名称');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('类目父级id');
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedInteger('level')->comment('类目层级');
            $table->boolean('is_directory')->comment('是否有子类目');
            $table->string('path')->comment('该类目所有父级id');
            $table->boolean('is_show')->default(1)->comment('是否在首页展示');
            $table->string('ximg')->nullable()->comment('首页展示的图片');
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
        Schema::dropIfExists('categories');
    }
}
