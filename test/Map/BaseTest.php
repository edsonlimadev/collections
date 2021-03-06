<?php

namespace Edsonlimadev\Collections;

use Edsonlimadev\Collections\Map\Immutable as Map;

class MapTest extends \PHPUnit_Framework_TestCase
{
    public function testGetKeysOfAMap()
    {
        $collection = new Map([
            'trash-metal' => ['Metallica', 'Megadeth'],
            'power-metal' => ['Blind Guardian', 'Iced Earth', 'Helloween'],
            'folk-metal' => ['Tuatha de Danann', 'Omnia']
        ]);
        $expected = new Immutable([
            'trash-metal',
            'power-metal',
            'folk-metal'
        ]);

        $this->assertTrue($expected->equals($collection->keys()));
    }

    public function testGetValuesOfAMap()
    {
        $collection = new Map([
            'Cart' => 'cart',
            'Cart.items' => 'cart/items',
            'Cart.customer' => 'cart/customer',
            'Cart.zipcode' => 'cart/zipcode',
        ]);
        $expected = new Immutable([
            'cart',
            'cart/items',
            'cart/customer',
            'cart/zipcode'
        ]);

        $this->assertTrue($expected->equals($collection->values()));
    }

    public function testGetADefinedValue()
    {
        $collection = new Map([
           'Chala head chala' => 'DBZ'
        ]);

        $this->assertEquals('DBZ', $collection->get('Chala head chala'));
    }

    /**
     * @expectedException \Edsonlimadev\Collections\Exception\KeyNotFoundException
     */
    public function testGetAnUndefinedValue()
    {
        $collection = new Map([
            'Chala head chala' => 'DBZ'
        ]);

        $collection->get('Inspector Gadget');
    }

    public function testGetAExistentValue()
    {
        $collection = new Map([
            'rage' => 'Don\'t fear the winter'
        ]);

        $this->assertEquals('Don\'t fear the winter', $collection->getValue('rage', ''));
    }

    public function testGetDefaultValue()
    {
        $collection = new Map([
            'rage' => 'Don\'t fear the winter'
        ]);

        $this->assertEquals(
            'Don\'t fear the reaper',
            $collection->getValue('Blue oyster cult', 'Don\'t fear the reaper')
        );
    }

    public function testCheckHasMethodWithAnExistentKey()
    {
        $bandsYears = new Map([
            'rage' => 1984
        ]);

        $this->assertTrue($bandsYears->has('rage'));
    }

    public function testCheckHasMethodWithAnInexistentKey()
    {
        $bandsYears = new Map([
            1984 => ['rage']
        ]);

        $this->assertFalse($bandsYears->has(1985));
    }
}
