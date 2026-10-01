<?php
// Opening markup for the principal / HOD / teacher portals.
// Expects: $role, $ur (signed-in account row), $page_title, $active (file name of the current menu item).

$portal_nav = array(
	'principal' => array(
		array('index.php', 'fa-building', 'Departments'),
	),
	'hod' => array(
		array('index.php', 'fa-users', 'Add Classroom'),
		array('subject_add.php', 'fa-book', 'Add Subject'),
	),
	'teacher' => array(
		array('index.php', 'fa-check', 'Mark Attendence'),
		array('attn_report.php', 'fa-bar-chart', 'Attendence Report'),
	),
);
// Managing students is for class teachers only.
if ($role === 'teacher' && $ur['status'] == 1) {
	array_splice($portal_nav['teacher'], 1, 0, array(array('stud_add.php', 'fa-plus', 'Add Student')));
	$portal_nav['teacher'][] = array('stud_report.php', 'fa-graduation-cap', 'Student Report');
}

$portal_name = ucfirst($ur['first_name']) . ' ' . ucfirst($ur['last_name']);
$portal_initials = substr($ur['first_name'], 0, 1) . substr($ur['last_name'], 0, 1);

// The sidebar is printed twice: fixed on desktop, slide-in on small screens.
function portal_sidebar_content($role, $nav, $active, $name, $initials)
{
	?>
    <div class="account2">
        <div class="avatar-initials" aria-hidden="true"><?php echo e($initials); ?></div>
        <h4 class="name"><?php echo e($name); ?></h4>
        <span class="role-badge"><?php echo e(role_label($role)); ?></span>
        <a href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out fa-fw mr-1"></i>Sign out</a>
    </div>
    <nav class="navbar-sidebar2">
        <ul class="list-unstyled navbar__list">
<?php foreach ($nav as $item) { ?>
            <li<?php echo $item[0] === $active ? ' class="active"' : ''; ?>>
                <a href="<?php echo $item[0]; ?>">
                    <i class="fa <?php echo $item[1]; ?>"></i><?php echo e($item[2]); ?>
                </a>
            </li>
<?php } ?>
        </ul>
    </nav>
	<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title><?php echo e($page_title); ?></title>
    <link rel="icon" type="image/png" href="../includes/images/icons/favicon.ico"/>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <link href="../includes/css/app.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="index.php">
                    <img src="images/icon/logo-white.png" alt="GP Awasari Attendence System" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
<?php portal_sidebar_content($role, $portal_nav[$role], $active, $portal_name, $portal_initials); ?>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="index.php">
                                    <img src="images/icon/logo-white.png" alt="GP Awasari Attendence System" />
                                </a>
                            </div>
                            <div class="header-title d-none d-lg-block"><?php echo e($page_title); ?></div>
                            <div class="header-button2">
                                <a class="header-signout d-none d-lg-inline-block" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fa fa-sign-out mr-1"></i>Sign out
                                </a>
                                <div class="header-button-item mr-0 js-sidebar-btn d-lg-none" role="button" aria-label="Open menu">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="index.php">
                        <img src="images/icon/logo-white.png" alt="GP Awasari Attendence System" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
<?php portal_sidebar_content($role, $portal_nav[$role], $active, $portal_name, $portal_initials); ?>
                </div>
            </aside>
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">You are here:</span>
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="index.php">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item"><?php echo e($page_title); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <div class="app-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
