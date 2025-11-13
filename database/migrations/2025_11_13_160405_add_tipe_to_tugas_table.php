<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipeToTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tugas', function (Blueprint $table) {
            // Tambahkan kolom 'tipe' setelah kolom 'judul'
            // Kita beri nilai default 'upload' agar data tugas lama Anda
            // otomatis dianggap sebagai 'tugas upload'.
            $table->string('tipe')->after('judul')->default('upload');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tugas', function (Blueprint $table) {
            // Perintah untuk membatalkan (jika di-rollback)
            $table->dropColumn('tipe');
        });
    }
}
