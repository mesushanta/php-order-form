<?php

session_start();
// session_unset();
// session_destroy();
// var_dump($_COOKIE);
// var_dump($_GET);
// var_dump($_POST);


// var_dump($_SESSION);

$message = array();
$history_total = 0;

if(isset($_COOKIE['total']) && !empty($_COOKIE['total'])) {
  $history_total = $_COOKIE['total'];
}



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
if(isset($_POST['process'])) {
  $message = submit_order();

  if(empty($message['error']['name']) && empty($message['error']['email']) && empty($message['error']['phone']) && empty($message['error']['city']) && empty($message['error']['postcode']) && empty($message['error']['street']) && empty($message['error']['house'])) {

    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $total = 0;

    setcookie('order_history', json_encode($_SESSION['cart']), time() + (86400 * 30), "/");

    if(isset($_COOKIE['total']) && !empty($_COOKIE['total'])) {
      $total = $_COOKIE['total'];
    }

    foreach($_SESSION['cart'] as $item) {
      $total = $total + ($item['qty'] * $item['price']);
    }

    setcookie('total', $total, time() + (86400 * 30), "/");
    clearCart();
    clearFields();

    }


  }
}
if (isset($_POST['add_to_cart'])) {
  addToCart();
}

function submit_order() {
  $message = array();
  $message['status'] = '';
  if((empty($_POST['name']) && empty($_POST['email']) && empty($_POST['phone']) && empty($_POST['city']) && empty($_POST['postcode']) && empty($_POST['street']) && empty($_POST['house']))) {
    $message['error']['cart'] = "Empty Cart. Please add food to order";
    $message['success'] = false;
  }
  if(isset($_POST['name'])) {
    $_SESSION['name'] = $_POST['name'];
    if($_POST['name'] == '') {
      $message['status'] = 'error';
      $message['error']['name'] = "Please provide your full name";
    }
    else {
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
      $message['error']['house'] = "";
    }
  }

  if(empty($message['error']['name']) && empty($message['error']['email']) && empty($message['error']['phone']) && empty($message['error']['city']) && empty($message['error']['postcode']) && empty($message['error']['street']) && empty($message['error']['house'])) {
    $message['status'] == 'success';
  }
  return $message;
}

function addToCart() {
    $id = $_POST['item_id'];
    $cart = array();

    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
    }
    $qty = 1;
    $is_exist = 0;
    $this_key = '';
    foreach($cart as $key => $value) {
      if($value['id'] == $id) {
        $qty = $value['qty'] + 1;
        $is_exist = 1;
        $this_key = $key;
      }
    }

    if($is_exist) {
      $cart[$this_key] = array(
         'id' => $id,
         'name' => $_POST['item_name'],
         'qty' => $qty,
         'price' => $_POST['item_price'],
         'img' => $_POST['item_img'],
       );

    }
    else {
      $new_item = array(
         'id' => $id,
         'name' => $_POST['item_name'],
         'qty' => 1,
         'price' => $_POST['item_price'],
         'img' => $_POST['item_img'],
       );
      array_push($cart, $new_item);
    }
    $_SESSION['cart'] = $cart;

    // setcookie('cart', json_encode($cart), time() + (86400 * 30), "/"); // 86400 = 1 day
  }

  function clearCart() {
    // setcookie('cart', '', time() - 3600);
    unset($_SESSION['cart']);
  }

  function clearFields() {
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['phone']);
    unset($_SESSION['city']);
    unset($_SESSION['postcode']);
    unset($_SESSION['street']);
    unset($_SESSION['house']);
  }

  function clearCookie() {
    setcookie('cart', '', time() - 3600);
  }
