<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }} - {{ $period }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #10b981;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
            color: #10b981;
            text-transform: uppercase;
        }
        .header p {
            margin: 4px 0 0;
            font-size: 10px;
            color: #666666;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
        }
        .title h2 {
            font-size: 14px;
            margin: 0;
            text-transform: uppercase;
        }
        .title p {
            margin: 4px 0 0;
            font-size: 11px;
            color: #444444;
        }
        .summary-box {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .summary-box td {
            padding: 8px 12px;
            border: 1px solid #dddddd;
            background-color: #f9f9f9;
        }
        .summary-label {
            font-weight: bold;
            color: #555555;
            font-size: 10px;
        }
        .summary-value {
            font-size: 14px;
            font-weight: bold;
            color: #10b981;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #1e293b;
            color: #ffffff;
            font-weight: bold;
            text-align: left;
            padding: 6px 8px;
            font-size: 9px;
            text-transform: uppercase;
        }
        .table td {
            padding: 6px 8px;
            border-bottom: 1px solid #eeeeee;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 30px;
            text-align: center;
            font-size: 8px;
            color: #999999;
            border-top: 1px solid #eeeeee;
            padding-top: 8px;
        }
        .page-number:before {
            content: "Halaman " counter(page);
        }
        .section-title {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #1e293b;
            border-left: 3px solid #10b981;
            padding-left: 6px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>SMART-SMASH Badminton Court</h1>
        <p>Jl. Badminton No. 1, Jakarta Selatan | Telp: 081234567890 | Email: info@smartsmash.com</p>
    </div>

    <!-- Title Info -->
    <div class="title">
        <h2>{{ $title }}</h2>
        <p>Periode: <strong>{{ $period }}</strong></p>
    </div>

    <!-- Summary Box -->
    <table class="summary-box">
        <tr>
            <td width="50%">
                <span class="summary-label">TOTAL RESERVASI SELESAI / DISETUJUI</span><br>
                <span style="font-size: 16px; font-weight: bold; color: #333;">{{ $totalBooking }} Booking</span>
            </td>
            <td width="50%">
                <span class="summary-label">TOTAL PENDAPATAN</span><br>
                <span class="summary-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
            </td>
        </tr>
    </table>

    <!-- Court Breakdown -->
    <div class="section-title">Rincian Pendapatan Per Lapangan</div>
    <table class="table">
        <thead>
            <tr>
                <th width="40%">Nama Lapangan</th>
                <th width="20%">Jenis Lapangan</th>
                <th width="20%" class="text-center">Total Booking</th>
                <th width="20%" class="text-right">Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fieldsBreakdown as $field)
                <tr>
                    <td><strong>{{ $field['nama_lapangan'] }}</strong></td>
                    <td>{{ $field['jenis_lapangan'] }}</td>
                    <td class="text-center">{{ $field['total_booking'] }}</td>
                    <td class="text-right">Rp {{ number_format($field['total_pendapatan'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Transactions Detail -->
    <div class="section-title">Detail Reservasi Transaksi</div>
    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode Booking</th>
                <th width="20%">Nama Pelanggan</th>
                <th width="15%">Lapangan</th>
                <th width="15%">Tanggal</th>
                <th width="18%">Jam Sewa</th>
                <th width="12%" class="text-right">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-family: monospace; font-weight: bold;">{{ $booking->kode_booking }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->field->nama_lapangan }}</td>
                    <td>{{ $booking->tanggal->format('d/m/Y') }}</td>
                    <td>{{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }} ({{ $booking->durasi }} Jam)</td>
                    <td class="text-right">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer Page -->
    <div class="footer">
        Laporan ini digenerate secara otomatis oleh SMART-SMASH System pada {{ $dateGenerated }}. <span class="page-number"></span>
    </div>

</body>
</html>
