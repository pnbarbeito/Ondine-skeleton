<?php

namespace Tests;

class BootstrapTest extends BaseTestCase
{
    public function testAutoloaderWorks()
    {
        // Test that composer autoloader is working
        $this->assertTrue(class_exists('Ondine\\Bootstrap'));
        $this->assertTrue(class_exists('Ondine\\Router'));
        $this->assertTrue(class_exists('Ondine\\Request'));
        $this->assertTrue(class_exists('Ondine\\Response'));
    }

    public function testApplicationClassesExist()
    {
        // Test that our application classes can be loaded
        $this->assertTrue(class_exists('App\\Controllers\\ExampleController'));
    }

    public function testConfigFileExists()
    {
        // Test that configuration files exist
        $this->assertFileExists(__DIR__ . '/../config/.env.example');
        $this->assertFileExists(__DIR__ . '/../public/index.php');
        $this->assertFileExists(__DIR__ . '/../composer.json');
    }

    public function testPublicFilesExist()
    {
        // Test that public files exist
        $this->assertFileExists(__DIR__ . '/../public/index.html');
        $this->assertFileExists(__DIR__ . '/../public/docs/index.html');
        $this->assertFileExists(__DIR__ . '/../public/openapi.yaml');
    }
}