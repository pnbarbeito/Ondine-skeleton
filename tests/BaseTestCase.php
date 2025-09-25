<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected function setUp(): void
    {
        // Set up test environment
        putenv('APP_ENV=testing');
        putenv('DB_DRIVER=sqlite');
        putenv('DB_SQLITE_PATH=:memory:');
        putenv('JWT_SECRET=test_jwt_secret_key_for_testing_only');
    }

    protected function tearDown(): void
    {
        // Clean up after each test
    }
}