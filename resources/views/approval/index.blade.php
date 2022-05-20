@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Approval Kepala Cabang</h1>
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
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    {{ $customer->nama_lengkap }}
                                                </td>
                                                <td class="text-center">{{ $customer->no_ktp }}</td>
                                                <td class="text-center">{{ $customer->no_rekening }}</td>
                                                <td class="text-center">@currency($customer->limit_kredit)</td>
                                                <td class="text-center">
                                                    @if ($customer->approval_lv_2 == 0)
                                                        <span class="text-white badge badge-pill pl-2 pr-2 bg-danger">
                                                            Belum diapprove</span>
                                                    @else
                                                        <span class="text-white badge badge-pill pl-2 pr-2 bg-success">
                                                            Sudah diapprove</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($customer->approval_lv_2 == 0)
                                                        <a href="{{ route('approval.detail', $customer->id) }}"
                                                            class="btn btn-info btn-sm">Approval</a>
                                                    @endif
                                                </td>
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
@endsection
