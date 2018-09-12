<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingForeignStories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->foreign('user_id') // foreignKey 
                ->references('id') // dari kolom id 
                ->on('users') // di tabel users
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
        Schema::table('stories', function (Blueprint $table) {
            //
        });
    }
}
