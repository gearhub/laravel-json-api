<?php

namespace SonarStudios\LaravelJsonApi\Tests\Schema;

use \Mockery;
use \PHPUnit_Framework_TestCase;

use SonarStudios\LaravelJsonApi\Schema\Link;
use SonarStudios\LaravelJsonApi\Schema\Relationship;
use SonarStudios\LaravelJsonApi\Schema\ResourceIdentifier;

class RelationshipTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->link                = Mockery::mock(Link::class);
        $this->resource_identifier = Mockery::mock(ResourceIdentifier::class);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_attempts_to_create_a_new_relationship_object()
    {
        $resource_identifiers = [
            $this->resource_identifier
        ];
        $links = [
            $this->link
        ];
        $meta = [
            'count' => 50
        ];
        $relationship = new Relationship('key', $resource_identifiers, $links, $meta);

        $this->assertEquals($relationship->getKey(), 'key');
        $this->assertEquals($relationship->getData(), $resource_identifiers);
        $this->assertEquals($relationship->getLinks(), $links);
        $this->assertEquals($relationship->getMeta(), $meta);
    }

    /**
     * @test
     */
    public function it_attempts_to_convert_to_array()
    {
        $this->link->shouldReceive('toArray')->andReturn([
            'self' => 'does not matter'
        ]);

        $this->resource_identifier->shouldReceive('toArray')->andReturn([
                'id'   => 1234,
                'type' => 'something else'
        ]);

        $relationship = new Relationship('key', [$this->resource_identifier], [$this->link], ['count' => 50]);

        $result = $relationship->toArray();
        $expected_result = [
            'key' => [
                'data' => [
                    'id'   => 1234,
                    'type' => 'something else'
                ],
                'links' => [
                    'self' => 'does not matter'
                ],
                'meta' => [
                    'count' => 50
                ]
            ]
        ];

        $this->assertEquals($result, $expected_result);
    }
}
