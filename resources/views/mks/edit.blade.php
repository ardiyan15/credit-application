{{-- @extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Skoring MKS</h1>
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
                                    @method('PATCH')
                                    @csrf
                                    <div class="col-lg-6 form-group">
                                        <label for="">Nasabah</label>
                                        <select name="nasabah_id" id="nasabah_id" class="form-control">
                                            <option value="">-- Pilih Nasabah --</option>
                                            @foreach ($customers as $customer)
                                                @if ($score->nasabah_id == $customer->id)
                                                    <option value="{{ $customer->id }}" selected>
                                                        {{ $customer->nama_lengkap }}
                                                    </option>
                                                @else
                                                    <option value="{{ $customer->id }}">
                                                        {{ $customer->nama_lengkap }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tr>
                                                <th width="150">No KTP</th>
                                                <td width="40">:</td>
                                                <td id="no_ktp">{{ $score->nasabah->no_ktp }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <td>:</td>
                                                <td id="name">{{ $score->nasabah->nama_lengkap }}</td>
                                            </tr>
                                            <tr>
                                                <th>Limit Kredit</th>
                                                <td>:</td>
                                                <td id="credit_limit">@currency($score->nasabah->limit_kredit)</td>
                                            </tr>
                                            <tr>
                                                <th>Tenor</th>
                                                <td>:</td>
                                                <td id="tenor">{{ $score->nasabah->jangka_waktu }}</td>
                                            </tr>
                                            <tr>
                                                <th>Cicilan Perbulan</th>
                                                <td>:</td>
                                                <td id="cicilan">@currency($score->nasabah->calculation->bunga_per_bulan)
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="col-lg-6">
                                        <label for="">Skoring</label>
                                        <input type="text" name="skor" placeholder="Skoring" class="form-control"
                                            value="{{ $score->skor }}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <button class="btn btn-primary btn-sm rounded">Simpan</button>
                                        <a href="" class="btn btn-secondary btn-sm rounded">Kembali</a>
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
        $("#nasabah_id").on('change', function() {
            let id = $(this).val()
            let url = '{{ route('get_nasabah', ':id') }}'
            url = url.replace(':id', id)

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

            $.ajax({
                type: 'GET',
                url: url,
                success: ({
                    data
                }) => {


                    $("#no_ktp").text(data.no_ktp)
                    $("#name").text(data.nama_lengkap)
                    $("#credit_limit").text("Rp. " + format_rupiah(data.limit_kredit))
                    $("#tenor").text(data.jangka_waktu + " bulan")
                    $("#cicilan").text("Rp. " + format_rupiah(data.calculation.bunga_per_bulan))
                },
                error: err => console.log(err)
            })
        })
    </script>
@endpush --}}

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
                                                class="form-control" required value="{{ $score->aset }}">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Pendapatan Rata - Rata Saat Kondisi Ramai</label>
                                            <div class="row mb-3">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_ramai_hari"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Ramai"
                                                        class="form-control" required
                                                        value="{{ $score->profit_ramai_hari }}">
                                                </div>
                                                <span style="margin-top: 5px;">/ hari</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_ramai"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Ramai"
                                                        class="form-control" required
                                                        value="{{ $score->profit_ramai }}">
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
                                                        class="form-control" required
                                                        value="{{ $score->profit_sepi_hari }}">

                                                </div>
                                                <span style="margin-top: 5px;">/ hari</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_sepi"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Sepi"
                                                        class="form-control" required value="{{ $score->profit_sepi }}">
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
                                                        class="form-control" required
                                                        value="{{ $score->profit_normal_hari }}">
                                                </div>
                                                <span style="margin-top: 5px;">/ hari</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="text" name="profit_normal" id="normal_perbulan"
                                                        placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Normal"
                                                        class="form-control" required
                                                        value="{{ $score->profit_normal }}">
                                                </div>
                                                <span style="margin-top: 5pxl">/ bulan</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Persediaan Rata - Rata</label>
                                            <input type="text" name="persediaan_aset" placeholder="Persedian Rata - Rata"
                                                class="form-control" required value="{{ $score->persediaan_aset }}">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Kekayaan Berupa Fixed Asset</label>
                                            <input type="text" name="fixed_aset" placeholder="Kekayaan Berupa Fixed Asset"
                                                class="form-control" required value="{{ $score->fixed_aset }}">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="">Laba Usaha Perbulan</label>
                                            <input type="text" name="laba_perbulan" placeholder="Laba Usaha Perbulan"
                                                class="form-control" readonly id="laba_perbulan" required
                                                value="{{ $score->laba_perbulan }}">
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

        let limit_kredit_nasabah = $("#limit_kredit_nasabah").val()

        let pendapatanNormalPerbulan = $("#normal_perbulan").val()

        let biayaHidup = Math.floor(parseInt(pendapatanNormalPerbulan) * 35 / 100);
        let labaBersihPerbulan = parseInt(pendapatanNormalPerbulan) - biayaHidup;
        let labaBersihPertahun = Math.floor(labaBersihPerbulan * 12 - biayaHidup);
        $("#laba_perbulan").val(labaBersihPerbulan)
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

        $("#normal_perbulan").on('keyup', function() {
            let pendapatanNormalPerbulan = $("#normal_perbulan").val()
            let biayaHidup = Math.floor(parseInt(pendapatanNormalPerbulan) * 35 / 100)
            let labaBersihPerbulan = parseInt(pendapatanNormalPerbulan) - biayaHidup
            let labaBersihPertahun = Math.floor(labaBersihPerbulan * 12 - biayaHidup);
            $("#laba_pertahun_input").val(labaBersihPertahun)
            $("#laba_perbulan").val(labaBersihPerbulan)
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
        })
    </script>
@endpush
