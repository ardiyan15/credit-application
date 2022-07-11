@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Employee</h1>
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
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('employee.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NIP</label>
                                                <input type="text" name="nip" class="form-control" placeholder="NIP"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama</label>
                                                <input type="text" name="nama" class="form-control" placeholder="Nama"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">No Telepon</label>
                                                <input type="text" name="no_telepon" class="form-control"
                                                    placeholder="No Telepon" required maxlength="13" minlength="13">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Jabatan</label>
                                                <select name="jabatan" id="" class="form-control" required>
                                                    <option value="">-- Pilih Jabatan --</option>
                                                    <option value="MKS">MKS</option>
                                                    <option value="MKA">MKA</option>
                                                    <option value="BOS">BOS</option>
                                                    <option value="Teller">Teller</option>
                                                    <option value="Customer Service Representative">Customer Service
                                                        Representative</option>
                                                    <option value="Mikro Branch Manager">Mikro Branch Manager</option>
                                                    <option value="Branch Manager">Branch Manager</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Alamat</label>
                                                <textarea name="alamat" id="" cols="30" rows="5" class="form-control" placeholder="Alamat" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm rounded">Submit</button>
                                    <a href="{{ route('employee.index') }}"
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
