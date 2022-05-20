<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            background-color: #0275d8;
            color: white;
            line-height: 1.5cm;
            margin-bottom: 50px;
        }

        header p {
            text-align: left;
            margin-left: 5%;
            margin-top: 2%;
            font-weight: bold;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 1.5cm;
        }

        .form {
            margin-top: 50px;
        }

        table {
            font-size: 15px;
        }

    </style>
</head>

<body>
    <header>
        <p>Formulir Aplikasi Kredit Mikro</p>
    </header>

    <div class="form">
        <div class="row">
            <span style="margin-right: 300px;">Cabang/Unit Mikro</span>
            <span>
                Tanggal Aplikasi
            </span>
            <hr>
            <table>
                <tr>
                    <th width="200">Pengajuan</th>
                    <td>:</td>
                    <td>Baru</td>
                </tr>
                <tr>
                    <th>Limit Kredit dimohon</th>
                    <td>:</td>
                    <td width="100"><u>@currency($customer->limit_kredit)</u></td>
                    <td><b>Terbilang</b> : <u>{{ \Terbilang::make($customer->limit_kredit, ' rupiah') }} </u></td>
                </tr>
                <tr>
                    <th>Jangka Waktu</th>
                    <td>:</td>
                    <td><u>{{ $customer->jangka_waktu . ' bulan' }}</u></td>
                </tr>
                <tr>
                    <th>Tujuan Penggunaan</th>
                    <td>:</td>
                    <td><u>{{ ucwords($customer->tujuan_penggunaan) }}</u></td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>:</td>
                    <td>{{ $customer->deskripsi }}</td>
                </tr>
            </table>

            <div class="data-calon-debitur bg-primary mt-3 p-2">
                <span class="text-white text-bold">A. DATA CALON DEBITUR</span>
            </div>
            <div class="data-pemohon bg-primary mt-2">
                <span class="text-bold text-white">A. 1 DATA PEMOHON</span>
            </div>
            <table>
                <tr>
                    <th width="200">1. Nama Lengkap</th>
                    <td>:</td>
                    <td>{{ $customer->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>2. Tempat, tanggal lahir</th>
                    <td>:</td>
                    <td width="150">
                        {{ $customer->tempat_lahir . ', ' . \Carbon\Carbon::parse($customer->tanggal_lahir)->translatedFormat('d F Y') }}
                    </td>
                    <td>
                        <b>Nama Ibu Kandung</b>: {{ $customer->nama_ibu_kandung }}
                    </td>
                </tr>
                <tr>
                    <th>3. Pendidikan Terakhir</th>
                    <td>:</td>
                    <td>{{ ucwords($customer->pendidikan_terakhir) }}</td>
                </tr>
                <tr>
                    <th>4. Alamat Sesuai KTP</th>
                    <td>:</td>
                    <td colspan="2">{{ $customer->alamat }}</td>
                </tr>
                <tr>
                    <th><span style="margin-left: 17px;">Kecamatan</span></th>
                    <td>:</td>
                    <td>{{ $customer->kecamatan }}</td>
                    <td><b>No telepon yang bisa dihubungi</b> : {{ $customer->no_telepon }}</td>
                </tr>
                <tr>
                    <th><span style="margin-left: 17px;">Kota</span></th>
                    <td>:</td>
                    <td>{{ $customer->kota }}</td>
                    <td width="50"><b>Provinsi</b>: {{ $customer->provinsi }}</td>
                    <td><b>Kode Pos</b>: {{ $customer->kode_pos }}</td>
                </tr>
                <tr>
                    <th>5. Alamat saat ini (bila berbeda)</th>
                    <td>:</td>
                    <td>{{ $customer->alamat_2 }}</td>
                </tr>
                <tr>
                    <th><span style="margin-left: 17px;">Kecamatan</span></th>
                    <td>:</td>
                    <td>{{ $customer->kecamatan_2 }}</td>
                    <td><b>No telepon yang bisa dihubungi</b> : {{ $customer->no_telepon_2 }}</td>
                </tr>
                <tr>
                    <th><span style="margin-left: 17px;">Kota</span></th>
                    <td>:</td>
                    <td>{{ $customer->kota_2 }}</td>
                    <td width="50"><b>Provinsi</b>: {{ $customer->provinsi_2 }}</td>
                    <td><b>Kode Pos</b>: {{ $customer->kode_pos_2 }}</td>
                </tr>
                <tr>
                    <th>6. No. KTP</th>
                    <td>:</td>
                    <td>{{ $customer->no_ktp }}</td>
                </tr>
                <tr>
                    <th>7. No. NPWP</th>
                    <td>:</td>
                    <td>{{ $customer->no_npwp }}</td>
                </tr>
                <tr>
                    <th>8. Status Tempat Tinggal</th>
                    <td>:</td>
                    <td>{{ ucwords($customer->status_tempat_tinggal) }}</td>
                </tr>
                <tr>
                    <th>9. Lama Tinggal</th>
                    <td>:</td>
                    <td>{{ $customer->lama_tinggal }}</td>
                </tr>
                <tr>
                    <th>10. Status</th>
                    <td>:</td>
                    <td>{{ $customer->status_pernikahan }}</td>
                </tr>
                <tr>
                    <th>11. Jumlah Tanggungan</th>
                    <td>:</td>
                    <td>{{ $customer->jumlah_tanggungan . ' Orang' }}</td>
                    <td><b>No. Kartu Keluarga </b>: {{ $customer->no_kartu_keluarga }}</td>
                </tr>
            </table>
            <div class="data-pemohon bg-primary mt-2">
                <span class="text-bold text-white">A. 2 DATA SUAMI / ISTRI</span>
            </div>
            <table>
                <tr>
                    <th width="200">12. Nama Suami / Istri</th>
                    <td>:</td>
                    <td width="150">{{ $customer->suami_istri->nama_suami_istri }}</td>
                    <td><b>No. KTP</b> : {{ $customer->suami_istri->no_ktp }}</td>
                </tr>
                <tr>
                    <th>13. Tempat, Tanggal Lahir</th>
                    <td>:</td>
                    <td> {{ $customer->suami_istri->tempat_lahir . ', ' . \Carbon\Carbon::parse($customer->suami_istri->tanggal_lahir)->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <th>14. Pendidikan Terakhir</th>
                    <td>:</td>
                    <td>{{ ucwords($customer->suami_istri->pendidikan_terakhir) }}</td>
                </tr>
                <tr>
                    <th>15. Pekerjaan Suami / Istri</th>
                    <td>:</td>
                    <td>{{ $customer->suami_istri->pekerjaan }}</td>
                </tr>
                <tr>
                    <th>16. Penghasilan Bulanan</th>
                    <td>:</td>
                    <td>@currency($customer->suami_istri->penghasilan)</td>
                </tr>
            </table>
            <div class="data-pemohon bg-primary mt-2">
                <span class="text-bold text-white">A. 3 DATA USAHA</span>
            </div>
            <table>
                <tr>
                    <th width="200">17. Berusaha Sejak</th>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($customer->usaha->berusaha_sejak)->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <th>18. Bidang Usaha</th>
                    <td>:</td>
                    <td width="150">{{ $customer->usaha->bidang_usaha }}</td>
                    <td><b>Jumlah Karyawan</b> : {{ $customer->usaha->jumlah_karyawan . ' Orang' }}</td>
                </tr>
                <tr>
                    <th>19. Alamat Usaha</th>
                    <td>:</td>
                    <td colspan="5">{{ $customer->usaha->alamat_usaha }}</td>
                </tr>
                <tr>
                    <th><span style="margin-left: 25px;">No. Telepon</span></th>
                    <td>:</td>
                    <td>{{ $customer->usaha->no_telepon }}</td>
                </tr>
                <tr>
                    <th>20. Status Kepemilikan Tempat Usaha</th>
                    <td>:</td>
                    <td>{{ ucwords($customer->usaha->status_kepemilikan) }}</td>
                    <td><b>Ditempati Sejak</b>:
                        {{ \Carbon\Carbon::parse($customer->usaha->ditempati_sejak)->translatedFormat('d F Y') }}
                    </td>
                </tr>
            </table>
            <div class="data-pemohon bg-primary mt-2">
                <span class="text-bold text-white">A. 4 DATA KERABAT DEKAT YANG TIDAK SERUMAH</span>
            </div>
            <table>
                <tr>
                    <th width="200">21. Nama Lengkap</th>
                    <td>:</td>
                    <td>{{ $customer->kerabat->nama_lengkap }}</td>
                    <td><b>Jenis Kelamin</b> : {{ ucwords($customer->kerabat->jenis_kelamin) }}</td>
                </tr>
                <tr>
                    <th>22. Hubungan</th>
                    <td>:</td>
                    <td>{{ $customer->kerabat->hubungan }}</td>
                </tr>
                <tr>
                    <th>23. Alamat Tinggal</th>
                    <td>:</td>
                    <td>{{ $customer->kerabat->alamat }}</td>
                </tr>
                <tr>
                    <th><span style="margin-left: 25pxl">Kota</span></th>
                    <td>:</td>
                    <td>{{ $customer->kerabat->kota }}</td>
                </tr>
                <tr>
                    <th><span style="margin-left: 25px;">Nomor Telepon Rumah</span></th>
                    <td>:</td>
                    <td width="150">{{ $customer->kerabat->nomor_telepon }}</td>
                    <td><b>Nomor HP</b> : {{ $customer->kerabat->no_handphone }}</td>
                </tr>
            </table>
            <div class="data-pemohon bg-primary mt-2">
                <span class="text-bold text-white">B. DATA KEUANGAN CALON DEBITUR</span>
            </div>
            <table style="float: left; margin-right: 150px;">
                <tr>
                    <th width="200">
                        <span style="margin-left: 25px;">Penghasilan Perbulan</span>
                    </th>
                    <td>:</td>
                    <td>@currency($customer->calon_debitur->penghasilan)</td>
                </tr>
                <tr>
                    <th>
                        <span style="margin-left: 25px;">
                            Biaya - Biaya
                        </span>
                    </th>
                    <td>:</td>
                    <td>@currency($customer->calon_debitur->biaya_biaya)</td>
                </tr>
                <tr>
                    <th>
                        <span style="margin-left: 25px;">Keuntungan</span>
                    </th>
                    <td>:</td>
                    <td>@currency($customer->calon_debitur->keuntungan)</td>
                </tr>
                <tr>
                    <th>
                        <span style="margin-left: 25px;">
                            Penghasilan Lainnya
                        </span>
                    </th>
                    <td>:</td>
                    <td>@currency($customer->calon_debitur->penghasilan_lainnya)</td>
                </tr>
            </table>
            <table style="float: left;">
                <tr>
                    <th width="200">
                        <span style="margin-left: 25px;">Total Pinjaman Lain</span>
                    </th>
                    <td>:</td>
                    <td>@currency($customer->calon_debitur->total_pinjaman_lain)</td>
                </tr>
                <tr>
                    <th>
                        <span style="margin-left: 25px;">
                            Sisa Waktu Angsuran
                        </span>
                    </th>
                    <td>:</td>
                    <td>{{ $customer->calon_debitur->sisa_waktu_angsuran . ' Bulan' }}</td>
                </tr>
                <tr>
                    <th>
                        <span style="margin-left: 25px;">Angsuran Pinjaman Lain</span>
                    </th>
                    <td>:</td>
                    <td>@currency($customer->calon_debitur->angsuran_pinjaman_lain)</td>
                </tr>
                <tr>
                    <th>
                        <span style="margin-left: 25px;">
                            Total Penghasilan
                        </span>
                    </th>
                    <td>:</td>
                    <td>@currency($customer->calon_debitur->total_penghasilan)</td>
                </tr>
            </table>
            <div style="clear: both;" class="p-2 data-pemohon bg-primary mt-2">
                <span class="text-bold text-primary">B. DATA KEUANGAN CALON DEBITUR</span>
            </div>
            <p>Apabila permohonan kredit disetujui, maka dengan ini saya/kami memberikan persetujuan kepada Bank untuk
                dipilih dengan memberi
                <span style="font-family: DejaVu Sans, sans-serif;">✔</span>
            </p>
            <p>Saya / kami dengan ini menyatakan bahwa:</p>
            <ol type="1">
                <li>Semua informasi diatas lengkap dan benar</li>
                <li>Memberikan persetujuan kepada PT Bank Mandiri (Persero) Tbk untuk mendapatkan dan meneliti seluruh
                    informasi lebih jauh dari sumber layak manapun dan akan memberikan informasi terbaru apabila
                    terdapat perubahan data dalam aplikasi ini.</li>
                <li>Bersedia mentaati segala persyaratan dan ketentuan yang berlaku di PT Bank Mandiri Persero Tbk.</li>
            </ol>
            <p>Mengacu kepada ketentuan Bank Indonesia tentang transparansi informasi Suku Bunga Dasar Kredit Bank
                Mandiri menginformasikan bahwa Suku Bunga Dasar Kredit (SBDK) kredit Mikro telah dipublikasikan melalui
                sarana papan pengumuman cabang, website www.bankmandiri.co.id dan surat kabar</p>
            <p>Sehubungan dengan Transparansi informasi Produk Bank dan Penggunaan Data Nasabah dengan ini saya / kami
                menyatakan bahwa:</p>
            <ol type="1">
                <li>Bank telah memberikan penjelasan yang cukup mengenai karakteristik Produk Bank yang akan saya / kami
                    telah mengerti dan memahani segala konsekuensi pemanfaatan Produk Bank, termasuk manfaat, risiko,
                    dan biaya - biaya yang melekat pada Produk Bank tersebut</li>
                <li>Memberikan persetujuan kepada Bank untuk memberikan dan atau menyebarluaskan data pribadi saya
                    kepada pihak lain di luar badan hukum Bank untuk tujuan komersial.
                    <ul type="none">
                        <table>
                            <tr>
                                <td width="20">Ya</td>
                                <td width="30">
                                    <div
                                        style="margin-top: 5px; display: inline-block; width: 30px; height: 20px; border: 1 solid black;">
                                    </div>
                                </td>
                                <td width="20">Tidak</td>
                                <td>
                                    <div
                                        style="margin-top: 5px; display: inline-block; width: 30px; height: 20px; border: 1 solid black;">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </ul>
                </li>
                <li>
                    Telah memahami penjelasan Bank mengenai tujuan dan konsekuensi dari pemberitaan dan atau
                    penyebarluasan data pribadi saya kepada pihak di luar badan hukum Bank di atas
                    <ul type="none">
                        <table>
                            <tr>
                                <td width="20">Ya</td>
                                <td width="30">
                                    <div
                                        style="margin-top: 5px; display: inline-block; width: 30px; height: 20px; border: 1 solid black;">
                                    </div>
                                </td>
                                <td width="20">Tidak</td>
                                <td>
                                    <div
                                        style="margin-top: 5px; display: inline-block; width: 30px; height: 20px; border: 1 solid black;">
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table style="margin-left: -80px; margin-top: 40px; float: left; margin-right: 150px;">
                            <tr>
                                <td width="400" colspan="3">
                                    <div class="text-right"
                                        style="margin-top: 20px; width: 100%; border-bottom: black solid 0.5px;">
                                        (Tangerang,{{ \Carbon\Carbon::parse($customer->created_at)->format('d/F/Y') }})
                                    </div>
                                    <span class="text-left">tandatangan</span>
                                </td>
                            </tr>
                            <tr>
                                <th height="50"></th>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td width="200" colspan="3">
                                    <div class="text-right"
                                        style="display: inline-block; margin-top: 20px; width: 40%; border-top: black solid 0.5px;">
                                        <span style="float: left;"
                                            class="text-left">{{ $user->fullname }}</span>
                                    </div>
                                    <div class="text-right"
                                        style="float: right; margin-top: 20px; width: 40%; border-top: black solid 0.5px;">
                                        <span style="clear: both;"
                                            class="text-right">{{ $customer->user_created->fullname }}</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table style="margin-top: 40px; float: left; margin-right: 50px;">
                            <tr>
                                <td width="400" colspan="3">
                                    <div class="text-right"
                                        style="margin-top: 20px; width: 100%; border-bottom: black solid 0.5px;">
                                        (Tangerang,{{ \Carbon\Carbon::parse($customer->created_at)->format('d/F/Y') }})
                                    </div>
                                    <span class="text-left">tandatangan</span>
                                </td>
                            </tr>
                            <tr>
                                <th height="50"></th>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td width="200" colspan="3">
                                    <div class="text-right"
                                        style="display: inline-block; margin-top: 20px; width: 40%; border-top: black solid 0.5px;">
                                        <span style="float: left;"
                                            class="text-left">{{ $customer->nama_lengkap }}</span>
                                    </div>
                                    <div class="text-left"
                                        style="float: right; margin-top: 20px; width: 40%; border-top: black solid 0.5px;">
                                        <span style="margin-top: 0px;"
                                            class="text-right">{{ $customer->suami_istri->nama_suami_istri }}</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </ul>
                </li>

            </ol>
        </div>
    </div>
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
