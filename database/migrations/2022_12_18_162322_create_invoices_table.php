<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_number');//رقم الفاتورة
            $table->date('invoice_date');//تاريخ الفاتورة
            $table->date('due_date');//تاريخ الدفع
            $table->foreignId('section_id')->constrained('sections','id')->cascadeOnDelete();//القسم
            $table->string('product');//المنتج
            $table->decimal('amount_commission',8,2);
            $table->decimal('amount_collection',8,2)->nullable();
            $table->double('discount')->nullable();//الخصم
            $table->string('rate_vat',999)->nullable();//نسبة الضريبة
            $table->decimal('value_vat',8,2)->nullable();//قيمة الضريبة
            $table->decimal('total',8,2);//الاجمالي
            $table->string('status');//الحالة
            $table->integer('status_value');//قيمة الضريبة
            $table->date('payment-date')->nullable();
            $table->longText('note')->nullable();//الملاحظات
            $table->string('user');//المستخدم
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
