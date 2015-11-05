<?php

namespace SonarStudios\LaravelJsonApi\Schema;

use Illuminate\Contracts\Support\Arrayable;

class Relationship implements Arrayable
{
    /**
     * @var mixed
     */
    protected $data = null;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var array
     */
    protected $links = null;

    /**
     * @var array|null
     */
    protected $meta = null;

    /**
     * Create a new relationship instance.
     *
     * @param string                                       $key
     * @param ResourceIdentifier|ResourceIdentifier[]|null $data
     * @param Links[]|null                                 $links
     * @param array|null                                   $meta
     *
     * @return void
     */
    public function __construct($key, $data = null, $links = null, $meta = null)
    {
        if (empty($data) && empty($links) && empty($meta)) {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException("Data, Links, and Meta cannot all be empty");
        }

        $this->setKey($key);

        if (!is_null($data)) {
            $this->setData($data);
        }
        if (!is_null($links)) {
            $this->setLinks($links);
        }
        if (!is_null($meta)) {
            $this->setMeta($meta);
        }
    }

    /**
     * @return ResourceIdentifier[]|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return Link[]|null
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return array|null
     */
    public function getMeta()
    {
        return $this->meta;
    }

    public function setData($data = null)
    {
        if (is_null($data)) {
            if (is_null($this->links) && is_null($this->meta)) {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException("Data, Links, and Meta cannot all be null.");
            }
        } else {
            if (gettype($data) !== 'array' && !($data instanceof ResourceIdentifier)) {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException('Data must be ResourceIdentifier or array of ResourceIdentifiers');
            } elseif (gettype($data) === 'array') {
                foreach($data as $resource) {
                    if (!($resource instanceof ResourceIdentifier)) {
                        throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException('Data must be ResourceIdentifier or array of ResourceIdentifiers');
                    }
                }
            }
        }

        $this->data = $data;
        return $this;
    }

    public function setKey($key)
    {
        if (empty($key) || gettype($key) !== 'string') {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidKeyException(self::class);
        }
        $this->key = $key;
        return $this;
    }

    /**
     * @param  Link[]|null $links
     *
     * @return $this
     */
    public function setLinks($links = null)
    {
        if (is_null($links)) {
            if (is_null($this->data) && is_null($this->meta)) {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException("Data, Links, and Meta cannot all be null.");
            }
        } else {
            if (gettype($links) !== 'array') {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidLinkException(self::class);
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
     * @param  array|null $meta
     *
     * @return $this
     */
    public function setMeta($meta = null)
    {
        if (is_null($meta)) {
            if (is_null($this->data) && is_null($this->links)) {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException("Data, Links, and Meta cannot all be null.");
            }
        } else {
            if (gettype($meta) !== 'array') {
                throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException(self::class);
            }
        }

        $this->meta = $meta;
        return $this;
    }

    public function toArray()
    {
        $returned_array = [
            $this->key => []
        ];

        if ($this->data) {
            $returned_array[$this->key]['data'] = array_reduce($this->data, function($prev, $resource_identifier) {
                return array_merge($prev, $resource_identifier->toArray());
            }, []);
        }
        if ($this->links) {
            $returned_array[$this->key]['links'] = array_reduce($this->links, function($prev, $link) {
                return array_merge($prev, $link->toArray());
            }, []);
        }
        if ($this->meta) {
            $returned_array[$this->key]['meta'] = $this->meta;
        }

        return $returned_array;
    }
}
