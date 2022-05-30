@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Pengajuan Kredit</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('credits.update', $customer->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <a href="{{ route('credits.print_credit', $customer->id) }}" target="_blank"
                                            class="btn btn-info btn-sm rounded mb-2">Print Form
                                            Kredit</a>
                                        @if ($customer->approval_lv_1 == 1 && $customer->approval_lv_2 == 1 && Auth::user()->roles == 'kepala cabang')
                                            <a target="_blank" href="{{ route('credits.print', $customer->id) }}"
                                                class="btn btn-success btn-sm rounded mb-2">Print Perjanjian Kredit</a>
                                        @endif
                                        <a href="{{ route('credits.index') }}"
                                            class="btn btn-sm btn-secondary rounded mb-2">Kembali</a>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Cabang / Unit Mikro</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>Jenis Pengajuan</label>
                                                <input type="text" value="{{ $customer->jenis_pengajuan }}"
                                                    class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Limit Kredit Dimohon</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" id="limit_kredit" class="rupiah form-control"
                                                    placeholder="Limit Kredit" name="limit_kredit" value="@currency($customer->limit_kredit)"
                                                    readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">Jangka Waktu (bulan)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input name="jangka_waktu" required type="number" class="form-control"
                                                    placeholder="jangka waktu (bulan)"
                                                    value="{{ $customer->jangka_waktu }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Tujuan Penggunaan</label>
                                                <input type="text" class="form-control"
                                                    value="{{ ucwords($customer->tujuan_penggunaan) }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Jelaskan Tujuan Penggunaan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="deskripsi_penggunaan"
                                                    placeholder="Jelaskan Tujuan Penggunaan" class="form-control"
                                                    value="{{ $customer->deskripsi }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Jenis Pinjaman</label>
                                                <input type="text" class="form-control"
                                                    value="{{ strtoupper($customer->jenis_pinjaman) }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Jenis Agunan</label>
                                                <input type="text" class="form-control"
                                                    value="{{ strtoupper($customer->jenis_agunan) }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Nama Pemilik Agunan</label>
                                                <input type="text" class="form-control" name="nama_pemilik_agunan"
                                                    placeholder="Nama Pemilik Agunan"
                                                    value="{{ $customer->nama_pemilik_agunan }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Nomor Sertifikat Agunan</label>
                                                <input type="text" class="form-control" name="nomor_sertifikat"
                                                    placeholder="Nomor Sertifikat"
                                                    value="{{ $customer->nomor_sertifikat }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Nomor Rekening</label>
                                                <input type="text" class="form-control" name="nomor_rekening"
                                                    placeholder="Nomor Rekening" value="{{ $customer->no_rekening }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Nasabah</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Lengkap</label>
                                                <input required type="text" class="form-control" name="nama_lengkap"
                                                    placeholder="Nama Lengkap" value="{{ $customer->nama_lengkap }}"
                                                    readonly>
                                                <small>
                                                    <a href="" class="document" data-id="{{ $customer->id }}"
                                                        data-type="document_nasabah" onclick="return false"
                                                        data-toggle="modal" data-target="#document">Lihat Dokumen</a>
                                                </small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tempat Lahir</label>
                                                <input required type="text" class="form-control" name="tempat_lahir"
                                                    placeholder="Tempat Lahir" value="{{ $customer->tempat_lahir }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tanggal Lahir</label>
                                                <input type="date" class="form-control" name="tanggal_lahir"
                                                    placeholder="Tanggal Lahir" value={{ $customer->tanggal_lahir }}
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Ibu Kandung</label>
                                                <input required type="text" class="form-control" name="ibu_kandung"
                                                    placeholder="Nama Ibu Kandung"
                                                    value="{{ $customer->nama_ibu_kandung }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pendidikan Terakhir</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{ ucwords($customer->pendidikan_terakhir) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat (Sesuai KTP)</label>
                                                <textarea required name="alamat_ktp" placeholder="Alamat Sesuai KTP" class="form-control" id="" cols="5" rows="3"
                                                    readonly>{{ $customer->alamat }}</textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kelurahan</label>
                                                <input required type="text" name="kelurahan" placeholder="Kelurahan"
                                                    class="form-control" value="{{ $customer->kelurahan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kecamatan</label>
                                                <input required type="text" name="kecamatan" placeholder="Kecamatan"
                                                    class="form-control" value="{{ $customer->kecamatan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kota</label>
                                                <input required type="text" name="kota" placeholder="Kota"
                                                    class="form-control" value="{{ $customer->kota }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Provinsi</label>
                                                <input required type="text" name="provinsi" placeholder="Provinsi"
                                                    class="form-control" value="{{ $customer->provinsi }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kode Pos</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="kode_pos" placeholder="Kode Pos"
                                                    class="form-control" value="{{ $customer->kode_pos }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No telepon yang dapat dihubungi</label>
                                                <input required type="text" name="no_telepon"
                                                    placeholder="No telepon yang bisa dihubungi" class="form-control"
                                                    value="{{ $customer->no_telepon }}" readonly>
                                            </div>
                                            <div class="col-md-12">
                                                <hr class="border border-primary">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat Saat ini (bila berbeda)</label>
                                                <textarea name="alamat_ktp_2" placeholder="Alamat Sesuai KTP" class="form-control" id="" cols="5" rows="3"
                                                    readonly>{{ $customer->alamat_2 }}</textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kelurahan</label>
                                                <input type="text" name="kelurahan_2" placeholder="Kelurahan"
                                                    class="form-control" value="{{ $customer->kelurahan_2 }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kecamatan</label>
                                                <input type="text" name="kecamatan_2" placeholder="Kecamatan"
                                                    class="form-control" value="{{ $customer->kecamatan_2 }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kota</label>
                                                <input type="text" name="kota_2" placeholder="Kota" class="form-control"
                                                    value="{{ $customer->kota_2 }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Provinsi</label>
                                                <input type="text" name="provinsi_2" placeholder="Provinsi"
                                                    class="form-control" value="{{ $customer->provinsi_2 }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kode Pos</label>
                                                <input type="text" name="kode_pos_2" placeholder="Kode Pos"
                                                    class="form-control" value="{{ $customer->kode_pos_2 }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No telepon yang dapat dihubungi</label>
                                                <input type="text" name="no_telepon_2"
                                                    placeholder="No telepon yang bisa dihubungi" class="form-control"
                                                    value="{{ $customer->no_telepon_2 }}" readonly>
                                            </div>
                                            <div class="col-md-12">
                                                <hr class="border border-primary">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No KTP</label> <small class="text-danger text-bold">*</small>
                                                <input required type="text" name="no_ktp" placeholder="No KTP"
                                                    class="form-control" value="{{ $customer->no_ktp }}" readonly>
                                                <small>
                                                    <a href="" class="document" data-id="{{ $customer->id }}"
                                                        data-type="document_ktp" onclick="return false" data-toggle="modal"
                                                        data-target="#document">Lihat Dokumen</a>
                                                </small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No NPWP</label> <small class="text-danger text-bold">*</small>
                                                <input required type="text" name="no_npwp" placeholder="No NPWP"
                                                    class="form-control" value="{{ $customer->no_npwp }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status Tempat Tinggal</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input type="text" class="form-control"
                                                    value="{{ $customer->status_tempat_tinggal }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Lama Tinggal</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input type="text" readonly class="form-control"
                                                    value="{{ $customer->lama_tinggal }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status</label>
                                                <input type="text" readonly class="form-control"
                                                    value="{{ $customer->status_pernikahan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Jumlah Tanggungan (perorang)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="jumlah_tanggungan"
                                                    placeholder="Jumlah Tanggungan (perorang)" class="form-control"
                                                    value="{{ $customer->jumlah_tanggungan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No Kartu Keluarga</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="no_kartu_keluarga"
                                                    class="form-control" placeholder="No Kartu Keluarga"
                                                    value="{{ $customer->no_kartu_keluarga }}" readonly>
                                                <small>
                                                    <a href="" class="document" data-id="{{ $customer->id }}"
                                                        data-type="keluarga_dokumen" onclick="return false"
                                                        data-toggle="modal" data-target="#document">Lihat Dokumen</a>
                                                </small>
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Suami / Istri</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Suami / Istri</label>
                                                <input type="text" name="nama_suami_istri" class="form-control"
                                                    placeholder="Nama Suami / Istri"
                                                    value="{{ $customer->suami_istri->nama_suami_istri }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status</label>
                                                <input type="text" value="{{ $customer->suami_istri->status }}"
                                                    class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tanggal Nikah</label>
                                                <input type="date" name="tanggal_nikah" class="form-control"
                                                    value="{{ $customer->suami_istri->tanggal_nikah }}" readonly>
                                                <small>
                                                    <a href="" class="document" data-id="{{ $customer->id }}"
                                                        data-type="document_marriage" onclick="return false"
                                                        data-toggle="modal" data-target="#document">Lihat Dokumen</a>
                                                </small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir_suami_istri" class="form-control"
                                                    placeholder="Tempat Lahir"
                                                    value="{{ $customer->suami_istri->tempat_lahir }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir_suami_istri"
                                                    placeholder="Tanggal Lahir Suami / istri" class="form-control"
                                                    value="{{ $customer->tanggal_lahir }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pendidikan Terakhir</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $customer->suami_istri->pendidikan_terakhir }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pekerjaan Suami / Istri</label>
                                                <input type="text" class="form-control" name="pekerjaan_suami_istri"
                                                    placeholder="Pekerjaan Suami / Istri"
                                                    value="{{ $customer->suami_istri->pekerjaan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No KTP</label>
                                                <input type="text" name="no_ktp_suami_istri"
                                                    placeholder="No KTP Suami / Istri" class="form-control"
                                                    value="{{ $customer->suami_istri->no_ktp }}" readonly />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Penghasilan Bulanan</label>
                                                <input type="text" name="penghasilan_bulanan"
                                                    placeholder="Penghasilan Bulanan" class="rupiah form-control"
                                                    value="{{ $customer->suami_istri->penghasilan }}" readonly>
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Usaha</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Berusaha Sejak</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="date" name="berusaha_sejak" class="form-control"
                                                    placeholder="Berusaha Sejak"
                                                    value="{{ $customer->usaha->berusaha_sejak }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Bidang Usaha</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="bidang_usaha" placeholder="Bidang Usaha"
                                                    class="form-control" value="{{ $customer->usaha->bidang_usaha }}"
                                                    readonly>
                                                <small>
                                                    <a href="" class="document" data-id="{{ $customer->id }}"
                                                        data-type="usaha_dokumen" onclick="return false" data-toggle="modal"
                                                        data-target="#document">Lihat Dokumen</a>
                                                </small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat Usaha</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <textarea required name="alamat_usaha" placeholder="Alamat usaha" class="form-control" id="" cols="5" rows="3"
                                                    readonly>{{ $customer->usaha->alamat_usaha }}</textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Jumlah Karyawan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="jumlah_karyawan" class="form-control"
                                                    placeholder="Jumlah Karyawan"
                                                    value="{{ $customer->usaha->jumlah_karyawan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status Kepemilikan Tempat Usaha</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input type="text" class="form-control"
                                                    value="{{ $customer->usaha->status_kepemilikan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No Telepon yang dapat dihubungi</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="numbr" class="form-control" name="no_telepon_usaha"
                                                    placeholder="No Telepon yang dapat dihubungi"
                                                    value="{{ $customer->usaha->no_telepon }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Ditempati Sejak</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="date" name="ditempati_usaha" class="form-control"
                                                    placeholder="Ditempati Sejak"
                                                    value="{{ $customer->usaha->ditempati_sejak }}" readonly>
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Kerabat Dekat Yang Tidak Serumah</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Lengkap</label>
                                                <input required type="text" name="nama_kerabat" placeholder="Nama Lengkap"
                                                    class="form-control"
                                                    value="{{ $customer->kerabat->nama_lengkap }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Jenis Kelamin</label>
                                                <input type="text" class="form-control"
                                                    value="{{ ucwords($customer->kerabat->jenis_kelamin) }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Hubungan Kerabat</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="hubungan_kerabat" class="form-control"
                                                    placeholder="Hubungan Kerabat"
                                                    value="{{ $customer->kerabat->hubungan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat Tinggal</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <textarea required name="alamat_kerabat" id="" cols="30" rows="3" class="form-control" placeholder="Alamat Tinggal"
                                                    readonly>{{ $customer->kerabat->alamat }}</textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kota</label>
                                                <input required type="text" name="kota_kerabat" placeholder="Kota"
                                                    class="form-control" value="{{ $customer->kerabat->kota }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No Telepon Rumah</label>
                                                <input type="number" name="no_telepon_rumah_kerabat"
                                                    placeholder="No Telepon Rumah" class="form-control"
                                                    value="{{ $customer->kerabat->kota }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Nomor HP</label>
                                                <input required type="number" name="no_hp_kerabat" placeholder="Nomor HP"
                                                    class="form-control"
                                                    value="{{ $customer->kerabat->no_handphone }}" readonly>
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Keuangan Calon Debitur</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Penghasilan Perbulan</label>
                                                <input required type="number" name="penghasilan_debitur"
                                                    class="form-control" placeholder="Penghasilan Debitur"
                                                    value="{{ $customer->calon_debitur->penghasilan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Total Pinjaman</label>
                                                <input required type="text" name="total_pinjaman"
                                                    placeholder="Total Pinjaman" class="form-control"
                                                    value="{{ $customer->calon_debitur->total_pinjaman_lain }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Biaya - Biaya</label>
                                                <input required type="number" name="biaya_debitur"
                                                    placeholder="Biaya - Biaya" class="form-control"
                                                    value="{{ $customer->calon_debitur->biaya_biaya }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Sisa Waktu Angsuran (Bulan)</label>
                                                <input required type="number" name="siswa_waktu_angsuran"
                                                    placeholder="Siswa Waktu Angsuran (Bulan)" class="form-control"
                                                    value="{{ $customer->calon_debitur->sisa_waktu_angsuran }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Keuntungan</label>
                                                <input required type="number" name="keuntungan" placeholder="Keuntungan"
                                                    class="form-control"
                                                    value="{{ $customer->calon_debitur->keuntungan }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Angsuran Pinjaman Lain (perbulan)</label>
                                                <input required type="number" name="angsuran_pinjaman_lain"
                                                    placeholder="Angsuran Pinjaman Lain (perbulan)" class="form-control"
                                                    value="{{ $customer->calon_debitur->angsuran_pinjaman_lain }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Penghasilan Lainnya</label>
                                                <input required type="number" name="penghasilan_lainnya"
                                                    placeholder="Penghasilan Lainnya" class="form-control"
                                                    value="{{ $customer->calon_debitur->penghasilan_lainnya }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Total Penghasilan (perbulan)</label>
                                                <input required type="number" name="total_penghasilan"
                                                    class="form-control" placeholder="Total Penghasilan (perbulan)"
                                                    value="{{ $customer->calon_debitur->total_penghasilan }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="document" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="img-content">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let jenisAgunan = '';
        let limitKredit

        $("#jenis_agunan").on('change', function() {
            jenisAgunan = $(this).val()
        })

        $("#submit").on('click', function(e) {
            limitKredit = $("#limit_kredit").val()
            if (jenisAgunan == 'bpkb motor' || jenisAgunan == 'bpkb mobil' && jenisAgunan > 50000000) {
                Swal.fire(
                    'Gagal',
                    'Jika agunan menggunakan BPKB Motor atau BPKB Mobil limit kredit tidak boleh lebih dari Rp. 50.000.000',
                    'error'
                )
                e.preventDefault()
            }
        })

        $(".document").on('click', function() {
            let type = $(this).data('type')
            let id = $(this).data('id')
            let source = ''

            $("#img-content").empty()

            $.ajax({
                type: 'POST',
                url: '{{ route('credits.get_document') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    // type: type,
                    id: id
                },
                success: ({
                    data
                }) => {
                    if (type == 'document_ktp') {
                        $("#img-content").append(
                            `<img class="text-center" src="{!! asset('/storage/ktp/${data.foto_ktp}') !!}" width="450" />`)
                    } else if (type == 'usaha_dokumen') {
                        $("#img-content").append(
                            `<img class="text-center" src="{!! asset('/storage/usaha/${data.foto_usaha}') !!}" width="450" />`)
                    } else if (type == 'keluarga_dokumen') {
                        $("#img-content").append(
                            `<img class="text-center" src="{!! asset('/storage/kk/${data.foto_kk}') !!}" width="450" />`)
                    } else if (type == 'document_marriage') {
                        $("#img-content").append(
                            `<img class="text-center" src="{!! asset('/storage/nikah/${data.foto_buku_nikah}') !!}" width="450" />`)
                    } else if (type == 'document_nasabah') {
                        $("#img-content").append(
                            `<img class="text-center" src="{!! asset('/storage/nikah/${data.foto_nasabah}') !!}" width="450" />`)
                    }
                },
                error: err => console.log(err)
            })
        })
    </script>
@endpush
