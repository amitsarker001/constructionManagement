<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cost_id')->default(0);
            $table->integer('step_id')->default(0);
            $table->integer('item_id')->default(0);
            $table->integer('supplier_id')->default(0);
            $table->double('quantity')->default(0);
            $table->double('rate')->default(0);
            $table->double('amount')->default(0);
            $table->double('standard_rate')->default(0);
            $table->double('standard_amount')->default(0);
            $table->double('increase_rate')->default(0);
            $table->double('increase_amount')->default(0);
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('cost_details');
    }
}
