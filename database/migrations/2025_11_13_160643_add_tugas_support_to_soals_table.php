<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTugasSupportToSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soals', function (Blueprint $table) {
            // 1. Tambah kolom tugas_id
            $table->foreignId('tugas_id')
                  ->nullable() // Boleh kosong
                  ->after('materi_id') // Posisi setelah materi_id
                  ->constrained('tugas') // Foreign key ke tabel 'tugas'
                  ->onDelete('cascade'); // Jika tugas dihapus, soalnya ikut hapus

            // 2. Tambah tipe_soal
            // Kita beri default 'pilgan' asumsi semua soal lama Anda adalah pilgan
            $table->string('tipe_soal')->after('tugas_id')->default('pilgan');

            // 3. Ubah materi_id agar Boleh NULL
            // (Gunakan 'bigInteger' atau 'unsignedBigInteger' sesuai tipe data Anda)
            $table->unsignedBigInteger('materi_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soals', function (Blueprint $table) {
            // Hapus foreign key dan kolom 'tugas_id'
            $table->dropForeign(['tugas_id']);
            $table->dropColumn('tugas_id');

            // Hapus kolom 'tipe_soal'
            $table->dropColumn('tipe_soal');

            // Kembalikan materi_id jadi WAJIB (tidak boleh null)
            $table->unsignedBigInteger('materi_id')->nullable(false)->change();
        });
    }
}
