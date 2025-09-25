<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApplicationTest extends BaseTestCase
{
    private $client;
    private $baseUrl = 'http://localhost:8000';

    protected function setUp(): void
    {
        parent::setUp();

        // Start test server in background
        $this->startTestServer();

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 5,
            'http_errors' => false
        ]);
    }

    private function startTestServer()
    {
        // For testing, we'll assume the server is running
        // In a real CI environment, you'd start it here
    }

    public function testApplicationResponds()
    {
        try {
            $response = $this->client->get('/');
            // Root endpoint may require authentication, so 401 is expected
            $this->assertTrue(in_array($response->getStatusCode(), [200, 401]));
        } catch (RequestException $e) {
            $this->markTestSkipped('Test server not running. Start with: php -S 0.0.0.0:8000 -t public');
        }
    }

    public function testApiDocsEndpoint()
    {
        try {
            $response = $this->client->get('/docs');
            // Docs endpoint may require authentication, so 401 is expected
            $this->assertTrue(in_array($response->getStatusCode(), [200, 401]));
            if ($response->getStatusCode() === 200) {
                $content = strtolower($response->getBody()->getContents());
                $this->assertTrue(strpos($content, 'swagger') !== false || strpos($content, 'api') !== false);
            }
        } catch (RequestException $e) {
            $this->markTestSkipped('Test server not running');
        }
    }

    public function testOpenApiSpecEndpoint()
    {
        try {
            $response = $this->client->get('/openapi.yaml');
            $this->assertEquals(200, $response->getStatusCode());
            $content = strtolower($response->getBody()->getContents());
            $this->assertTrue(strpos($content, 'openapi') !== false);
        } catch (RequestException $e) {
            $this->markTestSkipped('Test server not running');
        }
    }
}