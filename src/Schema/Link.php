<?php

namespace SonarStudios\LaravelJsonApi\Schema;

use Illuminate\Contracts\Support\Arrayable;

class Link implements Arrayable
{

    /**
     * @var string[]
     */
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
     * @param array $additional_meta
     *
     * @return $this
     */
    public function addMeta($additional_meta)
    {
        if (gettype($additional_meta) !== 'array') {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException(self::class);
        }
        if (is_array($this->meta)) {
            $meta = array_merge($this->meta, $additional_meta);
        } else {
            $meta = $additional_meta;
        }
        return $this->setMeta($meta);
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
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
     * @param string $href
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\Exception
     *
     * @return $this
     */
    public function setHref($href)
    {
        if (empty($href) || gettype($href) !== 'string') {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidArgumentException("Invalid Href for Class [" . self::class . "]. Must be non-empty string");
        }
        $this->href = $href;
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
        if (!in_array($key, $this->allowable_keys)) {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidKeyException(self::class, $this->allowable_keys);
        }
        $this->key = $key;
        return $this;
    }

    /**
     * @param  array|null  $meta
     *
     * @throws \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException
     *
     * @return $this
     */
    public function setMeta($meta)
    {
        if (!is_null($meta) && gettype($meta) !== 'array') {
            throw new \SonarStudios\LaravelJsonApi\Exceptions\InvalidMetaException(self::class);
        }
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $returned_array = [];
        if ($this->isObject()) {
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
