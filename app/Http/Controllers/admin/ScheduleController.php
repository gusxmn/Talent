<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    // Halaman kalender
    public function index()
    {
        return view('admin.schedules.index');
    }

    // API ambil jadwal untuk FullCalendar (AJAX)
    public function events(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);
        $status = $request->get('status');

        $schedules = Schedule::query()
            ->with(['application.user', 'application.jobListing', 'creator'])
            ->whereYear('start_time', $year)
            ->whereMonth('start_time', $month)
            ->when($status, function ($query, $status) {
                $query->whereHas('application', function ($q) use ($status) {
                    $q->where('status', $status);
                });
            })
            ->orderBy('start_time')
            ->get();

        // Format untuk FullCalendar
        $events = $schedules->map(function ($s) {
            return [
                'id'    => $s->id,
                'title' => $s->application->user->name . ' - ' . ucfirst(str_replace('_', ' ', $s->type)),
                'start' => $s->start_time,
                'end'   => $s->end_time,
                'extendedProps' => [
                    'location' => $s->location,
                    'notes'    => $s->notes,
                    'status'   => $s->application->status,
                ]
            ];
        });

        return response()->json($events);
    }

    // Simpan jadwal
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'type' => ['required', Rule::in(['interview_hr', 'technical_test', 'final_interview', 'onboarding'])],
            'start_time' => 'required|date|after:now',
            'end_time' => 'nullable|date|after:start_time',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $schedule = Schedule::create([
            'application_id' => $validated['application_id'],
            'type' => $validated['type'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'] ?? null,
            'location' => $validated['location'],
            'notes' => $validated['notes'] ?? null,
            'created_by' => auth()->id(),
        ]);

        // Update status application otomatis
        $application = $schedule->application()->first();
        if ($application && $application->status !== 'hired' && $schedule->type !== 'onboarding') {
            $application->update(['status' => 'interview']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil dibuat!',
            'data' => $schedule
        ]);
    }

    // Detail jadwal
    public function show($id)
    {
        $schedule = Schedule::with(['application.user', 'application.jobListing', 'creator'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $schedule
        ]);
    }

    // Hapus jadwal
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil dihapus.'
        ]);
    }
}
