@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Skoring MKA</h1>
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
                                <form action="{{ route('mks.update', $score->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-lg-6 form-group">
                                        <label for="">Nasabah</label>
                                        <select name="nasabah_id" id="nasabah_id" required class="form-control">
                                            <option value="{{ $score->nasabah->id }}" selected>
                                                {{ $score->nasabah->nama_lengkap }}
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6 form-group">
                                            <label for="">Kas, Tabungan, Deposito, atau Asset Lainnya</label>
                                            <input type="text" name="aset"
                                                placeholder="Kas, Tabungan, Deposito, atau Asset Lainnya"
                                                class="rupiah form-control" required value="@rupiah($score->aset)">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Pendapatan Rata - Rata Saat Kondisi Ramai</label>
                                            <div class="row mb-3">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_ramai_hari"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Ramai"
                                                        class="rupiah form-control" required value="@rupiah($score->profit_ramai_hari)">
                                                </div>
                                                <span style="margin-top: 5px;">/ hari</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_ramai"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Ramai"
                                                        class="rupiah form-control" required value="@rupiah($score->profit_ramai)">
                                                </div>
                                                <span style="margin-top: 5px;">/ bulan</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Pendapatan Rata - Rata Saat Kondisi Sepi</label>
                                            <div class="row mb-3">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_sepi_hari"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Sepi"
                                                        class="rupiah form-control" required value="@rupiah($score->profit_sepi_hari)">

                                                </div>
                                                <span style="margin-top: 5px;">/ hari</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_sepi"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Sepi"
                                                        class="rupiah form-control" required value="@rupiah($score->profit_sepi)">
                                                </div>
                                                <span style="margin-top: 5px;">/ bulan</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Pendapatan Rata - Rata Saat Kondisi Normal</label>
                                            <div class="row mb-3">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_normal_hari"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Normal"
                                                        class="rupiah form-control" required value="@rupiah($score->profit_normal_hari)">
                                                </div>
                                                <span style="margin-top: 5px;">/ hari</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_normal" id="normal_perbulan"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Normal"
                                                        class="rupiah form-control" required value="@rupiah($score->profit_normal)">
                                                </div>
                                                <span style="margin-top: 5pxl">/ bulan</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Persediaan Rata - Rata</label>
                                            <input type="text" name="persediaan_aset" placeholder="Persedian Rata - Rata"
                                                class="rupiah form-control" required value="@rupiah($score->persediaan_aset)">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Kekayaan Berupa Fixed Asset</label>
                                            <input type="text" name="fixed_aset" placeholder="Kekayaan Berupa Fixed Asset"
                                                class="rupiah form-control" required value="@rupiah($score->fixed_aset)">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Laba Usaha Perbulan</label>
                                            <input type="text" name="laba_perbulan" placeholder="Laba Usaha Perbulan"
                                                class="rupiah form-control" readonly id="laba_perbulan" required
                                                value="@rupiah($score->laba_perbulan)">
                                            <input type="hidden" name="laba_pertahun" id="laba_pertahun_input"
                                                value="{{ $score->laba_pertahun }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Hasil Skoring</h4>
                                    <span id="info" class="mb-2 badge d-none">Good</span>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div id="info_laba_bersih" class="card p-3">
                                                <span>Laba Bersih Pertahun</span>
                                                <span id="laba_pertahun">Rp. 0</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div id="info_limit_kredit" class="bg-secondary card p-3">
                                                <span>Limit Kredit</span>
                                                <span id="limit_kredit">@currency($score->nasabah->limit_kredit)</span>
                                                <input type="hidden" id="limit_kredit_value"
                                                    value="{{ $score->nasabah->limit_kredit }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <button id="submit" class="btn btn-primary btn-sm rounded">Simpan</button>
                                        <a href="{{ route('mks.index') }}"
                                            class="btn btn-secondary btn-sm rounded">Kembali</a>
                                    </div>
                                    <input type="hidden" id="limit_kredit_nasabah"
                                        value="{{ $score->nasabah->limit_kredit }}">
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
        let limitKredit = $("#limit_kredit_value").val()
        console.log(limitKredit)

        function format_rupiah(number) {
            var number_string = number.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah
        }

        let limit_kredit_nasabah = $("#limit_kredit_nasabah").val()

        let pendapatanNormalPerbulan = $("#normal_perbulan").val().split(".").join("")

        let biayaHidup = Math.floor(parseInt(pendapatanNormalPerbulan) * 35 / 100);
        let labaBersihPerbulan = parseInt(pendapatanNormalPerbulan) - biayaHidup;
        let labaBersihPertahun = Math.floor(labaBersihPerbulan * 12 - biayaHidup);
        $("#laba_perbulan").val(format_rupiah(labaBersihPerbulan))
        $("#laba_pertahun").text("Rp. " + format_rupiah(labaBersihPertahun))

        if (labaBersihPertahun > limit_kredit_nasabah) {
            $("#info_laba_bersih").removeClass("bg-danger bg-warning").addClass("bg-success")
            $("#submit").prop('disabled', false)
        } else if (labaBersihPerbulan == limit_kredit_nasabah) {
            $("#info_laba_bersih").removeClass('bg-danger bg-success').addClass("bg-warning")
            $("#submit").prop('disabled', false)
        } else {
            $("#info_laba_bersih").removeClass('bg-success bg-primary').addClass("bg-danger")
        }

        // $("#normal_perbulan").on('keyup', function() {
        //     let pendapatanNormalPerbulan = $("#normal_perbulan").val()
        //     let biayaHidup = Math.floor(parseInt(pendapatanNormalPerbulan) * 35 / 100)
        //     let labaBersihPerbulan = parseInt(pendapatanNormalPerbulan) - biayaHidup
        //     let labaBersihPertahun = Math.floor(labaBersihPerbulan * 12 - biayaHidup);
        //     $("#laba_pertahun_input").val(labaBersihPertahun)
        //     $("#laba_perbulan").val(labaBersihPerbulan)
        //     console.log(labaBersihPertahun)
        //     $("#laba_pertahun").text("Rp. " + format_rupiah(labaBersihPertahun))
        //     if (labaBersihPertahun > limit_kredit_nasabah) {
        //         $("#info_laba_bersih").removeClass("bg-danger bg-warning").addClass("bg-success")
        //         $("#submit").prop('disabled', false)
        //     } else if (labaBersihPerbulan == limit_kredit_nasabah) {
        //         $("#info_laba_bersih").removeClass('bg-danger bg-success').addClass("bg-warning")
        //         $("#submit").prop('disabled', false)
        //     } else {
        //         $("#info_laba_bersih").removeClass('bg-success bg-primary').addClass("bg-danger")
        //     }
        // })

        $("#normal_perbulan").on('keyup', function() {
            let pendapatanNormalPerbulan = $("#normal_perbulan").val().split(".").join("")
            // if (pendapatanNormalPerbulan == '') {
            //     return alert('Pendapatan Rata - Rata Perbulan Saat Kondisi Normal harus diisi ')
            // }
            let biayaHidup = Math.floor(parseInt(pendapatanNormalPerbulan) * 35 / 100)
            let labaBersihPerbulan = parseInt(pendapatanNormalPerbulan) - biayaHidup
            let labaBersihPertahun = Math.floor(labaBersihPerbulan * 12 - biayaHidup);
            $("#laba_pertahun_input").val(format_rupiah(labaBersihPertahun))
            $("#laba_perbulan").val(format_rupiah(labaBersihPerbulan))
            $("#laba_pertahun").text("Rp. " + format_rupiah(labaBersihPertahun))
            console.log(limitKredit)
            if (labaBersihPertahun > limitKredit) {
                $("#info_laba_bersih").removeClass("bg-danger bg-warning").addClass("bg-success")
                $("#submit").prop('disabled', false)
            } else if (labaBersihPerbulan == limitKredit) {
                $("#info_laba_bersih").removeClass('bg-danger bg-success').addClass("bg-warning")
                $("#submit").prop('disabled', false)
            } else {
                $("#info_laba_bersih").removeClass('bg-success bg-primary').addClass("bg-danger")
            }
        })
    </script>
@endpush
