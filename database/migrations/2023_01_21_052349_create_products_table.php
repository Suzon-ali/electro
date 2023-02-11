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
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('type_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->float('price');
            $table->float('discount_percentage')->nullable();
            $table->unsignedInteger('qty');
            $table->text('short_description');
            $table->longText('long_description');
            $table->text('color');
            $table->text('size');
            $table->string('tag')->nullable();
            $table->string('image');
            $table->boolean('status')->default(true);
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
