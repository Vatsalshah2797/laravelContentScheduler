<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->foreignId('wallet_id');
            $table->enum('type', ['Add To Wallet', 'Send Mail To Customer'])->default('Add To Wallet');
            $table->enum('status', ['Credited', 'Debited'])->default('Credited');
            $table->enum('payment_status', ['Success', 'Fail'])->default('Success');
            $table->foreign('wallet_id')
                ->references('id')
                ->on('wallets')
                ->onDelete('cascade');
            $table->foreignId('customer_id')
                ->nullable() // here
                ->references('id')
                ->on('customers');
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
        Schema::dropIfExists('wallet_transactions');
    }
};
