<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class UserPreferencesController extends Controller
{
    /**
     * Get preferences for authenticated user.
     */
    public function show(Request $request): JsonResponse
    {
        $prefs = [
            'autoRestart' => true,
        ];

        return new JsonResponse($prefs);
    }

    /**
     * Update preferences for authenticated user.
     */
    public function update(Request $request): JsonResponse
    {
        $prefs = ['autoRestart' => filter_var($request->get('autoRestart', true), FILTER_VALIDATE_BOOLEAN)];
        return new JsonResponse(['status' => 'saved', 'preferences' => $prefs]);
    }
}
