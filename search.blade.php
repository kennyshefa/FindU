<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FindU - Cari Barang</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #e8effc; 
            margin: 0; 
            padding: 20px; 
        }
        
        .container { 
            max-width: 1100px; 
            margin: auto; 
        }

        /* Navbar */
        .navbar { 
            background: white; 
            padding: 15px 25px; 
            border-radius: 10px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }

        .logo { 
            font-size: 28px; 
            font-weight: bold; 
            color: #1e3a8a; 
        }

        .menu a { 
            margin: 0 15px; 
            color: gray; 
            text-decoration: none; 
            font-weight: bold; 
        }

        .menu a.aktif { 
            color: orange; 
        }

        .user { 
            background: orange; 
            color: white; 
            padding: 10px 20px; 
            border-radius: 5px; 
        }

        /* Form cari */
        .form-cari { 
            text-align: center; 
            margin: 40px 0; 
        }

        .form-cari input { 
            width: 60%; 
            padding: 12px; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            font-size: 16px; 
        }

        .form-cari button { 
            padding: 12px 25px; 
            background: #2563eb; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-size: 16px; 
            cursor: pointer; 
        }

        /* Filter */
        .filter { 
            display: flex; 
            justify-content: space-between; 
            margin: 20px 0; 
        }

        .filter a { 
            padding: 8px 20px; 
            border: 1px solid gray; 
            border-radius: 20px; 
            color: gray; 
            text-decoration: none; 
            margin-right: 10px; 
        }

        .filter a.aktif { 
            background: #2563eb; 
            color: white; 
            border-color: #2563eb; 
        }

        /* Kartu barang */
        .daftar { 
            display: flex; 
            flex-wrap: wrap; 
            gap: 20px; 
        }

        .kartu { 
            background: white; 
            width: 240px; 
            padding: 15px; 
            border-radius: 8px; 
        }

        .foto { 
            height: 180px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            overflow: hidden; 
        }

        .foto img { 
            width: 100%; 
            height: 100%; 
            object-fit: contain; 
        }

        .label { 
            display: inline-block; 
            margin-top: 10px; 
            padding: 3px 12px; 
            border-radius: 20px; 
            font-size: 13px; 
        }

        .ditemukan { 
            background: #ccfbf1; 
            color: #14b8a6; 
        }

        .hilang { 
            background: #fee2e2; 
            color: #dc2626; 
        }

        .kartu h3 { 
            margin: 8px 0; 
        }

        .kartu p { 
            margin: 3px 0; 
            font-size: 14px; 
            color: #444; 
        }
        
    </style>
</head>
<body>
<div class="container">

    <div class="navbar">
        <div class="logo">FindU</div>
        <div class="menu">
            <a href="#">Beranda</a>
            <a href="{{ route('search') }}" class="aktif">Cari</a>
            <a href="#">Riwayat</a>
            <a href="#">Tentang Kami</a>
        </div>
        <div class="user">Hana</div>
    </div>

    <form class="form-cari" method="GET" action="{{ route('search') }}">
        <input type="text" name="q" value="{{ $cari }}" placeholder="Cari nama barang, lokasi, atau kategori...">
        <input type="hidden" name="status" value="{{ $status }}">
        <input type="hidden" name="urutan" value="{{ $urutan }}">
        <button type="submit">Cari</button>
    </form>

    <h1>Hasil Pencarian</h1>
    <p>Ditemukan {{ $jumlah }} hasil @if($cari != '') untuk "{{ $cari }}" @endif</p>

    <div class="filter">
        <div>
            <a href="{{ route('search', ['q' => $cari, 'status' => 'semua', 'urutan' => $urutan]) }}"
               class="{{ $status == 'semua' ? 'aktif' : '' }}">Semua</a>
            <a href="{{ route('search', ['q' => $cari, 'status' => 'hilang', 'urutan' => $urutan]) }}"
               class="{{ $status == 'hilang' ? 'aktif' : '' }}">Hilang</a>
            <a href="{{ route('search', ['q' => $cari, 'status' => 'ditemukan', 'urutan' => $urutan]) }}"
               class="{{ $status == 'ditemukan' ? 'aktif' : '' }}">Ditemukan</a>
        </div>

        <form method="GET" action="{{ route('search') }}">
            <input type="hidden" name="q" value="{{ $cari }}">
            <input type="hidden" name="status" value="{{ $status }}">
            <select name="urutan" onchange="this.form.submit()">
                <option value="terbaru" {{ $urutan == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                <option value="terlama" {{ $urutan == 'terlama' ? 'selected' : '' }}>Terlama</option>
            </select>
        </form>
    </div>

    <div class="daftar">
        @forelse($hasil as $b)
            <div class="kartu">
                <div class="foto">
                    <img src="{{ asset('assets/' . $b->gambar) }}" alt="{{ $b->nama }}">
                </div>
                <span class="label {{ $b->status }}">{{ ucfirst($b->status) }}</span>
                <h3>{{ $b->nama }}</h3>
                <p>📍 {{ $b->lokasi }}</p>
                <p>🕒 {{ $b->created_at->locale('id')->diffForHumans() }}</p>
            </div>
        @empty
            <p>Barang tidak ditemukan.</p>
        @endforelse
    </div>

</div>
</body>
</html>