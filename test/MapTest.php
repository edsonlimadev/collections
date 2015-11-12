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
}
