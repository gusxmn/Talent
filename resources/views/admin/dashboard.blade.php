@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <div class="col-md-4">
            <canvas id="userRoleChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="lokasiChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="userActivityChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // === Grafik User Role (Pie) ===
    const userRoleCtx = document.getElementById('userRoleChart');
    new Chart(userRoleCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($userRoles->keys()) !!},
            datasets: [{
                label: 'Jumlah User',
                data: {!! json_encode($userRoles->values()) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderWidth: 1
            }]
        }
    });

    // === Grafik Lokasi per Provinsi (Bar) ===
    const lokasiCtx = document.getElementById('lokasiChart');
    new Chart(lokasiCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($lokasiStats->keys()) !!},
            datasets: [{
                label: 'Jumlah Lokasi',
                data: {!! json_encode($lokasiStats->values()) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            }
        }
    });

    // === Grafik Aktivitas User per Hari (Line) ===
    const activityCtx = document.getElementById('userActivityChart');
    new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($userActivities->keys()) !!}, // tanggal
            datasets: [{
                label: 'Aktivitas User',
                data: {!! json_encode($userActivities->values()) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.3,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
