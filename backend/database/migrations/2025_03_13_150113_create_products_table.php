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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('discribtion');
            $table->decimal('price',8,2);
            $table->float('rating',2,1);

            // $table->unsignedBigInteger('category_id'); 
            // $table->unsignedBigInteger('order_id')->nullable(); 
            
            $table->timestamps();
        
            // $table->foreign('category_id')->references('id')->on('categories');
            // $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
