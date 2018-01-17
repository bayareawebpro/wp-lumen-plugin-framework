<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobsTable extends Migration
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

	    Schema::create('wplumen_jobs', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->string('queue');
		    $table->longText('payload');
		    $table->tinyInteger('attempts')->unsigned();
		    $table->unsignedInteger('reserved_at')->nullable();
		    $table->unsignedInteger('available_at');
		    $table->unsignedInteger('created_at');
		    $table->index(['queue', 'reserved_at']);
	    });

	    Schema::create('wplumen_failed_jobs', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->text('connection');
		    $table->text('queue');
		    $table->longText('payload');
		    $table->longText('exception');
		    $table->timestamp('failed_at')->useCurrent();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('wplumen_jobs');
	    Schema::dropIfExists('wplumen_failed_jobs');
    }
}
