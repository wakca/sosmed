<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelOrganisasiDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('organisasi_desa')){
            Schema::table('organisasi_desa', function(Blueprint $table){
                if(!Schema::hasColumn('organisasi_desa', 'judul')){
                    $table->string('judul');
                }

                if(!Schema::hasColumn('organisasi_desa', 'created_at')){
                    $table->timestamps();
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
        //
    }
}
