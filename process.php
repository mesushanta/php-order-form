<?php

session_start();
// var_dump($_COOKIE);
// var_dump($_GET);
// var_dump($_POST);


// var_dump($_SESSION);

$message = [];
$history = [];
$total = [];


$food_data = [
  ['id' => 1, 'name' => 'Club Ham', 'price' => 3.20, 'img' => 'https://www.mcdonalds.be/_webdata/product-images/de-hamburger.png'],
  ['id' => 2, 'name' => 'Club Cheese', 'price' => 3, 'img' => 'https://www.mcdonalds.be/_webdata/product-images/de-cheeseburger.png'],
  ['id' => 3, 'name' => 'Club Cheese & Ham', 'price' => 4, 'img' => 'https://www.mcdonalds.be/_webdata/product-images/de-double-cheese.png'],
  ['id' => 4, 'name' => 'Club Chicken', 'price' => 4, 'img' => 'https://www.mcdonalds.be/_webdata/product-images/mcchicken.png'],
  ['id' => 5, 'name' => 'Club Salmon', 'price' => 5, 'img' => 'https://www.mcdonalds.be/_webdata/product-images/royal-o-fish.png']
];
$drink_data = [
  ['id' => 6, 'name' => 'Cola', 'price' => 2, 'img' => 'https://www.mcdonalds.be/_webdata/product-images/12100825_Update_Drinks-Logos_500x50018.png'],
  ['id' => 7, 'name' => 'Fanta', 'price' => 2, 'img' => 'https://www.mcdonalds.be/_webdata/product-images/12100825_Update_Drinks-Logos_500x50016.png'],
  ['id' => 8, 'name' => 'Sprite', 'price' => 2, 'img' => 'https://www.mcdonalds.be/_webdata/product-images/12100825_Update_Drinks-Logos_500x50013-01.png'],
  ['id' => 9, 'name' => 'Ice-tea', 'price' => 3, 'img' => 'https://www.mcdonalds.be/_webdata/product-images/12100825_Update_Drinks-Logos_500x50017.png'],
];

$type = 'food';
if(isset($_GET['type'])) {
  $type = $_GET['type'];
}

if($type == 'drink') {
  $foods = $drink_data;
}
else {
  $foods = $food_data;
}
if (isset($_POST['process'])) {
  $message = submit_order();
}
if (isset($_POST['add_to_cart'])) {
  addToCart();
}

function submit_order() {
  
  if(isset($_POST['name'])) {
    $_SESSION['name'] = $_POST['name'];
    if($_POST['name'] == '') {
      $message['status'] = 'error';
      $message['error']['name'] = "Please provide your full name";
    }
    else {
      $message['status'] = 'ok';
      $message['error']['name'] = "";
    }
  }
  
  if(isset($_POST['email'])) {
    $_SESSION['email'] = $_POST['email'];
    
    if($_POST['email'] == '') {
      $message['status'] = 'error';
      $message['error']['email'] = "Please provide your email address";
    }
    else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $message['status'] = 'error';
      $message['error']['email'] = "This is invalid email address";
    }
    else {
      $message['status'] = 'ok';
      $message['error']['email'] = "";
    }
  
  }
  
  if(isset($_POST['phone'])) {
    $_SESSION['phone'] = $_POST['phone'];
    
    if($_POST['phone'] == '') {
      $message['status'] = 'error';
      $message['error']['phone'] = "Please provide your phone number";
    }
    else if(!filter_var($_POST['phone'], FILTER_VALIDATE_INT)) {
      $message['status'] = 'error';
      $message['error']['phone'] = "Phone number must be a number";
    }
    else if($_POST['phone'] < 0) {
      $message['status'] = 'error';
      $message['error']['phone'] = "Phone number can't be a negative number";
    }
    else {
      $message['status'] = 'ok';
      $message['error']['phone'] = "";
    }
  }
  
  if(isset($_POST['city'])) {
    $_SESSION['city'] = $_POST['city'];
    
    if($_POST['city'] == '') {
      $message['status'] = 'error';
      $message['error']['city'] = "Where shoud we deliver the food?";
    }
    else {
      $message['status'] = 'ok';
      $message['error']['city'] = "";
    }
  }
  if(isset($_POST['postcode'])) {
    $_SESSION['postcode'] = $_POST['postcode'];
    if($_POST['postcode'] == '') {
      $message['status'] = 'error';
      $message['error']['postcode'] = "Please provide your postcode";
    }
    else if(!filter_var($_POST['postcode'], FILTER_VALIDATE_INT)) {
      $message['status'] = 'error';
      $message['error']['postcode'] = "Postcode is always must be a number";
    }
    else if($_POST['postcode'] < 0) {
      $message['status'] = 'error';
      $message['error']['postcode'] = "How comes the postcode negative number ?";
    }
    else {
      $message['status'] = 'ok';
      $message['error']['postcode'] = "";
    }
  }
  if(isset($_POST['street'])) {
    $_SESSION['street'] = $_POST['street'];
    if($_POST['street'] == '') {
      $message['status'] = 'error';
      $message['error']['street'] = "Street name please";
    }
    else {
      $message['status'] = 'ok';
      $message['error']['street'] = "";
    }
  }
  if(isset($_POST['house'])) {
    $_SESSION['house'] = $_POST['house'];
    if($_POST['house'] == '') {
      $message['status'] = 'errosr';
      $message['error']['house'] = "Please provide your postcode";
    }
    else if(!filter_var($_POST['house'], FILTER_VALIDATE_INT)) {
      $message['status'] = 'error';
      $message['error']['house'] = "Postcode is always must be a number";
    }
    else if($_POST['house'] < 0) {
      $message['status'] = 'error';
      $message['error']['house'] = "How comes the house number negative number ?";
    }
    else {
      $message['status'] = 'ok';
      $message['error']['house'] = "";
    }
  }
  return $message;
}

function addToCart() {
    $id = $_POST['item_id'];
    $cart = array();

    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
    }
    
    $new_item = array(
       'id' => $id,
       'name' => $_POST['item_name'],
       'qty' => 1,
       'price' => $_POST['item_price'],
       'img' => $_POST['item_img'],
    );
    array_push($cart, $new_item);
    
    $_SESSION['cart'] = $cart;
    
    // setcookie('cart', json_encode($cart), time() + (86400 * 30), "/"); // 86400 = 1 day
  }
  
  function clearCart() {
    // setcookie('cart', '', time() - 3600);
    $_SESSION['cart'] = '';
  }