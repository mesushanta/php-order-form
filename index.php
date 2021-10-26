<?php
  include 'process.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Ham Burger</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" integrity="sha512-5D0ofs3AsWoKsspH9kCWlY7qGxnHvdN/Yz2rTNwD9L271Mno85s+5ERo03qk9SUNtdgOZ4A9t8kRDexkvnWByA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>


    <div class="max-w-screen-xl mx-auto my-20">

      <div class="w-full border-b-2 border-dashed border-red-400 py-4">

        <div class="inline-block text-left">
          <h1 class="text-3xl text-gray-800 py-1">Food Ordering</h1>
        </div>

        <div class="inline-block text-right float-right">
          <a href="/?type=food">
            <button type="button" class="px-8 mx-3 py-2 bg-red-500 hover:bg-red-600 border-red-700 rounded-md text-white">Food</button>
          </a>
          <a href="/?type=drink">
            <button type="button" class="px-8 mx-3 py-2 bg-red-500 hover:bg-red-600 border-red-700 rounded-md text-white">Drink</button>
          </a>
        </div>
      </div>

      <div class="grid grid-cols-5 gap-8">

        <div class="col-span-5 md:col-span-3">
          <form class="" action="" method="post">
            <div class="mt-8 bg-gray-100 border border-gray-300 shadow-lg">

              <h3 class="text-2xl text-gray-800 pt-10 px-6">Basic Details</h3>
              <div class="grid grid-cols-2 gap-8 my-4 px-6 py-4">

                <div id="name" class="py-1 col-span-2 md:col-span-1">
                    <label for="name" class="py-2 text-gray-600">Full Name</label><br>
                    <input name="name" type="text" class="px-4 h-12 my-2 block w-full border  focus:outline-none focus:ring-1 <?php if(isset($message['error']['name']) && $message['error']['name'] != '') { ?> border-red-400 focus:ring-red-400 <?php } else { ?> border-gray-400 focus:ring-blue-400<?php } ?> focus:border-transparent text-gray-500 rounded-sm" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; } ?>">
                    <?php if(isset($message['error']['name']) && $message['error']['name'] != '') { ?>
                    <span class="text-red-700 text-sm font-light"><?php echo $message['error']['name']; ?></span>
                    <?php } ?>
                </div>

                <div id="email" class="py-1 col-span-2 md:col-span-1">
                    <label for="email" class="py-2 text-gray-600">Your Email</label><br>
                    <input name="email" type="text" class="px-4 h-12 my-2 block w-full border  focus:outline-none focus:ring-1 <?php if(isset($message['error']['email']) && $message['error']['email'] != '') { ?> border-red-400 focus:ring-red-400 <?php } else { ?> border-gray-400 focus:ring-blue-400<?php } ?> focus:border-transparent text-gray-500 rounded-sm" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; } ?>">
                    <?php if(isset($message['error']['email']) && $message['error']['email'] != '') { ?>
                    <span class="text-red-700 text-sm font-light"><?php echo $message['error']['email']; ?></span>
                    <?php } ?>
                </div>

                <div id="phone" class="py-1 col-span-2 md:col-span-1">
                    <label for="phone" class="py-2 text-gray-600">Phone Number</label><br>
                    <input name="phone" type="text" class="px-4 h-12 my-2 block w-full border  focus:outline-none focus:ring-1 <?php if(isset($message['error']['phone']) && $message['error']['phone'] != '') { ?> border-red-400 focus:ring-red-400 <?php } else { ?> border-gray-400 focus:ring-blue-400<?php } ?> focus:border-transparent text-gray-500 rounded-sm" value="<?php if(isset($_SESSION['phone'])) { echo $_SESSION['phone']; } ?>">
                    <?php if(isset($message['error']['phone']) && $message['error']['phone'] != '') { ?>
                    <span class="text-red-700 text-sm font-light"><?php echo $message['error']['phone']; ?></span>
                    <?php } ?>
                </div>

              </div>

              <h3 class="text-2xl text-gray-800 pt-10 px-6">Address</h3>

              <div class="grid grid-cols-2 gap-8 my-4 px-6 py-4">

                <div id="name" class="py-1 col-span-2 md:col-span-1">
                    <label for="city" class="py-2 text-gray-600">City</label><br>
                    <input name="city" type="text" class="px-4 h-12 my-2 block w-full border  focus:outline-none focus:ring-1 <?php if(isset($message['error']['city']) && $message['error']['city'] != '') { ?> border-red-400 focus:ring-red-400 <?php } else { ?> border-gray-400 focus:ring-blue-400<?php } ?> focus:border-transparent text-gray-500 rounded-sm" value="<?php if(isset($_SESSION['city'])) { echo $_SESSION['city']; } ?>">
                    <?php if(isset($message['error']['city']) && $message['error']['city'] != '') { ?>
                    <span class="text-red-700 text-sm font-light"><?php echo $message['error']['city']; ?></span>
                    <?php } ?>
                </div>

                <div id="email" class="py-1 col-span-2 md:col-span-1">
                    <label for="postcode" class="py-2 text-gray-600">Postcode</label><br>
                    <input name="postcode" type="text" class="px-4 h-12 my-2 block w-full border  focus:outline-none focus:ring-1 <?php if(isset($message['error']['postcode']) && $message['error']['postcode'] != '') { ?> border-red-400 focus:ring-red-400 <?php } else { ?> border-gray-400 focus:ring-blue-400<?php } ?> focus:border-transparent text-gray-500 rounded-sm" value="<?php if(isset($_SESSION['postcode'])) { echo $_SESSION['postcode']; } ?>">
                    <?php if(isset($message['error']['postcode']) && $message['error']['postcode'] != '') { ?>
                    <span class="text-red-700 text-sm font-light"><?php echo $message['error']['postcode']; ?></span>
                    <?php } ?>
                </div>

                <div id="phone" class="py-1 col-span-2 md:col-span-1">
                    <label for="street" class="py-2 text-gray-600">Street</label><br>
                    <input name="street" type="text" class="px-4 h-12 my-2 block w-full border  focus:outline-none focus:ring-1 <?php if(isset($message['error']['street']) && $message['error']['street'] != '') { ?> border-red-400 focus:ring-red-400 <?php } else { ?> border-gray-400 focus:ring-blue-400<?php } ?> focus:border-transparent text-gray-500 rounded-sm" value="<?php if(isset($_SESSION['street'])) { echo $_SESSION['street']; } ?>">
                    <?php if(isset($message['error']['street']) && $message['error']['street'] != '') { ?>
                    <span class="text-red-700 text-sm font-light"><?php echo $message['error']['street']; ?></span>
                    <?php } ?>
                </div>

                <div id="phone" class="py-1 col-span-2 md:col-span-1">
                    <label for="house" class="py-2 text-gray-600">House Number</label><br>
                    <input name="house" type="text" class="px-4 h-12 my-2 block w-full border focus:outline-none focus:ring-1 <?php if(isset($message['error']['house']) && $message['error']['house'] != '') { ?> border-red-400 focus:ring-red-400 <?php } else { ?> border-gray-400 focus:ring-blue-400<?php } ?> focus:border-transparent text-gray-500 rounded-sm" value="<?php if(isset($_SESSION['house'])) { echo $_SESSION['house']; } ?>">
                    <?php if(isset($message['error']['house']) && $message['error']['house'] != '') { ?>
                    <span class="text-red-700 text-sm font-light"><?php echo $message['error']['house']; ?></span>
                    <?php } ?>
                </div>
                
                
                <div class="">
                  <button class="px-6 h-12 bg-blue-500 hover:bg-blue-600 border border-blue-700 text-white" type="submit" name="process">Order</button>
                </div>

              </div>
            </div>

            </form>
        </div>
        <div class="col-span-5 md:col-span-2 h-72 py-8">

          <div class="grid grid-cols-2 gap-4 w-full">
            <?php
            foreach ($foods as $food) {
              $food = (object) $food;
            ?>

            <div class="col-span-2 xl:col-span-1 w-full h-auto text-center border-2 border-blue-400 px-4 py-4">
              <h4 class="text-xl text-red-900 font-light"><?php echo $food->name; ?></h4>
              <img class="w-full mx-auto" src="<?php echo $food->img; ?>" alt="">

              <form class="" action="" method="post">
                <input type="hidden" name="item" value="<?php echo $food->id; ?>">
                <button class="px-4 h-10 mt-4 bg-blue-500 hover:bg-blue-600 hover:bg-blue-700 text-white rounded-sm" type="submit" name="add_to_cart">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                  </svg>
                  <span class="">Add</span>
                </button>
              </form>
            </div>

            <?php
            }
            ?>
          </div>

          <div class="">

          </div>



        </div>
      </div>


    </div>
  </body>
</html>
