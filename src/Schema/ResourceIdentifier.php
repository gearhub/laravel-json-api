<?php

namespace SonarStudios\LaravelJsonApi\Schema;

use Illuminate\Contracts\Support\Arrayable;

class ResourceIdentifier implements Arrayable
{
    /**
     * Unique identifier.
     *
     * @var int|string
     */
    protected $id;

    /**
     * @var array
     */
    protected $meta;

    /**
     * @var string
     */
    protected $type;

    /**
     * @param string     $type
     * @param int|string $id
     *
     * @return void
     */
    public function __construct($type, $id)
    {
        $this->setType($type);
        $this->setId($id);
    }

    /**
     * @param array $additional_meta
     *
     * @return $this
     */
    public function addMeta($additional_meta)
    {
        if (gettype($additional_meta) !== 'array') {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException($additional_meta, self::class);
        }
        if (is_array($this->meta)) {
            $meta = array_merge($this->meta, $additional_meta);
        } else {
            $meta = $additional_meta;
        }
        return $this->setMeta($meta);
    }

    /**
     * @param  array               $attributes
     * @param  Link[]|null         $links
     * @param  Relationship[]|null $relationships
     *
     * @return Resource
     */
    public function convertToResource($attributes, $links = null, $relationships = null)
    {
        return new Resource($this->type, $this->id, $attributes, $links, $relationships, $this->meta);
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
     * @return array|null
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param int|string $id
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\InvalidIdException
     *
     * @return $this
     */
    public function setId($id)
    {
        if (empty($id) || (gettype($id) !== 'string' && gettype($id) !== 'integer')) {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidIdException($id, self::class);
        }
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $key
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\InvalidKeyException
     *
     * @return $this
     */
    public function setKey($key)
    {
        if (!is_string($key)) {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidKeyException($this->key, self::class);
        }
        $this->key = $key;
        return $this;
    }

    /**
     * @param  array|null $meta
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException
     *
     * @return $this
     */
    public function setMeta($meta)
    {
        if (!is_null($meta) && gettype($meta) !== 'array') {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException($meta, self::class);
        }
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $returned_array = [
            'id'   => $this->id,
            'type' => $this->type
        ];

        if ($this->meta) {
            $returned_array['meta'] = $this->meta;
        }

        return $returned_array;
    }
}
