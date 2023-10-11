<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAimRent6 extends Migration
{
    public function up()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->string('picture');
        });
    }
    
    public function down()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->dropColumn('picture');
        });
    }
}
