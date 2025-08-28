<?php

namespace App;

class TestClass
{
    public function sayHello(): string
    {
        return 'Hello from Laravel!';
    }

    public function add(int $a, int $b): int
    {
        return $a + $b;
    }

    public function multiply(int $a, int $b): int
    {
        return $a * $b;
    }
}
