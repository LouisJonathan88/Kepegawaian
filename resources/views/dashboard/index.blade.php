@extends('layouts.dashboard')

@section('content')
<style>
    .card-dashboard {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-dashboard:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .dashboard-icon {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    .card-dashboard:hover .dashboard-icon {
        opacity: 1;
    }
    @media (max-width: 768px) {
        .display-6 {
            font-size: 1.5rem;
        }
    }
    .card-dashboard .display-6 {
        font-size: 1.5rem;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    @media (max-width: 992px) {
        .card-dashboard .display-6 {
            font-size: 1.2rem;
        }
    }
</style>
<div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')

        <!-- Konten Utama -->
        <main class="col-md-10 ms-sm-auto px-md-4">
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card border-primary card-dashboard">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-people fs-2 text-primary dashboard-icon"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Total Pegawai</h5>
                                <p class="display-6 fw-bold mb-0">{{ $totalEmployees }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-primary card-dashboard">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-building fs-2 text-primary dashboard-icon"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Total Departemen</h5>
                                <p class="display-6 fw-bold mb-0">{{ $totalDepartments }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-primary card-dashboard">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-briefcase fs-2 text-primary dashboard-icon"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Total Jabatan</h5>
                                <p class="display-6 fw-bold mb-0">{{ $totalPositions }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-primary card-dashboard">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-cash-coin fs-2 text-primary dashboard-icon"></i>
                            </div>
                            <div class="w-100 overflow-hidden">
                                <h5 class="card-title mb-0">Total Gaji</h5>
                                <p class="display-6 fw-bold mb-0" style="word-break: break-all;">
                                    Rp.{{ number_format($totalSalary, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Pegawai per Departemen</h5>
                            <div style="height: 290px;">
                                <canvas id="departmentChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Rata-Rata Gaji per Departemen</h5>
                            <canvas id="salaryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart Pegawai per Departemen
    const ctxDepartment = document.getElementById('departmentChart').getContext('2d');
    const employeesByDepartment = @json($employeesByDepartment);

    new Chart(ctxDepartment, {
    type: 'pie',
    data: {
        labels: employeesByDepartment.map(dept => dept.nama_departemen),
        datasets: [{
            data: employeesByDepartment.map(dept => dept.total_pegawai),
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(153, 102, 255, 0.8)',
                'rgba(255, 159, 64, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
            padding: 10
        },
        animation: {
            animateRotate: true,
            animateScale: true,
        },
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 20,
                    padding: 5,
                    font: {
                        size: 10
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                        let percentage = ((context.parsed / total) * 100).toFixed(1);
                        return `${context.label}: ${context.parsed} (${percentage}%)`;
                    }
                }
            }
        }
    }
});

    // Chart Gaji per Departemen
    const ctxSalary = document.getElementById('salaryChart').getContext('2d');
    const salaryByDepartment = @json($salaryByDepartment);

    new Chart(ctxSalary, {
        type: 'bar',
        data: {
            labels: salaryByDepartment.map(dept => dept.nama_departemen),
            datasets: [{
                label: 'Rata-rata Gaji',
                data: salaryByDepartment.map(dept => dept.rata_rata_gaji),
                backgroundColor: [
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(255, 99, 132, 0.8)'
                ]
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
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endpush