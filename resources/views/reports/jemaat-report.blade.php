<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Jemaat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .header {
            margin-bottom: 30px;
        }
        .date {
            text-align: right;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Data Jemaat</h1>
        <div class="date">Tanggal: {{ date('d F Y') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelompok</th>
                <th>Nama Jemaat</th>
                <th>Pelka</th>
                <th>Status Sidi</th>
                <th>Status Baptis</th>
                <th>Diunggah Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kelompok->nama ?? '-' }}</td>
                <td>{{ $item->anggotaKeluarga->nama ?? '-' }}</td>
                <td>{{ $item->pelka->nama ?? '-' }}</td>
                <td>{{ $item->dokumen->first() && $item->dokumen->first()->file_sidi ? 'Sudah' : 'Belum' }}</td>
                <td>{{ $item->dokumen->first() && $item->dokumen->first()->file_baptis ? 'Sudah' : 'Belum' }}</td>
                <td>
                    @foreach($item->dokumen as $dok)
                        {{ $dok->uploader->name ?? '-' }}@if(!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
