@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="userChart" class="rounded shadow"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="contractChart" class="rounded shadow"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
