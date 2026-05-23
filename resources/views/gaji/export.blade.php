<!DOCTYPE html>
<html>

<head>
    <title>Data Karyawan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <div style="text-align: center; margin-bottom: 24px;">
        <h1 style="margin: 0; font-size: 28px; letter-spacing: 1px;">SLIP GAJI KARYAWAN</h1>
        <p style="margin: 6px 0 0; font-size: 14px;">PT. Aplikasi Penggajian</p>
    </div>

    <div style="margin-bottom: 20px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px; border: 1px solid #333;"><strong>Nama</strong></td>
                <td style="padding: 8px; border: 1px solid #333;">{{ $karyawan->nama }}</td>
                <td style="padding: 8px; border: 1px solid #333;"><strong>Jabatan</strong></td>
                <td style="padding: 8px; border: 1px solid #333;">
                    {{ optional($karyawan->jabatan)->label() ?? ucfirst($karyawan->jabatan ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #333;"><strong>NIK</strong></td>
                <td style="padding: 8px; border: 1px solid #333;">{{ $karyawan->nik }}</td>
                <td style="padding: 8px; border: 1px solid #333;"><strong>Email</strong></td>
                <td style="padding: 8px; border: 1px solid #333;">{{ $karyawan->email }}</td>
            </tr>
        </table>
    </div>

    @forelse ($gajiKaryawans as $gaji)
        <div style="page-break-inside: avoid; margin-bottom: 28px; border: 1px solid #333; padding: 18px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                <div>
                    <strong>Tanggal Slip</strong><br>
                    {{ $gaji->created_at->format('d-m-Y') }}
                </div>
                <div style="text-align: right;">
                    <strong>ID Slip</strong><br>
                    #{{ $gaji->id }}
                </div>
            </div>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 18px;">
                <tbody>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #333; width: 50%;"><strong>Gaji Pokok</strong></td>
                        <td style="padding: 10px; border: 1px solid #333; text-align: right;">Rp
                            {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #333;"><strong>Lembur</strong></td>
                        <td style="padding: 10px; border: 1px solid #333; text-align: right;">Rp
                            {{ number_format($gaji->lembur, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #333;"><strong>Potongan Pinjaman</strong></td>
                        <td style="padding: 10px; border: 1px solid #333; text-align: right;">Rp
                            {{ number_format($gaji->pinjaman, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #333;"><strong>Total Penghasilan</strong></td>
                        <td style="padding: 10px; border: 1px solid #333; text-align: right;">Rp
                            {{ number_format($gaji->total_penghasilan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #333;"><strong>Gaji Bersih</strong></td>
                        <td style="padding: 10px; border: 1px solid #333; text-align: right; font-weight: 700;">Rp
                            {{ number_format($gaji->gaji_bersih, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div style="display: flex; justify-content: space-between; margin-top: 12px;">
                <div style="font-size: 12px; color: #555;">Catatan: Simpan slip ini sebagai bukti pembayaran gaji.</div>
                <div style="text-align: center;">
                    <div style="font-weight: 700;">Diterima oleh</div>
                    <div style="height: 60px;"></div>
                    <div style="border-top: 1px solid #333; margin-top: 8px;">Tanda Tangan</div>
                </div>
            </div>
        </div>
    @empty
        <p>Tidak ada slip gaji untuk karyawan ini.</p>
    @endforelse

</body>

</html>
