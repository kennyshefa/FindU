<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('status', 'semua');
        
        // Cek parameter auth atau session login
        // Default login jika ada auth=1 atau default, jika auth=0 maka tampilan sebelum login
        $authParam = $request->query('auth');
        if ($authParam !== null) {
            $isLoggedIn = ($authParam === '1');
            session(['is_logged_in' => $isLoggedIn]);
        } else {
            $isLoggedIn = session('is_logged_in', true);
        }

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
                'image' => asset('images/dashboard/item_1_dompet.png'),
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
                'image' => asset('images/dashboard/item_2_kunci.png'),
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
                'image' => asset('images/dashboard/item_3_tumbler.png'),
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
                'image' => asset('images/dashboard/item_4_kacamata.png'),
            ],
        ]);

        $filteredItems = ($filter !== 'semua')
            ? $items->where('type', $filter)
            : $items;

        return view('home.index', compact('filteredItems', 'filter', 'isLoggedIn'));
    }
}
