@extends('admin.layout')

@section('title', 'Manajemen Jadwal')

@section('content')
<div class="container">
    <h2 class="mb-4">Kalender Jadwal</h2>

    {{-- Elemen kalender yang akan dirender FullCalendar --}}
    <div id="calendar"></div>
</div>
@endsection

@push('styles')
    {{-- FullCalendar CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
    <style>
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }
    </style>
@endpush

@push('scripts')
    {{-- FullCalendar JS --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: '{{ route("admin.schedules.events") }}', // ambil dari controller
                    eventClick: function(info) {
                        info.jsEvent.preventDefault();
                        if (info.event.url) {
                            window.location.href = info.event.url;
                        }
                    }
                });
                calendar.render();
            }
        });
    </script>
@endpush
