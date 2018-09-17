<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoDesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('desa')){
            Schema::table('desa', function(Blueprint $table){

                if(!Schema::hasColumn('desa', 'nip')){
                    $table->string('nip')->nullable();
                }

                if(!Schema::hasColumn('desa', 'nama_kades')){
                    $table->string('nama_kades')->nullable();
                }

                if(!Schema::hasColumn('desa', 'foto_desa'))
                {
                    $table->string('foto_desa')->nullable();
                }

                if(!Schema::hasColumn('desa', 'foto_kades'))
                {
                    $table->string('foto_kades')->nullable();
                }

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
        if(Schema::hasTable('desa')){
            Schema::table('desa', function(Blueprint $table){
                if(Schema::hasColumn('desa', 'nip')){
                    $table->dropColumn('nip');
                }

                if(Schema::hasColumn('desa', 'nama_kades')){
                    $table->dropColumn('nama_kades');
                }

                if(Schema::hasColumn('desa', 'foto_desa'))
                {
                    $table->dropColumn('foto_desa');
                }

                if(Schema::hasColumn('desa', 'foto_kades'))
                {
                    $table->dropColumn('foto_kades');
                }
            });
        }
    }
}
