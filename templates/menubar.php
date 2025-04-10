<?php
$home_files = [
    'home.php'
];
$store_activity = [
    'store_activity.php',
    'store_activity_checkin_oor.php',
    'store_activity_checkout_oor.php',
    'store_activity_cam.php',
    'store_activity_cam_out.php',
    'store_activity_ci.php',
    'store_activity_co.php',
    'store_activity_report.php',
    'store_activity_coor_picture.php',
    'store_oor.php',
    'oor_check_stock.php',
];

$profile = [
    'profile.php',
    'profile_account.php',
];

$nop = ['new_open_outlet.php'];
$calendar = [
    'calendar.php'
];

$current_file = basename($_SERVER['PHP_SELF']);
?>

<!-- Menubar -->
<div class="menubar-area">
    <div class="toolbar-inner menubar-nav">
        <a href="home.php" class="nav-link <?= in_array($current_file, $home_files) ? 'active' : '' ?>">
            <i class="fa-solid fa-house text-white icon-sm"></i>
            <span class="text-white fs-sm">Home</span>
        </a>
        <a href="store_activity.php" class="nav-link <?= in_array($current_file, $store_activity) ? 'active' : '' ?>">
            <i class="fa-solid fa-clipboard text-white icon-sm"></i>
            <span class="text-white fs-sm">Store Activity</span>
        </a>
        <a href="new_open_outlet.php" class="nav-link <?= in_array($current_file, $nop) ? 'active' : '' ?>">
            <i class="fa-solid fa-box text-white icon-sm"></i>
            <span class="text-white fs-sm">New Open Outlet</span>
        </a>
        <a href="calendar.php" class="nav-link <?= in_array($current_file, $calendar) ? 'active' : '' ?>">
            <i class="fa-solid fa-calendar-days text-white icon-sm"></i>
            <span class="text-white fs-sm">Calendar</span>
        </a>
        <a href="profile.php" class="nav-link <?= in_array($current_file, $profile) ? 'active' : '' ?>">
            <i class="fa-regular fa-user text-white icon-sm"></i>
            <span class="text-white fs-sm">Profile</span>
        </a>
    </div>
</div>
<!-- Menubar -->