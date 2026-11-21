<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Halaman Cari Barang (Sesuai SEARCH.png)
    public function search(Request $request)
    {
        $keyword = $request->query('q', 'dompet');
        $filter = $request->query('status', 'semua');

        $searchResults = collect([
            [
                'id' => 1,
                'name' => 'Kotak Pensil',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_1.png'),
            ],
            [
                'id' => 2,
                'name' => 'Kotak Pensil',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_2.png'),
            ],
            [
                'id' => 3,
                'name' => 'Kipas Portable',
                'location' => 'Gedung F4.1',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_3.png'),
            ],
            [
                'id' => 4,
                'name' => 'Bekal',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_4.png'),
            ],
            [
                'id' => 5,
                'name' => 'Charger Laptop',
                'location' => 'GKM Lt.3',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_5.png'),
            ],
            [
                'id' => 6,
                'name' => 'Kunci Motor',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_6.png'),
            ],
            [
                'id' => 7,
                'name' => 'Kotak Pensil',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_7.png'),
            ],
            [
                'id' => 8,
                'name' => 'Gelang Berlian',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_8.png'),
            ],
        ]);

        return view('items.search', compact('keyword', 'searchResults', 'filter'));
    }

    // Detail Barang (Sesuai DETAIL BARANG.png)
    public function show($id = 1)
    {
        $item = (object) [
            'id' => $id,
            'name' => 'Dompet',
            'description' => 'Dompet Kulit warna Coklat Tua',
            'type' => 'ditemukan',
            'category' => 'Alat Tulis & Pribadi',
            'location' => 'Gedung F',
            'found_date' => '20 November 2026',
            'stored_at' => 'Pos Satpam Gedung F',
            'stored_note' => 'Setiap hari, 07.00-18.00 WIB',
            'status' => 'Belum diklaim',
            'image' => asset('images/dashboard/item_1_dompet.png'),
        ];

        return view('items.show', compact('item'));
    }

    // Form Lapor Barang Ditemukan (Sesuai UPLOAD BARANG DITEMUKAN.png)
    public function createFound()
    {
        return view('items.create-found');
    }

    public function storeFound(Request $request)
    {
        return redirect()->route('items.success-found');
    }

    // Form Lapor Barang Hilang (Sesuai UPLOAD BARANG HILANG.png)
    public function createLost()
    {
        return view('items.create-lost');
    }

    public function storeLost(Request $request)
    {
        return redirect()->route('items.success-lost');
    }

    // Halaman Berhasil Kirim Laporan Ditemukan (Sesuai LAPORAN BERHASIL UPLOAD BARANG.png)
    public function successFound()
    {
        return view('items.success-found');
    }

    // Halaman Berhasil Kirim Laporan Hilang (Sesuai LAPORAN BERHASIL.png)
    public function successLost()
    {
        return view('items.success-lost');
    }

    // Halaman Berhasil Klaim (Sesuai BERHASIL KLAIM.png)
    public function claimSuccess()
    {
        return view('items.claim-success');
    }
}
