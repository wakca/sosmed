<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingForeignImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->foreign('user_id') // foreignKey 
                ->references('id') // dari kolom id 
                ->on('users') // di tabel users
                ->onUpdate('cascade') // ketika terjadi perubahan di tabel users maka akan update
                ->onDelete('cascade'); // ketika data users di hapus akan ikut hilang
          
            $table->foreign('message_id') // foreignKey 
                ->references('id') // dari kolom id 
                ->on('messages') // di tabel users
                ->onUpdate('cascade') // ketika terjadi perubahan di tabel users maka akan update
                ->onDelete('cascade'); // ketika data users di hapus akan ikut hilang
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            //
        });
    }
}
