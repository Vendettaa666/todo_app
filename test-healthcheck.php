<?php
/**
 * Test Health Check Script
 * Jalankan script ini untuk test health check endpoint
 */

echo "=== Testing Health Check Endpoints ===\n\n";

$baseUrl = "https://tasklistapp.up.railway.app";

$endpoints = [
    '/health',
    '/welcome',
    '/'
];

foreach ($endpoints as $endpoint) {
    $url = $baseUrl . $endpoint;
    echo "Testing: $url\n";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        echo "❌ Error: $error\n";
    } else {
        echo "✅ HTTP Code: $httpCode\n";
        echo "Response: " . substr($response, 0, 200) . "...\n";
    }
    echo "\n";
}

echo "=== Health Check Test Complete ===\n";
