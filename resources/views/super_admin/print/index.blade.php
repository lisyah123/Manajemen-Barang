<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Barang</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
        .foto { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Ketersediaan Barang Gudang</h1>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Foto</th>
                <th style="width: 25%">Nama Barang</th>
                <th style="width: 15%">Kategori</th>
                <th style="width: 25%">Deskripsi</th>
                <th style="width: 15%">Sisa Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        @if($item->image)
                            <img src="{{ public_path('storage/' . $item->image) }}" class="foto">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category ? $item->category->name : '-' }}</td>
                    <td>{{ $item->description ?: '-' }}</td>
                    <td class="text-center">{{ $item->stock }} Unit</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>