<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Rvsitebuilder\Manage\Models\CoreApps;

class RegistOpenexamToCoreApp extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Model::unguard();
        $this->seed();
        Model::reguard();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }

    private function seed()
    {
        CoreApps::firstOrCreate(['app_name' => 'uzaweb/openexam']);
    }
}
