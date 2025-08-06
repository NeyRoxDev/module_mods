<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModsController
{
    public function install(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'url'  => ['required', 'url'],
            'name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid data',
                'errors'  => $validator->errors(),
            ], 400);
        }

        return response()->json([
            'message' => 'Mod installation queued',
        ], 200);
    }
}

