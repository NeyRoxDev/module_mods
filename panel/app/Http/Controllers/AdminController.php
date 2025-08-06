<?php

namespace App\Http\Controllers;

use App\Services\ModService;
use App\Exceptions\ModNotFoundException;
use App\Exceptions\ModDownloadException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function __construct(private ModService $mods)
    {
    }

    public function download(string $name): JsonResponse
    {
        try {
            $this->mods->download($name);
            return response()->json(['status' => 'ok']);
        } catch (ModNotFoundException $e) {
            return response()->json(['error' => 'Mod introuvable'], Response::HTTP_NOT_FOUND);
        } catch (ModDownloadException $e) {
            return response()->json(['error' => 'Échec du téléchargement'], Response::HTTP_BAD_GATEWAY);
        }
    }

    public function install(string $name): JsonResponse
    {
        try {
            $this->mods->install($name);
            $this->restartServer();
            return response()->json(['status' => 'ok']);
        } catch (ModNotFoundException $e) {
            return response()->json(['error' => 'Mod introuvable'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Échec de l\'installation'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(string $name): JsonResponse
    {
        try {
            $this->mods->delete($name);
            $this->restartServer();
            return response()->json(['status' => 'ok']);
        } catch (ModNotFoundException $e) {
            return response()->json(['error' => 'Mod introuvable'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Échec de la suppression'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function restartServer(): JsonResponse
    {
        $this->mods->restartServer();
        return response()->json(['status' => 'restarting']);
    }
}

