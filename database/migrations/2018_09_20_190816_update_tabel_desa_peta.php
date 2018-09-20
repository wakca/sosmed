<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelDesaPeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('desa')){
            Schema::table('desa', function (Blueprint $table){
                if(!Schema::hasColumn('desa','map')){
                    $table->longText('map')->nullable();
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
            Schema::table('desa', function (Blueprint $table){
                if(Schema::hasColumn('desa','map')){
                    $table->dropColumn('map');
                }
            });
        }
    }
}
