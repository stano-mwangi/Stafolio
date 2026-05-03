<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    /**
     * Update contact information
     */
    public function update(Request $request, $key)
    {
        $validated = $request->validate([
            'value' => 'required|string',
        ]);

        $contactInfo = ContactInfo::where('key', $key)->firstOrCreate(
            ['key' => $key],
            ['value' => '']
        );

        $contactInfo->update(['value' => $validated['value']]);

        return back()->with('success', 'Contact information updated successfully!');
    }

    /**
     * Get contact info by key
     */
    public function getContactInfo($key)
    {
        $contactInfo = ContactInfo::where('key', $key)->first();
        return $contactInfo ? $contactInfo->value : '';
    }
}
