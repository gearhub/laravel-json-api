<?php

namespace SonarStudios\LaravelJsonApi\Schema;

use Illuminate\Contracts\Support\Arrayable;

class ResourceIdentifier implements Arrayable
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
     * Creates array representation of ResourceIdentifier.
     *
     * @return array
     */
    public function toArray()
    {
        $this->validate();
        $returned_array = [
            'id' => $this->id,
            'type' => $this->type
        ];

        if ($this->meta) {
            $returned_array['meta'] = $this->meta;
        }

        return $returned_array;
    }

    /**
     * Validate the resource identifier.
     *
     * @return void
     */
    protected function validate()
    {
        $this->validateId();
    }

    /**
     * Validate the id member for the resource identifier.
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\InvalidResourceIdentifierIdException
     *
     * @return void
     */
    protected function validateId()
    {
        if (empty($this->id) || (gettype($this->id) !== 'string' && gettype($this->id) !== 'integer')) {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidResourceIdentifierIdException($this->id);
        }
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
