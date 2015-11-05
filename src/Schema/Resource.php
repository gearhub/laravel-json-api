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
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidAttributesException(self::class);
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
     * @return array|null
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return Link[]|null
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return Relationship[]|null
     */
    public function getRelationships()
    {
        return $this->relationships;
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
        if (empty($attributes) || gettype($attributes) !== 'array') {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidAttributesException(self::class);
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
        if (!is_null($links)) {
            if (gettype($links) !== 'array') {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException("Invalid Links for Class: " . self::class . ". Must be an array of Links or null.");
            }

            foreach($links as $link) {
                if (!($link instanceof Link)) {
                    throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidLinkException(self::class);
                }
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
        if (!is_null($relationships)) {
            if (gettype($relationships) !== 'array') {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException("Invalid Relationships for Class: " . self::class . ". Must be an array of Relationships or null.");
            }

            foreach($relationships as $relationship) {
                if (!($relationship instanceof Relationship)) {
                    throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidRelationshipException(self::class);
                }
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
            $returned_array['links'] = array_reduce($this->links, function($prev, $link) {
                return array_merge($prev, $link->toArray());
            }, []);
        }

        if ($this->meta) {
            $returned_array['meta'] = $this->meta;
        }

        if ($this->relationships) {
            $returned_array['relationships'] = array_reduce($this->relationships, function($prev, $relationship) {
                return array_merge($prev, $relationship->toArray());
            }, []);
        }

        return $returned_array;
    }
}
