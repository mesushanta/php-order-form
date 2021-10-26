<?php

namespace Stores;
 /**
  * The data
  */
 class Drink
 {

   private $drink;


   function __construct(...$drink)
   {
     $this->drink = $drink;
   }

   function getDrink() {
     return $this->drink;
   }

 }
