<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddonManagementsTable extends Migration
{
    public function up()
    {
        Schema::table('addon_managements', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_fk_2380439')->references('id')->on('add_on_categories');
        });
    }
}
