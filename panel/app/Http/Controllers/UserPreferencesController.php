<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class UserPreferencesController extends Controller
{
    /**
     * Get preferences for authenticated user.
     */
    public function show(Request $request): JsonResponse
    {
        // Placeholder preferences
        $prefs = [
            'autoRestart' => true,
        ];

        return response()->json($prefs);
    }

    /**
     * Update preferences for authenticated user.
     */
    public function update(Request $request): JsonResponse
    {
        $prefs = $request->only(['autoRestart']);
        // TODO: persist preferences
        return response()->json(['status' => 'saved', 'preferences' => $prefs]);
    }
}
