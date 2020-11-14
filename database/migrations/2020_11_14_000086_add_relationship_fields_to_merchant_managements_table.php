<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMerchantManagementsTable extends Migration
{
    public function up()
    {
        Schema::table('merchant_managements', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_fk_2380390')->references('id')->on('merchant_categories');
            $table->unsignedInteger('sub_cateogry_id');
            $table->foreign('sub_cateogry_id', 'sub_cateogry_fk_2380391')->references('id')->on('merchant_sub_categories');
            $table->unsignedInteger('created_by_id');
            $table->foreign('created_by_id', 'created_by_fk_2380392')->references('id')->on('users');
            $table->unsignedInteger('level_id');
            $table->foreign('level_id', 'level_fk_2380399')->references('id')->on('merchant_levels');
        });
    }
}
