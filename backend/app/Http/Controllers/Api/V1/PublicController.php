<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Setting;

class PublicController extends Controller
{
    public function settings()
    {
        $settings = Setting::query()->get(['key', 'value', 'type', 'group']);
        return response()->json(['success' => true, 'message' => 'Public settings.', 'data' => $settings]);
    }

    public function destinations()
    {
        $destinations = Destination::where('status', 'published')->orderBy('name')->paginate(24);
        return response()->json(['success' => true, 'message' => 'Destinations.', 'data' => $destinations]);
    }

    public function featuredDestinations()
    {
        $destinations = Destination::where('status', 'published')->where('featured', true)->orderBy('name')->get();
        return response()->json(['success' => true, 'message' => 'Featured destinations.', 'data' => $destinations]);
    }

    public function destination(string $slug)
    {
        $destination = Destination::where('status', 'published')->where('slug', $slug)->with('media')->firstOrFail();
        return response()->json(['success' => true, 'message' => 'Destination.', 'data' => $destination]);
    }
}
