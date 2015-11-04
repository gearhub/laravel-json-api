<?php

namespace SonarStudios\LaravelJsonApi\Tests\Schema;

use \Mockery;
use \PHPUnit_Framework_TestCase;

use SonarStudios\LaravelJsonApi\Schema\Link;

class LinkTest extends PHPUnit_Framework_TestCase
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
    public function it_attempts_to_create_a_new_link_object()
    {
        $new_link = new Link('self', 'some random string', ['count' => 50]);

        $this->assertEquals($new_link->getKey(), 'self');
        $this->assertEquals($new_link->getHref(), 'some random string');
        $this->assertEquals($new_link->getMeta(), ['count' => 50]);
    }

    /**
     * @test
     */
    public function it_attempts_to_convert_to_array_without_meta()
    {
        $new_link = new Link('self', 'some random string');

        $result = $new_link->toArray();
        $expected_result = [
            'self' => 'some random string'
        ];

        $this->assertEquals($result, $expected_result);
    }

    /**
     * @test
     */
    public function it_attempts_to_convert_to_array_with_meta()
    {
        $new_link = new Link('self', 'some random string', ['count' => 50]);

        $result = $new_link->toArray();
        $expected_result = [
            'self' => [
                'href' => 'some random string',
                'meta' => [
                    'count' => 50
                ]
            ]
        ];

        $this->assertEquals($result, $expected_result);
    }

    /**
     * @test
     */
    public function it_attempts_to_add_to_meta()
    {
        $new_link = new Link('self', 'some random string', ['count' => 50]);

        $new_link->addMeta(['something' => 'else']);
        $expected_result = [
            'count' => 50,
            'something' => 'else'
        ];

        $this->assertEquals($new_link->getMeta(), $expected_result);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException
     */
    public function it_fails_to_set_href_in_constructor()
    {
        $new_link = new Link('self', new \stdClass, ['count' => 50]);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException
     */
    public function it_fails_to_set_href_in_method()
    {
        $new_link = new Link('self', 'some random string', ['count' => 50]);

        $new_link->setHref(new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidKeyException
     */
    public function it_fails_to_set_key_in_constructor()
    {
        $new_link = new Link(new \stdClass, 'some random string', ['count' => 50]);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidKeyException
     */
    public function it_fails_to_set_key_in_method()
    {
        $new_link = new Link('self', 'some random string', ['count' => 50]);

        $new_link->setKey(new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException
     */
    public function it_fails_to_set_meta_in_constructor()
    {
        $new_link = new Link('self', 'some random string', new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException
     */
    public function it_fails_to_set_meta_in_method()
    {
        $new_link = new Link('self', 'some random string', ['count' => 50]);

        $new_link->setMeta(new \stdClass);
    }

    /**
     * @test
     * @expectedException \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException
     */
    public function it_fails_to_add_to_meta()
    {
        $new_link = new Link('self', 'some random string', ['count' => 50]);

        $new_link->addMeta(new \stdClass);
    }
}
