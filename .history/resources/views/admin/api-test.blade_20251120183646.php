@extends('admin.layout')

@section('title', 'Test API Provinsi & Kabupaten')
@section('content')

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-4">📡 Test API Provinsi & Kabupaten</h1>
        </div>
    </div>

    <div class="row">
        <!-- API Provinsi -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-map"></i> API Provinsi</h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-info btn-sm mb-3" onclick="fetchProvinsi()">
                        <i class="fas fa-sync"></i> Load Data Provinsi
                    </button>
                    <div id="provinsiContainer" style="max-height: 500px; overflow-y: auto;">
                        <p class="text-muted">Klik tombol untuk memuat data...</p>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        URL: <code>/admin/reference/provinsi/api/list</code>
                    </small>
                </div>
            </div>
        </div>

        <!-- API Kabupaten -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-city"></i> API Kabupaten</h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-info btn-sm mb-3" onclick="fetchKabupaten()">
                        <i class="fas fa-sync"></i> Load Data Kabupaten
                    </button>
                    <div id="kabupatenContainer" style="max-height: 500px; overflow-y: auto;">
                        <p class="text-muted">Klik tombol untuk memuat data...</p>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        URL: <code>/admin/reference/kabupaten/api/list</code>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- API Kabupaten by Provinsi -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> API Kabupaten by Provinsi</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="provinsiSelect" class="form-label">Pilih Provinsi:</label>
                            <select id="provinsiSelect" class="form-select form-select-sm" onchange="fetchKabupatenByProvinsi()">
                                <option value="">-- Pilih Provinsi --</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label d-block">&nbsp;</label>
                            <button class="btn btn-warning btn-sm" onclick="fetchKabupatenByProvinsi()">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                    </div>
                    <div id="kabupatenByProvinsiContainer" style="max-height: 400px; overflow-y: auto;">
                        <p class="text-muted">Pilih provinsi untuk melihat kabupatennnya...</p>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        URL: <code>/admin/reference/kabupaten/api/provinsi/{provinsiId}</code>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .api-table {
        font-size: 12px;
    }
    .api-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .json-response {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 12px;
        font-family: 'Courier New', monospace;
        font-size: 11px;
        white-space: pre-wrap;
        word-break: break-word;
        max-height: 300px;
        overflow-y: auto;
    }
</style>

<script>
// Fetch Provinsi
async function fetchProvinsi() {
    const container = document.getElementById('provinsiContainer');
    container.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div> Loading...';
    
    try {
        const response = await fetch('/admin/reference/provinsi/api/list');
        const data = await response.json();
        
        if (data.success && data.data.length > 0) {
            let html = `
                <table class="table table-sm api-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            data.data.forEach(provinsi => {
                html += `
                    <tr>
                        <td>${provinsi.id}</td>
                        <td><code>${provinsi.kode_provinsi}</code></td>
                        <td>${provinsi.nama_provinsi}</td>
                        <td><span class="badge ${provinsi.status ? 'bg-success' : 'bg-danger'}">${provinsi.status ? 'Aktif' : 'Nonaktif'}</span></td>
                    </tr>
                `;
            });
            
            html += `
                    </tbody>
                </table>
                <small class="text-muted d-block mt-2">Total: ${data.data.length} provinsi</small>
            `;
            
            container.innerHTML = html;
        } else {
            container.innerHTML = '<div class="alert alert-warning">Tidak ada data provinsi</div>';
        }
    } catch (error) {
        container.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
    }
}

// Fetch Kabupaten
async function fetchKabupaten() {
    const container = document.getElementById('kabupatenContainer');
    container.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div> Loading...';
    
    try {
        const response = await fetch('/admin/reference/kabupaten/api/list');
        const data = await response.json();
        
        if (data.success && data.data.length > 0) {
            let html = `
                <table class="table table-sm api-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            data.data.forEach(kabupaten => {
                html += `
                    <tr>
                        <td>${kabupaten.id}</td>
                        <td><code>${kabupaten.kode_kabupaten}</code></td>
                        <td>${kabupaten.nama_kabupaten}</td>
                        <td>${kabupaten.jenis}</td>
                    </tr>
                `;
            });
            
            html += `
                    </tbody>
                </table>
                <small class="text-muted d-block mt-2">Total: ${data.data.length} kabupaten</small>
            `;
            
            container.innerHTML = html;
        } else {
            container.innerHTML = '<div class="alert alert-warning">Tidak ada data kabupaten</div>';
        }
    } catch (error) {
        container.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
    }
}

// Load Provinsi ke dropdown
async function loadProvinsiBatch() {
    try {
        const response = await fetch('/admin/reference/provinsi/api/list');
        const data = await response.json();
        
        if (data.success && data.data.length > 0) {
            const select = document.getElementById('provinsiSelect');
            data.data.forEach(provinsi => {
                const option = document.createElement('option');
                option.value = provinsi.id;
                option.textContent = provinsi.nama_provinsi;
                select.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading provinsi:', error);
    }
}

// Fetch Kabupaten by Provinsi
async function fetchKabupatenByProvinsi() {
    const provinsiId = document.getElementById('provinsiSelect').value;
    const container = document.getElementById('kabupatenByProvinsiContainer');
    
    if (!provinsiId) {
        container.innerHTML = '<p class="text-muted">Pilih provinsi untuk melihat kabupatennnya...</p>';
        return;
    }
    
    container.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div> Loading...';
    
    try {
        const response = await fetch(`/admin/reference/kabupaten/api/provinsi/${provinsiId}`);
        const data = await response.json();
        
        if (data.success && data.data.length > 0) {
            let html = `
                <table class="table table-sm api-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            data.data.forEach(kabupaten => {
                html += `
                    <tr>
                        <td>${kabupaten.id}</td>
                        <td><code>${kabupaten.kode_kabupaten}</code></td>
                        <td>${kabupaten.nama_kabupaten}</td>
                        <td>${kabupaten.jenis}</td>
                    </tr>
                `;
            });
            
            html += `
                    </tbody>
                </table>
                <small class="text-muted d-block mt-2">Total: ${data.data.length} kabupaten di provinsi ini</small>
            `;
            
            container.innerHTML = html;
        } else {
            container.innerHTML = '<div class="alert alert-warning">Tidak ada data kabupaten untuk provinsi ini</div>';
        }
    } catch (error) {
        container.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
    }
}

// Load provinsi dropdown on page load
document.addEventListener('DOMContentLoaded', loadProvinsiBatch);
</script>

@endsection
