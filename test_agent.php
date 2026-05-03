<?php

require_once __DIR__ . '/vendor/autoload.php';

// Load environment
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test the AgentController
try {
    $controller = new App\Http\Controllers\AgentController();

    // Test portfolio data fetching
    $reflection = new ReflectionClass($controller);
    $method = $reflection->getMethod('getPortfolioData');
    $method->setAccessible(true);

    $data = $method->invoke($controller);

    echo "✅ Portfolio data fetched successfully!\n";
    echo "Keys: " . implode(', ', array_keys($data)) . "\n";
    echo "Skills: " . count($data['skills']) . "\n";
    echo "Technologies: " . count($data['technologies']) . "\n";
    echo "Education: " . count($data['education']) . "\n";
    echo "Projects: " . count($data['projects']) . "\n";
    echo "Contact Info: " . count($data['contact_info']) . "\n";

    // Test system prompt creation
    $promptMethod = $reflection->getMethod('createSystemPrompt');
    $promptMethod->setAccessible(true);
    $prompt = $promptMethod->invoke($controller, $data);

    echo "\n✅ System prompt created successfully!\n";
    echo "Prompt length: " . strlen($prompt) . " characters\n";

    echo "\n🎉 All tests passed! AI Agent is ready.\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}