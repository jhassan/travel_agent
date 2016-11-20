<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleVouchersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_vouchers_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->float('coa_credit')->default(0.00);
            $table->float('coa_debit')->default(0.00);
            $table->integer('sale_voucher_master_id')->default(0);
            $table->integer('coa_code')->default(0);
            $table->integer('coa_type')->default(0);
            $table->string('voucher_descriptions', 255);
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
        Schema::dropIfExists('sale_vouchers_detail');
    }
}
