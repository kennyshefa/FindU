<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('claim_code')->unique(); // contoh: FU-2611-0038
            $table->string('item_name');            // contoh: Kunci Motor
            $table->string('item_photo')->nullable();
            $table->string('location');             // contoh: Pos Satpam Gedung F
            $table->enum('status', ['menunggu', 'selesai', 'ditolak', 'kedaluwarsa'])->default('menunggu');
            $table->enum('step', ['klaim_diajukan', 'ke_pos_satpam', 'verifikasi_petugas', 'diserahkan'])->default('klaim_diajukan');
            $table->dateTime('expired_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->dateTime('handed_over_at')->nullable();
            $table->string('handed_over_by')->nullable();
            $table->string('handover_photo')->nullable();
            $table->json('timeline_logs')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
