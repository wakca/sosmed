<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelProyekDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('proyek_desa')){
            Schema::table('proyek_desa', function(Blueprint $table){
                if(!Schema::hasColumn('proyek_desa', 'keterangan')){
                    $table->text('keterangan')->nullable();
                }

                if(!Schema::hasColumn('proyek_desa', 'konten')){
                    $table->text('konten')->nullable();
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
        if(Schema::hasTable('proyek_desa')){
            Schema::table('proyek_desa', function(Blueprint $table){
                if(Schema::hasColumn('proyek_desa', 'keterangan')){
                    $table->removeColumn('keterangan');
                }

                if(Schema::hasColumn('proyek_desa', 'konten')){
                    $table->removeColumn('konten');
                }
            });
        }
    }
}
