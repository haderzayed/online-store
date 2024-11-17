<?php
namespace A;

const laravel="laravel A";
function hello (){
   echo "hello A";
}
class person {
    const MALE = 'm';
    const FEMAle = 'f';
     public $name;
     protected $gender;
     private $age;

     public static $country ;
     public function __constuct(){
       echo __CLASS__ ;
     }
     public function setAge($age){
        $this->age=$age;
        return $this; 
     }
     public function setGender($gender){
        $this->gender=$gender;
        return $this; 
     } 

}