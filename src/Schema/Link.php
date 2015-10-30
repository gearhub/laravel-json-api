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
        $this->key  = $key;
        $this->href = $href;
        $this->meta = $meta;
    }

    /**
     * Add to existing metadata.
     *
     * @param array $meta
     *
     * @return $this
     */
    public function addMeta(array $meta)
    {
        if (is_array($this->meta)) {
            $this->meta = array_merge($this->meta, $meta);
        } else {
            $this->meta = $meta;
        }
        return $this;
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
     * Creates array representation of Link.
     *
     * @return array
     */
    public function toArray()
    {
        $this->validate();
        $returned_array = [];
        if ($this->isObject) {
            $returned_array[
                $this->key => [
                    'href' => $this->href,
                    'meta' => $this->meta
                ]
            ];
        } else {
            $returned_array[
                $this->key => $this->href
            ];
        }
        return $returned_array;
    }

    /**
     * Set metadata on Link.
     *
     * @param  array  $meta
     *
     * @return $this
     */
    public function withMeta(array $meta)
    {
        $this->meta = $meta;
        return $this;
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

    /**
     * Validate link.
     *
     * @return void
     */
    protected function validate()
    {
        $this->validateKey();
    }

    /**
     * Validate Link key.
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\InvalidLinkKeyException
     */
    protected function validateKey()
    {
        if (!in_array($this->key, $this->allowable_keys)) {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidLinkKeyException($this->key);
        }
    }
}
