<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAimRentProductUnits extends Migration
{
    public function up()
    {
        Schema::create('aim_rent_product_units', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('product_id')->nullable();
            $table->string('licence_plate')->nullable();
            $table->text('notes')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_active')->nullable();
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->integer('year')->nullable();
            $table->string('engine_type')->nullable();
            $table->string('engine_size')->nullable();
            $table->string('engine_power')->nullable();
            $table->string('gearbox_type')->nullable();
            $table->integer('gearbox_shifts')->nullable();
            $table->integer('beds')->nullable();
            $table->boolean('has_wc')->nullable();
            $table->boolean('has_shower')->nullable();
            $table->boolean('has_kitchen')->nullable();
            $table->boolean('has_ac')->nullable();
            $table->boolean('has_heating')->nullable();
            $table->boolean('has_tv')->nullable();
            $table->boolean('has_bike_rack')->nullable();
            $table->boolean('has_pets_allowed')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('aim_rent_product_units');
    }
}
