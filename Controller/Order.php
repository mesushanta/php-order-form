<?php

namespace App\Controller;

require './Store/drink.php';
require './Store/food.php';

use Store\Food;
use Store\Drink;

/**
 *
 */
class Order
{

  // require './data/data.php';/

  private $type = 0;
  private $foods;
  // private $food_data;
  // private $drink_data;
  private $data;

  function __construct()
  {
    if(isset($_GET['type'])) {
      $this->type = $_GET['type'];
    }
    $this->data = (object) file_get_contents("./Data/data.php");
    // $this->data = $data;
    // $this->food_data = $data['food_data'];
    // $this->drink_data = $data->drink_data;
  }

  function getFoodList() {
    var_dump($this->data[0]);

    if(!$this->type) {
      // foreach($this->data as $key => $data) {
      //   var_dump($data[$key].'<br>');
      // }

      $food_obj = new Food($food_data);
      $foods = $food_obj->getFood();
      $foods = (object) $foods[0];
    }
    else {
      $drink_obj = new Drink($drink_data);
      $drinks = $drink_obj->getDrink();
      $foods = (object) $drinks[0];
    }

    return $foods;
  }

}
