<?php

use App\Models\Page;
use App\Models\ContactInfo;

if (!function_exists('getContent')) {
    /**
     * Get page content by key from database
     * Returns empty string if key not found
     */
    function getContent($key)
    {
        $page = Page::where('key', $key)->first();
        return $page ? $page->value : '';
    }
}

if (!function_exists('getContactInfo')) {
    /**
     * Get contact information by key from database
     * Returns empty string if key not found
     */
    function getContactInfo($key)
    {
        $contactInfo = ContactInfo::where('key', $key)->first();
        return $contactInfo ? $contactInfo->value : '';
    }
}
