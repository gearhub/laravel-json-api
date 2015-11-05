<?php

namespace SonarStudios\LaravelJsonApi\Tests\Schema;

use \Mockery;
use \PHPUnit_Framework_TestCase;

use SonarStudios\LaravelJsonApi\Schema\Link;
use SonarStudios\LaravelJsonApi\Schema\Relationship;
use SonarStudios\LaravelJsonApi\Schema\Resource;

class ResourceTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->link         = Mockery::mock(Link::class);
        $this->relationship = Mockery::mock(Relationship::class);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_attempts_to_create_a_new_resource_object()
    {
        $attributes = [
            'key' => 'value'
        ];
        $links = [
            $this->link
        ];
        $meta = [
            'count' => 50
        ];
        $relationships = [
            $this->relationship
        ];

        $new_resource = (new Resource('type', '1234', $attributes))->setLinks($links)->setRelationships($relationships)->setMeta($meta);

        $this->assertEquals($new_resource->getType(), 'type');
        $this->assertEquals($new_resource->getId(), '1234');
        $this->assertEquals($new_resource->getAttributes(), $attributes);
        $this->assertEquals($new_resource->getLinks(), $links);
        $this->assertEquals($new_resource->getRelationships(), $relationships);
        $this->assertEquals($new_resource->getMeta(), $meta);
    }

    /**
     * @test
     */
    public function it_attempts_to_convert_to_array()
    {
        $this->link->shouldReceive('toArray')->andReturn([
            'self' => 'does not matter'
        ]);

        $this->relationship->shouldReceive('toArray')->andReturn([
            'something' => [
                'id'   => 1234,
                'type' => 'something else'
            ]
        ]);

        $new_resource = new Resource('something', '1234', ['key' => 'value'], [$this->link], [$this->relationship], ['count' => 50]);

        $result = $new_resource->toArray();
        $expected_result = [
            'id' => '1234',
            'type' => 'something',
            'attributes' => [
                'key' => 'value'
            ],
            'links' => [
                'self' => 'does not matter'
            ],
            'meta' => [
                'count' => 50
            ],
            'relationships' => [
                'something' => [
                    'id'   => 1234,
                    'type' => 'something else'
                ]
            ]
        ];

        $this->assertEquals($result, $expected_result);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidAttributesException
     */
    public function it_fails_to_set_attributes_in_constructor()
    {
        $new_resource = new Resource('something', '1234', new \stdClass, [$this->link], [$this->relationship], ['count' => 50]);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidAttributesException
     */
    public function it_fails_to_set_attributes_in_method()
    {
        $new_resource = new Resource('something', '1234', ['key' => 'value'], [$this->link], [$this->relationship], ['count' => 50]);
        $new_resource->setAttributes(new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException
     */
    public function it_fails_to_set_links_in_constructor()
    {
        $new_resource = new Resource('something', '1234', ['key' => 'value'], new \stdClass, [$this->relationship], ['count' => 50]);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException
     */
    public function it_fails_to_set_links_to_object_in_method()
    {
        $new_resource = new Resource('something', '1234', ['key' => 'value'], [$this->link], [$this->relationship], ['count' => 50]);
        $new_resource->setLinks(new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidLinkException
     */
    public function it_fails_to_set_links_to_invalid_array_of_objects_in_method()
    {
        $new_resource = new Resource('something', '1234', ['key' => 'value'], [$this->link], [$this->relationship], ['count' => 50]);
        $new_resource->setLinks([new \stdClass]);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException
     */
    public function it_fails_to_set_relationships_in_constructor()
    {
        $new_resource = new Resource('something', '1234', ['key' => 'value'], [$this->link], new \stdClass, ['count' => 50]);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException
     */
    public function it_fails_to_set_relationships_to_object_in_method()
    {
        $new_resource = new Resource('something', '1234', ['key' => 'value'], [$this->link], [$this->relationship], ['count' => 50]);
        $new_resource->setRelationships(new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidRelationshipException
     */
    public function it_fails_to_set_relationships_to_invalid_array_of_objects_in_method()
    {
        $new_resource = new Resource('something', '1234', ['key' => 'value'], [$this->link], [$this->relationship], ['count' => 50]);
        $new_resource->setRelationships([new \stdClass]);
    }
}
