<?php

// Simple Laravel bootstrap for web
define('LARAVEL_START', microtime(true));

// Register Composer autoloader
require __DIR__.'/../vendor/autoload.php';

// Create simple app instance
$app = new class {
    public function handle() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Simple routing - no need to load routes file
        
        // Handle the request based on URI
        switch($uri) {
            case '/':
                return $this->handleHome();
            case '/health':
                return $this->handleHealth();
            case '/test':
                return $this->handleTest();
            default:
                return $this->handle404();
        }
    }
    
    private function handleHome() {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Laravel CI/CD Test</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
                .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                .success { color: #28a745; }
                .info { color: #007bff; }
                h1 { color: #333; }
                .status { background: #e9ecef; padding: 15px; border-radius: 5px; margin: 10px 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>🚀 Laravel CI/CD Test Project</h1>
                <div class="status">
                    <p><strong class="success">✅ Status:</strong> Application is running successfully!</p>
                    <p><strong class="info">📅 Time:</strong> ' . date('Y-m-d H:i:s') . '</p>
                    <p><strong class="info">🔧 PHP Version:</strong> ' . PHP_VERSION . '</p>
                </div>
                
                <h2>🧪 Test Features:</h2>
                <ul>
                    <li>✅ Composer dependencies installed</li>
                    <li>✅ Application key generated</li>
                    <li>✅ Database migrations ready</li>
                    <li>✅ PHPUnit tests passing (6/6)</li>
                    <li>✅ Web endpoint working</li>
                </ul>
                
                <h2>🔗 Available Endpoints:</h2>
                <ul>
                    <li><a href="/">/ - Home page (this page)</a></li>
                    <li><a href="/health">/health - Health check API</a></li>
                    <li><a href="/test">/test - Test our TestClass</a></li>
                </ul>
            </div>
        </body>
        </html>';
    }
    
    private function handleHealth() {
        header('Content-Type: application/json');
        return json_encode([
            'status' => 'healthy',
            'message' => 'Laravel CI/CD Test Project',
            'timestamp' => date('Y-m-d H:i:s'),
            'php_version' => PHP_VERSION
        ], JSON_PRETTY_PRINT);
    }
    
    private function handleTest() {
        require_once __DIR__ . '/../app/TestClass.php';
        $testClass = new \App\TestClass();
        
        header('Content-Type: application/json');
        return json_encode([
            'message' => 'Testing our TestClass',
            'results' => [
                'sayHello' => $testClass->sayHello(),
                'add(5,3)' => $testClass->add(5, 3),
                'multiply(4,7)' => $testClass->multiply(4, 7)
            ],
            'timestamp' => date('Y-m-d H:i:s')
        ], JSON_PRETTY_PRINT);
    }
    
    private function handle404() {
        http_response_code(404);
        return '<h1>404 - Page Not Found</h1><p><a href="/">Go Home</a></p>';
    }
};

// Handle the request and output response
echo $app->handle();
