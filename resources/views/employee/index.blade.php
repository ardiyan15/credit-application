@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Master Employee</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('users.create') }}"
                                    class="btn btn-primary btn-sm rounded pull-right">Tambah Employee</a>
                            </div>
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Roles</th>
                                            <th class="text-center">Tanggal Dibuat</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $employee->nip }}</td>
                                                <td class="text-center">{{ $employee->nama }}</td>
                                                <td class="text-center">{{ substr($employee->created_at, 0, 10) }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('users.destroy', $employee->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('users.edit', $employee->id) }}"
                                                            class="btn btn-info btn-sm rounded">Ubah</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        @if (Auth::user()->id != $employee->id)
                                                            <button onclick="return confirm('Ingin menghapus data?')"
                                                                class="btn btn-danger btn-sm rounded delete-confirm">Hapus</button>
                                                        @endif
                                                    </form>
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
