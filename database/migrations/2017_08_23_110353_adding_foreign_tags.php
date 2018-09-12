<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingForeignTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storytags', function (Blueprint $table) {
            $table->foreign('story_id') // foreignKey 
                ->references('id') // dari kolom id 
                ->on('stories') // di tabel users
                ->onUpdate('cascade') // ketika terjadi perubahan di tabel users maka akan update
                ->onDelete('cascade'); // ketika data users di hapus akan ikut hilang
            $table->foreign('tag_id') // foreignKey 
                ->references('id') // dari kolom id 
                ->on('tags') // di tabel users
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
        Schema::table('tags', function (Blueprint $table) {
            //
        });
    }
}
