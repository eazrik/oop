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

echo '100';
