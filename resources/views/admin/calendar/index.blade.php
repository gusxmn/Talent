@extends('admin.layout')

@section('title', 'jangan males yaa')
@section('content')
@php
    // Ambil peran pengguna yang sedang login untuk logika tampilan
    $userRole = Auth::user()->role;
    $isEditable = in_array($userRole, ['admin', 'super admin']);
@endphp

<div class="container-fluid mt-4">
    <h2 class="mb-4 fw-bold text-secondary">kalender skejull</h2>

    <div class="row">
        {{-- Sidebar kiri (Hanya tampil untuk Admin/Super Admin) --}}
        @if ($isEditable)
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">geser aja</h5>

                        <div id="external-events">
                            <div class="fc-event bg-success text-white p-2 mb-2 rounded" data-color="bg-success">Meeting</div>
                            <div class="fc-event bg-warning text-dark p-2 mb-2 rounded" data-color="bg-warning">Go home</div>
                            <div class="fc-event bg-primary text-white p-2 mb-2 rounded" data-color="bg-primary">wawancara id 8</div>
                            <div class="fc-event bg-info text-white p-2 mb-2 rounded" data-color="bg-info">Test dev id 2</div>
                            <div class="fc-event bg-danger text-white p-2 mb-3 rounded" data-color="bg-danger">olahraga</div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="drop-remove">
                                <label class="form-check-label small" for="drop-remove">remove after drop</label>
                            </div>
                        </div>

                        <h6 class="fw-semibold mt-3 mb-2">Create Event</h6>
                        <div class="mb-2">
                            <span class="btn btn-success p-2 me-1 color-picker" data-color="bg-success"></span>
                            <span class="btn btn-primary p-2 me-1 color-picker" data-color="bg-primary"></span>
                            <span class="btn btn-warning p-2 me-1 color-picker" data-color="bg-warning"></span>
                            <span class="btn btn-danger p-2 me-1 color-picker" data-color="bg-danger"></span>
                            <span class="btn btn-secondary p-2 color-picker" data-color="bg-secondary"></span>
                        </div>

                        <div class="input-group">
                            <input type="text" id="new-event" class="form-control form-control-sm" placeholder="Event Title">
                            <button id="add-event" class="btn btn-primary btn-sm">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Kalender kanan --}}
        <div class="col-md-{{ $isEditable ? '9' : '12' }}">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FullCalendar CSS & JS --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.15/index.global.min.js"></script>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- 🌈 Soft Theme FullCalendar Style (CSS tidak diubah) --}}
<style>
    #calendar {
        background: #fdfdfd;
        border-radius: 16px;
        padding: 1rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        font-family: "Poppins", sans-serif;
    }

    .fc-toolbar-title {
        font-weight: 600;
        font-size: 1.3rem;
        color: #444;
    }

    .fc-button {
        background-color: #eef2f7 !important;
        border: none !important;
        color: #333 !important;
        border-radius: 8px !important;
        transition: all 0.2s ease;
    }

    .fc-button:hover {
        background-color: #dce3ef !important;
    }

    .fc-day-today {
        background-color: #fff7e6 !important;
        border: 1px solid #ffe7a3 !important;
    }

    .fc-event {
        border: none !important;
        border-radius: 10px !important;
        padding: 4px 8px !important;
        color: #fff !important;
        transition: all 0.2s ease-in-out;
        font-size: 0.85rem;
    }

    .fc-event:hover {
        transform: scale(1.03);
        filter: brightness(1.1);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isEditable = @json($isEditable); // Ambil status edit dari PHP

    // === Draggable External Events (Hanya untuk Admin) ===
    if (isEditable) {
        let containerEl = document.getElementById('external-events');
        new FullCalendar.Draggable(containerEl, {
            itemSelector: '.fc-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText.trim(),
                    classNames: [eventEl.getAttribute('data-color')]
                };
            }
        });
    }

    // === Calendar ===
    const calendarEl = document.getElementById('calendar');

    // Tentukan URL API berdasarkan rute saat ini (Admin vs Wawancara)
    const baseUrl = window.location.pathname.startsWith('/wawancara') 
                    ? '{{ route("wawancara.jadwal.index.events") }}'
                    : '{{ route("admin.calendar.index.events") }}';

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        // Nonaktifkan semua interaksi edit jika bukan Admin/Super Admin
        editable: isEditable, 
        droppable: isEditable, 
        selectable: isEditable,
        height: 700,
        locale: 'id',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        // 🔥 Muat event dari database
        events: {
            url: baseUrl, // Menggunakan URL yang disesuaikan
            method: "GET",
            failure: () => Swal.fire('Gagal!', 'Tidak dapat memuat event dari server. Pastikan data ada dan role Anda memiliki izin.', 'error')
        },

        // 🌈 Tambahkan warna random lembut ke tiap event (tetap aktif untuk semua role)
        eventDidMount: function(info) {
            const pastelColors = [
                '#74b9ff', '#55efc4', '#fab26f',
                '#a29bfe', '#ff7675', '#81ecec',
                '#fd79a8', '#ffeaa7'
            ];
            const randomColor = pastelColors[Math.floor(Math.random() * pastelColors.length)];
            info.el.style.backgroundColor = randomColor;
            info.el.style.borderColor = randomColor;
        },
        
        // INTERAKSI TAMBAHAN (Hanya untuk Admin/Super Admin)
        
        // Tambah event lewat klik kalender
        select: function(info) {
            if (!isEditable) return; // Nonaktifkan untuk Wawancara

            Swal.fire({
                title: 'Tambah Jadwal',
                input: 'text',
                inputLabel: 'Masukkan nama kegiatan:',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    fetch("{{ route('admin.calendar.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            title: result.value,
                            start: info.startStr,
                            end: info.endStr
                        })
                    })
                    .then(res => res.json())
                    .then(() => {
                        calendar.refetchEvents();
                        Swal.fire('Tersimpan!', 'Jadwal berhasil ditambahkan.', 'success');
                    })
                    .catch(() => Swal.fire('Error!', 'Gagal menambah jadwal.', 'error'));
                }
            });
        },

        // 🔥 Saat event eksternal di-drop ke kalender
        eventReceive: function(info) {
             if (!isEditable) return; // Nonaktifkan untuk Wawancara
             
            let event = info.event;
            fetch("{{ route('admin.calendar.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    title: event.title,
                    start: event.startStr,
                    end: event.endStr,
                    color: event.backgroundColor
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.id) event.setProp('id', data.id);
                Swal.fire('Tersimpan!', 'Event berhasil ditambahkan ke kalender.', 'success');
            })
            .catch(() => Swal.fire('Error!', 'Gagal menyimpan event.', 'error'));

            if (document.getElementById('drop-remove').checked) {
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },

        // 🔄 Update posisi event (drag & drop)
        eventDrop: function(info) {
            if (!isEditable) return; // Nonaktifkan untuk Wawancara
            
            fetch("{{ route('admin.calendar.update') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    id: info.event.id,
                    start: info.event.startStr,
                    end: info.event.endStr
                })
            })
            .then(res => res.json())
            .then(() => Swal.fire('Berhasil!', 'Jadwal berhasil diperbarui.', 'success'))
            .catch(() => Swal.fire('Error!', 'Gagal memperbarui jadwal.', 'error'));
        },

        // 🗑️ Hapus event (eventClick)
        eventClick: function(info) {
            if (!isEditable) {
                // Untuk Wawancara, klik hanya menampilkan detail, BUKAN hapus
                Swal.fire({
                    title: info.event.title,
                    html: `<b>Mulai:</b> ${info.event.start.toLocaleString('id-ID')}<br>
                           <b>Selesai:</b> ${info.event.end ? info.event.end.toLocaleString('id-ID') : 'N/A'}`,
                    icon: 'info',
                    confirmButtonText: 'Tutup'
                });
                return;
            }
            
            // Logika Hapus untuk Admin/Super Admin
            Swal.fire({
                title: 'Hapus Jadwal?',
                text: `Yakin ingin menghapus "${info.event.title}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    fetch("{{ route('admin.calendar.delete') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id: info.event.id })
                    })
                    .then(res => res.json())
                    .then(() => {
                        info.event.remove();
                        Swal.fire('Terhapus!', 'Jadwal berhasil dihapus.', 'success');
                    })
                    .catch(() => Swal.fire('Error!', 'Gagal menghapus jadwal.', 'error'));
                }
            });
        }
    });

    calendar.render();

    // === Tambah event manual ke sidebar (Hanya untuk Admin) ===
    if (isEditable) {
        let currentColor = 'bg-success';
        document.querySelectorAll('.color-picker').forEach(btn => {
            btn.addEventListener('click', () => {
                currentColor = btn.getAttribute('data-color');
            });
        });

        document.getElementById('add-event').addEventListener('click', () => {
            let val = document.getElementById('new-event').value.trim();
            if (val.length === 0) return;
            let newEvent = document.createElement('div');
            newEvent.classList.add('fc-event', 'p-2', 'mb-2', 'rounded', currentColor, 'text-white');
            newEvent.innerText = val;
            newEvent.setAttribute('data-color', currentColor);
            document.getElementById('external-events').prepend(newEvent);
            new FullCalendar.Draggable(newEvent.parentNode, {
                itemSelector: '.fc-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText.trim(),
                        classNames: [eventEl.getAttribute('data-color')]
                    };
                }
            });
            document.getElementById('new-event').value = '';
            Swal.fire('Berhasil!', 'Event baru ditambahkan ke sidebar.', 'success');
        });
    }
});
</script>
@endsection
