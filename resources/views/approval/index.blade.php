@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>List Pengajuan Kredit</h1>
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
                                            <th class="text-center">Nomor Handphone</th>
                                            <th class="text-center">Limit Kredit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('approval.show', $customer->id) }}">
                                                        {{ $customer->nama_lengkap }}
                                                    </a>
                                                </td>
                                                <td class="text-center">{{ $customer->no_ktp }}</td>
                                                <td class="text-center">{{ $customer->no_telepon }}</td>
                                                <td class="text-center">{{ $customer->limit_kredit }}</td>
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
