<?php

namespace Acme;

class Staff
{
    protected $members = [];

    /**
     * Staff constructor.
     *
     * @param array $members member
     */
    public function __construct($members = [])
    {
        $this->members = $members;
    }

    /**
     * @param Person $person person
     *
     * @return void
     */
    public function add(Person $person)
    {
        $this->members[] = $person;
    }

    /**
     * @return array
     */
    public function members()
    {
        return $this->members;
    }
}
