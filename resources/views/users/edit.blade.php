@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
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
                                            <label for="">Username</label>
                                            <input class="form-control" value="{{ old('username', $user->username) }}"
                                                type="text" name="username" placeholder="username" required>
                                            @error('username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Password</label> <small>( isi password jika ingin diubah )</small>
                                            <input class="form-control" type="password" name="password"
                                                placeholder="password">
                                        </div>
                                        @if ($user->roles != 'superadmin')
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
                                        @endif
                                        <div class="col-md-6 form-group">
                                            <label for="">Employee</label>
                                            <select name="employee_id" id="" class="form-control">
                                                <option value="">-- Pilih Employee --</option>
                                                @foreach ($employees as $employee)
                                                    @if ($employee->employee_id == $user->employee_id)
                                                        <option value="{{ $employee->employee_id }}" selected>
                                                            {{ $employee->nama }}</option>
                                                    @else
                                                        <option value="{{ $employee->employee_id }}">
                                                            {{ $employee->nama }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-sm rounded">Simpan</button>
                                    <a href="{{ url()->previous() }}"
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
