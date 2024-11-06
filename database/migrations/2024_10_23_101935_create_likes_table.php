<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // if (!Schema::hasTable('likes')) adalah sebelum membuat table baru, kode ini akan memeriksa apakah tabel likes sudah ada di database
        // if (!...) adalah Jika tabel likes tidak ada, maka proses pembuatan tabel akan dilanjutkan.
        if (!Schema::hasTable('likes')) { // Mengembalikan true jika tabel likes sudah ada, dan false jika belum ada.
            Schema::create('likes', function (Blueprint $table) {
                $table->id();
                $table->timestamp('tanggal')->nullable();
                // $table->foreignId('id_contents') adalah Membuat kolom id_contents yang bertipe foreign key (kunci asing) untuk menghubungkan dengan tabel contents.
                // ->constrained('contents') adalah Menetapkan hubungan ke tabel contents. Laravel akan otomatis mencari kolom id di tabel contents untuk membuat hubungan ini.
                // ->onDelete('cascade'): Menetapkan perilaku penghapusan untuk kunci asing. Jika konten dihapus, maka semua like yang terkait dengan konten tersebut juga akan dihapus secara otomatis.
                $table->foreignId('id_contents')->constrained('contents')->onDelete('cascade');
                $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
