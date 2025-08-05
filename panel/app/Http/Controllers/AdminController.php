<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class AdminController extends Controller
{
    /**
     * Return list of installed mods.
     */
    public function index(): JsonResponse
    {
        $mods = [
            ['name' => 'WorldEdit', 'version' => '7.3.0'],
        ];

        return new JsonResponse($mods);
    }

    /**
     * Install a mod from provided URL.
     */
    public function install(Request $request): JsonResponse
    {
        $url = $request->get('url');
        return new JsonResponse(['status' => 'installed', 'url' => $url]);
    }

    /**
     * Uninstall a mod by name.
     */
    public function uninstall(Request $request): JsonResponse
    {
        $name = $request->get('name');
        return new JsonResponse(['status' => 'removed', 'name' => $name]);
    }
}
