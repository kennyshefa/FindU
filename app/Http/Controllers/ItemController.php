<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Halaman Cari Barang
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
                'image' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 2,
                'name' => 'Kotak Pensil',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => 'https://images.unsplash.com/photo-1585336261026-7788a1046182?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 3,
                'name' => 'Kipas Portable',
                'location' => 'Gedung F4.1',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => 'https://images.unsplash.com/photo-1618944847828-82e943c3bdb7?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 4,
                'name' => 'Bekal',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 5,
                'name' => 'Charger Laptop',
                'location' => 'GKM Lt.3',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 6,
                'name' => 'Kunci Motor',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => 'https://images.unsplash.com/photo-1582139329536-e7284fece509?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 7,
                'name' => 'Kotak Pensil',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => 'https://images.unsplash.com/photo-1513542789411-b6a5d4f31634?w=500&auto=format&fit=crop&q=60',
            ],
            [
                'id' => 8,
                'name' => 'Gelang Berlian',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => 'https://images.unsplash.com/photo-1611591475152-473523dd665e?w=500&auto=format&fit=crop&q=60',
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
            'image' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=800&auto=format&fit=crop&q=80',
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
