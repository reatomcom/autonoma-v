<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAimRent extends Migration
{
    public function up()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->increments('id')->unsigned()->change();
        });
    }
}
