<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('post_id')->nullable();
            $table->unsignedInteger('target_id');
            $table->tinyInteger('type')->comment('1 = commented, 2 = liked, 3 = following, 4= commented own post, 5 = other commented post, 6 = posted in your timeline.');
            $table->enum('read',['Y','N'])->default('N');
            $table->enum('delete',['Y','N'])->default('N');
            $table->timestamp('tgl_notif');
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
        Schema::dropIfExists('notification');
    }
}
