<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('recepient_id');
            $table->unsignedInteger('conversation_id');
            $table->text('message');
            $table->enum('has_image',['Y','N'])->default('N');
            $table->enum('read',['Y','N'])->default('N');
            $table->enum('del_sender',['Y','N'])->default('N');
            $table->enum('del_receiver',['Y','N'])->default('N');
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
        Schema::dropIfExists('messages');
    }
}
