<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAimRent extends Migration
{
    public function up()
    {
        Schema::create('aim_rent_', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 10, 0);
            $table->integer('year')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('aim_rent_');
    }
}
