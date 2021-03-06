<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembeCardManagementsTable extends Migration
{
    public function up()
    {
        Schema::create('membe_card_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_no');
            $table->string('username');
            $table->string('merchant');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
