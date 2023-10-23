<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAimRent4 extends Migration
{
    public function up()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->decimal('price', 10, 0);
            $table->dropColumn('min_price');
            $table->dropColumn('max_price');
        });
    }
    
    public function down()
    {
        Schema::table('aim_rent_', function($table)
        {
            $table->dropColumn('price');
            $table->decimal('min_price', 10, 0);
            $table->decimal('max_price', 10, 0);
        });
    }
}
