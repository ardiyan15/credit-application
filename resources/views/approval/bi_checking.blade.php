@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Approval BI Checking</h1>
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
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama Lengkap</th>
                                            <th class="text-center">Nomor KTP</th>
                                            <th class="text-center">Nomor Rekening</th>
                                            <th class="text-center">Limit Kredit</th>
                                            <th class="text-center">Opsi</th>
                                            <th hidden></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    @if (Auth::user()->roles != 'kepala cabang')
                                                        <a href="{{ route('approval.show', $customer->id) }}">
                                                            {{ $customer->nama_lengkap }}
                                                        </a>
                                                    @else
                                                        <a href="{{ route('approval.skoring', $customer->id) }}">
                                                            {{ $customer->nama_lengkap }}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $customer->no_ktp }}</td>
                                                <td class="text-center">{{ $customer->no_rekening }}</td>
                                                <td class="text-center">@currency($customer->limit_kredit)</td>
                                                <td class="text-center">
                                                    <button data-toggle="modal" data-target="#approve"
                                                        class="approve btn btn-primary btn-sm rounded">Approve</button>
                                                    <button data-toggle="modal" data-target="#reject"
                                                        class="reject btn btn-danger btn-sm rounded">Reject</button>
                                                </td>
                                                <td hidden class="id_customer">{{ $customer->id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="approve" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approve</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('approval.bi_checking_approval') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_customer" id="id_customer_input" value="">
                        <input type="hidden" name="type" value="approve">
                        <label for="">Pesan Approve</label>
                        <textarea name="pesan_approve" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm rounded">Simpan</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reject" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('approval.bi_checking_approval') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_customer" id="id_customer_input_reject" value="">
                        <input type="hidden" name="type" value="reject">
                        <label for="">Pesan Reject</label>
                        <textarea name="pesan_approve" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(".approve").on('click', function() {
            let idCustomer = $(this).closest('tr').find('.id_customer').text()
            $("#id_customer_input").val(idCustomer)
        })

        $(".reject").on('click', function() {
            let idCustomer = $(this).closest('tr').find('.id_customer').text()
            $("#id_customer_input_reject").val(idCustomer)
        })
    </script>
@endpush
