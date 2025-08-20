@extends('layouts.admin.template')
@section('title', 'Dashboard')
@section('content')
    <div class="row g-6">

        <!-- Welcome -->
        <div class="col-md-12">
            <div class="card">
                <div class="d-flex align-items-center g-5 row">
                    <div class="col-7">
                        <div class="card-body text-nowrap d-flex flex-column gap-4">
                            <h5 class="card-title mb-0">Selamat datang kembali!</h5>
                            <p class="text-primary mb-2">🎉🎉 {{ \Auth::user()->name }} 🎉🎉</p>
                            <p class="text-muted mb-0 text-wrap">Semoga harimu penuh keberkahan dan dimudahkan dalam setiap
                                langkah 🤲
                            </p>
                        </div>

                    </div>
                    <div class="col-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('admin') }}/assets/img/illustrations/card-advance-sale.png" height="140"
                                alt="view sales" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Welcome -->

        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Statistik</h5>
                    <small class="text-muted">Bulan Ini</small>
                </div>
                <div class="card-body d-flex align-items-end">
                    <div class="w-100">
                        <div class="row gy-3">
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded bg-label-primary me-4 p-2">
                                        <i class="ti ti-chart-pie-2 ti-lg"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ \Helper::doubleToIdr($totalPendapatan) }}</h5>
                                        <small>Pendapatan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded bg-label-info me-4 p-2"><i class="ti ti-users ti-lg"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ $totalUserTransaksi }}</h5>
                                        <small>Pelanggan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded bg-label-danger me-4 p-2">
                                        <i class="ti ti-shopping-cart ti-lg"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ $totalProduct }}</h5>
                                        <small>Produk</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded bg-label-success me-4 p-2">
                                        <i class="ti ti-currency-dollar ti-lg"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ $totalTransaksi }}</h5>
                                        <small>Jumlah Transaksi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Transaksi Bulan {{ date('m') }} {{ date('Y') }}</h5>
                        <p class="card-subtitle my-0">Abaya</p>
                    </div>
                </div>
                <div class="card-body">
                    <div id="lineAreaChart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let cardColor, headingColor, labelColor, borderColor, legendColor;

        if (isDarkStyle) {
            cardColor = config.colors_dark.cardColor;
            headingColor = config.colors_dark.headingColor;
            labelColor = config.colors_dark.textMuted;
            legendColor = config.colors_dark.bodyColor;
            borderColor = config.colors_dark.borderColor;
        } else {
            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            labelColor = config.colors.textMuted;
            legendColor = config.colors.bodyColor;
            borderColor = config.colors.borderColor;
        }

        // Color constant
        const chartColors = {
            column: {
                series1: '#826af9',
                series2: '#d2b0ff',
                bg: '#f8d3ff'
            },
            donut: {
                series1: '#fee802',
                series2: '#F1F0F2',
                series3: '#826bf8',
                series4: '#3fd0bd'
            },
            area: {
                series1: '#29dac7',
                series2: '#60f2ca',
                series3: '#a5f8cd'
            },
            bar: {
                bg: '#1D9FF2'
            }
        };
        // Line Area Chart
        // --------------------------------------------------------------------
        const categories = @json($categories);
        const series = @json($series);
        console.log({
            name: series[0].name,
            data: Object.values(series[0].data)
        })
        const areaChartEl = document.querySelector('#lineAreaChart'),
            areaChartConfig = {
                chart: {
                    height: 400,
                    type: 'area',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: false,
                    curve: 'straight'
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'start',
                    labels: {
                        colors: legendColor,
                        useSeriesColors: false
                    }
                },
                grid: {
                    borderColor: borderColor,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                colors: [chartColors.area.series3, chartColors.area.series2, chartColors.area.series1],
                series: [{
                    name: series[0].name,
                    data: Object.values(series[0].data)
                }],
                xaxis: {
                    categories: categories,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '13px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '13px'
                        },
                        formatter: function(val) {
                            return val.toFixed(0);
                        }
                    }
                },
                fill: {
                    opacity: 1,
                    type: 'solid'
                },
                tooltip: {
                    shared: false
                }
            };
        if (typeof areaChartEl !== undefined && areaChartEl !== null) {
            const areaChart = new ApexCharts(areaChartEl, areaChartConfig);
            areaChart.render();
        }
    </script>
@endpush
