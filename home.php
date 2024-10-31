<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Z&G</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
   <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
   <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
   <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
   <link rel="stylesheet" href="css/nice-select.css" type="text/css">
   <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
   <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
   <link rel="stylesheet" href="css/styles.css" type="text/css">
   <link rel="stylesheet" href="css/owl.theme.default.min.css">
</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="hero">
      <div class="hero__slider owl-carousel">
         <div class="hero__items set-bg" data-setbg="img/hero/zg-menn.jpg">
            <div class="container">
               <div class="row">
                  <div class="col-xl-5 col-lg-7 col-md-8">
                     <div class="hero__text" color="white">
                        <h1>PRIA</h1>
                        <h4>UP TO 70%</h4>
                        <a href="shop.php" class="primary-btn">Buy now <span class="arrow_right"></span></a>
                        <div class="hero__social">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="hero__items set-bg" data-setbg="img/hero/aldies.jpg">
            <div class="container">
               <div class="row">
                  <div class="col-xl-5 col-lg-7 col-md-8">
                     <div class="hero__text">
                        <h1>PEREMPUAN</h6>
                        <h4>UP TO 70%</h>
                        <p></p>
                        <a href="shop.php" class="primary-btn">Buy now <span class="arrow_right"></span></a>
                        <div class="hero__social">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </section>

   <section class="category">
      <h1 class="heading">Buy Arrival</h1>
      <div class="swiper category-slider">
         <div class="swiper-wrapper">
            <a href="category.php?category=wanita" class="swiper-slide slide">
               <h3>Wanita</h3>
            </a>
            <a href="category.php?category=pria" class="swiper-slide slide">
               <h3>Pria</h3>
            </a>
            <a href="category.php?category=bayi" class="swiper-slide slide">
               <h3>Bayi</h3>
            </a>
            <a href="category.php?category=anak" class="swiper-slide slide">
               <h3>Anak</h3>
            </a>
            <a href="category.php?category=sport" class="swiper-slide slide">
               <h3>Sport</h3>
            </a>
            <a href="category.php?category=sale" class="swiper-slide slide">
               <h3>Sale</h3>
            </a>
         </div>
         <div class="swiper-pagination"></div>
      </div>
   </section>

   <section class="home-products">
      <h1 class="heading">Produk Terbaru</h1>
      <div class="swiper products-slider">
         <div class="swiper-wrapper">
            <?php
            $select_products = $conn->prepare("SELECT * FROM products LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                  <form action="" method="post" class="swiper-slide slide">
                     <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['details']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_02']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_03']; ?>">
                     <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <div class="name"><?= $fetch_product['name']; ?></div>
                     <div class="details"><?= $fetch_product['details']; ?></div>
                     <div class="flex">
                        <div class="price"><span>Rp</span><?= $fetch_product['price']; ?><span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                        <button class="fas fa-cart-shopping fa-2x my-button" type="submit" name="add_to_cart"></button>
                     </div>
                  </form>
            <?php
               }
            } else {
               echo '<p class="empty">Belum ada produk yang ditambahkan!</p>';
            }
            ?>
         </div>
         <div class="swiper-pagination"></div>
      </div>
   </section>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".home-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });

      var swiper = new Swiper(".category-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 2,
            },
            650: {
               slidesPerView: 3,
            },
            768: {
               slidesPerView: 4,
            },
            1024: {
               slidesPerView: 5,
            },
         },
      });

      var swiper = new Swiper(".products-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            550: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="js/owl.carousel.min.js"></script>
   <script>
      $(document).ready(function() {
         $('.set-bg').each(function() {
            var bg = $(this).data('setbg');
            $(this).css('background-image', 'url(' + bg + ')');
         });

         $(".hero__slider").owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
         });
      });
   </script>
</body>

</html>