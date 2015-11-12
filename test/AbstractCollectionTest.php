<?php

namespace Edsonlimadev\Collections\Test;

use Edsonlimadev\Collections;

class AbstractCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testEach()
    {
        $sum = 0;
        $collection = new Collections\Immutable([1,2,3]);

        $collection->each(function($elem) use(&$sum) {
            $sum += (int) $elem;
        });

        $this->assertEquals(6, $sum);
    }

    public function testEachWithIndex()
    {
        $mapped = [];
        $collection = new Collections\Immutable(['a','b','c']);

        $collection->eachWithIndex(function($index, $element) use (&$mapped) {
           $mapped[++$index] = $element;
        });

        $this->assertEquals([
            1 => 'a',
            2 => 'b',
            3 => 'c'
        ], $mapped);
    }

    public function testFilter()
    {
        $collection = new Collections\Immutable([1,'a',3]);

        $filtered = $collection->filter(function($element) {
           return is_int($element);
        });

        $this->assertEquals(2, count($filtered));
        $this->assertEmpty(array_diff([1,3], array_values($filtered->toArray())));
    }

    public function testMap()
    {
        $collection = new Collections\Immutable([
            ['name' => 'Edson', 'age' => 25],
            ['name' => 'Batman', 'age' => 25]
        ]);

        $mapped = $collection->map(function($element) {
            return $element['name'];
        });

        $this->assertAttributeEquals(['Edson', 'Batman'], 'elements', $mapped);
    }

    public function testReduceWithoutInitialValue()
    {
        $collection = new Collections\Immutable(['Edson','Lima', 'Junior']);

        $this->assertEquals('Edson Lima Junior', $collection->reduce(function($partA, $partB) {
            return trim(sprintf('%s %s', $partA, $partB));
        }));
    }

    public function testReduceWithAInitialValue()
    {
        $collection = new Collections\Immutable([2,2,5]);

        $this->assertEquals(20, $collection->reduce(function($multiplier, $multiplicand) {
            return $multiplier * $multiplicand;
        }, 1));
    }

    public function testEqualsWithASimilarCollection()
    {
        $collectionA = new Collections\Immutable([42,'vamos mostrar cultura']);
        $collectionB = clone $collectionA;

        $this->assertTrue($collectionA->equals($collectionB));
    }

    public function testEqualsWithADifferentCollection()
    {
        $collectionA = new Collections\Immutable([42,'top nos falsetes']);
        $collectionB = new Collections\Immutable([1 => 42, 'a' =>'top nos falsetes']);

        $this->assertFalse($collectionA->equals($collectionB));
    }

    public function testEqualsWithACollectionWithSameValuesButDifferentIndexes()
    {
        $collectionA = new Collections\Immutable([42,'top nos falsetes, viu!!!']);
        $collectionB = new Collections\Immutable([1 => 42, 'a' =>'top nos falsetes, viu!!!']);

        $this->assertFalse($collectionA->equals($collectionB));
    }

    public function testContains()
    {
        $collection = new Collections\Immutable(range(40,42));

        $this->assertTrue($collection->contains(42));
    }

    public function testToArray()
    {
        $collection = new Collections\Immutable([42, new \stdClass()]);

        $this->assertEquals([42, new \stdClass()], $collection->toArray());
    }

    public function testGetIterator()
    {
        $collection = new Collections\Immutable([1,3]);
        $iterator = $collection->getIterator();
        $values = [];

        foreach($iterator as $element) {
            $values[] = $element;
        }

        $this->assertInstanceOf('\Iterator', $iterator);
        $this->assertEquals([1,3], $values);
    }

    public function testCount()
    {
        $collection = new Collections\Immutable([1,3]);

        $this->assertCount(2, $collection);
    }
}