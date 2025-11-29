<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('head_id')->constrained('heads')->onDelete('cascade'); // foreign key
            $table->string('product_name');
            $table->string('manufacture')->nullable();
            $table->integer('units');
            $table->decimal('price', 10, 2);
          
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

