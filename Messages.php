<?php

use Acme\Person;
use Acme\Staff;
use Acme\Business;

$eazrik = new Person('Eazrik');

$staff = new Staff([$eazrik]);

$acme = new Business($staff);

$acme->hire(new Person('Jane Doe'));

echo '<pre>';
var_dump($acme->getStaffMembers());
echo '</pre>';

echo 'feature test';
echo 'feature test 2';
echo 'feature test 3';

echo 'feature messages';
echo 'feature messages 2';
echo 'feature messages 3';

echo 'feature 58888 1';
echo 'feature 58888 2';
echo 'feature 58888 3';