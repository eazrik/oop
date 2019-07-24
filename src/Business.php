<?php

namespace Acme;

class Business
{
    protected $staff;

    /**
     * Business constructor.
     *
     * @param Staff $staff staff
     */
    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

    /**
     * @param Person $person person
     */
    public function hire(Person $person)
    {
        $this->staff->add($person);
    }

    /**
     * @return array
     */
    public function getStaffMembers()
    {
        return $this->staff->members();
    }
}
