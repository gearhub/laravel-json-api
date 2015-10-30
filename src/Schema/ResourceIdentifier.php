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
     *
     * @return void
     */
    public function __construct($type, $id)
    {
        $this->type = $type;
        $this->id   = $id;
    }

    /**
     * Convert a ResourceIdentifier object into a Resource object.
     *
     * @param  array $attributes
     * @param  Link[] $links
     * @param  array $meta
     * @param  Relationship[] $relationships
     *
     * @return Resource
     */
    public function convertToResource($attributes, $links = null, $meta = null, $relationships = null)
    {
        $meta = $meta ?: $this->meta;
        return new Resource($this->type, $this->id, $attributes, $links, $meta, $relationships);
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

    /**
     * Add metadata to ResourceIdentifier.
     *
     * @param  array  $meta
     *
     * @return $this
     */
    public function withMeta($meta = [])
    {
        $this->meta = $meta;
        return $this;
    }

}
