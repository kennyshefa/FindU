<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    private function resolveImageByName($name, $uploadedImage = null, $fallback = null)
    {
        if (!empty($uploadedImage)) {
            return $uploadedImage;
        }

        $text = mb_strtolower((string) $name);

        if (str_contains($text, 'dompet')) {
            return asset('images/dashboard/item_1_dompet.png');
        }
        if (str_contains($text, 'kunci')) {
            return asset('images/dashboard/item_2_kunci.png');
        }
        if (str_contains($text, 'tumbler') || str_contains($text, 'botol')) {
            return asset('images/dashboard/item_3_tumbler.png');
        }
        if (str_contains($text, 'kacamata')) {
            return asset('images/dashboard/item_4_kacamata.png');
        }
        if (str_contains($text, 'kipas')) {
            return asset('images/search/item_3.png');
        }
        if (str_contains($text, 'bekal') || str_contains($text, 'makan')) {
            return asset('images/search/item_4.png');
        }
        if (str_contains($text, 'charger') || str_contains($text, 'laptop')) {
            return asset('images/search/item_5.png');
        }
        if (str_contains($text, 'gelang')) {
            return asset('images/search/item_8.png');
        }
        if (str_contains($text, 'kotak pensil') || str_contains($text, 'pensil')) {
            return asset('images/search/item_1.png');
        }

        return $fallback ?? asset('images/search/item_1.png');
    }

    private function combinedItems()
    {
        $fromSession = collect(session('user_activities', []))->map(function ($act, $index) {
            $isUpload = ($act['category'] ?? '') === 'upload';
            $name = $act['title'] ?? 'Barang';

            $subtitle = $act['subtitle'] ?? '';
            $parts = explode('·', $subtitle);
            $location = trim(end($parts)) ?: 'Kampus';

            return [
                'id' => (string) ($act['id'] ?? ('session-' . $index)),
                'name' => $name,
                'location' => $location,
                'time' => 'Baru saja',
                'type' => $isUpload ? 'ditemukan' : 'hilang',
                'image' => $this->resolveImageByName($name, $act['image'] ?? null),
            ];
        });

        $fromHome = HomeController::dashboardItems()->map(function ($item) {
            return [
                'id' => (string) $item['id'],
                'name' => $item['name'],
                'location' => $item['location'],
                'time' => $item['time'],
                'type' => $item['type'],
                'image' => $this->resolveImageByName($item['name'], null, $item['image']),
            ];
        });

        $fromSearch = collect([
            [
                'id' => 'search-1',
                'name' => 'Kotak Pensil',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_1.png'),
            ],
            [
                'id' => 'search-2',
                'name' => 'Kotak Pensil',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_2.png'),
            ],
            [
                'id' => 'search-3',
                'name' => 'Kipas Portable',
                'location' => 'Gedung F4.1',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_3.png'),
            ],
            [
                'id' => 'search-4',
                'name' => 'Bekal',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_4.png'),
            ],
            [
                'id' => 'search-5',
                'name' => 'Charger Laptop',
                'location' => 'GKM Lt.3',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_5.png'),
            ],
            [
                'id' => 'search-6',
                'name' => 'Kunci Motor',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_6.png'),
            ],
            [
                'id' => 'search-7',
                'name' => 'Kotak Pensil',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_7.png'),
            ],
            [
                'id' => 'search-8',
                'name' => 'Gelang Berlian',
                'location' => 'Gedung F3.4',
                'time' => '4 hari yang lalu',
                'type' => 'ditemukan',
                'image' => asset('images/search/item_8.png'),
            ],
        ]);

        return $fromSession->concat($fromHome)->concat($fromSearch);
    }

    private function findItemById($id)
    {
        $targetId = (string) $id;

        foreach ($this->combinedItems() as $item) {
            if ((string) $item['id'] === $targetId) {
                return $item;
            }
        }

        return null;
    }

    public function search(Request $request)
    {
        $keyword = trim((string) $request->query('q', ''));
        $filter = $request->query('status', 'semua');

        $searchResults = $this->combinedItems()
            ->when($filter !== 'semua', function ($col) use ($filter) {
                return $col->where('type', $filter);
            })
            ->when($keyword !== '', function ($col) use ($keyword) {
                $q = mb_strtolower($keyword);
                return $col->filter(function ($item) use ($q) {
                    return str_contains(mb_strtolower($item['name']), $q)
                        || str_contains(mb_strtolower($item['location']), $q);
                });
            })
            ->values();

        return view('items.search', compact('keyword', 'searchResults', 'filter'));
    }

    public function show($id = 'home-1')
    {
        $picked = $this->findItemById($id);

        if (!$picked) {
            return redirect()->route('items.search')->with('error', 'Data barang tidak ditemukan.');
        }

        $item = (object) [
            'id' => $picked['id'],
            'name' => $picked['name'],
            'description' => $picked['name'] . ' di ' . $picked['location'],
            'type' => $picked['type'],
            'category' => 'Barang Kampus',
            'location' => $picked['location'],
            'found_date' => $picked['time'],
            'stored_at' => 'Pos Satpam Terdekat',
            'stored_note' => 'Setiap hari, 07.00-18.00 WIB',
            'status' => $picked['type'] === 'hilang' ? 'Menunggu ditemukan' : 'Belum diklaim',
            'image' => $picked['image'],
        ];

        return view('items.show', compact('item'));
    }

    public function submitClaim(Request $request, $id = 'home-1')
    {
        $picked = $this->findItemById($id);

        if (!$picked) {
            return redirect()->route('items.search')->with('error', 'Data barang tidak ditemukan.');
        }

        $claims = session('user_claims', []);
        $kodeKlaim = 'FU-' . date('ym') . '-' . str_pad(count($claims) + 1, 4, '0', STR_PAD_LEFT);

        $newClaim = [
            'id' => uniqid('claim_'),
            'claim_code' => $kodeKlaim,
            'item_id' => $picked['id'],
            'item_name' => $picked['name'],
            'location' => $picked['location'],
            'image' => $picked['image'],
            'validity' => 'Berlaku 7 hari. Setelah itu klaim kedaluwarsa.',
            'status' => 'Menunggu verifikasi',
            'expired_date' => date('d M Y', strtotime('+7 days')),
            'submitted_at' => date('d M Y, H.i'),
            'notice' => 'Bawa KTM dan ingat kapan (jam) serta di mana kamu merasa kehilangan barang ini. Kode hanya nomor antrean, bukan bukti kepemilikan.',
        ];

        array_unshift($claims, $newClaim);
        session(['user_claims' => $claims]);

        return redirect()->route('items.claim-success')->with('latest_claim', $newClaim);
    }

    public function createFound()
    {
        return view('items.create-found');
    }

    public function storeFound(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['nullable', 'string', 'max:100'],
            'found_date' => ['nullable', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ], [
            'name.required' => 'Nama barang wajib diisi.',
            'location.required' => 'Lokasi ditemukan wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG atau PNG.',
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $stored = $request->file('image')->store('items', 'public');
            $imagePath = asset('storage/' . $stored);
        }

        $activities = session('user_activities', []);
        $newActivity = [
            'id' => uniqid('act_'),
            'category' => 'upload',
            'category_label' => 'Upload',
            'category_color' => 'bg-purple-100 text-purple-700',
            'title' => $validated['name'],
            'subtitle' => 'Kamu upload ' . date('d M Y') . ' · ' . $validated['location'],
            'status_badge' => 'Menunggu pemilik',
            'status_badge_color' => 'bg-amber-50 text-amber-700 border border-amber-200/80',
            'action_button' => null,
            'action_is_badge' => false,
            'image' => $imagePath,
        ];

        array_unshift($activities, $newActivity);
        session(['user_activities' => $activities]);

        return redirect()->route('items.success-found');
    }

    public function createLost()
    {
        return view('items.create-lost');
    }

    public function storeLost(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['nullable', 'string', 'max:100'],
            'lost_date' => ['nullable', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ], [
            'name.required' => 'Nama barang hilang wajib diisi.',
            'location.required' => 'Lokasi barang wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG atau PNG.',
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $stored = $request->file('image')->store('items', 'public');
            $imagePath = asset('storage/' . $stored);
        }

        $activities = session('user_activities', []);
        $newActivity = [
            'id' => uniqid('act_'),
            'category' => 'kehilangan',
            'category_label' => 'Kehilangan',
            'category_color' => 'bg-amber-100 text-amber-800',
            'title' => $validated['name'],
            'subtitle' => 'Dilaporkan hilang ' . date('d M Y') . ' · ' . $validated['location'],
            'status_badge' => 'Belum ditemukan',
            'status_badge_color' => 'bg-amber-50 text-amber-700 border border-amber-200/80',
            'action_button' => null,
            'action_is_badge' => false,
            'image' => $imagePath,
        ];

        array_unshift($activities, $newActivity);
        session(['user_activities' => $activities]);

        return redirect()->route('items.success-lost');
    }

    public function successFound()
    {
        return view('items.success-found');
    }

    public function successLost()
    {
        return view('items.success-lost');
    }

    public function claimSuccess()
    {
        $claims = session('user_claims', []);
        $claim = session('latest_claim') ?? ($claims[0] ?? null);

        return view('items.claim-success', compact('claim'));
    }
}