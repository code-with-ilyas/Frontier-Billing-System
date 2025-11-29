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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('entry_date')->nullable();
            $table->string('bill_month')->nullable();
            $table->string('bill_year')->nullable();
            $table->date('issue_date')->nullable();
            $table->string('customer_name')->nullable();

             // 🔹 Directly save vehicle number (no foreign key)
            $table->string('vehicle_number')->nullable();

            // 🔹 Foreign key for Head
            $table->unsignedBigInteger('head_id')->nullable();
            $table->foreign('head_id')->references('id')->on('heads')->onDelete('set null');

            // 🔹 Foreign key for Product
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');

            $table->integer('quantity')->default(0);
            $table->decimal('rate', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
