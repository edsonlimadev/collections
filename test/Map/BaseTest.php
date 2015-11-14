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

    public function testGetDefaultValue()
    {
        $collection = new Map();
        $now = new \DateTime();

        $this->assertEquals($now, $collection->getValue('Gotta catch\'em all', $now));
        $this->assertEquals($now, $collection->getValue('Chala head chala', $now));
    }

//    public function testSetAValueToCollection()
//    {
//        $collection = new Immutable();
//
//        $collection->set('Shurato', 'Anime');
//
//        $this->assertEquals('Anime', $collection->get('Shurato'));
//    }
//
//    public function testSetMultipleValuesToCollection()
//    {
//        $collection = new Immutable();
//
//        $collection->set('Shurato', 'Anime');
//        $collection->set('Sandman', 'HQ');
//        $collection->set('DBZ', 'Anime');
//        $collection->set('Pokemon', 'Anime');
//
//        $this->assertEquals('Anime', $collection->get('Shurato'));
//        $this->assertEquals('HQ', $collection->get('Sandman'));
//        $this->assertEquals('Anime', $collection->get('DBZ'));
//        $this->assertEquals('Anime', $collection->get('Pokemon'));
//    }
}
