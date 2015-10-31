<?php

namespace SonarStudios\LaravelJsonApi\Schema;

use Illuminate\Contracts\Support\Arrayable;

class Link implements Arrayable
{

    protected $allowable_keys = [
        'self',
        'related',
        'first',
        'last',
        'previous',
        'next'
    ];

    /**
     * @var string
     */
    protected $href;

    /**
     * @var string
     */
    protected $key;

    /**
     * Metadata for link.
     *
     * @var array|null
     */
    protected $meta;

    /**
     * Create a new Link instance.
     *
     * @param string     $key
     * @param string     $href
     * @param array|null $meta
     *
     * @return void
     */
    public function __construct($key, $href, $meta = null)
    {
        $this->setKey($key);
        $this->setHref($href);
        $this->setMeta($meta);
    }

    /**
     * Add to existing metadata.
     *
     * @param array $additional_meta
     *
     * @return $this
     */
    public function addMeta(array $additional_meta)
    {
        $meta = $this->meta;
        if (is_array($meta)) {
            $meta = array_merge($meta, $additional_meta);
        }
        return $this->setMeta($meta);
    }

    /**
     * Get the href for the link.
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Get the key for the link.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the metadata for the Link.
     *
     * @return array|null
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set Link href.
     *
     * @param string $href
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\Exception
     *
     * @return $this
     */
    public function setHref($href)
    {
        if (empty($href)) {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\Exception("Invalid Href.");
        }
        $this->href = $href;
        return $this;
    }

    /**
     * Set Link key.
     *
     * @param string $key
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\InvalidLinkKeyException
     *
     * @return $this
     */
    public function setKey($key)
    {
        if (!in_array($key, $this->allowable_keys)) {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidLinkKeyException($this->key);
        }
        $this->key = $key;
        return $this;
    }

    /**
     * Set metadata on Link.
     *
     * @param  array|null  $meta
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\Exception
     *
     * @return $this
     */
    public function setMeta($meta)
    {
        if (!is_null($meta) && gettype($meta) !== 'array') {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\Exception("Invalid metadata.");
        }
        $this->meta = $meta;
        return $this;
    }

    /**
     * Create array representation of Link.
     *
     * @return array
     */
    public function toArray()
    {
        $returned_array = [];
        if ($this->isObject) {
            $returned_array[$this->key] = [
                'href' => $this->href,
                'meta' => $this->meta
            ];
        } else {
            $returned_array[$this->key] = $this->href;
        }
        return $returned_array;
    }

    /**
     * Check if the link should have an object value vs. a string.
     *
     * @return boolean
     */
    protected function isObject()
    {
        return isset($this->meta);
    }

}
