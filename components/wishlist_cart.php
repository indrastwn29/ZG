<?php

if(isset($_POST['add_to_wishlist'])){
   if($user_id == ''){
      header('location:user_login.php');
   }else{
      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);

      // Check if the product is already in the wishlist
      $check_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE pid = ? AND user_id = ?");
      $check_wishlist->execute([$pid, $user_id]);
      if($check_wishlist->rowCount() == 0){
         $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
         $insert_wishlist->execute([$user_id, $pid, $name, $price, $image]);
         $message[] = 'added to wishlist!';
      } else {
         $message[] = 'already in wishlist!';
      }
   }
}

if(isset($_POST['add_to_cart'])){
   if($user_id == ''){
      header('location:user_login.php');
   }else{
      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      // Check if the product is already in the cart
      $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE pid = ? AND user_id = ?");
      $check_cart->execute([$pid, $user_id]);
      if($check_cart->rowCount() == 0){
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         $message[] = 'added to cart!';
      } else {
         $message[] = 'already in cart!';
      }
   }
}

?>
