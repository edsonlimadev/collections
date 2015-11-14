<?php

namespace Edsonlimadev\Collections\Map;

class MutableTest extends \PHPUnit_Framework_TestCase
{
    public function testIfMutableIsAMapInstance()
    {
        $this->assertInstanceOf('Edsonlimadev\\Collections\\Map\\Base', new Mutable());
    }

    public function testSetAValueToCollection()
    {
        $collection = new Mutable();

        $collection->set('Shurato', 'Anime');

        $this->assertEquals('Anime', $collection->get('Shurato'));
    }

    public function testSetMultipleValuesToCollection()
    {
        $collection = new Mutable();

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
