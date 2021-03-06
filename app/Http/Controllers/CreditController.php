<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\Calon_Debitur;
use App\Models\Dokumen;
use App\Models\Kerabat;
use App\Models\Nasabah;
use App\Models\Suami_istri;
use App\Models\SukuBunga;
use App\Models\Usaha;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class CreditController extends Controller
{
    protected $menu = "master";
    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'customers' => Nasabah::with(['user_created' => function ($user_created) {
                $user_created->with('employee');
            }])->orderBy('id', 'DESC')->get(),
            'sub_menu' => 'credit'
        ];

        return view('credits.index')->with($data);
    }

    public function create()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'credit'
        ];
        return view('credits.create')->with($data);
    }

    public function store(Request $request)
    {
        // mendapatkkan cicilan per bulan
        $items = SukuBunga::all();

        $limit_kredit = str_replace('.', '', $request->limit_kredit);
        $penghasilan_debitur = str_replace('.', '', $request->penghasilan_debitur);
        $total_pinjaman = str_replace('.', '', $request->total_pinjaman);
        $biaya_debitur = str_replace('.', '', $request->biaya_debitur);
        $keuntungan = str_replace('.', '', $request->keuntungan);
        $angsuran_pinjaman_lain = str_replace('.', '', $request->angsuran_pinjaman_lain);
        $penghasilan_lainnya = str_replace('.', '', $request->penghasilan_lainnya);
        $total_penghasilan = str_replace('.', '', $request->total_penghasilan);
        $penghasilan_bulanan = str_replace('.', '', $request->penghasilan_bulanan);

        foreach ($items as $item) {
            if ($item->tipe === $request->jenis_pinjaman && $limit_kredit >= $item->kredit_terkecil && $limit_kredit < $item->kredit_terbesar) {
                $bunga_per_bulan = floor(($limit_kredit / $request->jangka_waktu) + ($limit_kredit * $item->per_bulan / 100));
                $bunga_per_tahun = $item->per_tahun;
            }
        }

        if ($request->jenis_pinjaman === 'kur') {

            $biaya_provisi_admin = ($limit_kredit * 1.5) / 100;

            if ($limit_kredit >= 200000000 && $limit_kredit <= 350000000) {
                $biaya_provisi_admin = ($limit_kredit * 0.25) / 100;
            }

            $biaya_administrasi = 250000;

            if ($limit_kredit >= 25000000 && $limit_kredit <= 350000000) {
                $biaya_administrasi = 500000;
            }
        } else {
            $biaya_provisi_admin = ($limit_kredit * 0.5) / 100;

            $biaya_administrasi = 50000;

            if ($limit_kredit >= 50000000) {
                $biaya_administrasi = 100000;
            }
        }

        // Generate continous number
        $nasabah = Nasabah::orderBy('id', 'DESC')->first();

        $nomor_urut = '0001';

        if ($nasabah !== null) {
            $nomor_urut = $nasabah->nomor_urut;
            (int)$last_number = substr($nomor_urut, 3);
            $result = $last_number + 1;
            $nomor_urut = sprintf('%04d', $result);
        }

        DB::beginTransaction();
        try {
            Nasabah::create([
                'jenis_kelamin' => $request->jenis_kelamin_nasabah,
                'no_rekening' => $request->nomor_rekening,
                'nomor_urut' => $nomor_urut,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'nama_ibu_kandung' => $request->ibu_kandung,
                'alamat' => $request->alamat_ktp,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'no_telepon' => $request->no_telepon,
                'kode_pos' => $request->kode_pos,
                'alamat_2' => $request->alamat_ktp_2,
                'kelurahan_2' => $request->kelurahan_2,
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
                'limit_kredit' => $limit_kredit,
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
                'pesan_approval_lv_2' => null,
                'created_by' => Auth::user()->id
            ]);

            $nasabah = Nasabah::orderBy('id', 'DESC')->first();

            Suami_istri::create([
                'nama_suami_istri' => $request->nama_suami_istri,
                'tempat_lahir' => $request->tempat_lahir_suami_istri,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_suami_istri,
                'pekerjaan' => $request->pekerjaan_suami_istri,
                'penghasilan' => $penghasilan_bulanan,
                'tanggal_lahir' => $request->tanggal_lahir_suami_istri,
                'nasabah_id' => $nasabah->id,
                'no_ktp' => $request->no_ktp_suami_istri,
                'tanggal_nikah' => $request->tanggal_nikah,
                'status' => $request->status
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
                'penghasilan' => $penghasilan_debitur,
                'biaya_biaya' => $biaya_debitur,
                'keuntungan' => $keuntungan,
                'penghasilan_lainnya' => $penghasilan_lainnya,
                'total_pinjaman_lain' => $total_pinjaman,
                'sisa_waktu_angsuran' => $request->sisa_waktu_angsuran,
                'angsuran_pinjaman_lain' => $angsuran_pinjaman_lain,
                'total_penghasilan' => $total_penghasilan,
                'nasabah_id' => $nasabah->id
            ]);

            $ext_ktp = $request->foto_ktp->getClientOriginalExtension();
            $ext_kk = $request->foto_kk->getClientOriginalExtension();
            $ext_usaha = $request->foto_usaha->getClientOriginalExtension();
            $ext_nasabah = $request->foto_nasabah->getClientOriginalExtension();

            $nikah = '';

            if ($request->foto_nikah != null) {
                $ext_nikah = $request->foto_nikah->getClientOriginalExtension();
                $nikah = time() . "." . $ext_nikah;
                $request->foto_nikah->storeAs('public/nikah', $nikah);
            }

            $ktp = time() . "." . $ext_ktp;
            $kk = time() . "." . $ext_kk;
            $usaha = time() . "." . $ext_usaha;
            $foto_nasabah = time() . "." . $ext_nasabah;

            Dokumen::create([
                'foto_ktp' => $ktp,
                'foto_kk' => $kk,
                'foto_usaha' => $usaha,
                'foto_buku_nikah' => $nikah,
                'foto_nasabah' => $foto_nasabah,
                'nasabah_id' => $nasabah->id
            ]);

            Calculation::create([
                'bunga_per_bulan' => $bunga_per_bulan,
                'biaya_provisi_admin' => $biaya_provisi_admin,
                'nasabah_id' => $nasabah->id,
                'biaya_administrasi' => $biaya_administrasi,
                'bunga_per_tahun' => $bunga_per_tahun
            ]);

            $request->foto_ktp->storeAs('public/ktp', $ktp);
            $request->foto_kk->storeAs('public/kk', $kk);
            $request->foto_usaha->storeAs('public/usaha', $usaha);

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
        $nasabah = Nasabah::with('suami_istri', 'usaha', 'kerabat')->findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'credit',
            'customer' => $nasabah
        ];

        return view('credits.detail')->with($data);
    }

    public function edit($id)
    {
        $jenis_pengajuan = [
            [
                'value' => 'Baru',
                'name' => 'Baru'
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

        $status_suami_istri = [
            [
                'value' => 'suami',
                'name' => 'Suami'
            ],
            [
                'value' => 'istri',
                'name' => 'Istri'
            ]
        ];

        $customer = Nasabah::with('calculation', 'calon_debitur', 'kerabat', 'suami_istri', 'usaha')->findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'credit',
            'customer' => $customer,
            'jenis_pengajuan' => $jenis_pengajuan,
            'tujuan_penggunaan' => $tujuan_penggunaan,
            'jenis_pinjaman' => $jenis_pinjaman,
            'jenis_agunan' => $jenis_agunan,
            'educations' => $educations,
            'residences' => $residences,
            'stays' => $stays,
            'marital_status' => $marital_status,
            'business_status' => $business_status,
            'status_suami_istri' => $status_suami_istri
        ];

        return view('credits.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $limit_kredit = str_replace('.', '', $request->limit_kredit);
        $penghasilan_debitur = str_replace('.', '', $request->penghasilan_debitur);
        $total_pinjaman = str_replace('.', '', $request->total_pinjaman);
        $biaya_debitur = str_replace('.', '', $request->biaya_debitur);
        $keuntungan = str_replace('.', '', $request->keuntungan);
        $angsuran_pinjaman_lain = str_replace('.', '', $request->angsuran_pinjaman_lain);
        $penghasilan_lainnya = str_replace('.', '', $request->penghasilan_lainnya);
        $total_penghasilan = str_replace('.', '', $request->total_penghasilan);
        $penghasilan_bulanan = str_replace('.', '', $request->penghasilan_bulanan);

        DB::beginTransaction();
        $items = SukuBunga::all();

        foreach ($items as $item) {
            if ($item->tipe === $request->jenis_pinjaman && $limit_kredit >= $item->kredit_terkecil && $limit_kredit < $item->kredit_terbesar) {
                $bunga_per_bulan = floor(($limit_kredit / $request->jangka_waktu) + ($limit_kredit * $item->per_bulan / 100));
            }
        }

        if ($request->jenis_pinjaman === 'kur') {

            $biaya_provisi_admin = ($limit_kredit * 1.5) / 100;

            if ($limit_kredit >= 200000000 || $limit_kredit <= 350000000) {
                $biaya_provisi_admin = ($limit_kredit * 0.25) / 100;
            }

            $biaya_administrasi = 250000;

            if ($limit_kredit >= 25000000 || $limit_kredit <= 350000000) {
                $biaya_administrasi = 500000;
            }
        } else {
            $biaya_provisi_admin = ($limit_kredit * 0.5) / 100;

            $biaya_administrasi = 50000;

            if ($limit_kredit >= 50000000) {
                $biaya_administrasi = 100000;
            }
        }


        try {
            Nasabah::where('id', $id)->update([
                'no_rekening' => $request->nomor_rekening,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'nama_ibu_kandung' => $request->ibu_kandung,
                'alamat' => $request->alamat_ktp,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'no_telepon' => $request->no_telepon,
                'kode_pos' => $request->kode_pos,
                'alamat_2' => $request->alamat_ktp_2,
                'kelurahan_2' => $request->kelurahan_2,
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
                'limit_kredit' => $limit_kredit,
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
                'penghasilan' => $penghasilan_bulanan,
                'tanggal_lahir' => $request->tanggal_lahir_suami_istri,
                'no_ktp' => $request->no_ktp_suami_istri,
                'tanggal_nikah' => $request->tanggal_nikah,
                'status' => $request->status
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
                'penghasilan' => $penghasilan_debitur,
                'biaya_biaya' => $biaya_debitur,
                'keuntungan' => $keuntungan,
                'penghasilan_lainnya' => $penghasilan_lainnya,
                'total_pinjaman_lain' => $total_pinjaman,
                'sisa_waktu_angsuran' => $request->sisa_waktu_angsuran,
                'angsuran_pinjaman_lain' => $angsuran_pinjaman_lain,
                'total_penghasilan' => $total_penghasilan
            ]);

            Calculation::where('nasabah_id', $id)->update([
                'bunga_per_bulan' => $bunga_per_bulan,
                'biaya_provisi_admin' => $biaya_provisi_admin,
                'biaya_administrasi' => $biaya_administrasi
            ]);

            $dokumen = Dokumen::where('nasabah_id', $id)->first();

            if ($request->foto_nikah) {
                $ext_nikah = $request->foto_nikah->getClientOriginalExtension();
                $nikah = time() . "." . $ext_nikah;
                $request->foto_nikah->storeAs('public/nikah', $nikah);
                $dokumen->foto_buku_nikah = $nikah;
            }

            if ($request->foto_ktp) {
                $ext_ktp = $request->foto_ktp->getClientOriginalExtension();
                $ktp = time() . "." . $ext_ktp;
                $request->foto_ktp->storeAs('public/ktp', $ktp);
                $dokumen->foto_ktp = $ktp;
            }

            if ($request->foto_kk) {
                $ext_kk = $request->foto_kk->getClientOriginalExtension();
                $kk = time() . "." . $ext_kk;
                $request->foto_kk->storeAs('public/kk', $kk);
                $dokumen->foto_kk = $kk;
            }

            if ($request->foto_usaha) {
                $ext_usaha = $request->foto_usaha->getClientOriginalExtension();
                $usaha = time() . "." . $ext_usaha;
                $request->foto_usaha->storeAs('public/usaha', $usaha);
                $dokumen->foto_usaha = $usaha;
            }

            if ($request->foto_nasabah) {
                $ext_nasabah = $request->foto_nasabah->getClientOriginalExtension();
                $foto_nasabah = time() . "." . $ext_nasabah;
                $request->foto_nasabah->storeAs('public/nasabah', $foto_nasabah);
                $dokumen->foto_nasabah = $foto_nasabah;
            }

            $dokumen->save();

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

    public function print_credit_approved($id)
    {
        $customer = Nasabah::with('calculation', 'calon_debitur', 'kerabat', 'suami_istri', 'usaha')->findOrFail($id);
        $head = User::with('employee')->where('roles', 'kepala cabang')->first();
        $pdf = PDF::loadview('credits.credit_approved', ['customer' => $customer, 'head' => $head]);

        return $pdf->stream();
    }

    public function get_document(Request $request)
    {
        $document = Dokumen::where('nasabah_id', $request->id)->first();

        if ($document !== null) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $document
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'error',
                'data' => 'document not found'
            ]);
        }
    }

    public function get_nasabah($id)
    {
        $customer = Nasabah::with('calculation')->findOrFail($id);

        if ($customer !== null) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $customer
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'error',
                'data' => 'data not found'
            ]);
        }
    }

    public function print_credit($id)
    {
        $customer = Nasabah::with('suami_istri')->findOrFail($id);
        $user = User::with('employee')->where('roles', 'kepala cabang')->first();

        $pdf = PDF::loadview('credits.form_credit', ['customer' => $customer, 'user' => $user]);
        $pdf->setPaper([0, 0, 1000, 2000]);
        return $pdf->stream();
    }

    public function get_instalment()
    {
        $items = SukuBunga::all();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $items
        ]);
    }
}
