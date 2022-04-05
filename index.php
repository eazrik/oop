<?php
//and here
require 'vendor/autoload.php';

//require 'Messages.php';

use eazrik\HelloComposer\Hello;

$instance = new Hello();

echo $instance->say("Hello World - I am using eazrik/hello-composer plugin!");
