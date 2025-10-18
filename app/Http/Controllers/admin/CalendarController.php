<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ✅ Tambahkan ini
use App\Models\Calendar;

class CalendarController extends Controller
{
    // Ambil semua event dari database untuk ditampilkan di kalender
    public function fetchEvents()
    {
        $events = Calendar::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'backgroundColor' => $event->backgroundColor ?? '#3788d8',
                'borderColor' => $event->borderColor ?? '#3788d8',
            ];
        });
        return response()->json($events);
    }

    // Simpan event baru ke database
    public function store(Request $request)
    {
        $event = Calendar::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'backgroundColor' => $request->backgroundColor ?? '#3788d8',
            'borderColor' => $request->borderColor ?? '#3788d8',
        ]);

        return response()->json($event);
    }

    // Hapus event
    public function destroy(Request $request)
    {
        $event = Calendar::find($request->id);
        if ($event) {
            $event->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error', 'message' => 'Event tidak ditemukan'], 404);
    }
}