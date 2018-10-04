<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableDesaLinkWeb extends Migration
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
                if(!Schema::hasColumn('desa','link_web')){
                    $table->text('link_web', 255)->nullable();
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
                if(Schema::hasColumn('desa','link_web')){
                    $table->dropColumn('link_web');
                }
            });
        }
    }
}
