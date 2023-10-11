<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAimRent2 extends Migration
{
    public function up()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->dropColumn('description');
        });
    }
}
