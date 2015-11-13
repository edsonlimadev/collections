<?php

namespace Edsonlimadev\Collections;

class MapTest extends \PHPUnit_Framework_TestCase
{
    public function testKeys()
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

    public function testValues()
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

    public function testGetAnUndefinedValue()
    {
        $collection = new Map([
            'Chala head chala' => 'DBZ'
        ]);

        $this->assertEquals(null, $collection->get('Inspector Gadget'));
    }

    public function testGetDefaultValue()
    {
        $collection = new Map([
            'Chala head chala' => 'DBZ'
        ]);

        $this->assertEquals('None', $collection->get('Gotta catch\'em all', 'None'));
        $this->assertEquals('DBZ', $collection->get('Chala head chala', 'None'));
    }

    public function testSetAValueToCollection()
    {
        $collection = new Map();

        $collection->set('Shurato', 'Anime');

        $this->assertEquals('Anime', $collection->get('Shurato'));
    }

    public function testSetMultipleValuesToCollection()
    {
        $collection = new Map();

        $collection->set('Shurato', 'Anime');
        $collection->set('Sandman', 'HQ');
        $collection->set('DBZ', 'Anime');
        $collection->set('Pokemon', 'Anime');

        $this->assertEquals('Anime', $collection->get('Shurato'));
        $this->assertEquals('HQ', $collection->get('Sandman'));
        $this->assertEquals('Anime', $collection->get('DBZ'));
        $this->assertEquals('Anime', $collection->get('Pokemon'));
    }
}
