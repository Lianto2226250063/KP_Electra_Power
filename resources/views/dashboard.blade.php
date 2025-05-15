@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Penjualan</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Invoice</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalInvoice }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Omzet</div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Penjualan Bulan Ini</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $monthlyInvoice }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Pegawai Teraktif</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $topEmployee ?? '-' }}</h5>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik penjualan per bulan --}}
    <div class="card mb-4">
        <div class="card-header">Grafik Penjualan per Bulan (Tahun {{ $selectedYear }})</div>
        <div class="card-body">
            <form method="GET" id="yearFilterForm" class="mb-3">
                <div class="form-group row">
                    <label for="year" class="col-sm-2 col-form-label">Pilih Tahun:</label>
                    <div class="col-sm-4">
                        <select name="year" id="year" class="form-control" onchange="document.getElementById('yearFilterForm').submit()">
                            @foreach ($availableYears as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-center">Jumlah Invoice</h5>
                    <div class="text-center mb-2">
                        <strong>Total Invoice Tahun {{ $selectedYear }}:</strong>
                        <span class="text-primary">{{ array_sum($salesChartData) }}</span>
                    </div>
                    <canvas id="invoiceChart"></canvas>
                </div>
                <div class="col-md-6">
                    <h5 class="text-center">Total Omzet</h5>
                    <div class="text-center mb-2">
                        <strong>Total Omzet Tahun {{ $selectedYear }}:</strong>
                        <span class="text-success">Rp {{ number_format(array_sum($salesChartOmzetData), 0, ',', '.') }}</span>
                    </div>
                    <canvas id="omzetChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($salesChartLabels) !!};

    const invoiceChart = new Chart(document.getElementById('invoiceChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Invoice',
                data: {!! json_encode($salesChartData) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });

    const omzetChart = new Chart(document.getElementById('omzetChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Omzet (Rp)',
                data: {!! json_encode($salesChartOmzetData) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
