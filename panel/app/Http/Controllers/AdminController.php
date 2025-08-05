<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class AdminController extends Controller
{
    /**
     * Return list of installed mods.
     */
    public function index(): JsonResponse
    {
        // Placeholder data
        $mods = [
            ['name' => 'WorldEdit', 'version' => '7.3.0'],
        ];

        return response()->json($mods);
    }

    /**
     * Install a mod from provided URL.
     */
    public function install(Request $request): JsonResponse
    {
        $url = $request->input('url');
        // TODO: implement real install logic
        return response()->json(['status' => 'installed', 'url' => $url]);
    }

    /**
     * Uninstall a mod by name.
     */
    public function uninstall(Request $request): JsonResponse
    {
        $name = $request->input('name');
        // TODO: implement real uninstall logic
        return response()->json(['status' => 'removed', 'name' => $name]);
    }
}
