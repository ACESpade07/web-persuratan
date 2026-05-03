<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        h2   { text-align: center; margin-bottom: 4px; font-size: 16px; }
        p.sub{ text-align: center; color: #666; margin: 0 0 16px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #1e3a5f; color: white; }
        th, td { padding: 7px 10px; border: 1px solid #ddd; text-align: left; }
        tbody tr:nth-child(even) { background: #f5f7fa; }
        .badge-masuk  { color: #065f46; background: #d1fae5; padding: 2px 8px; border-radius: 99px; }
        .badge-keluar { color: #1e40af; background: #dbeafe; padding: 2px 8px; border-radius: 99px; }
        .footer { margin-top: 20px; font-size: 10px; color: #999; text-align: right; }
    </style>
</head>
<body>

    <h2>Laporan Arsip Surat</h2>
    <p class="sub">
        Periode:
        {{ $bulan ? \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') : 'Semua Bulan' }}
        {{ $tahun ?? 'Semua Tahun' }}
        &nbsp;·&nbsp; Total {{ $data->count() }} surat
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:30px;">No</th>
                <th>Nomor Surat</th>
                <th style="width:60px;">Jenis</th>
                <th>Pengirim / Tujuan</th>
                <th>Perihal</th>
                <th style="width:85px;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td style="font-family: monospace;">{{ $item->nomor_surat }}</td>
                <td>
                    @if($item->jenis == 'Masuk')
                        <span class="badge-masuk">Masuk</span>
                    @else
                        <span class="badge-keluar">Keluar</span>
                    @endif
                </td>
                <td>{{ $item->kontak }}</td>
                <td>{{ $item->perihal }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#999;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer">Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>

</body>
</html>