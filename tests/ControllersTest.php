<?php

/**
 * Fake API request handler used for tests.
 *
 * @param string $action  Action to perform ('install' or 'remove').
 * @param array  $data    Request payload.
 *
 * @return array{status:int, error?:string, message?:string}
 */
function fakeApiRequest(string $action, array $data): array
{
    $required = ['url', 'name', 'autoRestart'];
    if ($action === 'remove') {
        $required = ['name'];
    }

    foreach ($required as $param) {
        if (!array_key_exists($param, $data)) {
            return [
                'status' => 422,
                'error' => "Missing parameter: {$param}",
            ];
        }
    }

    if (!empty($data['simulate_fail'])) {
        return [
            'status' => 500,
            'error' => $action === 'install'
                ? 'Failed to install mod'
                : 'Failed to remove mod',
        ];
    }

    return [
        'status' => 200,
        'message' => 'OK',
    ];
}

/**
 * Helper assertion for responses.
 */
function assertResponse(int $expectedStatus, ?string $expectedError, array $response): void
{
    if ($response['status'] !== $expectedStatus) {
        throw new Exception("Expected status {$expectedStatus}, got {$response['status']}");
    }
    if ($expectedError !== null) {
        if (!isset($response['error'])) {
            throw new Exception('Expected an error message');
        }
        if ($response['error'] !== $expectedError) {
            throw new Exception("Expected error '{$expectedError}', got '{$response['error']}'");
        }
    }
}

function test_missing_url(): void
{
    $response = fakeApiRequest('install', [
        'name' => 'Example',
        'autoRestart' => true,
    ]);
    assertResponse(422, 'Missing parameter: url', $response);
}

function test_missing_name(): void
{
    $response = fakeApiRequest('install', [
        'url' => 'http://example',
        'autoRestart' => true,
    ]);
    assertResponse(422, 'Missing parameter: name', $response);
}

function test_missing_auto_restart(): void
{
    $response = fakeApiRequest('install', [
        'url' => 'http://example',
        'name' => 'Example',
    ]);
    assertResponse(422, 'Missing parameter: autoRestart', $response);
}

function test_install_failure(): void
{
    $response = fakeApiRequest('install', [
        'url' => 'http://example',
        'name' => 'Example',
        'autoRestart' => true,
        'simulate_fail' => true,
    ]);
    assertResponse(500, 'Failed to install mod', $response);
}

function test_remove_failure(): void
{
    $response = fakeApiRequest('remove', [
        'name' => 'Example',
        'simulate_fail' => true,
    ]);
    assertResponse(500, 'Failed to remove mod', $response);
}

// Execute tests
try {
    test_missing_url();
    test_missing_name();
    test_missing_auto_restart();
    test_install_failure();
    test_remove_failure();
    echo "All tests executed\n";
} catch (Exception $e) {
    echo 'Test failed: ' . $e->getMessage() . "\n";
    exit(1);
}
