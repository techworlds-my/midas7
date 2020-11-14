<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipManagementsTable extends Migration
{
    public function up()
    {
        Schema::create('membership_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('merchant')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
