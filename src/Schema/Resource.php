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
    public function __construct($type, $id = null, $attributes, $links = null, $meta = null, $relationships = null)
    {
        $this->type          = $type;
        $this->id            = $id;
        $this->attributes    = $attributes;
        $this->links         = $links;
        $this->meta          = $meta;
        $this->relationships = $relationships;
    }

    /**
     * Convert Resource object into ResourceIdentifier object.
     *
     * @param  array $meta
     *
     * @return ResourceIdentifier
     */
    public function convertToResouceIdentifier($meta)
    {
        $meta = $meta ?: $this->meta;
        return new ResourceIdentifier($this->type, $this->id, $meta)
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

    /**
     * Add metadata to Resource.
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

    /**
     * Add links to Resource.
     *
     * @param  Link[]  $links
     *
     * @return $this
     */
    public function withLinks($links = [])
    {
        $this->links = $links;
        return $this;
    }

    /**
     * Add relationships to Resource.
     *
     * @param  Relationship[]  $relationships
     *
     * @return $this
     */
    public function withRelationships($relationships = [])
    {
        $this->relationships = $relationships;
        return $this;
    }
}
