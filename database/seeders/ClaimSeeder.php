<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Claim;

class ClaimSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Klaim Aktif
        Claim::updateOrCreate(
            ['claim_code' => 'FU-2611-0038'],
            [
                'item_name' => 'Kunci Motor',
                'location' => 'Pos Satpam Gedung F',
                'status' => 'menunggu',
                'step' => 'klaim_diajukan',
                'expired_at' => '2026-11-27 23:59:59',
            ]
        );

        // 2. Riwayat: Kotak Pensil (Selesai)
        Claim::updateOrCreate(
            ['claim_code' => 'FU-2611-0042'],
            [
                'item_name' => 'Kotak Pensil',
                'location' => 'Pos Satpam Gedung F',
                'status' => 'selesai',
                'step' => 'diserahkan',
                'handed_over_at' => '2026-11-20 14:32:00',
                'handed_over_by' => '[Nama Petugas]',
                'timeline_logs' => [
                    ['time' => '20 Nov 2026, 14.32', 'desc' => 'Diserahkan oleh [Nama Petugas] setelah verifikasi'],
                    ['time' => '20 Nov 2026, 14.30', 'desc' => 'Foto serah terima dicatat server'],
                    ['time' => '20 Nov 2026, 10.15', 'desc' => 'Klaim diajukan'],
                ],
            ]
        );

        // 3. Riwayat: Tumbler Biru (Ditolak)
        Claim::updateOrCreate(
            ['claim_code' => 'FU-2611-0031'],
            [
                'item_name' => 'Tumbler Biru',
                'location' => 'Pos Satpam Gedung F',
                'status' => 'ditolak',
                'rejection_reason' => 'ciri tidak sesuai',
                'updated_at' => '2026-11-12 10:00:00',
            ]
        );

        // 4. Riwayat: Kacamata (Kedaluwarsa)
        Claim::updateOrCreate(
            ['claim_code' => 'FU-2611-0027'],
            [
                'item_name' => 'Kacamata',
                'location' => 'Pos Satpam Gedung F',
                'status' => 'kedaluwarsa',
                'rejection_reason' => 'Tidak datang ke pos dalam 7 hari',
                'updated_at' => '2026-11-10 10:00:00',
            ]
        );
    }
}
