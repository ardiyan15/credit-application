@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Master User</h1>
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
                                    class="btn btn-primary btn-sm rounded pull-right">Tambah User</a>
                            </div>
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="background-color: #013066">
                                            <th class="text-center text-white">#</th>
                                            <th class="text-center text-white">Username</th>
                                            <th class="text-center text-white">Roles</th>
                                            <th class="text-center text-white">Tanggal Dibuat</th>
                                            <th class="text-center text-white">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $user->username }}</td>
                                                <td class="text-center">{{ $user->roles }}</td>
                                                <td class="text-center">{{ substr($user->created_at, 0, 10) }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-info btn-sm rounded">Ubah</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        @if (Auth::user()->id != $user->id)
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
