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
        Schema::create('bibleverses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('book_number');
            $table->string('book_name');
            $table->string('book_short');
            $table->integer('chapter');
            $table->integer('verse');
            $table->text('verse_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bibleverses');
    }
};
