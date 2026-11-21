<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('status', 'semua');
        $isLoggedIn = $request->query('auth', '1') == '1'; // toggle via query ?auth=0 untuk preview sebelum login

        $items = collect([
            [
                'id' => 1,
                'name' => 'Dompet',
                'category' => 'Alat Tulis & Pribadi',
                'type' => 'ditemukan',
                'type_label' => 'Ditemukan',
                'type_color' => 'bg-emerald-50 text-emerald-600 border border-emerald-200/80',
                'location' => 'Perpus UB',
                'time' => '4 hari yang lalu',
                'image' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 2,
                'name' => 'Kunci Motor',
                'category' => 'Aksesoris & Kendaraan',
                'type' => 'ditemukan',
                'type_label' => 'Ditemukan',
                'type_color' => 'bg-emerald-50 text-emerald-600 border border-emerald-200/80',
                'location' => 'Parkiran FILKOM',
                'time' => '2 jam yang lalu',
                'image' => 'https://images.unsplash.com/photo-1582139329536-e7284fece509?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 3,
                'name' => 'Tumbler Biru',
                'category' => 'Perlengkapan',
                'type' => 'hilang',
                'type_label' => 'Hilang',
                'type_color' => 'bg-amber-50 text-amber-700 border border-amber-200/80',
                'location' => 'Gedung FISIP',
                'time' => '5 jam yang lalu',
                'image' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 4,
                'name' => 'Kacamata',
                'category' => 'Aksesoris',
                'type' => 'ditemukan',
                'type_label' => 'Ditemukan',
                'type_color' => 'bg-emerald-50 text-emerald-600 border border-emerald-200/80',
                'location' => 'Kantin FEB',
                'time' => '1 hari yang lalu',
                'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&auto=format&fit=crop&q=60',
            ],
        ]);

        $filteredItems = ($filter !== 'semua')
            ? $items->where('type', $filter)
            : $items;

        return view('home.index', compact('filteredItems', 'filter', 'isLoggedIn'));
    }
}
