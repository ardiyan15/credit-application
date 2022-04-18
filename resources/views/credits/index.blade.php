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
                                <a href="{{ route('credits.create') }}" class="btn btn-primary btn-sm rounded">Tambah
                                    Pengajuan Kredit</a>
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
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <a
                                                        href="{{ route('credits.show', $customer->id) }}">{{ $customer->nama_lengkap }}</a>
                                                </td>
                                                <td class="text-center">{{ $customer->no_ktp }}</td>
                                                <td class="text-center">{{ $customer->no_rekening }}</td>
                                                <td class="text-center">@currency($customer->limit_kredit)</td>
                                                <td class="text-center">
                                                    @if ($customer->approval_lv_1 == 0)
                                                        <span class="text-white badge badge-pill p-1 bg-warning">Pending
                                                            MKA</span>
                                                    @elseif($customer->approval_lv_1 == 3)
                                                        <span
                                                            class="text-white badge badge-pill pl-2 pr-2 bg-danger">Ditolak
                                                            MKA</span>
                                                    @elseif($customer->approval_lv_2 == 0)
                                                        <span class="text-white badge badge-pill p-1 bg-warning">Pending
                                                            K.Cabang</span>
                                                    @elseif($customer->approval_lv_2 == 2)
                                                        <span
                                                            class="text-white badge badge-pill pl-2 pr-2 bg-info">Revisi</span>
                                                    @elseif($customer->approval_lv_2 == 3)
                                                        <span
                                                            class="text-white badge badge-pill pl-2 pr-2 bg-danger">Ditolak
                                                            K. Cabang</span>
                                                    @else
                                                        <span
                                                            class="text-white badge badge-pill p-1 bg-success">Disetujui</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($customer->approval_lv_1 == 1 && $customer->approval_lv_2 == 0)
                                                        <span>{{ $customer->pesan_approval_lv_1 }}</span>
                                                    @elseif($customer->approval_lv_1 == 1 && $customer->approval_lv_2 == 1)
                                                        <span>{{ $customer->pesan_approval_lv_2 }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('credits.destroy', $customer->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if (($customer->approval_lv_1 == 0 && $customer->approval_lv_2 == 0) || ($customer->approval_lv_1 == 1 && $customer->approval_lv_2 == 2))
                                                            <a href="{{ route('credits.edit', $customer->id) }}"
                                                                class="btn btn-sm btn-info rounded">Edit</a>
                                                        @elseif($customer->approval_lv_1 == 1 && $customer->approval_lv_2 == 1)
                                                            <a target="_blank"
                                                                href="{{ route('credits.print', $customer->id) }}"
                                                                class="btn btn-success btn-sm rounded">Print</a>
                                                        @endif
                                                        <button
                                                            class="delete-confirm btn btn-sm btn-danger rounded">Hapus</button>
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
            let id = $(this).data('id')
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
