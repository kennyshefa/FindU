<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $storedClaims = collect(session('user_claims', []));
        $storedActivities = collect(session('user_activities', []));

        $firstClaim = $storedClaims->first();
        $activeClaim = is_array($firstClaim) ? (object) $firstClaim : null;

        $claimActivities = $storedClaims->map(function ($c) {
            return (object) [
                'id' => $c['id'] ?? uniqid(),
                'category' => 'klaim',
                'category_label' => 'Klaim',
                'category_color' => 'bg-blue-100 text-blue-700',
                'title' => $c['item_name'] ?? 'Barang Klaim',
                'subtitle' => 'Klaim ' . ($c['claim_code'] ?? '-') . ' · Diajukan ' . ($c['submitted_at'] ?? '-'),
                'status_badge' => $c['status'] ?? 'Menunggu verifikasi',
                'status_badge_color' => 'bg-amber-50 text-amber-700 border border-amber-200/80',
                'action_button' => null,
                'action_is_badge' => false,
                'image' => $c['image'] ?? null,
            ];
        });

        $otherActivities = $storedActivities->map(function ($a) {
            $isUpload = ($a['category'] ?? '') === 'upload';

            return (object) [
                'id' => $a['id'] ?? uniqid(),
                'category' => $a['category'] ?? 'upload',
                'category_label' => $a['category_label'] ?? ($isUpload ? 'Upload' : 'Kehilangan'),
                'category_color' => $a['category_color'] ?? ($isUpload ? 'bg-purple-100 text-purple-700' : 'bg-amber-100 text-amber-800'),
                'title' => $a['title'] ?? 'Barang',
                'subtitle' => $a['subtitle'] ?? '',
                'status_badge' => $a['status_badge'] ?? null,
                'status_badge_color' => $a['status_badge_color'] ?? 'bg-amber-50 text-amber-700 border border-amber-200/80',
                'action_button' => $a['action_button'] ?? null,
                'action_is_badge' => $a['action_is_badge'] ?? false,
                'image' => $a['image'] ?? null,
            ];
        });

        $allActivities = $otherActivities->concat($claimActivities)->values();

        $stats = [
            'uploaded' => $otherActivities->where('category', 'upload')->count(),
            'lost' => $otherActivities->where('category', 'kehilangan')->count(),
            'claimed' => $claimActivities->count(),
            'completed' => 0,
        ];

        $counts = [
            'semua' => $allActivities->count(),
            'upload' => $allActivities->where('category', 'upload')->count(),
            'kehilangan' => $allActivities->where('category', 'kehilangan')->count(),
            'klaim' => $allActivities->where('category', 'klaim')->count(),
        ];

        $activities = ($filter !== 'semua')
            ? $allActivities->where('category', $filter)->values()
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
        $claims = collect(session('user_claims', []))
            ->reject(fn ($item) => ($item['id'] ?? null) === $id)
            ->values()
            ->all();

        session(['user_claims' => $claims]);

        return back()->with('success', 'Klaim berhasil dibatalkan.');
    }
}