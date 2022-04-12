@extends('layouts.app')
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
                                <form action="{{ route('mks.store') }}" method="POST">
                                    @csrf
                                    <div class="col-lg-6 form-group">
                                        <label for="">Nasabah</label>
                                        <select name="nasabah_id" id="nasabah_id" class="form-control">
                                            <option value="">-- Pilih Nasabah --</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->nama_lengkap }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tr>
                                                <th width="150">No KTP</th>
                                                <td width="40">:</td>
                                                <td id="no_ktp" width="200"></td>
                                                <th width="150">Jenis Agunan</th>
                                                <td width="40">:</td>
                                                <td id="jenis_agunan"></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <td>:</td>
                                                <td id="name"></td>
                                            </tr>
                                            <tr>
                                                <th>Limit Kredit</th>
                                                <td>:</td>
                                                <td id="credit_limit"></td>
                                            </tr>
                                            <tr>
                                                <th>Tenor</th>
                                                <td>:</td>
                                                <td id="tenor"></td>
                                            </tr>
                                            <tr>
                                                <th>Cicilan Perbulan</th>
                                                <td>:</td>
                                                <td id="cicilan"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="col-lg-6">
                                        <label for="">Skoring</label>
                                        <input type="text" name="skor" placeholder="Skoring" class="form-control">
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
                    $("#jenis_agunan").text(data.jenis_agunan)
                },
                error: err => console.log(err)
            })
        })
    </script>
@endpush
