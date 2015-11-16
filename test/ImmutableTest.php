<?php

namespace Edsonlimadev\Collections;

class ImmutableTest extends \PHPUnit_Framework_TestCase
{
    public function testVerifyIfImmutableIsACollectionInstance()
    {
        $this->assertInstanceOf('Edsonlimadev\\Collections\\Collection', new Immutable());
    }
}
