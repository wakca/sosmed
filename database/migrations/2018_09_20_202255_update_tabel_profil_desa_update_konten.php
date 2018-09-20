<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelProfilDesaUpdateKonten extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('profil_desa')){
            Schema::table('profil_desa', function(Blueprint $table){
                if(Schema::hasColumn('profil_desa', 'konten')){
                    $table->longText('konten')->nullable()->change();
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
        if(Schema::hasTable('profil_desa')){
            Schema::table('profil_desa', function(Blueprint $table){
                if(Schema::hasColumn('profil_desa', 'konten')){
                    $table->text('konten')->nullable()->change();
                }
            });
        }
    }
}
