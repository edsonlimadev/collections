<?php

namespace Edsonlimadev\Collections;

class ImmutableTest extends \PHPUnit_Framework_TestCase
{
    public function testIfImmutableIsACollectionInstance()
    {
        $this->assertInstanceOf('Edsonlimadev\\Collections\\AbstractCollection', new Immutable());
    }
}
