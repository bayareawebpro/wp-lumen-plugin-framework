<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    global $wpdb;
	    if(!version_compare(mb_substr($wpdb->get_results( 'SELECT version() as version')[0]->version, 0, 6), '5.7.7') >= 0){
		    Schema::defaultStringLength(191);
	    }

	    Schema::create('wplumen_sessions', function (Blueprint $table) {
		    $table->string('id')->unique();
		    $table->unsignedInteger('user_id')->nullable();
		    $table->string('ip_address', 45)->nullable();
		    $table->text('user_agent')->nullable();
		    $table->text('payload');
		    $table->integer('last_activity');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('wplumen_sessions');
    }
}
