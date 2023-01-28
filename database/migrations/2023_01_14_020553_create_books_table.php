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
        Schema::create('books', function (Blueprint $table) {
            $table->char('id', 16)->primary();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('isbn')->unique();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('tgl_terbit');
            $table->text('sinopsis');
            $table->string('img_cover')->nullable();
            $table->string('file_ebook')->nullable(); // can be imgs or pdf
            // $table->unsignedBigInteger('number_of_reads');
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
        Schema::dropIfExists('books');
    }
};
