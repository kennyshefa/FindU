<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'semua');

        // 4 Statistik Atas Sesuai Desain Revisi
        $stats = [
            'uploaded' => 3,     // Barang diupload
            'lost' => 4,         // Laporan kehilangan
            'claimed' => 4,      // Klaim diajukan
            'completed' => 2,    // Selesai
        ];

        // Data Klaim Aktif
        $activeClaim = (object) [
            'id' => 1,
            'claim_code' => 'FU-2611-0042',
            'item_name' => 'Kunci Motor',
            'location' => 'Pos Satpam Gedung F',
            'validity' => 'Berlaku 7 hari. Setelah itu klaim kedaluwarsa.',
            'status' => 'Menunggu verifikasi',
            'expired_date' => '27 Nov 2026',
            'step' => 'klaim_diajukan',
            'notice' => 'Bawa KTM dan ingat kapan (jam) serta di mana kamu merasa kehilangan barang ini. Kode hanya nomor antrean, bukan bukti kepemilikan.',
        ];

        // 10 Riwayat Aktivitas Lengkap Sesuai Desain Revisi
        $allActivities = collect([
            (object) [
                'id' => 1,
                'category' => 'klaim',
                'category_label' => 'Klaim',
                'category_color' => 'bg-blue-100 text-blue-700',
                'title' => 'Kunci Motor',
                'subtitle' => 'Klaim FU-2611-0038 · Diajukan 20 Nov 2026',
                'status_badge' => 'Menunggu verifikasi',
                'status_badge_color' => 'bg-amber-50 text-amber-700 border border-amber-200/80',
                'action_button' => null,
            ],
            (object) [
                'id' => 2,
                'category' => 'klaim',
                'category_label' => 'Klaim',
                'category_color' => 'bg-blue-100 text-blue-700',
                'title' => 'Kotak Pensil',
                'subtitle' => 'FU-2611-0042 · Diserahkan 20 Nov 2026',
                'status_badge' => 'Klaim berhasil',
                'status_badge_color' => 'bg-emerald-50 text-emerald-600 border border-emerald-200/80',
                'action_button' => 'Lihat jejak',
            ],
            (object) [
                'id' => 3,
                'category' => 'kehilangan',
                'category_label' => 'Kehilangan',
                'category_color' => 'bg-amber-100 text-amber-800',
                'title' => 'Kunci Motor',
                'subtitle' => 'Dilaporkan hilang 19 Nov 2026 · Gedung F lantai 1',
                'status_badge' => 'Ditemukan, sedang diklaim',
                'status_badge_color' => 'bg-blue-50 text-blue-600 border border-blue-200/80',
                'action_button' => 'Lihat klaim',
            ],
            (object) [
                'id' => 4,
                'category' => 'upload',
                'category_label' => 'Upload',
                'category_color' => 'bg-purple-100 text-purple-700',
                'title' => 'Dompet Hitam',
                'subtitle' => 'Kamu upload 18 Nov 2026 · Disimpan di Pos Satpam Gedung A',
                'status_badge' => 'Menunggu pemilik',
                'status_badge_color' => 'bg-amber-50 text-amber-700 border border-amber-200/80',
                'action_button' => 'Lihat postingan',
            ],
            (object) [
                'id' => 5,
                'category' => 'upload',
                'category_label' => 'Upload',
                'category_color' => 'bg-purple-100 text-purple-700',
                'title' => 'Payung Hijau',
                'subtitle' => 'Kamu upload 14 Nov 2026 · Diambil pemilik 16 Nov 2026',
                'status_badge' => 'Sudah kembali ke pemilik',
                'status_badge_color' => 'bg-emerald-50 text-emerald-600 border border-emerald-200/80',
                'action_button' => null,
            ],
            (object) [
                'id' => 6,
                'category' => 'klaim',
                'category_label' => 'Klaim',
                'category_color' => 'bg-blue-100 text-blue-700',
                'title' => 'Tumbler Biru',
                'subtitle' => 'FU-2611-0031 · Ditolak 12 Nov 2026 · Alasan petugas: ciri tidak sesuai',
                'status_badge' => 'Ditolak',
                'status_badge_color' => 'bg-rose-50 text-rose-600 border border-rose-200/80',
                'action_button' => 'Ajukan keberatan',
            ],
            (object) [
                'id' => 7,
                'category' => 'kehilangan',
                'category_label' => 'Kehilangan',
                'category_color' => 'bg-amber-100 text-amber-800',
                'title' => 'Tumbler Biru',
                'subtitle' => 'Dilaporkan hilang 10 Nov 2026 · Kantin Gedung C',
                'status_badge' => null,
                'status_badge_color' => null,
                'action_button' => 'Laporan ditutup',
                'action_is_badge' => true,
            ],
            (object) [
                'id' => 8,
                'category' => 'klaim',
                'category_label' => 'Klaim',
                'category_color' => 'bg-blue-100 text-blue-700',
                'title' => 'Kacamata',
                'subtitle' => 'FU-2611-0027 · Kedaluwarsa 10 Nov 2026 · Tidak datang ke pos dalam 7 hari',
                'status_badge' => 'Kedaluwarsa',
                'status_badge_color' => 'bg-slate-100 text-slate-600 border border-slate-200/80',
                'action_button' => 'Klaim lagi',
            ],
            (object) [
                'id' => 9,
                'category' => 'kehilangan',
                'category_label' => 'Kehilangan',
                'category_color' => 'bg-amber-100 text-amber-800',
                'title' => 'Kacamata',
                'subtitle' => 'Dilaporkan hilang 1 Nov 2026 · Perpustakaan',
                'status_badge' => 'Belum ditemukan',
                'status_badge_color' => 'bg-amber-50 text-amber-700 border border-amber-200/80',
                'action_button' => 'Edit laporan',
            ],
            (object) [
                'id' => 10,
                'category' => 'upload',
                'category_label' => 'Upload',
                'category_color' => 'bg-purple-100 text-purple-700',
                'title' => 'Kartu Parkir',
                'subtitle' => 'Kamu upload 29 Okt 2026 · Dihapus karena duplikat',
                'status_badge' => null,
                'status_badge_color' => null,
                'action_button' => 'Diarsipkan',
                'action_is_badge' => true,
            ],
        ]);

        // Hitung Jumlah per Kategori
        $counts = [
            'semua' => $allActivities->count(),
            'upload' => $allActivities->where('category', 'upload')->count(),
            'kehilangan' => $allActivities->where('category', 'kehilangan')->count(),
            'klaim' => $allActivities->where('category', 'klaim')->count(),
        ];

        // Filter Data Sesuai Tab
        $activities = ($filter !== 'semua')
            ? $allActivities->where('category', $filter)
            : $allActivities;

        return view('claims.index', compact(
            'stats',
            'activeClaim',
            'activities',
            'filter',
            'counts'
        ));
    }

    public function cancel($id)
    {
        return back()->with('success', 'Klaim berhasil dibatalkan.');
    }
}
