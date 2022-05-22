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
                            <div class="card-header">
                                <a href="{{ route('sukubunga.create') }}" class="btn btn-primary btn-sm rounded">Tambah
                                    Suku
                                    Bunga</a>
                            </div>
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="background-color: #013066">
                                            <th class="text-center text-white">#</th>
                                            <th class="text-center text-white">Jenis Pinjaman</th>
                                            <th class="text-center text-white">Range Kredit</th>
                                            <th class="text-center text-white">Bunga Per Bulan</th>
                                            <th class="text-center text-white">Bunga Per Tahun</th>
                                            <th class="text-center text-white">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ strtolower($item->tipe) }}</td>
                                                <td class="text-center">
                                                    @currency($item->kredit_terkecil) - @currency($item->kredit_terbesar)
                                                </td>
                                                <td class="text-center">{{ $item->per_bulan . '%' }}</td>
                                                <td class="text-center">{{ $item->per_tahun . '%' }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('sukubunga.destroy', $item->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a href="{{ route('sukubunga.edit', $item->id) }}"
                                                            class="text-center btn btn-info btn-sm rounded">Edit</a>
                                                        <button
                                                            class="delete-confirm text-center btn btn-danger btn-sm rounded">Hapus</button>
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

@push('scripts')
    <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Hapus Data',
                text: 'Ingin menghapus data?',
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: "Batal",
                focusConfirm: false,
            }).then((value) => {
                if (value.isConfirmed) {
                    $(this).closest("form").submit()
                }
            });
        });
    </script>
@endpush
