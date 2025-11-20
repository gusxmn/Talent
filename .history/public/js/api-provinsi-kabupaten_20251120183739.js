/**
 * DOKUMENTASI API PROVINSI & KABUPATEN
 * =====================================
 * 
 * Endpoint yang tersedia:
 * 1. GET /admin/reference/provinsi/api/list - Ambil semua provinsi
 * 2. GET /admin/reference/kabupaten/api/list - Ambil semua kabupaten
 * 3. GET /admin/reference/kabupaten/api/provinsi/{provinsiId} - Ambil kabupaten by provinsi
 */

// =============================================================================
// CONTOH 1: FETCH SEMUA PROVINSI
// =============================================================================
async function ambilSemuaProvinsi() {
    try {
        const response = await fetch('/admin/reference/provinsi/api/list');
        const data = await response.json();
        
        if (data.success) {
            console.log('Provinsi:', data.data);
            // data.data adalah array of provinsi
            // Setiap item memiliki: id, kode_provinsi, nama_provinsi, status
            return data.data;
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// =============================================================================
// CONTOH 2: FETCH SEMUA KABUPATEN
// =============================================================================
async function ambilSemuaKabupaten() {
    try {
        const response = await fetch('/admin/reference/kabupaten/api/list');
        const data = await response.json();
        
        if (data.success) {
            console.log('Kabupaten:', data.data);
            // data.data adalah array of kabupaten
            // Setiap item memiliki: id, kode_kabupaten, nama_kabupaten, jenis, provinsi_id
            return data.data;
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// =============================================================================
// CONTOH 3: FETCH KABUPATEN DARI PROVINSI TERTENTU
// =============================================================================
async function ambilKabupatenByProvinsi(provinsiId) {
    try {
        const response = await fetch(`/admin/reference/kabupaten/api/provinsi/${provinsiId}`);
        const data = await response.json();
        
        if (data.success) {
            console.log('Kabupaten di provinsi ini:', data.data);
            return data.data;
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// =============================================================================
// CONTOH 4: POPULATE DROPDOWN PROVINSI
// =============================================================================
async function populateProvins iDropdown(selectElementId) {
    const provinsis = await ambilSemuaProvinsi();
    const select = document.getElementById(selectElementId);
    
    if (provinsis) {
        provinsis.forEach(provinsi => {
            const option = document.createElement('option');
            option.value = provinsi.id;
            option.textContent = `${provinsi.kode_provinsi} - ${provinsi.nama_provinsi}`;
            select.appendChild(option);
        });
    }
}

// =============================================================================
// CONTOH 5: DYNAMIC KABUPATEN DROPDOWN (Trigger saat Provinsi berubah)
// =============================================================================
async function populateKabupatenDropdown(provinsiSelectId, kabupatenSelectId) {
    const provinsiSelect = document.getElementById(provinsiSelectId);
    const kabupatenSelect = document.getElementById(kabupatenSelectId);
    
    provinsiSelect.addEventListener('change', async function() {
        const provinsiId = this.value;
        
        // Clear kabupaten options
        kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
        
        if (provinsiId) {
            const kabupatens = await ambilKabupatenByProvinsi(provinsiId);
            
            if (kabupatens) {
                kabupatens.forEach(kabupaten => {
                    const option = document.createElement('option');
                    option.value = kabupaten.id;
                    option.textContent = `${kabupaten.kode_kabupaten} - ${kabupaten.nama_kabupaten} (${kabupaten.jenis})`;
                    kabupatenSelect.appendChild(option);
                });
            }
        }
    });
}

// =============================================================================
// CONTOH 6: POPULATE DENGAN FILTER (Hanya Aktif)
// =============================================================================
async function populateProvinsiDropdownAktif(selectElementId) {
    const provinsis = await ambilSemuaProvinsi();
    const select = document.getElementById(selectElementId);
    
    if (provinsis) {
        // Filter hanya yang status true (aktif)
        const aktif = provinsis.filter(p => p.status);
        
        aktif.forEach(provinsi => {
            const option = document.createElement('option');
            option.value = provinsi.id;
            option.textContent = provinsi.nama_provinsi;
            select.appendChild(option);
        });
    }
}

// =============================================================================
// CONTOH 7: BUILD TABLE DARI API DATA
// =============================================================================
async function buildProvinsiTable(containerId) {
    const provinsis = await ambilSemuaProvinsi();
    const container = document.getElementById(containerId);
    
    if (!provinsis || provinsis.length === 0) {
        container.innerHTML = '<p>Tidak ada data provinsi</p>';
        return;
    }
    
    let html = `
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
    `;
    
    provinsis.forEach((provinsi, index) => {
        const statusBadge = provinsi.status 
            ? '<span class="badge bg-success">Aktif</span>' 
            : '<span class="badge bg-danger">Nonaktif</span>';
        
        html += `
            <tr>
                <td>${index + 1}</td>
                <td><code>${provinsi.kode_provinsi}</code></td>
                <td>${provinsi.nama_provinsi}</td>
                <td>${statusBadge}</td>
            </tr>
        `;
    });
    
    html += `
            </tbody>
        </table>
    `;
    
    container.innerHTML = html;
}

// =============================================================================
// CONTOH 8: SEARCH & FILTER DATA
// =============================================================================
async function searchProvinsi(searchQuery) {
    const provinsis = await ambilSemuaProvinsi();
    
    const hasil = provinsis.filter(p => 
        p.nama_provinsi.toLowerCase().includes(searchQuery.toLowerCase()) ||
        p.kode_provinsi.toLowerCase().includes(searchQuery.toLowerCase())
    );
    
    return hasil;
}

// =============================================================================
// CONTOH PENGGUNAAN DI HTML
// =============================================================================
/*

<body>
    <!-- Dropdown Provinsi -->
    <div class="mb-3">
        <label for="provinsiSelect">Provinsi:</label>
        <select id="provinsiSelect" class="form-control">
            <option value="">-- Pilih Provinsi --</option>
        </select>
    </div>

    <!-- Dropdown Kabupaten (akan di-populate otomatis) -->
    <div class="mb-3">
        <label for="kabupatenSelect">Kabupaten:</label>
        <select id="kabupatenSelect" class="form-control">
            <option value="">-- Pilih Kabupaten --</option>
        </select>
    </div>

    <script src="path/to/this-file.js"></script>
    <script>
        // Saat halaman load, populate dropdown Provinsi
        document.addEventListener('DOMContentLoaded', function() {
            populateProvinsiDropdown('provinsiSelect');
            populateKabupatenDropdown('provinsiSelect', 'kabupatenSelect');
        });
    </script>
</body>

*/

// =============================================================================
// CONTOH 9: COMBINE DENGAN FORM SUBMISSION
// =============================================================================
async function handleFormSubmit(event) {
    event.preventDefault();
    
    const provinsiId = document.getElementById('provinsiSelect').value;
    const kabupatenId = document.getElementById('kabupatenSelect').value;
    
    // Ambil data lengkap
    const provinsis = await ambilSemuaProvinsi();
    const kabupatens = await ambilKabupatenByProvinsi(provinsiId);
    
    const provinsi = provinsis.find(p => p.id == provinsiId);
    const kabupaten = kabupatens.find(k => k.id == kabupatenId);
    
    const formData = {
        provinsi: {
            id: provinsi.id,
            kode: provinsi.kode_provinsi,
            nama: provinsi.nama_provinsi
        },
        kabupaten: {
            id: kabupaten.id,
            kode: kabupaten.kode_kabupaten,
            nama: kabupaten.nama_kabupaten,
            jenis: kabupaten.jenis
        }
    };
    
    console.log('Form Data:', formData);
    
    // Kirim ke server
    // await fetch('/your-endpoint', {
    //     method: 'POST',
    //     headers: { 'Content-Type': 'application/json' },
    //     body: JSON.stringify(formData)
    // });
}

// =============================================================================
// CONTOH 10: ERROR HANDLING
// =============================================================================
async function fetchWithErrorHandling(url) {
    try {
        const response = await fetch(url);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.message || 'API error');
        }
        
        return data.data;
        
    } catch (error) {
        console.error('Fetch error:', error);
        alert(`Error: ${error.message}`);
        return null;
    }
}

// =============================================================================
// CONTOH RESPONSE FORMAT
// =============================================================================
/*

RESPONSE PROVINSI (Success):
{
    "success": true,
    "data": [
        {
            "id": 1,
            "kode_provinsi": "11",
            "nama_provinsi": "Aceh",
            "status": true
        },
        {
            "id": 2,
            "kode_provinsi": "12",
            "nama_provinsi": "Sumatera Utara",
            "status": true
        }
    ]
}

RESPONSE KABUPATEN (Success):
{
    "success": true,
    "data": [
        {
            "id": 1,
            "kode_kabupaten": "1101",
            "nama_kabupaten": "Aceh Barat",
            "jenis": "Kabupaten",
            "provinsi_id": 1
        }
    ]
}

ERROR RESPONSE:
{
    "success": false,
    "message": "Gagal mengambil data: ..."
}

*/
