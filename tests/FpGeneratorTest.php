<?php

namespace Hexlay\FpGenerator\Tests;

use Hexlay\FpGenerator\FpGenerator;
use PHPUnit\Framework\TestCase;
use function preg_match;
use function preg_match_all;
use function strlen;

class FpGeneratorTest extends TestCase
{

    private FpGenerator $fpGenerator;

    public function __construct()
    {
        parent::__construct();
        $this->fpGenerator = new FpGenerator();
    }

    public function testPasswordLength()
    {
        $password = $this->fpGenerator->generate(10);
        $this->assertEquals(10, strlen($password));
    }

    public function testPasswordHasAtLeastOneSymbol()
    {
        $password = $this->fpGenerator->generate();
        $contains = preg_match('/[!#$%&(){}\[\]=]/', $password);
        $this->assertTrue((bool)$contains);
    }

    public function testPasswordHasAtLeastOneNumber()
    {
        $password = $this->fpGenerator->generate(6, 2);
        $contains = preg_match('/\d/', $password);
        $this->assertTrue((bool)$contains);
    }

    public function testPasswordHasAtLeastOneLowercase()
    {
        $password = $this->fpGenerator->generate(6, 1);
        $contains = preg_match('/[a-z]/', $password);
        $this->assertTrue((bool)$contains);
    }

    public function testPasswordHasAtLeastTwoUppercase()
    {
        $password = $this->fpGenerator->generate(6, 1);
        $count = preg_match_all('/[A-Z]/', $password);
        $this->assertGreaterThanOrEqual(2, $count);
    }
}
