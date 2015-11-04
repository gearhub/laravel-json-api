<?php

namespace SonarStudios\LaravelJsonApi\Schema;

use Illuminate\Contracts\Support\Arrayable;

class Resource extends ResourceIdentifier
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var mixed
     */
    protected $links;

    /**
     * @var mixed
     */
    protected $relationships;

    /**
     * @param string              $type
     * @param int|string          $id
     * @param array               $attributes
     * @param Link[]|null         $links
     * @param Relationship[]|null $relationships
     * @param array|null          $meta
     *
     * @return void
     */
    public function __construct($type, $id, $attributes, $links = null, $relationships = null, $meta = null)
    {
        $this->setType($type);
        $this->setId($id);
        $this->setAttributes($attributes);
        $this->setLinks($links);
        $this->setRelationships($relationships);
        $this->setMeta($meta);
    }

    /**
     * @param array $additional_attributes
     *
     * @return $this
     */
    public function addAttributes($additional_attributes)
    {
        if (gettype($additional_attributes) !== 'array') {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidAttributesException($additional_attributes, self::class);
        }
        if (is_array($this->attributes)) {
            $attributes = array_merge($this->attributes, $additional_attributes);
        } else {
            $attributes = $additional_attributes;
        }
        return $this->setAttributes($attributes);
    }

    /**
     * @return ResourceIdentifier
     */
    public function convertToResouceIdentifier()
    {
        return new ResourceIdentifier($this->type, $this->id, $this->meta);
    }

    /**
     * @param array $attributes
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\InvalidAttributesException
     *
     * @return $this
     */
    public function setAttributes($attributes)
    {
        if (empty($this->attributes) || gettype($this->attributes !== 'array')) {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidAttributesException($attributes, self::class);
        }
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param  Link[]|null $links
     *
     * @return $this
     */
    public function setLinks($links = null)
    {
        $links = $links ?: [];
        foreach($links as $link) {
            if (get_class($link) !== Link::class) {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidLinkException($link, self::class);
            }
        }
        $this->links = $links;
        return $this;
    }

    /**
     * @param  Relationship[]|null $relationships
     *
     * @return $this
     */
    public function setRelationships($relationships = null)
    {
        $relationships = $relationships ?: [];
        foreach($relationships as $relationship) {
            if (get_class($relationship) !== Relationship::class) {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidRelationshipException($relationship, self::class);
            }
        }
        $this->relationships = $relationships;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $returned_array = [
            'id'         => $this->id,
            'type'       => $this->type,
            'attributes' => $this->attributes
        ];

        if ($this->links) {
            $returned_array['links'] = array_map(function($link) {
                return $link->toArray();
            }, $this->links);
        }

        if ($this->meta) {
            $returned_array['meta'] = $this->meta;
        }

        if ($this->relationships) {
            $returned_array['relationships'] = array_map(function($relationship) {
                return $relationship->toArray();
            }, $this->relationships);
        }

        return $returned_array;
    }
}
