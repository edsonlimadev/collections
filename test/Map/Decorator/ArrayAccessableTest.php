<?php

namespace Edsonlimadev\Collections;

use Edsonlimadev\Collections\Map;
use Edsonlimadev\Collections\Map\Decorator\ArrayAccessable;

class ArrayAccessableTest extends \PHPUnit_Framework_TestCase
{
    public function testVerirfyIfArrayAccessableIsAMap()
    {
        $this->assertInstanceOf(
            'Edsonlimadev\\Collections\\Map\\Interfaces\\Map',
            new ArrayAccessable(new Map\Mutable())
        );
    }

    public function testSetMultipleValuesInAMutableMap()
    {
        $mutableMap = new Map\Mutable([
            'gokufamily.sj1' => 'Goku',
            'gokufamily.sj2' => 'Gohan',
            'gokufamily.sj3' => 'Pan'
        ]);
        $map = new ArrayAccessable($mutableMap);
        $map['vegetafamily.sj1'] = 'Vegeta';
        $map['vegetafamily.sj2'] = 'Trunks';

        $this->assertEquals('Vegeta', $mutableMap->get('vegetafamily.sj1'));
        $this->assertEquals('Trunks', $mutableMap->get('vegetafamily.sj2'));
    }

    /**
     * @expectedException \Exception
     */
    public function testSetAValueInAnImutableMap()
    {
        $imutableMap = new Map\Immutable([1,2,3,4]);
        $map = new ArrayAccessable($imutableMap);

        $map[] = 6;
    }

    public function testUnsetAValueInAMutableMap()
    {
        $mutableMap = new Map\Mutable([
            'hero'    => 'Ryu',
            'villain' => 'Fou lu'
        ]);
        $map = new ArrayAccessable($mutableMap);
        unset($map['villain']);

        $this->assertAttributeEquals(['hero' => 'Ryu'], 'elements', $mutableMap);
    }

    public function testOffsetExistsInAnMap()
    {
        $imutableMap = new Map\Immutable([
            'vocals' => 'Peter Gabriel',
            'drums'  => ''
        ]);
        $map = new ArrayAccessable($imutableMap);

        $this->assertTrue(isset($map['vocals']));
        $this->assertFalse(isset($map['bass']));
        $this->assertTrue(empty($map['drums']));
    }

    public function testGetAnExistentKeyInAMap()
    {
        $imutableMap = new Map\Immutable([
            'vocals'  => 'Ozzy Osbourne',
            'guitars' => 'Randy Rhoads'
        ]);
        $map = new ArrayAccessable($imutableMap);

        $this->assertEquals('Randy Rhoads', $map['guitars']);
    }

    /**
     * @expectedException \Edsonlimadev\Collections\Exception\KeyNotFoundException
     */
    public function testGetAnInexistentKeyInAMap()
    {
        $imutableMap = new Map\Immutable([
            'vocals'  => 'Dio',
            'guitars' => 'Tonny Iommi'
        ]);
        $map = new ArrayAccessable($imutableMap);

        $map['bass'];
    }
}
