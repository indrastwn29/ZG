<?php
// Function to get monthly report
function getMonthlyReport($conn, $month, $year) {
    $query = "SELECT * FROM `orders` WHERE MONTH(placed_on) = ? AND YEAR(placed_on) = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$month, $year]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $report = [
        'total_orders' => count($orders),
        'total_pending' => 0,
        'total_completed' => 0,
        'total_revenue' => 0,
        'orders_details' => []
    ];

    foreach ($orders as $order) {
        if ($order['payment_status'] == 'pending') {
            $report['total_pending'] += $order['total_price'];
        } elseif ($order['payment_status'] == 'completed') {
            $report['total_completed'] += $order['total_price'];
            $report['total_revenue'] += $order['total_price'];
        }
        $report['orders_details'][] = $order;
    }

    return $report;
}

// Function to get yearly report
function getYearlyReport($conn, $year) {
    $query = "SELECT * FROM `orders` WHERE YEAR(placed_on) = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$year]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $report = [
        'total_orders' => count($orders),
        'total_pending' => 0,
        'total_completed' => 0,
        'total_revenue' => 0,
        'orders_details' => []
    ];

    foreach ($orders as $order) {
        if ($order['payment_status'] == 'pending') {
            $report['total_pending'] += $order['total_price'];
        } elseif ($order['payment_status'] == 'completed') {
            $report['total_completed'] += $order['total_price'];
            $report['total_revenue'] += $order['total_price'];
        }
        $report['orders_details'][] = $order;
    }

    return $report;
}
?>
