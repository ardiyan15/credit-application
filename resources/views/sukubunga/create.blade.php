@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Perhitungan Suku Bunga</h1>
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
                                <form method="POST" action="{{ route('sukubunga.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tipe</label>
                                                <select name="tipe" id="" class="form-control">
                                                    <option value="">-- Pilih Tipe --</option>
                                                    <option value="kur">KUR</option>
                                                    <option value="kum">KUM</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Kredit Terkecil</label>
                                                <input type="text" name="kredit_terkecil" class="form-control"
                                                    placeholder="Kredit Terkecil">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Kredit Terbesar</label>
                                                <input type="text" name="kredit_terbesar" class="form-control"
                                                    placeholder="Kredit Terbsesar">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Bunga Per Bulan (%)</label>
                                                <input type="text" name="per_bulan" class="form-control"
                                                    placeholder="Bunga Per bulan">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Bunga Per Tahun (%)</label>
                                                <input type="text" name="per_tahun" class="form-control"
                                                    placeholder="Bunga Per bulan">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm rounded">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
