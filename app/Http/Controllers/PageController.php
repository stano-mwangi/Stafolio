<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Get page content by key
     */
    public function getContent($key)
    {
        $page = Page::where('key', $key)->first();
        return $page ? $page->value : '';
    }

    /**
     * Update page content
     */
    public function updateContent(Request $request, $key)
    {
        $validated = $request->validate([
            'value' => 'required|string',
        ]);

        $page = Page::where('key', $key)->firstOrCreate(
            ['key' => $key],
            ['value' => '']
        );

        $page->update(['value' => $validated['value']]);

        return back()->with('success', 'Page content updated successfully!');
    }

    /**
     * Get all pages
     */
    public function getAllPages()
    {
        return Page::all();
    }
}
