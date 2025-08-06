<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Throwable;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return a standardized JSON success response.
     *
     * Child controllers should use this helper to keep API responses consistent.
     *
     * @param mixed $data    Data to include in the response body.
     * @param string|null $message Optional message for the client.
     * @param int $status    HTTP status code for the response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = null, ?string $message = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Return a standardized JSON error response and report the exception.
     *
     * Controllers may call this in catch blocks to provide consistent error data.
     *
     * @param \Throwable $e The exception that was thrown.
     * @param string|null $message Optional custom message.
     * @param int $status HTTP status code for the response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(Throwable $e, ?string $message = null, int $status = 500): JsonResponse
    {
        report($e);

        return response()->json([
            'status' => 'error',
            'message' => $message ?? $e->getMessage(),
        ], $status);
    }

    /**
     * Execute a callback and automatically handle any exception.
     *
     * This helper wraps controller actions, returning a success response on
     * completion or a standardized error response if an exception occurs.
     *
     * @param callable $callback Operation to execute.
     * @param string|null $message Optional success message.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handleRequest(callable $callback, ?string $message = null): JsonResponse
    {
        try {
            $data = $callback();

            return $this->success($data, $message);
        } catch (Throwable $e) {
            return $this->error($e);
        }
    }
}

