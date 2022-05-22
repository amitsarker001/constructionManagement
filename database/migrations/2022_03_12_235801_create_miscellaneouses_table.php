<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiscellaneousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miscellaneouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cost_name')->nullable();
            $table->double('quantity')->default(0);
            $table->double('unit_price')->default(0);
            $table->double('total_cost')->default(0);
            $table->text('remarks')->nullable();
            $table->timestamp('entry_date')->nullable();
            $table->integer('user_id')->default(0);
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
        Schema::dropIfExists('miscellaneouses');
    }
}
