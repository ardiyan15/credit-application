@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container">

            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="credit" class="rounded shadow"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="accs" class="rounded shadow"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="reject_head" class="rounded shadow"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="reject_mka" class="rounded shadow"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let employeeData = JSON.parse(`<?php echo $result; ?>`)
        let accs = JSON.parse(`<?php echo $accs; ?>`)
        let reject_head = JSON.parse(`<?php echo $reject_head; ?>`)
        let reject_mka = JSON.parse(`<?php echo $reject_mka; ?>`)

        var ctx = document.getElementById('credit').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: [''],
                datasets: [{
                    label: 'Chart Total Debitur',
                    data: employeeData.total,
                }, ]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        },
                        scaleLabel: {
                            display: false
                        }
                    }]
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });

        var accsContainer = document.getElementById('accs').getContext('2d');
        var accsChart = new Chart(accsContainer, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: [''],
                datasets: [{
                    label: 'Chart Total Kredit Disetujui',
                    data: accs.total,
                }, ]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        },
                        scaleLabel: {
                            display: false
                        }
                    }]
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });

        var reject_head_container = document.getElementById('reject_head').getContext('2d');
        var reject_head_chart = new Chart(reject_head_container, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: [''],
                datasets: [{
                    label: 'Chart Total Kredit Ditolak Kepala Cabang',
                    data: reject_head.total,
                }, ]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        },
                        scaleLabel: {
                            display: false
                        }
                    }]
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });

        var reject_mka_container = document.getElementById('reject_mka').getContext('2d');
        var reject_mka_chart = new Chart(reject_mka_container, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: [''],
                datasets: [{
                    label: 'Chart Total Kredit Ditolak MKA',
                    data: reject_mka.total,
                }, ]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        },
                        scaleLabel: {
                            display: false
                        }
                    }]
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });
    </script>
@endpush
