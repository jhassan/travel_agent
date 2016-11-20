<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flight_way')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('ven_percent_rec_comm')->default(0);
            $table->integer('ven_give_psf_comm')->default(0);
            $table->integer('ven_wht_percent_comm')->default(0);
            $table->integer('client_percent_rec_comm')->default(0);
            $table->integer('client_receive_psf_comm')->default(0);
            $table->integer('client_wht_percent_comm')->default(0);
            $table->integer('vendor_id')->default(0);
            $table->integer('client_id')->default(0);
            $table->string('pax_name', 255);
            $table->string('pnr', 10);
            $table->string('ticket_no', 15);
            $table->string('sector', 255);
            $table->float('basic_fare')->default(0.00);
            $table->float('tax')->default(0.00);
            $table->float('actual_fare_total')->default(0.00);
            $table->float('vendor_rec_comm_total')->default(0.00);
            $table->float('ven_give_psf_total')->default(0.00);
            $table->float('ven_wht_total')->default(0.00);
            $table->float('ven_main_total')->default(0.00);
            $table->float('client_rec_comm_total')->default(0.00);
            $table->float('client_receive_psf_total')->default(0.00);
            $table->float('client_wht_total')->default(0.00);
            $table->float('client_main_total')->default(0.00);
            $table->float('profit_loss_total')->default(0.00);
            $table->float('vendor_payable_amount')->default(0.00);
            $table->float('client_receivable_amount')->default(0.00);
            $table->date('depart_date');
            $table->date('return_date');
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
        Schema::dropIfExists('sale_vouchers');
    }
}
