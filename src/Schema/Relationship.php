<?php

namespace SonarStudios\LaravelJsonApi\Schema;

use Illuminate\Contracts\Support\Arrayable;

class Relationship implements Arrayable
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var array
     */
    protected $links;

    /**
     * @var array|null
     */
    protected $meta;

    /**
     * Create a new relationship instance.
     *
     * @param string                                  $key
     * @param ResourceIdentifier|ResourceIdentifier[] $data
     * @param Links[]                                 $links
     * @param array|null                              $meta
     *
     * @return void
     */
    public function __construct($key, $data, $links, $meta = null)
    {
        $this->key   = $key;
        $this->data  = $data;
        $this->links = $links;
        $this->meta  = $meta;
    }
}
