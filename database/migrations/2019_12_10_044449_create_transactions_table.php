<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['purchase', 'sell']);
            $table->string('invoice_no')->nullable();
            $table->dateTime('transaction_date');
            $table->decimal('total_before', 8, 2)->default(0)->comment('Total before the purchase/invoice tax, this includeds the indivisual product tax');
            $table->decimal('discount_amount', 8, 2)->default(0);
            $table->decimal('final_total', 8, 2)->default(0);
            $table->enum('status', ['Progress','Paid'])->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
