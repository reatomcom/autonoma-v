<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAimRent3 extends Migration
{
    public function up()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->decimal('max_price', 10, 0);
            $table->renameColumn('price', 'min_price');
        });
    }
    
    public function down()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->dropColumn('max_price');
            $table->renameColumn('min_price', 'price');
        });
    }
}
