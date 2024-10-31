<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo">Admin<span> Panel</span></a>

      <nav class="navbar">
         <a href="../admin/dashboard.php">Home</a>
         <a href="../admin/products.php">Produk</a>
         <a href="../admin/placed_orders.php">Order</a>
         <a href="../admin/admin_accounts.php">Admin</a>
         <a href="../admin/users_accounts.php">User</a>
         <a href="../admin/messages.php">Pesan</a>
         <a href="../admin/monthly_report.php">Laporan Bulanan</a>
         <a href="../admin/yearly_report.php">Laporan Tahunan</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">Update Profile</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">Register</a>
            <a href="../admin/admin_login.php" class="option-btn">Login</a>
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('keluar dari situs web?');">logout</a> 
      </div>

   </section>

</header>
