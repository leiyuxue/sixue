<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soliders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('标题');
            $table->string('img')->comment('图片');
            $table->string('link')->comment('链接地址');
            $table->boolean('enable')->default(1)->comment('是否开启');
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
        Schema::dropIfExists('soliders');
    }
}
