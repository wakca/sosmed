<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->enum('jk', ['Laki-laki', 'Perempuan'])->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->tinyInteger('verified')->default(0);
            $table->tinyInteger('online_status')->default(0);
            $table->tinyInteger('blokir')->default(0);
            $table->string('provinsi',2)->default(0);
            $table->string('kabupaten',4)->default(0);
            $table->string('kecamatan',7)->default(0);
            $table->string('desa',10)->default(0);
            $table->string('password');
            $table->tinyInteger('level')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
