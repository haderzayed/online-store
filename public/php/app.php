<?php
include 'A/person.php';
include 'B/person.php';

$person1 =new A\person();
$person2 =new B\person();
$person1->name='Hadeer';
$person2->name='mohamed';
A\person::$country='egypt';
B\person::$country='gaza';

var_dump($person1 ,$person2 );
// echo $person1->name , A\person::$country;
// echo "<br>";
// echo $person2->name , B\person::$country;