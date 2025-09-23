<?php
/**
 * Debug Startup Script
 * Test startup process locally
 */

echo "=== Debug Startup Process ===\n\n";

// Test 1: Check if Laravel can bootstrap
echo "1. Testing Laravel bootstrap...\n";
try {
    require __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    echo "✅ Laravel bootstrap: OK\n\n";
} catch (Exception $e) {
    echo "❌ Laravel bootstrap failed: " . $e->getMessage() . "\n\n";
    exit(1);
}

// Test 2: Check database connection
echo "2. Testing database connection...\n";
try {
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    $connection = DB::connection();
    $pdo = $connection->getPdo();
    echo "✅ Database connection: OK\n\n";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n\n";
}

// Test 3: Test migration
echo "3. Testing migration...\n";
try {
    Artisan::call('migrate:status');
    echo "✅ Migration status: OK\n\n";
} catch (Exception $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n\n";
}

// Test 4: Test routes
echo "4. Testing routes...\n";
try {
    $routes = Route::getRoutes();
    $healthRoute = $routes->getByName('health') ?? $routes->get('health');
    if ($healthRoute) {
        echo "✅ Health route: OK\n\n";
    } else {
        echo "❌ Health route not found\n\n";
    }
} catch (Exception $e) {
    echo "❌ Route test failed: " . $e->getMessage() . "\n\n";
}

echo "=== Debug Complete ===\n";
