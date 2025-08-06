<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserPreferencesController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $preferences = UserPreference::where('user_id', $user->id)
            ->pluck('value', 'key');

        return response()->json($preferences);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string'],
        ]);

        $user = $request->user();

        $preference = UserPreference::updateOrCreate(
            ['user_id' => $user->id, 'key' => $data['key']],
            ['value' => $data['value']]
        );

        return response()->json($preference, 201);
    }
}

