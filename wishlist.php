<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:user_login.php');
};

include 'components/wishlist_cart.php';

if (isset($_POST['delete'])) {
   $wishlist_id = $_POST['wishlist_id'];
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
   $delete_wishlist_item->execute([$wishlist_id]);
}

if (isset($_GET['delete_all'])) {
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist_item->execute([$user_id]);
   header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wishlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="products">

      <h3 class="heading">Your Wishlist</h3>

      <div class="box-container">

         <?php
         $grand_total = 0;
         $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
         $select_wishlist->execute([$user_id]);
         if ($select_wishlist->rowCount() > 0) {
            while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
               // Query to fetch product details
               $select_product = $conn->prepare("SELECT * FROM products WHERE id = ?");
               $select_product->execute([$fetch_wishlist['pid']]);
               $product = $select_product->fetch(PDO::FETCH_ASSOC);

               // Check if product exists and has stock
               if ($product && $product['stock'] > 0) {
                  $grand_total += $fetch_wishlist['price'];
         ?>
                  <form action="" method="post" class="box">
                     <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
                     <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_wishlist['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">
                     <a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="">
                     <div class="name"><?= $fetch_wishlist['name']; ?></div>
                     <div class="flex">
                        <div class="price">Rp<?= $fetch_wishlist['price']; ?>/-</div>
                        <div class="stock">Stok: <?= $product['stock']; ?></div>
                        <input type="number" name="qty" class="qty" min="1" max="<?= $product['stock']; ?>" onkeypress="if(this.value.length==2) return false;" value="1">
                     </div>
                     <input type="submit" value="Masukkan ke keranjang" class="btn" name="add_to_cart">
                     <input type="submit" value="hapus item" onclick="return confirm('hapus ini dari daftar keinginan?');" class="delete-btn" name="delete">
                  </form>
               <?php } else { ?>
                  <div class="box">
                     <a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="">
                     <div class="name"><?= $fetch_wishlist['name']; ?></div>
                     <div class="empty-stock">Stok Habis</div>
                     <div class="flex">
                        <div class="price">Rp<?= $fetch_wishlist['price']; ?>/-</div>
                     </div>
                     <form action="" method="post">
                        <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                        <?php if ($product['stock'] > 0) { ?>
                           <input type="submit" value="masukkan ke keranjang" class="btn" name="add_to_cart">
                        <?php } else { ?>
                           <input type="button" value="Stok Habis" class="btn" disabled style="background-color: #ccc;">
                        <?php } ?>
                        <input type="submit" value="hapus item" onclick="return confirm('hapus ini dari daftar keinginan?');" class="delete-btn" name="delete">
                     </form>
                  </div>
         <?php
               }
            }
         } else {
            echo '<p class="empty">Daftar keinginan anda kosong</p>';
         }
         ?>
      </div>

      <div class="wishlist-total">
         <p>grand total : <span>Rp<?= $grand_total; ?>/-</span></p>
         <a href="shop.php" class="option-btn">lanjut belanja</a>
         <a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('hapus semua dari wishlist?');">hapus semua item</a>
      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".hero__slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });
   </script>

</body>

</html>