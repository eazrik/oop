<?php

namespace Acme;

/**
 * Class Person
 *
 * @package Acme
 */
class Person
{
    /**
     * @var string $name
     */
    protected $name;

    /**
     * Person constructor.
     *
     * @param string $name Person name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}
