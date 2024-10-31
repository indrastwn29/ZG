<?php
include '../components/connect.php';
include '../components/functions.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

$month = date('m');
$year = date('Y');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $month = $_POST['month'];
    $year = $_POST['year'];
}

$report = getMonthlyReport($conn, $month, $year);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    <style>
        .order-box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .order-box.pending {
            border-color: #ffcc00;
            background-color: #fff8e1;
        }
        .order-box.completed {
            border-color: #4caf50;
            background-color: #e8f5e9;
        }
    </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">
    <h1 class="heading">Laporan Bulanan</h1>

    <form method="post" class="box-container">
        <div class="box">
            <label for="month">Bulan</label>
            <select name="month" id="month">
                <?php for ($m = 1; $m <= 12; $m++): ?>
                    <option value="<?= sprintf('%02d', $m) ?>" <?= $m == $month ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $m, 1)) ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="box">
            <label for="year">Tahun</label>
            <select name="year" id="year">
                <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
                    <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>><?= $y ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="box">
            <button type="submit" class="btn">Lihat Laporan</button>
        </div>
    </form>

    <div class="box-container">
        <div class="box">
            <h3><?= $report['total_orders']; ?></h3>
            <p>Pesanan bulan ini</p>
        </div>
        <div class="box">
            <h3><span>Rp.</span><?= number_format($report['total_pending'], 2, ',', '.'); ?><span>/-</span></h3>
            <p>Total tertunda</p>
        </div>
        <div class="box">
            <h3><span>Rp.</span><?= number_format($report['total_completed'], 2, ',', '.'); ?><span>/-</span></h3>
            <p>Total selesai</p>
        </div>
        <div class="box">
            <h3><span>Rp.</span><?= number_format($report['total_revenue'], 2, ',', '.'); ?><span>/-</span></h3>
            <p>Total pendapatan</p>
        </div>
    </div>

    <h2 class="heading">Detail Pesanan</h2>

    <?php foreach ($report['orders_details'] as $order): ?>
        <div class="order-box <?= $order['payment_status'] == 'pending' ? 'pending' : ($order['payment_status'] == 'completed' ? 'completed' : ''); ?>">
            <p><strong>Ditempatkan pada:</strong> <?= $order['placed_on']; ?></p>
            <p><strong>Nama:</strong> <?= $order['name'] ?? 'N/A'; ?></p>
            <p><strong>No HP:</strong> <?= $order['number'] ?? 'N/A'; ?></p>
            <p><strong>Alamat:</strong> <?= $order['address'] ?? 'N/A'; ?></p>
            <p><strong>Total Produk:</strong> <?= $order['total_products']; ?></p>
            <p><strong>Total Pembayaran:</strong> Rp<?= number_format($order['total_price'], 2, ',', '.'); ?>/-</p>
            <p><strong>Metode Pembayaran:</strong> <?= $order['method'] ?? 'N/A'; ?></p>
            <p><strong>Bukti Pembayaran:</strong> <?= $order['bukti'] ?? 'N/A'; ?></p>
        </div>
    <?php endforeach; ?>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
