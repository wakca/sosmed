<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelProyekDesaRubahKolomJudul extends Migration
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
                if(Schema::hasColumn('proyek_desa', 'judul')){
                    $table->text('judul')->change();
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
                if(Schema::hasColumn('prokek_desa', 'judul')){
                    $table->text('judul', 10)->change();
                }
            });
        }
    }
}
