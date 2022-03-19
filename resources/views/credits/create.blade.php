@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Pengajuan Kredit</h1>
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
                                <form action="{{ route('credits.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <h5 class="mb-4 bg-primary p-2 rounded">Cabang / Unit Mikro</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>Jenis Pengajuan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="jenis_pengajuan" id="" class="form-control">
                                                    <option value="">-- Pilih Pengajuan --</option>
                                                    <option value="Baru">Baru</option>
                                                    <option value="Top Up">Top Up</option>
                                                    <option value="Take Over">Take Over</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Limit Kredit Dimohon</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" id="limit_kredit" class="rupiah form-control"
                                                    placeholder="Limit Kredit" name="limit_kredit">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputPassword1">Jangka Waktu (bulan)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" class="form-control"
                                                    placeholder="jangka waktu (bulan)">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Tujuan Penggunaan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="" id="" class="form-control">
                                                    <option value="" selected>-- Pilih Tujuan Penggunaan --</option>
                                                    <option value="kur">KUR</option>
                                                    <option value="kum">KUM</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Jelaskan Tujuan Penggunaan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="deskripsi_penggunaan"
                                                    placeholder="Jelaskan Tujuan Penggunaan" class="form-control">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Nasabah</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Lengkap</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" class="form-control" name="nama_lengkap"
                                                    placeholder="Nama Lengkap">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tempat Lahir</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" class="form-control" name="tempat_lahir"
                                                    placeholder="Tempat Lahir">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tanggal Lahir</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input type="date" class="form-control" name="tanggal_lahir"
                                                    placeholder="Tanggal Lahir">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Ibu Kandung</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" class="form-control" name="ibu_kandung"
                                                    placeholder="Nama Ibu Kandung">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pendidikan Terakhir</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="pendidikan_terakhir" id="" class="form-control">
                                                    <option value="">-- Pilih Pendidikan Terakhir --</option>
                                                    <option value="tidak tamat sd">Tidak Tamat SD</option>
                                                    <option value="sd">SD</option>
                                                    <option value="smp">SMP</option>
                                                    <option value="sma">SMA</option>
                                                    <option value="diploma">Diploma</option>
                                                    <option value="sarjana">Sarjana</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat (Sesuai KTP)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <textarea required name="alamat_ktp" placeholder="Alamat Sesuai KTP" class="form-control" id="" cols="5"
                                                    rows="3"></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kecamatan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="kecamatan" placeholder="Kecamatan"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kota</label> <small class="text-danger text-bold">*</small>
                                                <input required type="text" name="kota" placeholder="Kota"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Provinsi</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="provinsi" placeholder="Provinsi"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kode Pos</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="kode_pos" placeholder="Kode Pos"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No telepon yang dapat dihubungi</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="no_telepon"
                                                    placeholder="No telepon yang bisa dihubungi" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat Saat ini (bila berbeda)</label>
                                                <textarea name="alamat_ktp" placeholder="Alamat Sesuai KTP" class="form-control" id="" cols="5" rows="3"></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kecamatan</label>
                                                <input type="text" name="kecamatan" placeholder="Kecamatan"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kota</label>
                                                <input type="text" name="kota" placeholder="Kota" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Provinsi</label>
                                                <input type="text" name="provinsi" placeholder="Provinsi"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kode Pos</label>
                                                <input type="text" name="kode_pos" placeholder="Kode Pos"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No telepon yang dapat dihubungi</label>
                                                <input type="text" name="no_telepon"
                                                    placeholder="No telepon yang bisa dihubungi" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No KTP</label> <small class="text-danger text-bold">*</small>
                                                <input required type="text" name="no_ktp" placeholder="No KTP"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No NPWP</label> <small class="text-danger text-bold">*</small>
                                                <input required type="text" name="no_npwp" placeholder="No NPWP"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status Tempat Tinggal</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="status_tempat_tinggal" id="" class="form-control">
                                                    <option value="" selected>-- Pilih Status Tempat Tinggal --</option>
                                                    <option value="milik sendiri">Milik Sendiri</option>
                                                    <option value="sewa / kontrak">Sewa / Kontrak </option>
                                                    <option value="milik keluarga / orang tua">Milik Keluarga / Orang Tua
                                                    </option>
                                                    <option value="rumah dinas / provinsi">Rumah Dinas / Provinsi</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Lama Tinggal</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="" id="" class="form-control">
                                                    <option value="">-- Pilih Lama Tinggal --</option>
                                                    <option value="< 2 tahun">
                                                        < 2 Tahun</option>
                                                    <option value="> 2 < 5 tahun">> 2 < 5 Tahun</option>
                                                    <option value="> 5 tahun">> 5 Tahun</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status</label> <small class="text-danger text-bold">*</small>
                                                <select required name="status_pernikahan" id="" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="menikah">Menikah</option>
                                                    <option value="tidak menikah">Tidak Menikah</option>
                                                    <option value="janda / duda">Janda / Duda</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Jumlah Tanggungan (perorang)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="jumlah_tanggungan"
                                                    placeholder="Jumlah Tanggungan (perorang)" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No Kartu Keluarga</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="no_kartu_keluarga"
                                                    class="form-control" placeholder="No Kartu Keluarga">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Suami / Istri</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Suami / Istri</label>
                                                <input type="text" name="nama_suami_istri" class="form-control"
                                                    placeholder="Nama Suami / Istri">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control"
                                                    placeholder="Tempat Lahir">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir_suami_istri"
                                                    placeholder="Tanggal Lahir Suami / istri" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pendidikan Terakhir</label>
                                                <select name="pendidikan_terakhir_suami_istri" id=""
                                                    class="form-control">
                                                    <option value="">-- Pilih Pendidikan Terakhir --</option>
                                                    <option value="tidak tamat sd">Tidak Tamat SD</option>
                                                    <option value="sd">SD</option>
                                                    <option value="smp">SMP</option>
                                                    <option value="sma">SMA</option>
                                                    <option value="diploma">Diploma</option>
                                                    <option value="sarjana">Sarjana</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No KTP</label>
                                                <input type="text" name="no_ktp_suami_istri"
                                                    placeholder="No KTP Suami / Istri" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Penghasilan Bulanan</label>
                                                <input type="text" name="penghasilan_bulanan"
                                                    placeholder="Penghasilan Bulanan" class="rupiah form-control">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Usaha</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Berusaha Sejak</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="date" name="berusaha_sejak" class="form-control"
                                                    placeholder="Berusaha Sejak">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Bidang Usaha</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="bidang_usaha" placeholder="Bidang Usaha"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat Usaha</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <textarea required name="alamat_usaha" placeholder="Alamat usaha" class="form-control" id="" cols="5"
                                                    rows="3"></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Jumlah Karyawan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="jumlah_karyawan" class="form-control"
                                                    placeholder="Jumlah Karyawan">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Status Kepemilikan Tempat Usaha</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="status_kepemilikan" id="" class="form-control">
                                                    <option value="" selected>-- Pilih Status Kepemilikan --</option>
                                                    <option value="milik sendiri">Milik Sendiri</option>
                                                    <option value="sewa">Sewa</option>
                                                    <option value="keluarga">Keluarga</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No Telepon yang dapat dihubungi</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="numbr" class="form-control" name="no_telepon_usaha"
                                                    placeholder="No Telepon yang dapat dihubungi">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Ditempati Sejak</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="date" name="ditempati_usaha" class="form-control"
                                                    placeholder="Ditempati Sejak">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Kerabat Dekat Yang Tidak Serumah</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Nama Lengkap</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="nama_kerabat" placeholder="Nama Lengkap"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Jenis Kelamin</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <select required name="jenis_kelamin_kerabat" id="" class="form-control">
                                                    <option value="" selected>-- Pilih Jenis Kelamin --</option>
                                                    <option value="laki - laki">Laki - Laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Hubungan Kerabat</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="hubungan_kerabat" class="form-control"
                                                    placeholder="Hubungan Kerabat">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Alamat Tinggal</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <textarea required name="alamat_kerabat" id="" cols="30" rows="3" class="form-control"
                                                    placeholder="Alamat Tinggal"></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Kota</label> <small class="text-danger text-bold">*</small>
                                                <input required type="text" name="kota" placeholder="Kota"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">No Telepon Rumah</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input type="number" name="no_telepon_rumah" placeholder="No Telepon Rumah"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Nomor HP</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="no_hp_kerabat" placeholder="Nomor HP"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <h5 class="mb-4 bg-primary p-2 rounded">Data Keuangan Calon Debitur</h5>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Penghasilan Perbulan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="penghasilan_debitur"
                                                    class="form-control" placeholder="Penghasilan Debitur">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Total Pinjaman</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="text" name="total_pinjaman"
                                                    placeholder="Total Pinjaman" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Biaya - Biaya</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="biaya_debitur"
                                                    placeholder="Biaya - Biaya" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Sisa Waktu Angsuran (Bulan)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="siswa_waktu_angsuran"
                                                    placeholder="Siswa Waktu Angsuran (Bulan)" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Keuntungan</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="keuntungan" placeholder="Keuntungan"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Angsuran Pinjaman Lain (perbulan)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="angsuran_pinjaman_lain"
                                                    placeholder="Angsuran Pinjaman Lain (perbulan)" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Penghasilan Lainnya</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="penghasilan_lainnya"
                                                    placeholder="Penghasilan Lainnya" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Total Penghasilan (perbulan)</label> <small
                                                    class="text-danger text-bold">*</small>
                                                <input required type="number" name="total_penghasilan"
                                                    class="form-control" placeholder="Total Penghasilan (perbulan)">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm rounded">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        var rupiah = document.getElementsByClassName('rupiah');

        rupiah.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            // return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endpush
