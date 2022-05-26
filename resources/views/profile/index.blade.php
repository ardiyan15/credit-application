@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile User</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td class="text-bold" width="100">Username</td>
                                        <td width="20">:</td>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Employee</td>
                                        <td>:</td>
                                        <td>{{ $user->employee->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Roles</td>
                                        <td>:</td>
                                        <td>{{ $user->roles }}</td>
                                    </tr>
                                </table>
                                <a href="{{ route('profile.edit', $user->id) }}"
                                    class="btn btn-info btn-sm rounded mt-3">Ubah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
