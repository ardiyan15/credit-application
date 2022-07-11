<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .center {
            margin-left: 5%;
            margin-right: 5%;
        }

        table {
            font-size: 12px;
        }

    </style>
</head>

<body>
    <div style="padding: 15px; border: 1px dashed black">
        <h5 class="text-center">MICRO BANKING SCORING SYSTEM</h5>
        <h6 class="text-center mb-4">PERMOHONAN : Rekomendasi</h6>
        <table class="center">
            <tr>
                <th>Nama Pemohon</th>
                <td>:</td>
                <td width="200">{{ strtoupper($scoring->nasabah->nama_lengkap) }}</td>
                <th>NIP MKS</th>
                <td>:</td>
                <td>{{ $scoring->nasabah->user_created->employee->nip }}</td>
            </tr>
            <tr>
                <th>MBU Cabang</th>
                <td>:</td>
                <td>KCP MMU Jakarta Raya Kosambi</td>
                <th>Nama MKS</th>
                <td>:</td>
                <td>{{ ucwords($scoring->nasabah->user_created->employee->nama) }}</td>
            </tr>
            <tr>
                <th>No Aplikasi</th>
                <td>:</td>
                <td>R03.JRK/{{ $scoring->nasabah->nomor_urut }}/{{ strtoupper($scoring->nasabah->jenis_pinjaman) }}/{{ substr($scoring->nasabah->created_at, 0, 4) }}
                </td>
                <th>NIP MKA</th>
                <td>:</td>
                <td>{{ $scoring->mka->employee->nip }}</td>
            </tr>
            <tr>
                <th>Jenis Permohonan</th>
                <td>:</td>
                <td>Permohonan Baru</td>
                <th>Nama MKA</th>
                <td>:</td>
                <td>{{ $scoring->mka->employee->nama }}</td>
            </tr>
            <tr>
                <th>Jenis Produk</th>
                <td>:</td>
                <td>{{ strtoupper($scoring->nasabah->jenis_pinjaman) . ' - ' . ucwords($scoring->nasabah->tujuan_penggunaan) }}
                </td>
                <th>Limit</th>
                <td>:</td>
                <td>@currency($scoring->nasabah->limit_kredit)</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($scoring->nasabah->created_at)->format('d/m/Y') }}</td>
                <th>Tujuan</th>
                <td>:</td>
                <td>{{ ucwords($scoring->nasabah->tujuan_penggunaan) }}</td>
            </tr>
        </table>
        <h6 class="text-center mb-4 mt-4">INFORMASI UMUM</h6>
        <table class="center">
            <tr>
                <th>Tanggal Lahir</th>
                <td>:</td>
                <td width="190">{{ \Carbon\Carbon::parse($scoring->nasabah->tanggal_lahir)->format('d/m/Y') }}</td>
                <th>Bentuk Usaha</th>
                <td>:</td>
                <td>Perorangan</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>:</td>
                <td>{{ $scoring->nasabah->jenis_kelamin }}</td>
                <th>Mulai Berusaha Sejak</th>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($scoring->nasabah->usaha->berusaha_sejak)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Pendidikan Terakhir</th>
                <td>:</td>
                <td>{{ ucwords($scoring->nasabah->pendidikan_terakhir) }}</td>
                <th>Kepemilikan Telepon</th>
                <td>:</td>
                <td>
                    @if ($scoring->nasabah->no_telepon)
                        Ada
                    @else
                        Tidak Ada
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status Perkawinan</th>
                <td>:</td>
                <td>{{ $scoring->nasabah->status_pernikahan }}</td>
                <th>No Telepon Rumah/Usaha</th>
                <td>:</td>
                <td>
                    @if ($scoring->nasabah->usaha->no_telepon)
                        {{ $scoring->nasabah->usaha->no_telepon }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Jumlah Anak (orang)</th>
                <td>:</td>
                <td>{{ $scoring->nasabah->jumlah_tanggungan }}</td>
                <th>Menetap Sejak</th>
                <td>:</td>
                <td>01/02/2015</td>
            </tr>
            <tr>
                <th>Status Kepemilikan</th>
                <td>:</td>
                <td>{{ ucwords($scoring->nasabah->status_tempat_tinggal) }}</td>
                <th>KTP</th>
                <td>:</td>
                <td>
                    @if ($scoring->nasabah->no_ktp)
                        {{ $scoring->nasabah->no_ktp }}
                    @else
                        Tidak Ada
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
