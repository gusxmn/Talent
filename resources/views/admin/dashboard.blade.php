@extends('admin.layout')

@section('content')
<div class="container">
    <h3 class="mb-4">Dashboard Admin</h3>

    <div class="row">
        <!-- Grafik User berdasarkan Role -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Statistik User per Role
                </div>
                <div class="card-body">
                    <canvas id="userRoleChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Aktivitas User -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    Aktivitas User per Hari
                </div>
                <div class="card-body">
                    <canvas id="userActivityChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari Controller (PHP -> JS)
    const userRoles = @json($userRoles);
    const userActivities = @json($userActivities);

    // Chart Role
    const ctxRole = document.getElementById('userRoleChart').getContext('2d');
    new Chart(ctxRole, {
        type: 'pie',
        data: {
            labels: Object.keys(userRoles),
            datasets: [{
                label: 'Jumlah User',
                data: Object.values(userRoles),
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'],
            }]
        }
    });

    // Chart Aktivitas
    const ctxActivity = document.getElementById('userActivityChart').getContext('2d');
    new Chart(ctxActivity, {
        type: 'line',
        data: {
            labels: Object.keys(userActivities),
            datasets: [{
                label: 'Aktivitas User',
                data: Object.values(userActivities),
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28,200,138,0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });
</script>
@endsection
