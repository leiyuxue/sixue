<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeixinOpenidToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->string('weixin_openid')->unique()->nullable()->after('password');
           $table->string('weixin_unionid')->unique()->nullable()->after('weixin_openid');
           $table->string('password')->nullable()->change();
           $table->string('phone')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('weixin_openid');
            $table->dropColumn('weixin_unionid');
            $table->string('password')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
        });
    }
}
