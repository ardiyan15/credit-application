@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Skoring MKA</h1>
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
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="background-color: #013066">
                                            <th class="text-center text-white">#</th>
                                            <th class="text-center text-white">Nasabah</th>
                                            <th class="text-center text-white">Nomor KTP</th>
                                            <th class="text-center text-white">Nomor Rekening</th>
                                            <th class="text-center text-white">Limit Kredit</th>
                                            <th class="text-center text-white">Status</th>
                                            <th class="text-center text-white">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $customer->nama_lengkap }}</td>
                                                <td class="text-center">{{ $customer->no_ktp }}</td>
                                                <td class="text-center">{{ $customer->no_rekening }}</td>
                                                <td class="text-center">@currency($customer->limit_kredit)</td>
                                                <td class="text-center">
                                                    @if ($customer->skoring != null)
                                                        <span class="text-white badge badge-pill pl-2 pr-2 bg-success">
                                                            Sudah Ada Skoring</span>
                                                    @else
                                                        <span class="text-white badge badge-pill pl-2 pr-2 bg-danger">
                                                            Belum Ada Skroing</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($customer->skoring && Auth::user()->roles == 'mka')
                                                        <form action="{{ route('mks.destroy', $customer->skoring->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('mks.edit', $customer->skoring->id) }}"
                                                                class="btn btn-info btn-sm"><i class="fas fa-edit"
                                                                    title="Edit"></i></a>
                                                            <button class="delete-confirm btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash" aria-hidden="true"
                                                                    data-toggle="tooltip" title="Hapus"></i></button>
                                                            <a target="_blank"
                                                                href="{{ route('mks.print', $customer->skoring->id) }}"
                                                                class="btn btn-primary btn-sm"><i class="fas fa-print"
                                                                    title="Print"></i></a>
                                                        </form>
                                                    @endif
                                                    @if ($customer->skoring == null && Auth::user()->roles == 'mka')
                                                        <a href="{{ route('mks.add_skoring', $customer->id) }}"
                                                            class="btn btn-primary btn-sm"><i class="fa fa-star"
                                                                aria-hidden="true" data-toggle="tooltip"
                                                                title="Skoring"></i></a>
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
