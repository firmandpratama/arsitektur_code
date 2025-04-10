<?php
error_reporting(E_ERROR | E_WARNING | E_ALL);
function dd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    die();
    // Menghentikan eksekusi skrip
}


function errorCheck($koneksi)
{
    echo "Gagal insert. query error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi);

    // Menghentikan eksekusi skrip
}
