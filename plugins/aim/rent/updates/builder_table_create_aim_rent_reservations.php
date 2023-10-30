<?php namespace Aim\Rent\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAimRentReservations extends Migration
{
    public function up()
    {
        Schema::create('aim_rent_reservations', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('product_id')->nullable();
            $table->integer('product_unit_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('days')->nullable();
            $table->decimal('in_total', 10, 2)->nullable();
            $table->integer('invoice_id')->nullable();
            $table->string('status')->nullable();
            $table->text('extra_info')->nullable();
            $table->text('client_name_surname')->nullable();
            $table->text('client_phone_number')->nullable();
            $table->text('client_email')->nullable();
            $table->text('inside_notes')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('aim_rent_reservations');
    }
}
