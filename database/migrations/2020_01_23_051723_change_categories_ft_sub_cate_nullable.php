<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCategoriesFtSubCateNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name', 100)->change();
            $table->string('description', 255)->nullable()->change();
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->string('name', 100)->change();
            $table->string('description', 255)->nullable()->change();
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
