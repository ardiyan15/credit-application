@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah User</h1>
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
                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Nama Lengkap</label>
                                            <input class="form-control" value="{{ $user->fullname }}" type="text"
                                                name="fullname" placeholder="Nama Lengkap" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Username</label>
                                            <input class="form-control" value="{{ $user->username }}" type="text"
                                                name="username" placeholder="username" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Password</label> <small>( isi password jika ingin diubah )</small>
                                            <input class="form-control" type="password" name="password"
                                                placeholder="password">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Roles</label>
                                            <select name="roles" class="form-control" required>
                                                <option value="" selected>-- Pilih Roles --</option>
                                                @foreach ($roles as $role)
                                                    @if ($role['value'] == $user->roles)
                                                        <option value="{{ $role['value'] }}" selected>
                                                            {{ $role['name'] }}</option>
                                                    @else
                                                        <option value="{{ $role['value'] }}">{{ $role['name'] }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-sm rounded">Simpan</button>
                                    <a href="{{ route('users.index') }}"
                                        class="btn btn-secondary btn-sm rounded">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
