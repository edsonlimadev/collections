<?php

namespace Edsonlimadev\Collections\Map;

class ImmutableTest extends \PHPUnit_Framework_TestCase
{
    public function testVerifyIfImmutableIsAMapInstance()
    {
        $this->assertInstanceOf('Edsonlimadev\\Collections\\Map\\Base', new Immutable());
    }
}
