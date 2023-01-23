<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices','id')->cascadeOnDelete();
            $table->integer('invoice_number');//رقم الفاتورة
            $table->string('section');//القسم
            $table->string('product');//المنتج
            $table->string('status');//الحالة
            $table->integer('status_value');//قيمة الضريبة
            $table->date('payment_date')->nullable();//تاريخ الدفع
            $table->longText('note')->nullable();//الملاحظات
            $table->string('user');//المستخدم
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
        Schema::dropIfExists('invoice_details');
    }
}
