<?php

use PHPUnit\Framework\TestCase;
use App\TestClass;

class TestClassTest extends TestCase
{
    private TestClass $testClass;

    protected function setUp(): void
    {
        $this->testClass = new TestClass();
    }

    public function testSayHello(): void
    {
        $result = $this->testClass->sayHello();
        $this->assertEquals('Hello from Laravel!', $result);
    }

    public function testAdd(): void
    {
        $result = $this->testClass->add(2, 3);
        $this->assertEquals(5, $result);
    }

    public function testMultiply(): void
    {
        $result = $this->testClass->multiply(4, 5);
        $this->assertEquals(20, $result);
    }

    public function testAddWithZero(): void
    {
        $result = $this->testClass->add(0, 10);
        $this->assertEquals(10, $result);
    }

    public function testMultiplyWithZero(): void
    {
        $result = $this->testClass->multiply(0, 10);
        $this->assertEquals(0, $result);
    }

    public function testMultipleOperations(): void
    {
        $add = $this->testClass->add(1, 2);
        $multiply = $this->testClass->multiply(3, 4);
        
        $this->assertEquals(3, $add);
        $this->assertEquals(12, $multiply);
    }
}
