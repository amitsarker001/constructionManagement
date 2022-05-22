<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name')->unique();
            $table->string('item_code')->nullable();
            $table->string('barcode')->nullable();
            $table->string('unit')->nullable();
            $table->double('unit_price')->default(0);
            $table->double('standard_rate')->default(0);
            $table->double('standard_amount')->default(0);
            $table->text('item_description')->nullable();
            $table->double('reorder_level')->default(0);
            $table->integer('sort_order')->default(1)->comment('Ascending order according to sort order');
            $table->boolean('is_active')->default(1)->comment('0 = Inactive, 1 = Active');
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
        Schema::dropIfExists('items');
    }
}
