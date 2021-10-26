<?php

namespace Store;
 /**
  * The data
  */
 class Food
 {

   private $food;

   function __construct(...$food)
   {
     $this->food = $food;
   }

   function getFood() {
     return $this->food;
   }

 }
