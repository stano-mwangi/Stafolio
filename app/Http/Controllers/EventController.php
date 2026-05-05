<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:100',
            'metadata' => 'sometimes|array',
        ]);

        Event::create([
            'event_name' => $validated['event_name'],
            'ip_address' => $request->ip(),
            'metadata' => $validated['metadata'] ?? [],
            'created_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
}
