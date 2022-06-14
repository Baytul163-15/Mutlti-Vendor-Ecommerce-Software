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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->string('admin_type')->nullable();
            $table->string('product_name')->unique();
            $table->string('product_code')->unique();
            $table->string('product_color')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_selling')->nullable();
            $table->string('product_discount')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_slug')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_vedio')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('is_featured',['No','Yes'])->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('products');
    }
};
