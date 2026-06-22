<!DOCTYPE html>
<html>
<head>
    <title>Laporan Riwayat Transaksi</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #2c3e50; padding-bottom: 15px; margin-bottom: 25px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; color: #2c3e50; }
        .header p { margin: 5px 0 0; color: #7f8c8d; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #bdc3c7; padding: 10px 8px; text-align: left; }
        th { background-color: #ecf0f1; font-weight: bold; text-align: center; text-transform: uppercase; font-size: 11px;}
        .text-center { text-align: center; }
        .masuk { color: #27ae60; font-weight: bold; }
        .keluar { color: #c0392b; font-weight: bold; }
        .badge { padding: 3px 8px; border-radius: 3px; font-size: 10px; color: white; display: inline-block;}
        .bg-masuk { background-color: #27ae60; }
        .bg-keluar { background-color: #c0392b; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Riwayat Transaksi Barang</h1>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 25%">Nama Barang</th>
                <th style="width: 10%">Tipe</th>
                <th style="width: 10%">Jumlah</th>
                <th style="width: 35%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}</td>
                    <td>{{ $transaction->item ? $transaction->item->name : 'Barang Dihapus' }}</td>
                    <td class="text-center">
                        @if($transaction->type === 'masuk')
                            <span class="badge bg-masuk">MASUK</span>
                        @else
                            <span class="badge bg-keluar">KELUAR</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="{{ $transaction->type === 'masuk' ? 'masuk' : 'keluar' }}">
                            {{ $transaction->type === 'masuk' ? '+' : '-' }}{{ $transaction->quantity }}
                        </span>
                    </td>
                    <td>{{ $transaction->description ?: '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data transaksi dicatat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>