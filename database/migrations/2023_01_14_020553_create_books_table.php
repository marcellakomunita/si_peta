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
            $table->string('id', 16)->primary();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('isbn', 13)->unique();
            $table->string('judul');
            $table->unsignedBigInteger('penulis_id')->references('id')->on('authors');
            $table->unsignedBigInteger('penerbit_id')->references('id')->on('publishers');;
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
