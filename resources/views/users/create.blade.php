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
                                <form action="{{ route('users.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">NIP</label>
                                            <input type="text" class="form-control" placeholder="NIP" name="nip">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Nama Lengkap</label>
                                            <input class="form-control" type="text" name="fullname"
                                                placeholder="Nama Lengkap" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Username</label>
                                            <input class="form-control" type="text" name="username" placeholder="username"
                                                required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Password</label>
                                            <input class="form-control" type="password" name="password"
                                                placeholder="password" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Roles</label>
                                            <select name="roles" class="form-control" required>
                                                <option value="" selected>-- Pilih Roles --</option>
                                                <option value="mks">MKS</option>
                                                <option value="mka">MKA</option>
                                                <option value="kepala cabang">Kepala Cabang</option>
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
