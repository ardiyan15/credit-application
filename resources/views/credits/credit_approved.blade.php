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
        #calculation {
            font-size: 12px;
        }

    </style>
</head>

<body>
    <h4 class="text-center">Perjanjian Kredit</h4>
    <h5 class="text-center">Nomor :
        R03.JRK/{{ $customer->nomor_urut }}/{{ strtoupper($customer->jenis_pinjaman) }}/{{ substr($customer->created_at, 0, 4) }}
    </h5>
    <p style="font-size: 13px;">Perjanjian kredit ini dibuat dan ditandatangani di DKI Jakarta pada hari Jumat, 29 Maret
        2019 oleh dan antara :
    </p>
    <ol type="I" style="font-size: 13px;">
        <li class="text-justify">
            PT Bank Mandiri (Persero) Tbk. b erkedudukan di Jakarta Selatan dan berkantor pusat di Jl. Jend. Gatot
            Subroto
            Kav. YULIANA MAHARANI selaku kepala Unit / Cabang MMU KCP MMU Jakarta Raya Kosambi 1, oleh karena itu
            sah
            bertindak untuk atas nama PT Bank Mandiri (Persero) Tbk. selanjutnya disebut "<b>Bank</b>"
        </li>
        <li class="text-justify">
            Tuan {{ strtoupper($customer->nama_lengkap) }}
            {{ \Carbon\Carbon::parse($customer->tanggal_lahir)->age }} tahun
            bertempat tinggal di
            {{ strtoupper($customer->alamat) }} pemegang KTP
            no. {{ $customer->no_ktp }} diterbitkan oleh Kelurahan {{ strtoupper($customer->kelurahan) }} Kecamatan
            {{ strtoupper($customer->kecamatan) }} Kabupaten/Kotamadya
            {{ $customer->kota }} dan untuk
            melakukan perbuatan hukum telah mendapatkan persetujuan dari {{ $customer->suami_istri->status }}
            @if ($customer->suami_istri->status == 'istri')
                Nyonya
            @else
                Tuan
            @endif
            {{ $customer->suami_istri->nama_suami_istri }} sesuai kutipan
            akta/surat nikah tanggal
            {{ \Carbon\Carbon::parse($customer->suami_istri->tanggal_nikah)->format('d F Y') }} Pemegang KTP No.
            {{ $customer->suami_istri->no_ktp }} yang turut
            hadir dan menandatangani akta ini
            unutk selanjutnya disebut "<b>Debitur</b>"
        </li>
    </ol>
    <p style="font-size: 13px;">Bank dan Debitur untuk selanjutnya secara bersama - sama disebut juga "<b>Para Pihak</b>
    </p>
    <p style="font-size: 13px;" class="text-justify">Para Pihak bertindak dalam kedudukan masing - masing seperti
        tersebut di atas terlebih
        dahulu menerangkan bahwa
        Para Pihak sepakat untuk mengatur pemberian Kredit tersebut dalam Perjanjian Kredit yang dibuat dengan ketentuan
        dan syarat sebagai berikut (Perjanjian Kredit ini berikut semua lampiran perubahan dan penambahannya dari waktu
        kewaktu selanjutnya disebut "Perjanjian Kredit") </p>

    <div class="text-center" style="font-size: 13px;">
        <span class="text-center"><b> Pasal 1 </b></span> <br>
        <span class="text-center"><b>Jumlah, Tujuan, Sifat, Jangka Waktu, dan Angsuran Kredit</b></span>
    </div> <br>

    <table id="calculation">
        <tr>
            <td width="20">1. </td>
            <td width="150">Jumlah Kredit</td>
            <td>:</td>
            <td>@currency($customer->limit_kredit) ({{ \Terbilang::make($customer->limit_kredit, ' rupiah') }})</td>
        </tr>
        <tr>
            <td>2. </td>
            <td>Tujuan Kredit</td>
            <td>:</td>
            <td>{{ $customer->tujuan_penggunaan }}</td>
        </tr>
        <tr>
            <td>3. </td>
            <td>Provisi</td>
            <td>:</td>
            <td>@currency($customer->calculation->biaya_provisi_admin)</td>
        </tr>
        <tr>
            <td>4. </td>
            <td>Bunga</td>
            <td>:</td>
            <td>{{ $customer->calculation->bunga_per_tahun . '% efektif' }}</td>
        </tr>
        <tr>
            <td>5. </td>
            <td>Administrasi</td>
            <td>:</td>
            <td>@currency($customer->calculation->biaya_administrasi)</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="4"> Biaya tersebut diatas ditanggung Debitur dan biaya - biaya yang telah dibayarkan/disetor
                tidak dapat
                ditarik kembali</td>
        </tr>
        <tr>
            <td>6. </td>
            <td>Jangka Waktu</td>
            <td>:</td>
            <td>{{ $customer->jangka_waktu }} Bulan terhitung mulai Pencairan Kredit. Berakhirnya jangka waktu
                Kredit tidak dengan
                sendirinya
                menyebabkan Kredit lunas</td>
        </tr>
        <tr>
            <td>7. </td>
            <td>Pembayaran Kredit</td>
            <td>:</td>
            <td>Pembayaran pokok berikut bunganya dengan cara angsuran tetap yaitu jumlah angsuran pokok berikut
                bunganya dalam 36 kali angsuran berturut - turut tiap - tiap kali sebesar
                @currency($customer->calculation->bunga_per_bulan) (
                {{ \Terbilang::make($customer->calculation->bunga_per_bulan, ' rupiah') }} ) sesuai dengan jadwal
                angsuran yang ditetapkan dalam lampiran yang merupakan satu
                kesatuan dengna Perjanjian Kredit ini</td>
        </tr>
        <tr>
            <td>9. </td>
            <td>Denda Keterlambatan</td>
            <td>:</td>
            <td>
                2% diatas suku bunga yang berlaku dan dihitung dari jumlah tunggakan
            </td>
        </tr>
    </table>
    <br>

    <div class="text-center" style="font-size: 13px;">
        <span class="text-center"><b>Pasal 2</b></span> <br>
        <span class="text-center"><b>Agunan</b></span>
    </div>
    <p style="font-size: 13px;">Untuk menjamin pembayaran kembali Kredit secara tertib sesuai dengan Perjanjian Kredit,
        dengan ini Debitur
        menyerahkan agunan berupa</p>
    <p style="font-size: 13px;">{{ strtoupper($customer->nama_lengkap) }} -
        {{ strtoupper($customer->jenis_agunan) }} dengan
        sertifikat
        No. {{ $customer->nomor_sertifikat }}</p>

    <br> <br>
    <div class="text-center" style="font-size: 13px;">
        <span class="text-center"><b> Pasal 3 </b></span><br>
        <span class="text-center"><b>Pencairan Kredit</b></span>
    </div>

    <div style="font-size: 13px;">
        <p>Pencairan Kredit dilakukan secara sekaligus dengan cara dipindahkan ke rekening tabungan atas nama Debitur
            nomor
            rekening {{ $customer->no_rekening }} setelah persyaratan yaitu:</p>
        <ol type="1">
            <li>Perjanjian Kredit telah ditandatangani.</li>
            <li>Telah dilakukan pengamanan/pengikatan agunan sesuai dengan persyaratan Bank.</li>
            <li>Telah dilakukan penutupan asuransi jiwa dengna syarat Banker's Clause PT. Bank Mandiri (Persero) Tbk.
                pada
                perusahaan asuransi yang menjadi rekanan Bank.</li>
            <li>Telah dilakukan penutupan asuransi kredit dan kerugian untuk agunan yang dapat diasuransikan dengan
                syarat
                Banker's Clause PT. Bank Mandiri (Persero) Tbk. pada perusahaan asuransi yang menjadi rekanan Bank,
                apabila
                dipersyaratkan Bank</li>
        </ol>

        <div class="text-justify">
            <span>Perjanjian Kredit ini merupakan satu kesatuan dan bagian yang tidak dapat dipisahkan dengan Ketentuan
                Kredit
                Usaha Mikro.</span>
            <span>Demikian Perjanjian Kredit ini ditandatangani oleh Para Pihak di atas materai rangkap 2 (dua)
                masing-masing
                memiliki kekuatan pembuktian yang sama.</span>
        </div>
    </div>


    <table class="mt-3" style="font-size: 13px;">
        <tr>
            <td width="180">
                Debitur
            </td>
            <td width="150">
                Menyetujui
            </td>
            <td>
                <b>PT. Bank Mandiri (Persero) TBK MBU - KCP MMU Jakarta Raya Kosambi</b>
            </td>
        </tr>
    </table>

    <table style="margin-top: 100px; font-size: 13px;">
        <tr>
            <td width="180">{{ strtoupper($customer->nama_lengkap) }}</td>
            <td width="150">
                {{ $customer->suami_istri->status . ' : ' . strtoupper($customer->suami_istri->nama_suami_istri) }}
            </td>
            <td>INDAH YULIANA</td>
        </tr>
    </table>

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
