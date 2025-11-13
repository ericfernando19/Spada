<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materi_id');
            $table->string('pertanyaan');
            $table->text('pilihan_a')->nullable();
            $table->text('pilihan_b')->nullable();
            $table->text('pilihan_c')->nullable();
            $table->text('pilihan_d')->nullable();
            $table->string('jawaban_benar')->nullable(); // misalnya: 'A'
            $table->timestamps();

            $table->foreign('materi_id')->references('id')->on('materis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
