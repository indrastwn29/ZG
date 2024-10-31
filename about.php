<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/logooo.png" alt="">
      </div>

      <div class="content">
         <h3>ZG</h3>
         <h3>RP | Indonesia</h3>
         <p>Konsep bisnis ZG adalah menawarkan mode dan kualitas terbaik dengan harga terjangkau serta berkomitmen pada praktik berkelanjutan. ZG telah menjadi salah satu perusahaan fashion terkemuka di dunia dengan fokus pada tren dan inovasi yang ramah lingkungan.</p>
         <p>ZG juga mematuhi regulasi di Indonesia, termasuk menyediakan layanan pengaduan konsumen sesuai peraturan dari Kementerian Perdagangan Republik Indonesia. Semua konten di situs web ZG dilindungi hak cipta dan merupakan milik ZG.</p>
         <a href="contact.php" class="btn">Hubungi kami</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">ulasan klien</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/P1.jpeg" alt="">
         <p>Saya senang berbelanja menggunakan website Tokoqu karena sangat mudah digunakan.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>FALLEVI</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/P1.jpeg" alt="">
         <p>Tokoqu sangat lengkap dan gampang diakses dan lengkap.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>FALLEVI</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/P4.jpg" alt="">
         <p>Saya sangat suka berbelanja melalui Tokoqu karena lengkap dan mudah digunakan.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>DAFFA</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/P3.jpeg" alt="">
         <p>Pembayaran di Tokoqu sangat lengkap sehingga saya sangat senang berbelanja disini.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>UFARENGGA</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/P2.jpeg" alt="">
         <p>Saya belanja di Tokoqu karena disini saya merasa aman untuk berbelanja.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>FALLEVI</h3>
      </div>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>