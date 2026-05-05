<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Event;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        Event::create([
            'event_name' => 'contact_sent',
            'ip_address' => $request->ip(),
            'metadata' => [
                'page' => $request->path(),
            ],
            'created_at' => now(),
        ]);

        return back()->with('success','Message sent successfully.');
    }
}
