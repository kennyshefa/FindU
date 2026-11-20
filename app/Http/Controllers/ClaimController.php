<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $activeClaim = null;
        $historyClaims = collect([]);
        $totalClaims = 4;
        $waitingCount = 1;
        $completedCount = 1;
        $rejectedOrExpiredCount = 2;

        try {
            // 1. Hitung Statistik (Stats Summary)
            $totalClaims = Claim::count();
            $waitingCount = Claim::where('status', 'menunggu')->count();
            $completedCount = Claim::where('status', 'selesai')->count();
            $rejectedOrExpiredCount = Claim::whereIn('status', ['ditolak', 'kedaluwarsa'])->count();

            // 2. Ambil Klaim Aktif
            $activeClaim = Claim::active()->latest()->first();

            // 3. Filter Riwayat
            $historyQuery = Claim::history()->latest();
            if ($filter !== 'semua') {
                $historyQuery->where('status', $filter);
            }
            $historyClaims = $historyQuery->get();
        } catch (\Throwable $e) {
            // Jika database belum dimigrasi / belum terkoneksi, gunakan fallback dummy
        }

        // Fallback dummy riwayat jika tabel belum diisi
        if ($historyClaims->isEmpty()) {
            $dummyHistory = collect([
                (object) [
                    'id' => 2,
                    'claim_code' => 'FU-2611-0042',
                    'item_name' => 'Kotak Pensil',
                    'item_photo' => null,
                    'status' => 'selesai',
                    'date_text' => 'Diserahkan 20 Nov 2026',
                    'has_timeline' => true,
                    'handover_photo' => null,
                    'timeline' => [
                        [
                            'time' => '20 Nov 2026, 14.32',
                            'desc' => 'Diserahkan oleh [Nama Petugas] setelah verifikasi',
                        ],
                        [
                            'time' => '20 Nov 2026, 14.30',
                            'desc' => 'Foto serah terima dicatat server',
                        ],
                        [
                            'time' => '20 Nov 2026, 10.15',
                            'desc' => 'Klaim diajukan',
                        ],
                    ],
                    'objection_deadline' => '27 Nov 2026',
                ],
                (object) [
                    'id' => 3,
                    'claim_code' => 'FU-2611-0031',
                    'item_name' => 'Tumbler Biru',
                    'item_photo' => null,
                    'status' => 'ditolak',
                    'date_text' => 'Ditolak 12 Nov 2026 · Alasan petugas: ciri tidak sesuai',
                    'has_timeline' => false,
                    'can_appeal' => true,
                ],
                (object) [
                    'id' => 4,
                    'claim_code' => 'FU-2611-0027',
                    'item_name' => 'Kacamata',
                    'item_photo' => null,
                    'status' => 'kedaluwarsa',
                    'date_text' => 'Kedaluwarsa 10 Nov 2026 · Tidak datang ke pos dalam 7 hari',
                    'has_timeline' => false,
                    'can_reclaim' => true,
                ],
            ]);

            if ($filter !== 'semua') {
                $historyClaims = $dummyHistory->where('status', $filter);
            } else {
                $historyClaims = $dummyHistory;
            }
        }

        return view('claims.index', compact(
            'totalClaims',
            'waitingCount',
            'completedCount',
            'rejectedOrExpiredCount',
            'activeClaim',
            'historyClaims',
            'filter'
        ));
    }

    public function cancel($id)
    {
        $claim = Claim::find($id);
        if ($claim && $claim->status === 'menunggu') {
            $claim->update(['status' => 'ditolak', 'rejection_reason' => 'Dibatalkan oleh pengguna']);
        }
        return back()->with('success', 'Klaim berhasil dibatalkan.');
    }
}
