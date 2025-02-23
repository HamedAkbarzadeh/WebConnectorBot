<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('color_id')->nullable()->constrained('product_colors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('guarantee_id')->nullable()->constrained('guarantees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('wood_id')->nullable()->constrained('woods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('cloth_id')->nullable()->constrained('clothes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('number')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
