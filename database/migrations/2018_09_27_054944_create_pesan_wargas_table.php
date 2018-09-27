<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesanWargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('pesan_warga')){
            Schema::create('pesan_warga', function (Blueprint $table) {
                $table->increments('id');
                $table->string('desa_id');
                $table->string('nama_lengkap');
                $table->string('email');
                $table->string('subjek');
                $table->text('pesan');
                $table->boolean('read')->default(0);
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesan_warga');
    }
}
