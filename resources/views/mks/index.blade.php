@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Skoring MKS</h1>
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
                                <a href="{{ route('mks.create') }}" class="btn btn-primary btn-sm rounded">Perhitungan
                                    MKS</a>
                            </div>
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nasabah</th>
                                            <th class="text-center">Nomor KTP</th>
                                            <th class="text-center">Nomor Rekening</th>
                                            <th class="text-center">Limit Kredit</th>
                                            <th class="text-center">Scoring</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($scores as $score)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $score->nasabah->nama_lengkap }}</td>
                                                <td class="text-center">{{ $score->nasabah->no_ktp }}</td>
                                                <td class="text-center">{{ $score->nasabah->no_rekening }}</td>
                                                <td class="text-center">@currency($score->nasabah->limit_kredit)</td>
                                                <td class="text-center">@currency($score->skor)</td>
                                                <td class="text-center">
                                                    <form action="{{ route('mks.destroy', $score->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('mks.edit', $score->id) }}"
                                                            class="btn btn-info btn-sm">Edit</a>
                                                        <button class="delete-confirm btn btn-danger btn-sm">Hapus</button>
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
