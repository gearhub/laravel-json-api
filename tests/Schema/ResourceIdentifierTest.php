<?php

namespace SonarStudios\LaravelJsonApi\Tests\Schema;

use \Mockery;
use \PHPUnit_Framework_TestCase;

use SonarStudios\LaravelJsonApi\Schema\ResourceIdentifier;

class ResourceIdentifierTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        //
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function it_attempts_to_create_a_new_resource_identifier_object()
    {
        $new_ri = new ResourceIdentifier('something', '1234', ['count' => 50]);

        $this->assertEquals($new_ri->getType(), 'something');
        $this->assertEquals($new_ri->getId(), '1234');
        $this->assertEquals($new_ri->getMeta(), ['count' => 50]);
    }

    /**
     * @test
     */
    public function it_attempts_to_convert_to_array()
    {
        $new_ri = new ResourceIdentifier('something', 1234, ['count' => 50]);

        $result = $new_ri->toArray();
        $expected_result = [
            'id' => 1234,
            'type' => 'something',
            'meta' => [
                'count' => 50
            ]
        ];

        $this->assertEquals($result, $expected_result);
    }

    /**
     * @test
     */
    public function it_attempts_to_add_to_meta()
    {
        $new_ri = new ResourceIdentifier('something', 1234, ['count' => 50]);

        $new_ri->addMeta(['something' => 'else']);
        $expected_result = [
            'count' => 50,
            'something' => 'else'
        ];

        $this->assertEquals($new_ri->getMeta(), $expected_result);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidIdException
     */
    public function it_fails_to_set_id_in_constructor()
    {
        $new_ri = new ResourceIdentifier('something', new \stdClass, ['count' => 50]);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidIdException
     */
    public function it_fails_to_set_id_in_method()
    {
        $new_ri = new ResourceIdentifier('something', 1234, ['count' => 50]);

        $new_ri->setId(new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException
     */
    public function it_fails_to_set_type_in_constructor()
    {
        $new_ri = new ResourceIdentifier(new \stdClass, 'some random string', ['count' => 50]);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException
     */
    public function it_fails_to_set_type_in_method()
    {
        $new_ri = new ResourceIdentifier('something', 'some random string', ['count' => 50]);

        $new_ri->setType(new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException
     */
    public function it_fails_to_set_meta_in_constructor()
    {
        $new_ri = new ResourceIdentifier('self', 'some random string', new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException
     */
    public function it_fails_to_set_meta_in_method()
    {
        $new_ri = new ResourceIdentifier('self', 'some random string', ['count' => 50]);

        $new_ri->setMeta(new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException
     */
    public function it_fails_to_add_to_meta()
    {
        $new_ri = new ResourceIdentifier('self', 'some random string', ['count' => 50]);

        $new_ri->addMeta(new \stdClass);
    }
}
