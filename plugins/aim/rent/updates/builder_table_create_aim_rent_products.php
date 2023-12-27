<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAimRentProducts extends Migration
{
    public function up()
    {
        Schema::create('aim_rent_products', function($table)
        {
            $table->increments('id')->unsigned();
                        
            $table->string('title')->nullable();
            $table->string('product_type')->nullable();
            $table->string('slug')->nullable();
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

            $table->decimal('price_season_week_1', 10, 2)->nullable();
            $table->decimal('price_season_week_2', 10, 2)->nullable();
            $table->decimal('price_season_week_3', 10, 2)->nullable();
            $table->decimal('price_season_week_4', 10, 2)->nullable();
            $table->decimal('price_offseason_week_1', 10, 2)->nullable();
            $table->decimal('price_offseason_week_2', 10, 2)->nullable();
            $table->decimal('price_offseason_week_3', 10, 2)->nullable();
            $table->decimal('price_offseason_week_4', 10, 2)->nullable();

            $table->smallInteger('season_from_month')->nullable();
            $table->smallInteger('season_from_day')->nullable();
            $table->smallInteger('season_to_month')->nullable();
            $table->smallInteger('season_to_day')->nullable();
            $table->smallInteger('offseason_from_month')->nullable();
            $table->smallInteger('offseason_from_day')->nullable();
            $table->smallInteger('offseason_to_month')->nullable();
            $table->smallInteger('offseason_to_day')->nullable();

            $table->text('videos')->nullable();

            $table->boolean('is_active')->nullable();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('aim_rent_products');
    }
}
