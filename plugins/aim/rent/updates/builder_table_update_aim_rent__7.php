<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAimRent7 extends Migration
{
    public function up()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->integer('seats');
            $table->integer('beds');
            $table->dropColumn('picture');
        });
    }
    
    public function down()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->dropColumn('seats');
            $table->dropColumn('beds');
            $table->string('picture', 255);
        });
    }
}
