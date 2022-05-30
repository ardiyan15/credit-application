@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Pengajuan Kredit</h1>
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
                                <form id="formCredit" action="{{ route('credits.update', $customer->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <h5 class="mb-4 bg-primary p-2 rounded">Cabang / Unit Mikro</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>Jenis Pengajuan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="jenis_pengajuan" id="" class="form-control">
                                                    <option value="">-- Pilih Pengajuan --</option>
                                                    @foreach ($jenis_pengajuan as $pengajuan)
                                                        @if ($pengajuan['value'] == $customer->jenis_pengajuan)
                                                            <option value="{{ $pengajuan['value'] }}" selected>
                                                                {{ $pengajuan['name'] }}</option>
                                                        @else
                                                            <option value="{{ $pengajuan['value'] }}">
                                                                {{ $pengajuan['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Limit Kredit Dimohon</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" id="limit_kredit" class="rupiah form-control"
                                                    placeholder="Limit Kredit" name="limit_kredit"
                                                    value="@rupiah($customer->limit_kredit)">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">Jangka Waktu (bulan)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input name="jangka_waktu" required type="number" class="form-control"
                                                    placeholder="jangka waktu (bulan)"
                                                    value="{{ $customer->jangka_waktu }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Tujuan Penggunaan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="tujuan_penggunaan" id="" class="form-control">
                                                    <option value="" selected>-- Pilih Tujuan Penggunaan --</option>
                                                    @foreach ($tujuan_penggunaan as $tujuan)
                                                        @if ($tujuan['value'] == $customer->tujuan_penggunaan)
                                                            <option value="{{ $tujuan['value'] }}" selected>
                                                                {{ $tujuan['name'] }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $tujuan['value'] }}">
                                                                {{ $tujuan['name'] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Jelaskan Tujuan Penggunaan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="deskripsi_penggunaan"
                                                    placeholder="Jelaskan Tujuan Penggunaan" class="form-control"
                                                    value="{{ $customer->deskripsi }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Jenis Pinjaman</label>
                                                <select name="jenis_pinjaman" id="jenis_pinjaman" class="form-control">
                                                    <option value="">-- Pilih Jenis Pinjaman --</option>
                                                    @foreach ($jenis_pinjaman as $pinjaman)
                                                        @if ($pinjaman['value'] == $customer->jenis_pinjaman)
                                                            <option value="{{ $pinjaman['value'] }}" selected>
                                                                {{ $pinjaman['name'] }}</option>
                                                        @else
                                                            <option value="{{ $pinjaman['value'] }}">
                                                                {{ $pinjaman['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Jenis Agunan</label>
                                                <select name="jenis_agunan" id="jenis_agunan" class="form-control">
                                                    <option value="">-- Pilih Jenis Agunan --</option>
                                                    @foreach ($jenis_agunan as $agunan)
                                                        @if ($agunan['value'] == $customer->jenis_agunan)
                                                            <option value="{{ $agunan['value'] }}" selected>
                                                                {{ $agunan['name'] }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $agunan['value'] }}">
                                                                {{ $agunan['name'] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Nama Pemilik Agunan</label>
                                                <input type="text" class="form-control" name="nama_pemilik_agunan"
                                                    placeholder="Nama Pemilik Agunan"
                                                    value="{{ $customer->nama_pemilik_agunan }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Nomor Sertifikat Agunan</label>
                                                <input type="text" class="form-control" name="nomor_sertifikat"
                                                    placeholder="Nomor Sertifikat"
                                                    value="{{ $customer->nomor_sertifikat }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Nomor Rekening</label>
                                                <input type="text" class="form-control" name="nomor_rekening"
                                                    placeholder="Nomor Rekening" value="{{ $customer->no_rekening }}">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Nasabah</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Lengkap</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" class="form-control" name="nama_lengkap"
                                                    placeholder="Nama Lengkap" value="{{ $customer->nama_lengkap }}">
                                                <small>
                                                    <a href="" class="document" data-id="{{ $customer->id }}"
                                                        data-type="document_nasabah" onclick="return false"
                                                        data-toggle="modal" data-target="#document">Lihat Dokumen</a>
                                                </small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tempat Lahir</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" class="form-control" name="tempat_lahir"
                                                    placeholder="Tempat Lahir" value="{{ $customer->tempat_lahir }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tanggal Lahir</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input type="date" class="form-control" name="tanggal_lahir"
                                                    placeholder="Tanggal Lahir" value={{ $customer->tanggal_lahir }}>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Ibu Kandung</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" class="form-control" name="ibu_kandung"
                                                    placeholder="Nama Ibu Kandung"
                                                    value="{{ $customer->nama_ibu_kandung }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pendidikan Terakhir</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="pendidikan_terakhir" id="" class="form-control">
                                                    <option value="">-- Pilih Pendidikan Terakhir --</option>
                                                    @foreach ($educations as $education)
                                                        @if ($education['value'] == $customer->pendidikan_terakhir)
                                                            <option value="{{ $education['value'] }}" selected>
                                                                {{ $education['name'] }}</option>
                                                        @else
                                                            <option value="{{ $education['value'] }}">
                                                                {{ $education['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat (Sesuai KTP)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <textarea required name="alamat_ktp" placeholder="Alamat Sesuai KTP" class="form-control" id="" cols="5"
                                                    rows="3">{{ $customer->alamat }}</textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kelurahan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="kelurahan" placeholder="Kelurahan"
                                                    class="form-control" value="{{ $customer->kelurahan }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kecamatan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="kecamatan" placeholder="Kecamatan"
                                                    class="form-control" value="{{ $customer->kecamatan }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kota</label> <small class="text-danger text-bold">*</small>
                                                <input required type="text" name="kota" placeholder="Kota"
                                                    class="form-control" value="{{ $customer->kota }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Provinsi</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="provinsi" placeholder="Provinsi"
                                                    class="form-control" value="{{ $customer->provinsi }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kode Pos</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="kode_pos" placeholder="Kode Pos"
                                                    class="form-control" value="{{ $customer->kode_pos }}"
                                                    maxlength="5" minlength="5">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No telepon yang dapat dihubungi</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="no_telepon"
                                                    placeholder="No telepon yang bisa dihubungi" class="form-control"
                                                    value="{{ $customer->no_telepon }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Upload Foto Nasabah <small>(Jika ingin
                                                        diubah)</small></label>
                                                <input type="file" name="foto_nasabah" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="mb-4 bg-primary p-2 rounded"></h5>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat Saat ini (bila berbeda)</label>
                                                <textarea name="alamat_ktp_2" placeholder="Alamat Sesuai KTP" class="form-control" id="" cols="5"
                                                    rows="3">{{ $customer->alamat_2 }}</textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kelurahan</label>
                                                <input type="text" name="kelurahan_2" placeholder="Kelurahan"
                                                    class="form-control" value="{{ $customer->kelurahan_2 }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kecamatan</label>
                                                <input type="text" name="kecamatan_2" placeholder="Kecamatan"
                                                    class="form-control" value="{{ $customer->kecamatan_2 }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kota</label>
                                                <input type="text" name="kota_2" placeholder="Kota" class="form-control"
                                                    value="{{ $customer->kota_2 }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Provinsi</label>
                                                <input type="text" name="provinsi_2" placeholder="Provinsi"
                                                    class="form-control" value="{{ $customer->provinsi_2 }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kode Pos</label>
                                                <input type="text" name="kode_pos_2" placeholder="Kode Pos"
                                                    class="form-control" value="{{ $customer->kode_pos_2 }}"
                                                    maxlength="5" minlength="5">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No telepon yang dapat dihubungi</label>
                                                <input type="text" name="no_telepon_2"
                                                    placeholder="No telepon yang bisa dihubungi" class="form-control"
                                                    value="{{ $customer->no_telepon_2 }}">
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="mb-4 bg-primary p-2 rounded"></h5>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No KTP</label> <small class="text-danger text-bold">*</small>
                                                <input required type="text" name="no_ktp" placeholder="No KTP"
                                                    class="form-control" value="{{ $customer->no_ktp }}"
                                                    maxlength="16" minlength="16">
                                                <small>
                                                    <a href="" class="document" data-id="{{ $customer->id }}"
                                                        data-type="document_ktp" onclick="return false" data-toggle="modal"
                                                        data-target="#document">Lihat Dokumen</a>
                                                </small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Upload Foto KTP <small>(Jika ingin
                                                        diubah)</small></label>
                                                <input type="file" name="foto_ktp" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No NPWP</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="no_npwp" maxlength="15" minlength="15"
                                                    placeholder="No NPWP" class="form-control"
                                                    value="{{ $customer->no_npwp }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status Tempat Tinggal</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="status_tempat_tinggal" id="" class="form-control">
                                                    <option value="" selected>-- Pilih Status Tempat Tinggal --</option>
                                                    @foreach ($residences as $residence)
                                                        @if ($residence['value'] == $customer->status_tempat_tinggak)
                                                            <option value="{{ $residence['value'] }}" selected>
                                                                {{ $residence['name'] }}</option>
                                                        @else
                                                            <option value="{{ $residence['value'] }}" selected>
                                                                {{ $residence['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Lama Tinggal</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="lama_tinggal" id="" class="form-control">
                                                    <option value="">-- Pilih Lama Tinggal --</option>
                                                    @foreach ($stays as $stay)
                                                        @if ($stay['value'] == $customer->lama_tinggal)
                                                            <option value="{{ $stay['value'] }}" selected>
                                                                {{ $stay['name'] }}</option>
                                                        @else
                                                            <option value="{{ $stay['value'] }}">{{ $stay['name'] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status</label> <small class="text-danger text-bold">*</small>
                                                <select required name="status_pernikahan" id="" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    @foreach ($marital_status as $status)
                                                        @if ($status['value'] == $customer->status_pernikahan)
                                                            <option value="{{ $status['value'] }}" selected>
                                                                {{ $status['name'] }}</option>
                                                        @else
                                                            <option value="{{ $status['value'] }}">
                                                                {{ $status['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Jumlah Tanggungan (perorang)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="jumlah_tanggungan"
                                                    placeholder="Jumlah Tanggungan (perorang)" class="form-control"
                                                    value="{{ $customer->jumlah_tanggungan }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No Kartu Keluarga</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" minlength="16" maxlength="16"
                                                    name="no_kartu_keluarga" class="form-control"
                                                    placeholder="No Kartu Keluarga"
                                                    value="{{ $customer->no_kartu_keluarga }}">
                                                <small>
                                                    <a href="" class="document" data-id="{{ $customer->id }}"
                                                        data-type="keluarga_dokumen" onclick="return false"
                                                        data-toggle="modal" data-target="#document">Lihat Dokumen</a>
                                                </small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Upload Foto Kartu Keluarga <small>(Jika Ingin
                                                        diubah)</small></label>
                                                <input type="file" name="foto_kk" class="form-control">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Suami / Istri</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Suami / Istri</label>
                                                <input type="text" name="nama_suami_istri" class="form-control"
                                                    placeholder="Nama Suami / Istri"
                                                    value="{{ $customer->suami_istri->nama_suami_istri }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status</label>
                                                <select name="status" id="" class="form-control">
                                                    @foreach ($status_suami_istri as $sts)
                                                        @if ($sts['value'] == $customer->suami_istri->status)
                                                            <option value="{{ $sts['value'] }}" selected>
                                                                {{ $sts['name'] }}</option>
                                                        @else
                                                            <option value="">
                                                                {{ $sts['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tanggal Nikah</label>
                                                <input type="date" name="tanggal_nikah" class="form-control"
                                                    value="{{ $customer->suami_istri->tanggal_nikah }}">
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
                                                    value="{{ $customer->suami_istri->tempat_lahir }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir_suami_istri"
                                                    placeholder="Tanggal Lahir Suami / istri" class="form-control"
                                                    value="{{ $customer->tanggal_lahir }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pendidikan Terakhir</label>
                                                <select name="pendidikan_terakhir_suami_istri" id=""
                                                    class="form-control">
                                                    <option value="">-- Pilih Pendidikan Terakhir --</option>
                                                    @foreach ($educations as $education)
                                                        @if ($education['value'] == $customer->suami_istri->pendidikan_terakhir)
                                                            <option value="{{ $education['value'] }}" selected>
                                                                {{ $education['name'] }}</option>
                                                        @else
                                                            <option value="{{ $education['value'] }}">
                                                                {{ $education['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pekerjaan Suami / Istri</label>
                                                <input type="text" class="form-control" name="pekerjaan_suami_istri"
                                                    placeholder="Pekerjaan Suami / Istri"
                                                    value="{{ $customer->suami_istri->pekerjaan }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No KTP</label>
                                                <input type="text" name="no_ktp_suami_istri"
                                                    placeholder="No KTP Suami / Istri" minlength="16" maxlength="16"
                                                    class="form-control"
                                                    value="{{ $customer->suami_istri->no_ktp }}" />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Penghasilan Bulanan</label>
                                                <input type="text" name="penghasilan_bulanan"
                                                    placeholder="Penghasilan Bulanan" class="rupiah form-control"
                                                    value="{{ $customer->suami_istri->penghasilan }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Upload Foto Buku Nikah <small>(Jika ingin
                                                        diubah)</small></label>
                                                <input type="file" name="foto_nikah" class="form-control">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Usaha</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Berusaha Sejak</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="date" name="berusaha_sejak" class="form-control"
                                                    placeholder="Berusaha Sejak"
                                                    value="{{ $customer->usaha->berusaha_sejak }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Bidang Usaha</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="bidang_usaha" placeholder="Bidang Usaha"
                                                    class="form-control" value="{{ $customer->usaha->bidang_usaha }}">
                                                <small>
                                                    <a href="" class="document" data-id="{{ $customer->id }}"
                                                        data-type="usaha_dokumen" onclick="return false" data-toggle="modal"
                                                        data-target="#document">Lihat Dokumen</a>
                                                </small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat Usaha</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <textarea required name="alamat_usaha" placeholder="Alamat usaha" class="form-control" id="" cols="5"
                                                    rows="3">{{ $customer->usaha->alamat_usaha }}</textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Jumlah Karyawan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="jumlah_karyawan" class="form-control"
                                                    placeholder="Jumlah Karyawan"
                                                    value="{{ $customer->usaha->jumlah_karyawan }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status Kepemilikan Tempat Usaha</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="status_kepemilikan" id="" class="form-control">
                                                    <option value="" selected>-- Pilih Status Kepemilikan --</option>
                                                    @foreach ($business_status as $status)
                                                        @if ($status['value'] == $customer->usaha->status_kepemilikan)
                                                            <option value="{{ $status['value'] }}" selected>
                                                                {{ $status['name'] }}</option>
                                                        @else
                                                            <option value="{{ $status['value'] }}">
                                                                {{ $status['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No Telepon yang dapat dihubungi</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="numbr" class="form-control" name="no_telepon_usaha"
                                                    placeholder="No Telepon yang dapat dihubungi"
                                                    value="{{ $customer->usaha->no_telepon }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Ditempati Sejak</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="date" name="ditempati_usaha" class="form-control"
                                                    placeholder="Ditempati Sejak"
                                                    value="{{ $customer->usaha->ditempati_sejak }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Upload Foto Tempat Usaha <small>(Jika ingin
                                                        diubah)</small></label>
                                                <input type="file" name="foto_usaha" class="form-control">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Kerabat Dekat Yang Tidak Serumah</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Lengkap</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="nama_kerabat" placeholder="Nama Lengkap"
                                                    class="form-control"
                                                    value="{{ $customer->kerabat->nama_lengkap }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Jenis Kelamin</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="jenis_kelamin_kerabat" id="" class="form-control">
                                                    <option value="" selected>-- Pilih Jenis Kelamin --</option>
                                                    <option value="laki - laki"
                                                        @if ($customer->kerabat->jenis_kelamin == 'laki - laki') selected @endif>Laki - Laki
                                                    </option>
                                                    <option value="perempuan"
                                                        @if ($customer->kerabat->jenis_kelamin == 'perempuan') selected @endif>Perempuan
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Hubungan Kerabat</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="hubungan_kerabat" class="form-control"
                                                    placeholder="Hubungan Kerabat"
                                                    value="{{ $customer->kerabat->hubungan }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat Tinggal</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <textarea required name="alamat_kerabat" id="" cols="30" rows="3" class="form-control"
                                                    placeholder="Alamat Tinggal">{{ $customer->kerabat->alamat }}</textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kota</label> <small class="text-danger text-bold">*</small>
                                                <input required type="text" name="kota_kerabat" placeholder="Kota"
                                                    class="form-control" value="{{ $customer->kerabat->kota }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No Telepon Rumah</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input type="number" name="no_telepon_rumah_kerabat"
                                                    placeholder="No Telepon Rumah" class="form-control"
                                                    value="{{ $customer->kerabat->kota }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Nomor HP</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="no_hp_kerabat" placeholder="Nomor HP"
                                                    class="form-control"
                                                    value="{{ $customer->kerabat->no_handphone }}">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Keuangan Calon Debitur</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Penghasilan Perbulan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="penghasilan_debitur"
                                                    class="rupiah form-control" placeholder="Penghasilan Debitur"
                                                    value="@rupiah($customer->calon_debitur->penghasilan)">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Total Pinjaman</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="total_pinjaman"
                                                    placeholder="Total Pinjaman" class="rupiah form-control"
                                                    value="@rupiah($customer->calon_debitur->total_pinjaman_lain)">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Biaya - Biaya</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="biaya_debitur" placeholder="Biaya - Biaya"
                                                    class="rupiah form-control" value="@rupiah($customer->calon_debitur->biaya_biaya)">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Sisa Waktu Angsuran (Bulan)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="sisa_waktu_angsuran"
                                                    placeholder="Siswa Waktu Angsuran (Bulan)" class="form-control"
                                                    value="{{ $customer->calon_debitur->sisa_waktu_angsuran }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Keuntungan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="keuntungan" placeholder="Keuntungan"
                                                    class="rupiah form-control" value="@rupiah($customer->calon_debitur->keuntungan)">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Angsuran Pinjaman Lain (perbulan)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="angsuran_pinjaman_lain"
                                                    placeholder="Angsuran Pinjaman Lain (perbulan)"
                                                    class="rupiah form-control" value="@rupiah($customer->calon_debitur->angsuran_pinjaman_lain)">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Penghasilan Lainnya</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="penghasilan_lainnya"
                                                    placeholder="Penghasilan Lainnya" class="rupiah form-control"
                                                    value="@rupiah($customer->calon_debitur->penghasilan_lainnya)">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Total Penghasilan (perbulan)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="total_penghasilan"
                                                    class="rupiah form-control" placeholder="Total Penghasilan (perbulan)"
                                                    value="@rupiah($customer->calon_debitur->total_penghasilan)">
                                            </div>
                                        </div>
                                    </div>
                                    <button id="save" type="button" class="btn btn-primary btn-sm rounded">Submit</button>
                                    <a href="{{ route('credits.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
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
                            `<img class="text-center" src="{!! asset('/storage/nasabah/${data.foto_nasabah}') !!}" width="450" />`)
                    }
                },
                error: err => console.log(err)
            })
        })

        $("#save").on('click', function(e) {
            e.preventDefault()
            let limit_credit = parseInt($("#limit_kredit").val().split(".").join(""))
            let jenis_pinjaman = $("#jenis_pinjaman").val()
            calculation(limit_credit, jenis_pinjaman)
        })

        function calculation(limit_kredit, jenis_pinjaman) {
            $.ajax({
                type: 'GET',
                url: `{{ route('credits.get_instalment') }}`,
                success: ({
                    data
                }) => {
                    instalment = false
                    data.forEach((item, index) => {
                        if (item.tipe == jenis_pinjaman && limit_kredit >= item.kredit_terkecil &&
                            limit_kredit < item.kredit_terbesar) {
                            instalment = true
                        }
                    })
                    if (instalment == false) {
                        Swal.fire(
                            'Gagal',
                            'Limit Kredit tidak sesuai dengan suku bunga',
                            'error'
                        )
                        return false
                    } else {
                        $("#formCredit").submit()
                    }
                },
                error: err => console.log(err)
            })
        }
    </script>
@endpush
