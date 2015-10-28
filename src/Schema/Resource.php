<?php

namespace SonarStudios\LaravelJsonApi\Schema;

class Resource
{
    /**
     * Attributes to be visible.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Unique identifier for the resource.
     *
     * @var int|string
     */
    protected $id;

    /**
     * Links to be visible.
     *
     * @var mixed
     */
    protected $links;

    /**
     * Metadata for the resource.
     *
     * @var array
     */
    protected $meta;

    /**
     * Relationships to be visible.
     *
     * @var mixed
     */
    protected $relationships;

    /**
     * Type of the resource.
     *
     * @var string
     */
    protected $type;

    /**
     * Create a new resource instance.
     *
     * @param string          $type
     * @param int|string|null $id
     * @param array           $meta
     *
     * @return void
     */
    public function __construct($type, $attributes, $id = null, $meta = [])
    {
        $this->type = $type;
        $this->id   = $id;
        $this->meta = $meta;
    }

    /**
     * @return int|string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }
}
