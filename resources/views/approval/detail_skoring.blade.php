@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Skoring</h1>
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
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label for="">Limit Awal Yang Diminta</label>
                                        <input type="text" readonly value="@currency($customer->limit_kredit)"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Limit Yang Disetujui</label>
                                        <input type="text" readonly value="@currency($customer->limit_kredit)"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Jangka Waktu (Bulan)</label>
                                        <input type="text" readonly value="{{ $customer->jangka_waktu }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Tingkat Suku Bunga</label>
                                        <input type="text" readonly class="form-control"
                                            value="{{ $customer->calculation->bunga_per_tahun . '%' }}">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Cicilan Perbulan</label>
                                        <input type="text" readonly class="form-control"
                                            value="@currency($customer->calculation->bunga_per_bulan)">
                                    </div>
                                </div>
                                <Button id="approve" data-toggle="modal" data-target="#exampleModal"
                                    class="btn btn-success btn-sm rounded">Approve</Button>
                                <button id="reject" data-toggle="modal" data-target="#rejectModal"
                                    class="btn btn-danger btn-sm rounded">Tolak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approval Kepala Cabang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('approve.head_division', $customer->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="type" id="type">
                        <label for="" id="title_message">Pesan Approve</label>
                        <textarea name="approval_message" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-sm btn rounded btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm rounded btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $("#approve").on('click', function() {
            $("#title_message").text('Pesan Approve')
            $("#type").val('approve');
        })

        $("#reject").on('click', function() {
            $("#title_message").text('Pesan Reject')
            $("#type").val('reject');
        })
    </script>
@endpush
