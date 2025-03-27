<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number')->unique(); // Mã hợp đồng
            $table->unsignedBigInteger('customer_id');   // ID khách hàng
            $table->unsignedBigInteger('service_id')->nullable(); // ID dịch vụ (nếu có)
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('amount', 10, 2);
            $table->text('terms')->nullable();            // Điều khoản hợp đồng
            $table->text('description')->nullable();      // Mô tả hợp đồng
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};


