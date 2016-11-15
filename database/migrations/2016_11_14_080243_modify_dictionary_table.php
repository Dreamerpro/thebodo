<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDictionaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dictionary', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('bodo_definition')->nullable()->collation('utf8_unicode_ci');
            $table->tinyInteger('status',0);
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('dictionary', function (Blueprint $table) {
            $table->dropColumn(['id','bodo_definition','created_at','updated_at','status','user_id']);
        });
        
    }
}
