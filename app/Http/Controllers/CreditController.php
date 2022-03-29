<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\Calon_Debitur;
use App\Models\Kerabat;
use App\Models\Nasabah;
use App\Models\Suami_istri;
use App\Models\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    public function index()
    {
        return view('credits.index');
    }

    public function create()
    {
        return view('credits.create');
    }

    public function store(Request $request)
    {
        // mendapatkkan bunga per bulan
        $bunga_per_bulan = floor(($request->limit_kredit / $request->jangka_waktu) + ($request->limit_kredit * 0.27 / 100));

        $biaya_provisi_admin = ($request->limit_kredit * 1.5) / 100;

        if ($request->limit_kredit >= 200000000 || $request->limit_kredit <= 350000000) {
            $biaya_provisi_admin = ($request->limit_kredit * 0.25) / 100;
        }

        $biaya_administrasi = 250000;

        if ($request->limit_kredit >= 25000000 || $request->limit_kredit <= 350000000) {
            $biaya_administrasi = 500000;
        }

        if ($request->jenis_agunan == 'bpkb motor' || $request->jenis_agunan == 'bpkb mobil' && $request->limit_kredit)

            DB::beginTransaction();
        try {
            Nasabah::create([
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'nama_ibu_kandung' => $request->ibu_kandung,
                'alamat' => $request->alamat_ktp,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'no_telepon' => $request->no_telepon,
                'kode_pos' => $request->kode_pos,
                'alamat_2' => $request->alamat_ktp_2,
                'kecamatan_2' => $request->kecamatan_2,
                'kota_2' => $request->kota_2,
                'kode_pos_2' => $request->kode_pos_2,
                'no_ktp' => $request->no_ktp,
                'no_npwp' => $request->no_npwp,
                'status_tempat_tinggal' => $request->status_tempat_tinggal,
                'lama_tinggal' => $request->lama_tinggal,
                'status_pernikahan' => $request->status_pernikahan,
                'jumlah_tanggungan' => $request->jumlah_tanggungan,
                'no_kartu_keluarga' => $request->no_kartu_keluarga,
                'jenis_pengajuan' => $request->jenis_pengajuan,
                'limit_kredit' => $request->limit_kredit,
                'jangka_waktu' => $request->jangka_waktu,
                'tujuan_penggunaan' => $request->tujuan_penggunaan,
                'deskripsi' => $request->deskripsi_penggunaan,
            ]);

            $nasabah = Nasabah::orderBy('id', 'DESC')->first();

            Suami_istri::create([
                'nama_suami_istri' => $request->nama_suami_istri,
                'tempat_lahir' => $request->tempat_lahir_suami_istri,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_suami_istri,
                'pekerjaan' => $request->pekerjaan_suami_istri,
                'penghasilan' => $request->penghasilan_bulanan,
                'tanggal_lahir' => $request->tanggal_lahir_suami_istri,
                'nasabah_id' => $nasabah->id,
            ]);

            Usaha::create([
                'berusaha_sejak' => $request->berusaha_sejak,
                'bidang_usaha' => $request->bidang_usaha,
                'status_kepemilikan' => $request->status_kepemilikan,
                'jumlah_karyawan' => $request->jumlah_karyawan,
                'no_telepon' => $request->no_telepon_usaha,
                'ditempati_sejak' => $request->ditempati_usaha,
                'alamat_usaha' => $request->alamat_usaha,
                'nasabah_id' => $nasabah->id
            ]);

            Kerabat::create([
                'nama_lengkap' => $request->nama_kerabat,
                'jenis_kelamin' => $request->jenis_kelamin_kerabat,
                'hubungan' => $request->hubungan_kerabat,
                'alamat' => $request->alamat_kerabat,
                'kota' => $request->kota_kerabat,
                'nomor_telepon' => $request->nomor_telepon_rumah_kerabat,
                'no_handphone' => $request->no_hp_kerabat,
                'nasabah_id' => $nasabah->id
            ]);

            Calon_Debitur::create([
                'penghasilan' => $request->penghasilan_debitur,
                'biaya_biaya' => $request->biaya_debitur,
                'keuntungan' => $request->keuntungan,
                'penghasilan_lainnya' => $request->penghasilan_lainnya,
                'total_pinjaman_lain' => $request->total_pinjaman,
                'sisa_waktu_angsuran' => $request->siswa_waktu_angsuran,
                'angsuran_pinjaman_lain' => $request->angsuran_pinjaman_lain,
                'total_penghasilan' => $request->total_penghasilan,
                'nasabah_id' => $nasabah->id
            ]);

            Calculation::ccreate([
                'bunga_per_bulan' => $bunga_per_bulan,
                'biaya_provisi_admin' => $biaya_provisi_admin,
                'jenis_agunan' => $request->jenis_agunan,
                ''
            ]);

            DB::commit();
            return redirect('credits')->with('success', 'Beerhasil tambah adata');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal tambah data');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
