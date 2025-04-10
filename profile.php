<?php
include "templates/header.php";
// dd($password);

include "templates/sidebar.php";
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM tbl_face_recognition WHERE email = '$email'");
$getquery = mysqli_fetch_assoc($query);



?>

<style>
    .inner-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .banner-wrapper {
        padding: 10px 0 10px;
    }

    .dz-info {
        flex-grow: 1;
        text-align: center;
    }

    .dz-media {
        flex-shrink: 0;
    }

    .card {
        height: 100% !important;
        padding: -1px;
        font-size: 10px;
    }

    .fs-lg {
        font-weight: bold;
    }

    .inner-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .dz-info {
        flex-grow: 1;
        text-align: center;
    }

    .dz-media {
        flex-shrink: 0;
    }

    .banner-wrapper {
        margin-bottom: 0px;
    }
</style>

<div class="banner-wrapper author-notification" style="box-shadow: 3px 3px 3px lightslategrey;">
    <div class="container inner-wrapper">
        <div class="dz-media">
        </div>
        <div class="dz-info">
            <b class="name mb-0 text-center fs-6">Profile</b>
        </div>
        <div class="dz-media">
            <a href="notifications.php" class="text-white">
                <i class="fa-regular fa-bell fs-5 me-3"></i>
            </a>
        </div>
    </div>
</div>

<!-- <div class="calendar-container">
    <div class="calendar-header">
        <button id="prev-month"><i class="fa-solid fa-chevron-left"></i></button>
        <span class="month-year" id="month-year">Januari 2025</span>
        <button id="next-month"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
    <div class="calendar-dates" id="calendar-dates"></div>
</div> -->

<!-- Page Content -->
<div class="page-content bottom-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dz-list">
                            <ul>
                                <li>
                                    <a href="#" class="item-content">
                                        <?php if (empty($getquery['foto_profil'])) : ?>
                                            <img src="assets/images/3d_avatar_13.png" alt="">
                                        <?php else :
                                            echo '<img src="assets/images/avatar/' . $getquery['foto_profil'] . '" alt="" style="border-radius: 100%;" width="80" height="80">';
                                        endif; ?>

                                        &nbsp;&nbsp;
                                        <div class="dz-inner">
                                            <ount class="dz-title"><?= $name_sales; ?></ount><br>
                                            <ount class="dz-title"><?= $nik_sales; ?></ount><br>
                                            <ount class="dz-title"><?= $divisi; ?></ount><br>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="profile_account.php" class="item-content item-link">
                                        <div class="me-3">
                                            <i class="fa-regular fa-circle-user" style="font-size: 32px;"></i>
                                        </div>
                                        <div class="dz-inner">
                                            <ount class="dz-title">Account</ount>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="item-content item-link">
                                        <div class="me-3">
                                            <i class="fa-solid fa-book-open" style="font-size: 28px;"></i>
                                        </div>
                                        <div class="dz-inner light">
                                            <span class="dz-title">User Guide</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="katalog_product.php" class="item-content item-link">
                                        <div class="me-3">
                                            <i class="fa-solid fa-swatchbook" style="font-size: 27px;"></i>
                                        </div>
                                        <div class="dz-inner light">
                                            <span class="dz-title">Katalog Product</span>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                if ($jabatan_pos == 'Sales Spv (Branch)') {
                                ?>
                                    <li>
                                        <a href="https://emoa.avaija.com/e-moa/login_bysalesapp.php?email=<?= $email; ?>&password=<?= $password_view; ?>" target="_blank" class="item-content item-link">
                                            <div class="me-3">
                                                <i class="fa-solid fa-grip" style="font-size: 27px;"></i>
                                            </div>
                                            <div class="dz-inner light">
                                                <span class="dz-title">E-MOA</span>
                                            </div>
                                        </a>
                                    </li>
                                <?php
                                } ?>
                                <li>
                                    <a href="logout.php" class="item-content item-link">
                                        <div class="me-3">
                                            <i class="fa-solid fa-right-from-bracket" style="font-size: 32px;"></i>
                                        </div>
                                        <div class="dz-inner">
                                            <span class="dz-title">Logout</span>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Content End-->



<?php
include "templates/menubar.php";
include "templates/footer.php";
?>