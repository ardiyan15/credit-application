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
    protected $menu = "Kredit";
    public function index()
    {
        $data = [
            'customers' => Nasabah::orderBy('id', 'DESC')->get()
        ];

        return view('credits.index')->with($data);
    }

    public function create()
    {
        return view('credits.create');
    }

    public function store(Request $request)
    {
        // mendapatkkan bunga per bulan
        if ($request->jenis_pinjaman === 'kur') {

            $bunga_per_bulan = floor(($request->limit_kredit / $request->jangka_waktu) + ($request->limit_kredit * 0.27 / 100));

            $biaya_provisi_admin = ($request->limit_kredit * 1.5) / 100;

            if ($request->limit_kredit >= 200000000 || $request->limit_kredit <= 350000000) {
                $biaya_provisi_admin = ($request->limit_kredit * 0.25) / 100;
            }

            $biaya_administrasi = 250000;

            if ($request->limit_kredit >= 25000000 || $request->limit_kredit <= 350000000) {
                $biaya_administrasi = 500000;
            }
        } else {
            if ($request->limit_kredit <= 50000000) {
                $bunga_per_bulan = floor(($request->limit_kredit / $request->jangka_waktu) + ($request->limit_kredit * 1.5 / 100));
            } else {
                $bunga_per_bulan = floor(($request->limit_kredit / $request->jangka_waktu) + ($request->limit_kredit * 0.99 / 100));
            }

            $biaya_provisi_admin = ($request->limit_kredit * 0.5) / 100;

            $biaya_administrasi = 50000;

            if ($request->limit_kredit >= 50000000) {
                $biaya_administrasi = 100000;
            }
        }


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
                'nama_pemilik_agunan' => $request->nama_pemilik_agunan,
                'nomor_sertifikat' => $request->nomor_sertifikat,
                'jenis_agunan' => $request->jenis_agunan,
                'jenis_pinjaman' => $request->jenis_pinjaman,
                'approval_lv_1' => 0,
                'pesan_approval_lv_1' => null,
                'approval_lv_2' => 0,
                'pesan_approval_lv_2' => null
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
                'no_ktp' => $request->no_ktp_suami_istri
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

            Calculation::create([
                'bunga_per_bulan' => $bunga_per_bulan,
                'biaya_provisi_admin' => $biaya_provisi_admin,
                'nasabah_id' => $nasabah->id,
                'biaya_administrasi' => $biaya_administrasi
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
        $jenis_pengajuan = [
            [
                'value' => 'Baru',
                'name' => 'Baru'
            ],
            [
                'value' => 'Top Up',
                'name' => 'Top Up'
            ],
            [
                'value' => 'Take Over',
                'name' => 'Take Ovew'
            ]
        ];

        $tujuan_penggunaan = [
            [
                'value' => 'modal kerja',
                'name' => 'Modal Kerja'
            ],
            [
                'value' => 'investasi',
                'name' => 'Investasi'
            ],
            [
                'value' => 'kum',
                'name' => 'KUM'
            ]
        ];

        $jenis_pinjaman = [
            [
                'value' => 'kur',
                'name' => 'KUR'
            ],
            [
                'value' => 'kum',
                'name' => 'KUM'
            ]
        ];

        $jenis_agunan = [
            [
                'value' => 'shgb',
                'name' => 'SHGB (Sertifikat Hak Guna Bangunan)'
            ],
            [
                'value' => 'shm',
                'name' => 'SHM (Sertifikat Hak Milik)'
            ],
            [
                'value' => 'bpkb motor',
                'name' => 'BPKB Motor'
            ],
            [
                'value' => 'bpkb mobil',
                'name' => 'BPKB Mobil'
            ],
            [
                'value' => 'ajb',
                'name' => 'AJB (Akta Jual Beli)'
            ]
        ];

        $educations = [
            [
                'value' => 'tidak tamat sd',
                'name' => 'Tidak Tamat SD'
            ],
            [
                'value' => 'sd',
                'name' => 'SD'
            ],
            [
                'value' => 'smp',
                'name' => 'SMP'
            ],
            [
                'value' => 'sma',
                'name' => 'SMA'
            ],
            [
                'value' => 'diploma',
                'name' => 'Diploma'
            ],
            [
                'value' => 'sarjana',
                'name' => 'Sarjana'
            ]
        ];

        $residences = [
            [
                'value' => 'milik sendiri',
                'name' => 'Milik Sendiri'
            ],
            [
                'value' => 'sewa / kontrak',
                'name' => 'Sewa / Kontrak'
            ],
            [
                'value' => 'milik keluarga / orang tua',
                'name' => 'Milik Keluarga / Orang Tua'
            ],
            [
                'value' => 'rumah dinas / provinsi',
                'name' => 'Rumah Dinas / Provinsi'
            ]
        ];

        $stays = [
            [
                'value' => '< 2 tahun',
                'name' => '< 2 Tahun'
            ],
            [
                'value' => '> 2 < 5 tahun',
                'name' => '> 2 < 5 Tahun'
            ],
            [
                'value' => '> 5 tahun',
                'name' => '> 5 Tahun'
            ]
        ];

        $marital_status = [
            [
                'value' => 'menikah',
                'name' => 'Menikah'
            ],
            [
                'value' => 'tidak menikah',
                'name' => 'Tidak Menikah'
            ],
            [
                'value' => 'janda / duda',
                'name' => 'Janda / Duda'
            ]
        ];

        $business_status = [
            [
                'value' => 'milik sendiri',
                'name' => 'Milik Sendiri'
            ],
            [
                'value' => 'sewa',
                'name' => 'Sewa'
            ],
            [
                'value' => 'keluarga',
                'name' => 'Keluarga'
            ]
        ];

        $customer = Nasabah::with('calculation', 'calon_debitur', 'kerabat', 'suami_istri', 'usaha')->findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'customer' => $customer,
            'jenis_pengajuan' => $jenis_pengajuan,
            'tujuan_penggunaan' => $tujuan_penggunaan,
            'jenis_pinjaman' => $jenis_pinjaman,
            'jenis_agunan' => $jenis_agunan,
            'educations' => $educations,
            'residences' => $residences,
            'stays' => $stays,
            'marital_status' => $marital_status,
            'business_status' => $business_status
        ];

        return view('credits.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        if ($request->jenis_pinjaman === 'kur') {

            $bunga_per_bulan = floor(($request->limit_kredit / $request->jangka_waktu) + ($request->limit_kredit * 0.27 / 100));

            $biaya_provisi_admin = ($request->limit_kredit * 1.5) / 100;

            if ($request->limit_kredit >= 200000000 || $request->limit_kredit <= 350000000) {
                $biaya_provisi_admin = ($request->limit_kredit * 0.25) / 100;
            }

            $biaya_administrasi = 250000;

            if ($request->limit_kredit >= 25000000 || $request->limit_kredit <= 350000000) {
                $biaya_administrasi = 500000;
            }
        } else {
            if ($request->limit_kredit <= 50000000) {
                $bunga_per_bulan = floor(($request->limit_kredit / $request->jangka_waktu) + ($request->limit_kredit * 1.5 / 100));
            } else {
                $bunga_per_bulan = floor(($request->limit_kredit / $request->jangka_waktu) + ($request->limit_kredit * 0.99 / 100));
            }

            $biaya_provisi_admin = ($request->limit_kredit * 0.5) / 100;

            $biaya_administrasi = 50000;

            if ($request->limit_kredit >= 50000000) {
                $biaya_administrasi = 100000;
            }
        }


        try {
            Nasabah::where('id', $id)->update([
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
                'nama_pemilik_agunan' => $request->nama_pemilik_agunan,
                'nomor_sertifikat' => $request->nomor_sertifikat,
                'jenis_agunan' => $request->jenis_agunan,
                'jenis_pinjaman' => $request->jenis_pinjaman
            ]);

            Suami_istri::where('nasabah_id', $id)->update([
                'nama_suami_istri' => $request->nama_suami_istri,
                'tempat_lahir' => $request->tempat_lahir_suami_istri,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_suami_istri,
                'pekerjaan' => $request->pekerjaan_suami_istri,
                'penghasilan' => $request->penghasilan_bulanan,
                'tanggal_lahir' => $request->tanggal_lahir_suami_istri,
                'no_ktp' => $request->no_ktp_suami_istri
            ]);

            Usaha::where('nasabah_id', $id)->update([
                'berusaha_sejak' => $request->berusaha_sejak,
                'bidang_usaha' => $request->bidang_usaha,
                'status_kepemilikan' => $request->status_kepemilikan,
                'jumlah_karyawan' => $request->jumlah_karyawan,
                'no_telepon' => $request->no_telepon_usaha,
                'ditempati_sejak' => $request->ditempati_usaha,
                'alamat_usaha' => $request->alamat_usaha
            ]);

            Kerabat::where('nasabah_id', $id)->update([
                'nama_lengkap' => $request->nama_kerabat,
                'jenis_kelamin' => $request->jenis_kelamin_kerabat,
                'hubungan' => $request->hubungan_kerabat,
                'alamat' => $request->alamat_kerabat,
                'kota' => $request->kota_kerabat,
                'nomor_telepon' => $request->nomor_telepon_rumah_kerabat,
                'no_handphone' => $request->no_hp_kerabat
            ]);

            Calon_Debitur::where('nasabah_id', $id)->update([
                'penghasilan' => $request->penghasilan_debitur,
                'biaya_biaya' => $request->biaya_debitur,
                'keuntungan' => $request->keuntungan,
                'penghasilan_lainnya' => $request->penghasilan_lainnya,
                'total_pinjaman_lain' => $request->total_pinjaman,
                'sisa_waktu_angsuran' => $request->siswa_waktu_angsuran,
                'angsuran_pinjaman_lain' => $request->angsuran_pinjaman_lain,
                'total_penghasilan' => $request->total_penghasilan
            ]);

            Calculation::where('nasabah_id', $id)->update([
                'bunga_per_bulan' => $bunga_per_bulan,
                'biaya_provisi_admin' => $biaya_provisi_admin,
                'biaya_administrasi' => $biaya_administrasi
            ]);

            DB::commit();
            return redirect('/credits')->with('success', 'Berhasil Update Data Nasabah');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal Update Data Nasabah');
        }
    }

    public function destroy($id)
    {
        $customer = Nasabah::findOrFail($id);
        $customer->delete();
        return back()->with('success', 'Berhasil Hapus Data');
    }
}
