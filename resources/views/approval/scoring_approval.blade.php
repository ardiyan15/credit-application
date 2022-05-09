@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Approval Pengajuan Kredit</h1>
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
                                <h5>{{ $customer->nama_lengkap }}</h5>
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label for="">Kas, Tabungan, Deposito, atau Asset Lainnya</label>
                                        <input type="text" name="aset"
                                            placeholder="Kas, Tabungan, Deposito, atau Asset Lainnya" class="form-control"
                                            required readonly value="{{ $customer->skoring->aset }}">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Pendapatan Rata - Rata Perbulan Saat Kondisi Ramai</label>
                                        <input type="text" name="profit_ramai"
                                            placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Ramai"
                                            class="form-control" required readonly
                                            value="{{ $customer->skoring->profit_ramai }}">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Pendapatan Rata - Rata Perbulan Saat Kondisi Sepi</label>
                                        <input type="text" name="profit_sepi"
                                            placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Sepi"
                                            class="form-control" required readonly
                                            value="{{ $customer->skoring->profit_sepi }}">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Pendapatan Rata - Rata Perbulan Saat Kondisi Normal</label>
                                        <input type="text" name="profit_normal" id="normal_perbulan"
                                            placeholder="Pendapatan Rata - Rata Perbulan Saat Kondisi Normal"
                                            class="form-control" required readonly
                                            value="{{ $customer->skoring->profit_normal }}">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Persediaan Rata - Rata</label>
                                        <input type="text" name="persediaan_aset" placeholder="Persedian Rata - Rata"
                                            class="form-control" required readonly
                                            value="{{ $customer->skoring->persediaan_aset }}">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Kekayaan Berupa Fixed Asset</label>
                                        <input type="text" name="fixed_aset" placeholder="Kekayaan Berupa Fixed Asset"
                                            class="form-control" required readonly
                                            value="{{ $customer->skoring->fixed_aset }}">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Laba Usaha Perbulan</label>
                                        <input type="text" name="laba_perbulan" placeholder="Laba Usaha Perbulan"
                                            class="form-control" readonly id="laba_perbulan" required readonly
                                            value="{{ $customer->skoring->laba_perbulan }}">
                                        <input type="hidden" name="laba_pertahun" id="laba_pertahun_input">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <table>
                                            <tr>
                                                <th width="150">Jenis Pengajuan</th>
                                                <td width="10">:</td>
                                                <td>{{ ucwords($customer->jenis_pengajuan) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Dengan Penjamin</th>
                                                <td>:</td>
                                                <td>
                                                    @if ($customer->jenis_agunan !== null)
                                                        <input type="checkbox" readonly checked name="" id="">
                                                    @else
                                                        <input type="checkbox" name="" readonly id="">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kredit</th>
                                                <td>:</td>
                                                <td id="jenis_kredit">{{ strtoupper($customer->jenis_pinjaman) }}</td>
                                            </tr>
                                            <tr>
                                                <th> <span style="font-size: 15px;">
                                                        Tujuan Penggunaan
                                                    </span></th>
                                                <td>:</td>
                                                <td>{{ $customer->usaha->bidang_usaha }}</td>
                                            </tr>
                                            <tr>
                                                <th>Keterangan</th>
                                                <td>:</td>
                                                <td>{{ $customer->deskripsi }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tr>
                                                <th width="230">Limit Awal yang diminta</th>
                                                <td width="20">:</td>
                                                <td>@currency($customer->limit_kredit)</td>
                                            </tr>
                                            <tr>
                                                <th>Limit Yang disetujui</th>
                                                <td>:</td>
                                                <td id="td_limit"><input type="number" value="" id="limit_approve"
                                                        placeholder="Limit yang disetujui" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <th>Jangka Waktu /bulan</th>
                                                <td>:</td>
                                                <td><input type="text" id="jangka_waktu" placeholder="jangka waktu /bulan"
                                                        class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tingkat Suku Bunga</th>
                                                <td>:</td>
                                                <td id="suku_bunga">{{ $customer->calculation->bunga_per_tahun . '%' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Cicilan</th>
                                                <td>:</td>
                                                <td id="result"></td>
                                            </tr>
                                        </table>
                                        <button id="compute" class="btn btn-primary btn-sm rounded">Hitung</button>
                                        <button data-toggle="modal" data-target="#modalApprove" id="save" disabled
                                            class="btn btn-success btn-sm rounded">Approve</button>
                                        <button id="reject" data-toggle="modal" data-target="#rejectModal"
                                            class="btn btn-danger btn-sm rounded">Reject</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalApprove" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approval</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('approve.head_division', $customer->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <label for="">Pesan Approve</label>
                        <textarea name="approval_message" id="" cols="30" rows="10" class="form-control"></textarea>
                        <input type="hidden" name="type" value="approve">
                        <input type="hidden" name="limit_kredit" id="input_limit_kredit">
                        <input type="hidden" name="tenor" id="input_tenor">
                        <input type="hidden" name="jenis_kredit" id="input_jenis_kredit">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm rounded">Simpan</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approval Kepala Cabang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('approval.reject_credit', $customer->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="type" id="type">
                        <label for="" id="title_message">Pesan Reject</label>
                        <textarea name="approval_message" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-sm btn rounded btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm rounded btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let tenor = ''
        let limit_kredit = ''
        let instalment = ''
        let jenis_pinjaman = $("#jenis_kredit").text().toLowerCase()

        $("#compute").on('click', function() {
            limit_kredit = parseInt($("#limit_approve").val())
            tenor = $("#jangka_waktu").val()
            if (limit_kredit == '' || isNaN(limit_kredit)) {
                Swal.fire(
                    'Gagal',
                    'limit kredit harus diisi',
                    'error'
                )
                return false
            } else if (tenor == '') {
                Swal.fire(
                    'Gagal',
                    'Jangka waktu harus diisi',
                    'error'
                )
                return false
            }
            calculation(limit_kredit, jenis_pinjaman)
        })

        function rupiah(number) {
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

        function calculation(limit_kredit, jenis_pinjaman) {
            $.ajax({
                type: 'GET',
                url: `{{ route('credits.get_instalment') }}`,
                success: ({
                    data
                }) => {
                    data.forEach((item, index) => {
                        if (item.tipe == jenis_pinjaman && limit_kredit >= item.kredit_terkecil &&
                            limit_kredit < item.kredit_terbesar) {
                            instalment = Math.floor((limit_kredit / tenor) + (limit_kredit * item
                                .per_bulan / 100))
                        }
                    })
                    $("#result").empty()
                    $("#result").append("Rp. " + rupiah(instalment))
                    $("#input_limit_kredit").val(limit_kredit)
                    $("#input_tenor").val(tenor)
                    $("#input_jenis_kredit").val(jenis_pinjaman)
                    if ($("#result") != '') {
                        $("#save").prop('disabled', false)
                    }
                },
                error: err => console.log(err)
            })
        }
    </script>
@endpush
