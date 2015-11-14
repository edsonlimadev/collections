<?php

namespace Edsonlimadev\Collections;

class AbstractCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testVerifyGetIteratorMethod()
    {
        $collection = new Immutable([1,3]);
        $iterator = $collection->getIterator();
        $values = [];

        foreach ($iterator as $element) {
            $values[] = $element;
        }

        $this->assertInstanceOf('\Iterator', $iterator);
        $this->assertEquals([1,3], $values);
    }

    public function testVerifyCountMethod()
    {
        $collection = new Immutable([1,3]);

        $this->assertCount(2, $collection);
    }

    public function testVerifyContainsMethod()
    {
        $collection = new Immutable(range(40,42));

        $this->assertTrue($collection->contains(42));
    }

    public function testVerifyToArrayMethod()
    {
        $collection = new Immutable([42, new \stdClass()]);

        $this->assertEquals([42, new \stdClass()], $collection->toArray());
    }

    public function testEqualsWithASimilarCollection()
    {
        $collectionA = new Immutable([42,'vamos mostrar cultura']);
        $collectionB = clone $collectionA;

        $this->assertTrue($collectionA->equals($collectionB));
    }

    public function testEqualsWithADifferentCollection()
    {
        $collectionA = new Immutable([42,'top nos falsetes']);
        $collectionB = new Immutable([1 => 42, 'a' =>'top nos falsetes']);

        $this->assertFalse($collectionA->equals($collectionB));
    }

    public function testEqualsWithACollectionWithSameValuesButDifferentIndexes()
    {
        $collectionA = new Immutable([42,'top nos falsetes, viu!!!']);
        $collectionB = new Immutable([1 => 42, 'a' =>'top nos falsetes, viu!!!']);

        $this->assertFalse($collectionA->equals($collectionB));
    }

    public function testEachWithoutIndex()
    {
        $sum = 0;
        $collection = new Immutable([1,2,3]);

        $collection->each(function($elem) use(&$sum) {
            $sum += (int) $elem;
        });

        $this->assertEquals(6, $sum);
    }

    public function testEachWithIndex()
    {
        $mapped = [];
        $collection = new Immutable(['a','b','c']);

        $collection->each(function($element, $index) use (&$mapped) {
           $mapped[++$index] = $element;
        });

        $this->assertEquals([
            1 => 'a',
            2 => 'b',
            3 => 'c'
        ], $mapped);
    }

    /**
     * @expectedException \Edsonlimadev\Collections\Exception\InvalidClosureException
     */
    public function testEachWithAnInvalidClosure()
    {
        $collection = new Immutable(['Genesis', 'Yes']);

        $collection->each(function($a, $b, $c, $d, $e) {});
    }

    public function testFilterWithoutIndex()
    {
        $collection = new Immutable([1,'a',3]);

        $filtered = $collection->filter(function($element) {
           return is_int($element);
        });

        $this->assertEquals(2, count($filtered));
        $this->assertEmpty(array_diff([1,3], array_values($filtered->toArray())));
    }

    public function testFilterWithIndex()
    {
        $collection = new Immutable([1,'a',3,'b','c']);

        $filtered = $collection->filter(function($element, $index) {
           return ($index % 2 == 1);
        });

        $this->assertEquals(2, count($filtered));
        $this->assertTrue($filtered->equals(new Immutable([1 => 'a', 3 => 'b'])));
    }

    /**
     * @expectedException \Edsonlimadev\Collections\Exception\InvalidFilterException
     */
    public function testFilterWithAnInvalidClosure()
    {
        $collection = new Immutable(['Alcatrazz', 'Rainbow']);

        $collection->filter(function($a, $b, $c) {});
    }

    public function testMapWithoutIndex()
    {
        $collection = new Immutable([
            ['name' => 'Edson', 'age' => 25],
            ['name' => 'Batman', 'age' => 25]
        ]);

        $mapped = $collection->map(function($element) {
            return $element['name'];
        });

        $this->assertAttributeEquals(['Edson', 'Batman'], 'elements', $mapped);
    }

    public function testMapWithIndex()
    {
        $collection = new Immutable([
            ['name' => 'Robin', 'age' => 25],
            ['name' => 'Jocker', 'age' => 26],
            ['name' => 'Batman', 'age' => 25]
        ]);

        $mapped = $collection->map(function($element, $index) {
            return ($index % 2 == 0) ? $element['name'] : $element['age'];
        });

        $this->assertAttributeEquals(
            [
                0 => 'Robin',
                1 => 26,
                2 => 'Batman'
            ],
            'elements',
            $mapped
        );
    }

    /**
     * @expectedException \Edsonlimadev\Collections\Exception\InvalidMapException
     */
    public function testMapWithAnInvalidClosure()
    {
        $collection = new Immutable(['Deep Purple']);

        $collection->map(function($a, $b, $c) {});
    }

    public function testReduceWithoutInitialValue()
    {
        $collection = new Immutable(['Edson','Lima', 'Junior']);

        $this->assertEquals('Edson Lima Junior', $collection->reduce(function($partA, $partB) {
            return trim(sprintf('%s %s', $partA, $partB));
        }));
    }

    public function testReduceWithAInitialValue()
    {
        $collection = new Immutable([2,2,5]);

        $this->assertEquals(20, $collection->reduce(function($multiplier, $multiplicand) {
            return $multiplier * $multiplicand;
        }, 1));
    }

    /**
     * @expectedException \Edsonlimadev\Collections\Exception\InvalidReduceException
     */
    public function testReduceWithAnInvalidClosure()
    {
        $collection = new Immutable(['Deep Purple']);

        $collection->reduce(function($a, $b, $c) {});
    }

    public function testSortWithAValidClosure()
    {
        $collectionA = new Immutable([1,3,2]);
        $expected = new Immutable([1,2,3]);

        $sortedCollection = $collectionA->sort(function($a, $b) {
            return $a > $b;
        });

        $this->assertTrue($sortedCollection->equals($expected));
    }

    /**
     * @expectedException \Edsonlimadev\Collections\Exception\InvalidSortException
     */
    public function testSortWithAnInvalidClosure()
    {
        $collection = new Immutable();

        $collection->sort(function($a, $b, $c) {});
    }
}
