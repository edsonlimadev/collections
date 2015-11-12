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
}
