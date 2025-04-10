<?php
include '../koneksi.php';

if (isset($_POST['simpan_check_store'])) {
    $email_sales = $_POST['email_sales'];
    $account_number = $_POST['account_number'];
    $nama_mitra = $_POST['nama_mitra'];
    $nama_item = $_POST['nama_item'];
    $qty = $_POST['qty'];
    $goodwill = $_POST['goodwill'];
    $intelegent = $_POST['intelegent'];
    $ttnt = $_POST['ttnt'];

    $datenow = date('Y-m-d H:i:s');

    $koneksi->begin_transaction();

    try {
        foreach ($nama_item as $index => $item) {
            $qty_item = $qty[$index];

            $sql = "INSERT INTO tbl_check_store_stock_activity (nama_item, qty, goodwill, intelegent, ttnt, create_time) 
                    VALUES (?, ?, ?, ?, ?, ?)";

            if ($stmt = $koneksi->prepare($sql)) {
                $stmt->bind_param("sissss", $item, $qty_item, $goodwill, $intelegent, $ttnt, $datenow);

                $stmt->execute();
            } else {
                throw new Exception("Gagal mempersiapkan query: " . $koneksi->error);
            }
        }

        $koneksi->commit();
        echo "Data berhasil disimpan!";
    } catch (Exception $e) {
        $koneksi->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}

$koneksi->close();
