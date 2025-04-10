<?php
include "templates/header.php";
include "templates/sidebar.php";
include "koneksi.php";


// dd($_COOKIE);
// include "getApiHome.php";
$parts = explode('-', $kode_cabang);

$branch = isset($parts[1]) ? $parts[1] : '';

$email = $_SESSION['email'];
$query = mysqli_query($koneksi, "SELECT * FROM tbl_face_recognition WHERE email = '$email'");
$getquery = mysqli_fetch_assoc($query);

?>




<!-- Banner -->
<style>
    .inner-wrapper {
        display: flex;
        align-items: center;
        /* Pusatkan vertikal */
        justify-content: space-between;
        /* h5 di tengah, gambar di kanan */
        width: 100%;
    }

    .dz-info {
        flex-grow: 1;
        /* Biarkan dz-info mengisi ruang di tengah */
        text-align: center;
    }

    .dz-media {
        flex-shrink: 0;
        /* Jangan biarkan gambar menyusut */
    }

    #chart {
        margin-left: 30px;
        margin-bottom: -10px;
        margin-top: -30px;
    }

    .card {
        height: 88px !important;
        padding: -1px;
        font-size: 10px;
    }

    @media (max-width: 800px) {
        .fs-md {
            font-size: 16px;
        }

        .fs-md-2 {
            font-size: 19px;
        }

        .fs-md-3 {
            font-size: 15px;
        }

        h6,
        .h6 {
            font-size: 20;
        }

        .display-1 {
            font-size: 4.2rem;
        }

        .activity {
            font-size: 20px !important;
        }
    }

    @media (max-width: 400px) {
        .fs-md {
            font-size: 14px;
        }

        .fs-md-2 {
            font-size: 14px;
        }

        .fs-md-3 {
            font-size: 12px;
        }

        h6,
        .h6 {
            font-size: 11px;
        }

        .display-1 {
            font-size: 1rem;
        }

        .h5,
        .h5 {
            font-size: 1.125rem;
        }
    }
</style>

<div class="banner-wrapper author-notification" style="box-shadow: 3px 3px 3px lightslategrey;">
    <div class="container inner-wrapper">
        <div class="dz-media">
            <h4>HAVE A GOOD JOB!</h4>
        </div>
        <div class="dz-info">


        </div>
        <div class="dz-media d-flex flex-column">
            <img src="assets/images/logo/Importa Logo Primary - White.png" class="img-fluid" style="width: 150px;" alt="">
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between" style="margin-bottom: -30px; padding: 2px; margin-top: -20px; margin-left: 10px;">
        <!-- Bagian Kiri: Profil -->
        <div class="d-flex align-items-center">
            <div class="dz-media media-45 rounded-circle me-3">
                <?php if (empty($getquery['foto_profil'])): ?>
                    <a href="profile.php">
                        <img id="preview" src="assets/images/3d_avatar_13.png" alt="Foto Profil" style="border-radius: 100%;" width="100" height="100">
                    </a>
                <?php else: ?>
                    <a href="profile.php">
                        <img id="preview" src="assets/images/avatar/<?= $getquery['foto_profil'] ?>" class="rounded-circle" alt="author-image" width="50">
                    </a>
                <?php endif; ?>
            </div>
            <div class="ml-3" style="float: left;">
                <h6 class="name mb-0 text-white fs-md"><?= $name_sales; ?></h6>
                <span class="fs-md"><?= $nik_sales; ?></span> <br>
                <span class="fs-md"><?= $jabatan_pos . " - " . $branch; ?></span>
            </div>
        </div>
        <!-- Bagian Kanan: Notifikasi -->
        <div>
            <a href="notifications.php" class="text-white" style="margin-right: 20px;margin-bottom:10px;">
                <i class="fa-regular fa-bell fs-1"></i>
            </a>
        </div>
    </div>

</div>


</div>
<!-- Banner End -->
<!-- Page Content -->
<div class="page-content">

    <div class="content-inner pt-0">
        <div class="container fb">
            <div class="m-b30"></div>


            <!-- Dashboard Area -->
            <div class="dashboard-area">
                <!-- Features -->
                <div class="features-box">
                    <div class="row " style="margin-top: 40px;">
                        <div class="col">
                            <h6 class="text-success">1 New Open Outlet</h6>
                        </div>
                    </div>
                    <div class="row m-b20 g-3" style="margin-top: -10px;">
                        <div class="col">
                            <div class="card p-2 d-flex flex-row align-items-center bg-red-700 card-info">
                                <!-- <div class="display-1 fw-bold me-1">2</div> -->
                                <div class="d-flex flex-column lh-2">
                                    <span class="fs-md-2 fw-semibold">Target Omset</span>
                                    <span class="fs-md-2">Rp 50.000.000</span>
                                </div>
                                <div class="ms-auto">

                                    <svg width="50" height="50" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="30" height="30" fill="url(#pattern0_681_611)" />
                                        <defs>
                                            <pattern id="pattern0_681_611" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                <use xlink:href="#image0_681_611" transform="scale(0.0333333)" />
                                            </pattern>
                                            <image id="image0_681_611" width="30" height="30" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA5klEQVR4nO2STQrCMBBGA3XhiXSla1vv4EIvo6CnEo+gC9214gHcieKTgSmk2NC/UEHyNg3tdF6+SYwJBFoCzIErkAFxn2IR5qS+EiQVtVPg7UucWY1kHTnqVsBD6+4iBWZthENgzTdnYJFvQJ7Azvq+dW2uEmAEHLXRS5PKuC+WQNY3TYemXXY5yxR4arMTMLZqIk0rqW3kXCeNpSVnKWxk3KYEYKCb9H6J0hr1if5TuETAweqzryOOyxq1CFDAdGjUKIFPcYGfi3FMog9xgdZiGiZo+t6JL0EQmyrCqM3fX67A3/EBWoUgJENBMakAAAAASUVORK5CYII=" />
                                        </defs>
                                    </svg>

                                </div>
                            </div>
                        </div>



                        <div class="col">
                            <div class="card p-2 d-flex flex-row align-items-center bg-red-700 card-info">
                                <!-- <div class="display-1 fw-bold me-1">0</div> -->
                                <div class="d-flex flex-column lh-2">
                                    <span class="fs-md-2 fw-semibold">Omset Tercapai</span>
                                    <span class="fs-md-2">Rp 30.000.000</span>
                                </div>
                                <div class="ms-auto">

                                    <svg width="50" height="50" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="30" height="30" fill="url(#pattern0_681_616)" />
                                        <defs>
                                            <pattern id="pattern0_681_616" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                <use xlink:href="#image0_681_616" transform="scale(0.015625)" />
                                            </pattern>
                                            <image id="image0_681_616" width="64" height="64" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEoUlEQVR4nO2aW8gVVRSAt6XZ1exipV1EDYvwj7BMBbtAhUKlXSywjCiNJAypvzDLqFCLLpRRSAX+WlpJPYrlg3Z5SMR6UErqxUBJDIpK0tTKvlicZZ2mvefM7FnzM8czH8zLmTlrnbXOnrXXZTtXU1NTUyLAMUB/12kAk4HNNDgIfAKMdZ0AcBfwF/9nP3B5yveGAINdOwMMAH4hzNYU4/cCe9raCcD1tObcgAP2pDkAGA5MBUa7qgLclsEBXgPEcOCMwL2HgT+bZKwCjnBVAxjVwvh9wPE5ZXZpIE0yw1URYE2KA56PkHdvQNabrooAJ+u2l2QF0C9C3nUBByxyVQXoA1wDPAHMA8YUkNUX2Jgw/gcJnK5TAI5TZ34AvAKcnXFL/hBYXsmAWTbAlU0rxru7HNYARwKPATNjBZwuQlwnQiPjknx+tetE+Hfv3WgoU3aFbUC3qzo0trEJwEmGMl9Qp25wnQhwqgalUe5wABgPPKt77RbgMy1SZoqxkTJHaMa4VV+XvNfHqr+PvcWKVHPAp6TzK/BknnaY7NWa4VnwiCsD4Hat6JJIM+OA53NZFadllD0XO340XwU0mh2+slSYBbwduLdJmqM5gqQFf5g2Y2kkRbsDS/1l4Hzd5nrU+0kWZ9AxydAB68yMF7QASSKGDnf+wuWrxLPyegxLPuv57oKUVZaVL32/KxqgH/CzR9F8vX8OcDPwIHAFcGmgK/x4Rn1nag/glohrjJTPZsYLapSPqXr/EjEO+EI/D3WFgwmQBEpgugbCvNcDUvm5sgDuDBj0jKf8fAP4LfD89wH5YwNxIy/vl1L3A3MCCuW97pZ33tO+3uV5fn9A/qEJkgXTynDAtBZKd2vx9E+7G3jU89wOj+yjA/EilsVlOOCigLJVauhO4EXgc2lh63fu8Dy/NiD/O0MH3F9WZbg9oUiGFCOb7g8EBjV9R/KBJPelZJdFtz7h6+TraOmE7oSygxp0xjVvO7qk53mWteT4J6bIvwxYArwXcb2rK/GEUoxvMuybgOcl6t8KPKc1gY9ZLgdijPQiIi7bHKAZTXd9CZHwtJbFPpa7jABTgG+JR/6MZYVWA41BRJevmtLZX54f+FLWfwW4EPgdG3qKOOB1FbIwZeCwSAshUirAq3LqlTrAir3RrwPwmgpZkCEuXKtp8Ksy+ARmA+dF6q2MA/rqUi+vrVT+K7DUtfHhqm0F//meUrfE3qBy2yBwlKSZwMrIZGUpcFNOnZO0uozR9w7wUJZWXEukxJQWk9G7+VTBCjQvm2IOZfwHYCK2zcoBGYJw2hbbuyUyjY6vJV0t9MmROUvmF3XAxYY1+0+t2tVaXe7AjqsLOUDQzK+oE2SLutFlQH50oA2flyXOeCQ2O7JxOQMYmlPfEO1HxuiTIDrOzPim6e7EyHa11PvHugwAZ+kUKrYtXizq+9CJq28mmAdpnY1voWehQXdIhjIjnBXASMMcfXvo3JHxaGy9pQPuwZYL2mo4CtyALYPaajwO9PcMO807NTqBtjogMdfE+EMAp+iEeHPk0ZUNcmqjVYTWqdJbBY7IfATc3du9jJqampoa14b8Ddbk9yKvyZ9GAAAAAElFTkSuQmCC" />
                                        </defs>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row m-b20 g-3" style="margin-top: -42px;">
                        <div class="col">
                            <div class="card p-2 d-flex flex-row align-items-center bg-red-700 card-info">
                                <div class="display-1 fw-bold me-1">2</div>
                                <div class="d-flex flex-column lh-2">
                                    <span class="fs-md-2 fw-semibold">Activity</span>
                                    <span class="fs-md-2">Today</span>
                                </div>
                                <div class="ms-auto">

                                    <svg width="50" height="50" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="31" height="31" fill="url(#pattern0_70_895)" />
                                        <defs>
                                            <pattern id="pattern0_70_895" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                <use xlink:href="#image0_70_895" transform="scale(0.015625)" />
                                            </pattern>
                                            <image id="image0_70_895" width="64" height="64" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAE70lEQVR4nO2b24vVVRTH9+io6ZTd7PoYpqVvoWUOEtjFlEiw/yCqlyhnSgiySIvAoiibDEszCMrpBj1I9NINJi0wQXoJjSwqJ22Y0Yqgm5/YzDrxa7f2b/8ue5/zmzhfOE9n77XXd+3bWmuvnzFddNFFFwkATAMWA7cBu4AR4BtgHDiFQOl3GHhf+twFLAVmmClE+nrgVeAEBaDI0GBlvQLcAsw0TQNwNrBJZrgUFFkhjMpY53eGbQZ2aQJ3AMfLEq9hgBZ+AbYAc00nAMwCDpTka/f/buB+Wc6LFbmXATcCA8BrwNGAzG9t+04Z4WrgZEBBu3+HgGuB3gpj9ADLga0554o9VLfbSUnDNHPIlTCC3RYbgbNMJABnAOuBYx5D7AMujjXevwBcCnxuCQeM8BfwFNBnEkEMYff/H4oR7EE8P/aAl8vpixD1GeEzYEXUwfP1uhL4QjHCd8DCWINcBHytnMDXmAZAVsPbihGszhfUFT5bZlWDuhI6AWA6sFPR8RPLoY7g5zzks0aIs9RqQm6LFxQdh6oKXEsYH1S52hKvhHeUK3J1WUF9Bdxa+/95pmGwniFwSNG1+FYAHg2Q/xNYYhoKuR3cK/Khop3nySmfh22m4QAed3S2nObFmP3xQoKacT2OlloFwExgLGCAgbax8Ou5CNhQoN2g4p774wVgXYD8rzF9+yqQaLEVIW4pcJi7E7o2r8ObAQPsMp2f+R8cnTYF+jzjtB/2NewtkMZabppFHgm1e3L62VDadd56izR0MZY3UBPJZzxEt+9SreEA+diTkmQK8hkZrzt9B7VGOwMG2JiCYGrynsndoTW6XZIMvt+i2ATbQV5krXZkfJhOcwXArdYxKZmAiUJe5C1w5Hxl2gUmc/gWHxdJYdvw2pMJfr7qIQyc68gaq0SmBvkW9uYZIQX5jIebxW9aow3AfTm/6RXeDex7oAt1JTh5x9rLvooBxsjHORUG7pOkCXkrIdXMl9oCTL7K5mF+jahsxGeElDNf6hBEVzKLG2oo4DPCp6nJF74G0ROKWayvqYTPCEnJe8LiHVVc4eEIioSMEJ28jPtGEVf4qoABjmpvgxGNkIp8j/KWuMSXUp4IGGFZJKVcIzybKtIE+h0OJ7xXOv9dKi62RlSsZYRk5GUcKz+L3XUeQ8aBORGVm52Y/FxlVd8cKnk53vSkaFEA9zq6HwsWWQGbAwYY7VhdTgkAZyqT+WBRt/GngBG2m4YDeMLR+efC7jzwSMAA9sFxpWkopFjDfRp7oIyAOcCRgBEOmuYu/S8dXY+UrhMAbsohb7dIv2kYJLX/rrJaV1UVODSFyE/zJHafriN0FrA/RF7i+VIJk5gQL/YlT8h9Wl3hF9r4OYd8v/y3p0ziMxbsW6Wy7BGd49QTM5lQyCPfwqF2Fk7Ia9ZhT/nsgtSD93v8hd+lOOH0xLP+pFSqoJz4l6QaO0Te9RgHI8cO1re/B/jRM+ZI7drAIgAey371EcCERGTLquQT5HRfYctycgqzT8kY7fuYAlhT4QMJ+9ozLCtjlVZjKAUQaySQecvzQuRWhF7XNuKKx7hZ/OxKqPHBxEmpRo+2xSpDAqiHc8rYYxrgexvVNbFG0Ug+YZ0s84mIBrCJmJclYTNlviCbIQff3fIJ3EeZz+b+idSUfvZefw94EbgTuKJJ5bhddNGF+V/hb32sDIvYgCmwAAAAAElFTkSuQmCC" />
                                        </defs>
                                    </svg>

                                </div>
                            </div>
                        </div>



                        <div class="col">
                            <div class="card p-2 d-flex flex-row align-items-center bg-red-700 card-info">
                                <div class="display-1 fw-bold me-1">0</div>
                                <div class="d-flex flex-column lh-2">
                                    <span class="fs-md-2 fw-semibold">Out Of Route</span>
                                    <span class="fs-md-2">Today</span>
                                </div>
                                <div class="ms-auto">
                                    <svg width="50" height="50" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="25" height="25" fill="url(#pattern0_70_941)" />
                                        <defs>
                                            <pattern id="pattern0_70_941" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                <use xlink:href="#image0_70_941" transform="scale(0.02)" />
                                            </pattern>
                                            <image id="image0_70_941" width="50" height="50" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAADjklEQVR4nO3ZXailUxzH8X3GOE15iZlRaETCTGFmkLy7cEOkGGkuGJQykuKOcsGFyVGK4TRISrlBXi6UEg0TM1FqGpoYyks5RmryWhjMR6v5b5bnPM/ez977Ocd+an51aq911vqv9X3WWv/18u90DmjMhDfwMW7EwgbtLgybu/AJ1mNRU/aTcBU+xOaUyPUFbhkFCAtwbQAU9R3uw5Jh7SfhHLydG85BPiv8HmiEshHI7aSRuD6+3NYs/2c8jOPr2k/CcryU2fm2DKTsS/YdoYp6n5fVw4V4AX9Gub/wKs6usp+EpZjC71Hvl0gfPgukT8dmAQ0CUBROwkb8mtV9F1diIit3CO7Cj1HmDzyJY7Iy5SB9pkp3yhXzP8UNOKgXQEkby/AQfspsfYC1uC2fOng5Ta0SG71B+nz52lOvJtBhuANfl7TxHi7uUbceSIU73dW0u442FsWHSdvBR8lJ1KgzGMi4Si8QPI/X5rDxbdHs01lemlqP4owmQV5Pfw12/NS0zuL3BN7BPkxH3sH4IbryVmMgTQrn4bdoZnmPcmfiTqyO9Opwt5tx1EggYWw699t9Oj2JB/ENZmLTug57075RD/0/rrnrftd2RgTZEP/eVmWoUD51vKipYb0bjsTlvfanuiBLYmHWWi8xCkXNDANRFK7AprTnjLxGcDrWVB3H5xjkubC3oQmQtPCStmd59+N7PFMxtR5oCGQV9uDeJkAuwRY82z3cxVFdDPtkwMxki32yCZCum+4UNBRImbAYx3X+J2kKZD6FQ7ETj7Ud5Njo7u62g0yE93qi1SBlai0IFrQexH4P+SUebzvI+cWzX5tHZCtuajVImVoJghNbD2L/7THp5raDvB9dvbQ1IMqvzOkhfH1J2dFBcAKu6V5FcVbcKN9M56IRQKbM1lRF2XogFV9nMl7W0ytH0room0IIXV0WeVdHMGZT3bdhA9w0BwGpelBIb1U74pK1OCt/chqpLH17Vu+0yFuJW7GicCBchiPmCmTke3gCSLtylu5Gm/Z0b31xVU76apAr87yClNg8F0/h7izvkZi+04NcmQcBmbMHhSakCFIVJhj2QWGeorprcpD0oDx0ELQHQB7R6io9gd6TO4ch27igEFzdUtXwuEZ1V+CVzM7uGOl/+9mCqO7GbN/6J6rbq9I4R3X3RlT36F72xzmquw8v4pRB7I9jVPeiUey3Iqp7QJ0x1d9G3Pp/WEvkdgAAAABJRU5ErkJggg==" />
                                        </defs>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>





                </div>

                <!-- Features End -->



                <!-- apexchart -->
                <!-- <div id="chart"> </div> -->
                <!-- end apexchart -->


                <!-- card -->

                <h5 class="activity">Activity Today</h5>

                <div class="container bg-gray-200 ">

                    <div id="data-container">
                    </div>

                    <div id="loader">
                        <p>Loading...</p>
                    </div>



                    <!-- <div class="card shadow h-100 border-right-success">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-2">
                                    <i class="fas fa-calendar fa-2x text-dark"></i>
                                </div>
                                <div class="col-7" style="margin-left: -20px;">
                                    <div class="font-weight-bold text-dark text-uppercase fs-lg" style="margin-top: -13px;">
                                        Toko Mebel</div>
                                    <div class="font-weight-bold text-dark">
                                        06 Januari 2025 10.30-12.10</div>
                                    <div class="text-dark">
                                        Jl. Cik Ditiro</div>
                                </div>
                                <div class="col-3 h6 text-success font-weight-bolder" style="margin-right: 20px;">Done</div>

                            </div>
                        </div>
                    </div> -->
                    <!-- end card -->



                </div>



            </div>
        </div>
    </div>

</div>
<!-- Page Content End-->











<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var page = 1;
        var limit = 5;
        var totalData = window.totalData || 0;


        function loadData(page) {
            $.ajax({
                url: 'controller/getAPiHome.php',
                method: 'GET',
                data: {
                    page: page,
                    limit: limit
                },
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(response) {
                    $('#data-container').append(response);
                    $('#loader').hide();
                },
                error: function() {
                    alert("Gagal memuat data.");
                    $('#loader').hide();
                }
            });
        }


        loadData(page);


        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() == $(document).height() && totalData > (page * limit)) {
                page++;
                loadData(page);
            }
        });
    });
</script>


<!-- 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "getApi.php",
            success: function(response) {
                console.log("Response:", response);
                $("#result").text(JSON.stringify(response, null, 2));
            },
            error: function(xhr, status, error) {
                console.error("Gagal:", xhr.responseText);
                $("#result").text("Gagal mengambil data!");
            }
        });

        $.ajax({
            url: "getApi.php",

            dataType: "json",
            success: function(response) {
                console.log("Data API:", response);

                $(".card-title").text(response.value || "Nama Tidak Tersedia");
                $(".card-date").text(response.tanggal || "Tanggal Tidak Diketahui");
                $(".card-address").text(response.alamat || "Alamat Tidak Ada");
                $(".card-status").text(response.status || "Status Tidak Ada");
            },
            error: function(xhr, status, error) {
                console.error("Gagal:", xhr.responseText);
                $(".card-body").html("<p class='text-danger'>Gagal mengambil data!</p>");
            }
        });
    });
</script> -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                trigger: 'click'
            });
        });


        document.addEventListener("click", function(e) {
            tooltipList.forEach(function(tooltip) {
                if (!tooltip._element.contains(e.target)) {
                    tooltip.hide();
                }
            });
        });
    });
</script>
<?php
include "templates/menubar.php";
include "templates/footer.php";
?>