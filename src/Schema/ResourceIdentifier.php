<?php

namespace SonarStudios\LaravelJsonApi\Schema;

class ResourceIdentifier
{
    /**
     * Unique identifier for the resource.
     *
     * @var int|string
     */
    protected $id;

    /**
     * Metadata for the resource.
     *
     * @var array
     */
    protected $meta;

    /**
     * Type of the resource.
     *
     * @var string
     */
    protected $type;

    /**
     * Create a new resource identifier instance.
     *
     * @param string     $type
     * @param int|string $id
     * @param array      $meta
     *
     * @return void
     */
    public function __construct($type, $id, $meta = [])
    {
        $this->type = $type;
        $this->id   = $id;
        $this->meta = $meta;
    }

    /**
     * @return int|string
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
