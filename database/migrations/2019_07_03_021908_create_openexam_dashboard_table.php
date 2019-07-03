<?php

use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpenexamDashboardTable extends Migration
{
    /**
     * Run the migrations. 
     */
    public function up()
    {
    	if (!Schema::hasTable('openexam_dashboard')) {
        	Schema::create('openexam_dashboard', function (Blueprint $table) {
            	$table->increments('id');
            	$table->timestamps();
        	});
        }
    	
    	if (!Schema::hasColumn('openexam_dashboard', 'title')) {
    		Schema::table('openexam_dashboard', function (Blueprint $table) {
	        	$table->engine = 'InnoDB';
	        	$table->text('title')->nullable()->after('id');
	        });
    	}
    	if (!Schema::hasColumn('openexam_dashboard', 'detail')) {
    		Schema::table('openexam_dashboard', function (Blueprint $table) {
	        	$table->engine = 'InnoDB';
	        	$table->text('detail')->nullable()->after('title');
	        });
    	}         
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
		// DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // Schema::dropIfExists('openexam_dashboard');
		// DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
