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
        Schema::create('item_variations', function (Blueprint $table) {
            $table->id();
            $table->string('variation_group');
            $table->string('name');
            $table->string('slug');
            $table->integer('warehouse')->nullable();
            $table->foreignId('size_id');
            $table->foreignId('color_id');
            $table->foreignId('special_id');
            $table->foreignId('print_id');
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
        Schema::dropIfExists('item_variations');
    }
};
