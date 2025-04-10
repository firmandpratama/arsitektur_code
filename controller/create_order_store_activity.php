<?php
require '../koneksi.php';
require '../helpers/debug.php';

// dd($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $pdo->beginTransaction();

        $activityID = $_POST['activityID'] ?? null;
        $accountNumber = $_POST['account_number'] ?? null;
        $storeName = $_POST['store_name'] ?? null;
        $noted = $_POST['noted'] ?? null;
        $page = $_POST['storePage'] ?? null;

        $sql = "INSERT INTO tbl_create_order_store_activities (account_number, store_name, noted, page) 
                VALUES (:account, :store, :noted, :page)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':account' => $accountNumber,
            ':store' => $storeName,
            ':noted' => $noted,
            ':page' => $page
        ]);
        $orderId = $pdo->lastInsertId();

        $namaItems = isset($_POST['item_name']) ? (array)$_POST['item_name'] : [];
        $skus = isset($_POST['sku']) ? (array)$_POST['sku'] : [];
        $stocks = isset($_POST['stock']) ? (array)$_POST['stock'] : [];
        $qtys = isset($_POST['c_qty']) ? (array)$_POST['c_qty'] : [];

        $jumlahItem = max(count($namaItems), count($skus), count($stocks), count($qtys));

        for ($i = 0; $i < $jumlahItem; $i++) {
            $namaItem = $namaItems[$i] ?? null;
            $sku = $skus[$i] ?? null;
            $stock = isset($stocks[$i]) ? (int)$stocks[$i] : null;
            $qty = isset($qtys[$i]) ? (int)$qtys[$i] : null;

            if (!$namaItem || !$sku || is_null($stock) || is_null($qty)) {
                continue;
            }

            $sql = "INSERT INTO tbl_create_order_items (create_order_id, name_item, sku, stock, qty) 
                    VALUES (:create_order_id, :name_item, :sku, :stock, :qty)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':create_order_id' => $orderId,
                ':name_item' => $namaItem,
                ':sku' => $sku,
                ':stock' => $stock,
                ':qty' => $qty,
            ]);
        }

        $pdo->commit();

        $redirectPage = ($page === 'store_activity') ? '../store_activity_report.php' : '../store_activity.php';
        echo "<script>alert('New order successfully created!'); window.location.href = '$redirectPage?checkID=$activityID';</script>";
    } catch (Exception $e) {
        $pdo->rollBack();
        $redirectPage = ($page === 'store_activity') ? '../store_activity_report.php' : '../store_activity.php';
        echo "<script>alert('New order failed!'); window.location.href = '$redirectPage?checkID=$activityID';</script>";
    }
} else {
    $redirectPage = ($page === 'store_activity') ? '../store_activity_report.php' : '../store_activity.php';
    echo "<script>alert('New order failed to be created!'); window.location.href = '$redirectPage?checkID=$activityID';</script>";
}
