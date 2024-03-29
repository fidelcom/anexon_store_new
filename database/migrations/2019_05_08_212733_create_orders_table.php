<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('set null');

            $table->string('billing_email'); 
            $table->string('billing_name'); 
            $table->string('billing_address');
            $table->string('billing_phone'); 
            $table->string('delivery_fee')->default(0); 
            $table->integer('billing_discount')->default(0); 
            $table->string('billing_discount_code')->nullable(); 
            $table->integer('billing_subtotal');
            $table->integer('billing_total'); 
            $table->string('payment_gateway')->default('pay_stack'); 
            $table->boolean('shipped')->default(false);   
                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
