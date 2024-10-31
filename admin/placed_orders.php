<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit();
}

if (isset($_POST['update_status'])) {
   $order_id = $_POST['order_id'];
   $payment_status = filter_var($_POST['payment_status'], FILTER_SANITIZE_STRING);
   $pengiriman_status = filter_var($_POST['pengiriman_status'], FILTER_SANITIZE_STRING);
   
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ?, pengiriman_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $pengiriman_status, $order_id]);
   
   $message[] = 'Status pembayaran dan pengiriman diperbarui!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Memesan</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="orders">

<h1 class="heading">Memesan</h1>

<div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if ($select_orders->rowCount() > 0) {
         while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
   ?>
   <div class="box">
      <p>Ditempatkan pada : <span><?= htmlspecialchars($fetch_orders['placed_on']); ?></span> </p>
      <p>Nama : <span><?= htmlspecialchars($fetch_orders['name']); ?></span> </p>
      <p>No HP : <span><?= htmlspecialchars($fetch_orders['number']); ?></span> </p>
      <p>Alamat : <span><?= htmlspecialchars($fetch_orders['address']); ?></span> </p>
      <p>Total Produk : <span><?= htmlspecialchars($fetch_orders['total_products']); ?></span> </p>
      <p>Total Pembayaran : <span>Rp<?= htmlspecialchars($fetch_orders['total_price']); ?>/-</span> </p>
      <p>Metode Pembayaran : <span><?= htmlspecialchars($fetch_orders['method']); ?></span> </p>
      <p>Bukti Pembayaran : 
         <?php if (!empty($fetch_orders['bukti'])): ?>
            <img src="../uploaded_img/<?= htmlspecialchars($fetch_orders['bukti']); ?>" alt="Bukti Pembayaran" width="100">
         <?php endif; ?>
      </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= htmlspecialchars($fetch_orders['id']); ?>">
         <select name="payment_status" class="select">
            <option value="pending" <?= ($fetch_orders['payment_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="completed" <?= ($fetch_orders['payment_status'] == 'completed') ? 'selected' : ''; ?>>Selesai</option>
         </select>
         <select name="pengiriman_status" class="select">
            <option value="diproses" <?= ($fetch_orders['pengiriman_status'] == 'diproses') ? 'selected' : ''; ?>>Diproses</option>
            <option value="dalam perjalanan" <?= ($fetch_orders['pengiriman_status'] == 'dalam perjalanan') ? 'selected' : ''; ?>>Dalam Perjalanan</option>
            <option value="telah diterima" <?= ($fetch_orders['pengiriman_status'] == 'telah diterima') ? 'selected' : ''; ?>>Telah Diterima</option>
         </select>
         <div class="flex-btn">
            <input type="submit" value="Update" class="option-btn" name="update_status">
            <a href="placed_orders.php?delete=<?= htmlspecialchars($fetch_orders['id']); ?>" class="delete-btn" onclick="return confirm('Hapus pesanan ini?');">Hapus</a>
         </div>
      </form>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">Belum ada pesanan!</p>';
      }
   ?>

</div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>
