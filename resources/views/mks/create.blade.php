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
                                <form action="{{ route('mks.store') }}" method="POST">
                                    @csrf
                                    <div class="col-lg-6 form-group">
                                        <label for="">Nasabah</label>
                                        <select name="nasabah_id" id="nasabah_id" required class="form-control">
                                            <option value="{{ $customer->id }}" selected>{{ $customer->nama_lengkap }}
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6 form-group">
                                            <label for="">Kas, Tabungan, Deposito, atau Asset Lainnya</label>
                                            <input type="text" name="aset"
                                                placeholder="Kas, Tabungan, Deposito, atau Asset Lainnya"
                                                class="form-control" required value="0">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Pendapatan Rata - Rata Perbulan Saat Kondisi Ramai</label>
                                            <input type="text" name="profit_ramai"
                                                placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Ramai"
                                                class="form-control" required value="0">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Pendapatan Rata - Rata Perbulan Saat Kondisi Sepi</label>
                                            <input type="text" name="profit_sepi"
                                                placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Sepi"
                                                class="form-control" required value="0">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Pendapatan Rata - Rata Perbulan Saat Kondisi Normal</label>
                                            <input type="text" name="profit_normal" id="normal_perbulan"
                                                placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Normal"
                                                class="form-control" required value="0">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Persediaan Rata - Rata</label>
                                            <input type="text" name="persediaan_aset" placeholder="Persedian Rata - Rata"
                                                class="form-control" required value="0">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Kekayaan Berupa Fixed Asset</label>
                                            <input type="text" name="fixed_aset" placeholder="Kekayaan Berupa Fixed Asset"
                                                class="form-control" required value="0">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Laba Usaha Perbulan</label>
                                            <input type="text" name="laba_perbulan" placeholder="Laba Usaha Perbulan"
                                                class="form-control" readonly id="laba_perbulan" required>
                                            <input type="hidden" name="laba_pertahun" id="laba_pertahun_input">
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
                                                <span id="limit_kredit">Rp. 0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <button id="submit" class="btn btn-primary btn-sm rounded">Simpan</button>
                                        <a href="{{ route('mks.index') }}"
                                            class="btn btn-secondary btn-sm rounded">Kembali</a>
                                    </div>
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
        let limitKredit = ''

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

        let id = $('#nasabah_id option:selected').val()

        // let id = $(this).val()
        let url = '{{ route('get_nasabah', ':id') }}'
        url = url.replace(':id', id)

        $.ajax({
            type: 'GET',
            url: url,
            success: ({
                data
            }) => {
                limitKredit = data.limit_kredit
                $("#limit_kredit").text("Rp. " + format_rupiah(data.limit_kredit))

                let pendapatanNormalPerbulan = $("#normal_perbulan").val()

                let biayaHidup = Math.floor(parseInt(pendapatanNormalPerbulan) * 35 / 100)
                let labaBersihPerbulan = parseInt(pendapatanNormalPerbulan) - biayaHidup
                let labaBersihPertahun = Math.floor(labaBersihPerbulan * 12 - biayaHidup);
                $("#laba_perbulan").val(labaBersihPerbulan)
                $("#laba_pertahun").text("Rp. " + format_rupiah(labaBersihPertahun))
                if (labaBersihPertahun > limitKredit) {
                    $("#info_laba_bersih").removeClass("bg-danger bg-warning").addClass("bg-success")
                    $("#submit").prop('disabled', false)
                } else if (labaBersihPerbulan == limitKredit) {
                    $("#info_laba_bersih").removeClass('bg-danger bg-success').addClass("bg-warning")
                    $("#submit").prop('disabled', false)
                } else {
                    $("#info_laba_bersih").removeClass('bg-success bg-primary').addClass("bg-danger")
                }
            },
            error: err => console.log(err)
        })

        $("#normal_perbulan").on('keyup', function() {
            let pendapatanNormalPerbulan = $("#normal_perbulan").val()
            // if (pendapatanNormalPerbulan == '') {
            //     return alert('Pendapatan Rata - Rata Perbulan Saat Kondisi Normal harus diisi ')
            // }
            let biayaHidup = Math.floor(parseInt(pendapatanNormalPerbulan) * 35 / 100)
            let labaBersihPerbulan = parseInt(pendapatanNormalPerbulan) - biayaHidup
            let labaBersihPertahun = Math.floor(labaBersihPerbulan * 12 - biayaHidup);
            $("#laba_pertahun_input").val(labaBersihPertahun)
            $("#laba_perbulan").val(labaBersihPerbulan)
            $("#laba_pertahun").text("Rp. " + format_rupiah(labaBersihPertahun))
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
