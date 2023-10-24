<?php 
require_once './includes/header.php'; 
require_once './includes/functions.php';
session_start();

$company_name = $company_address = $office_state = $unit_head = $unit_section = $frontdesk_number = "";
// Check if the user is already logged in
if(!isset($_SESSION["loggin"]) && $_SESSION["loggin"] !== true){
    header("location: login.php");
    exit;
} else {
    
	// Get students siwes details with the student ID and lecturer ID from siwes_information_details
    $siwes = getSiwesDetails($_SESSION['lecturer_id'], $_SESSION['student_id']);

	// Get student profile details
	$student = getStudentsById($_SESSION['student_id']);
	$matric_number = $student['matric_number'];
	$email = $student['email'];
	$fullname = $student['fullname'];
	
	if ($siwes != null && $student != null) {

		// Get Siwes details
		$company_name = $siwes['company_name'];
		$company_address = $siwes['company_address'];
		$office_state = $siwes['office_state_city'];
		$unit_head = $siwes['unit_headname'];
		$unit_section = $siwes['unit_section'];
		$frontdesk_number = $siwes['frontdesk_number'];
	}
    

}
?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.jpg" alt="">
            <span class="d-none d-lg-block">SIWES</span>
        </a>
        <?php if($_SESSION['user_role'] == "admin"): ?>
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <?php endif; ?>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="assets/img/profile-img.png" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">Computer Science</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo $_SESSION['username']; ?></h6>
                        <span><?php echo $_SESSION['user_role']; ?></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="./includes/logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Allocation</span>
            </a>
        </li><!-- End Dashboard Nav -->

    </ul>
</aside><!-- End Sidebar-->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active">SIWES details</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="assets/img/profile-img.png" alt="Profile" class="rounded-circle" />
                        <h2 class="mb-1"><?php echo $fullname; ?></h2>
                        <h3><?php echo $matric_number; ?></h3>
                        <small class="fs-5 text-primary"><?php echo $email; ?></small>
                        <div class="social-links mt-2">
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                                    Details
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Company Info</h5>

                                <div class="row">
                                    <div class="col-md-4 label">
                                        Company Name
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $company_name; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 label">
                                        Company Address
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $company_address; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 label">
                                        Office State / City
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $office_state; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 label">
                                        Unit / Section
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $unit_section; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 label">
                                        Unit / Section Head
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $unit_head; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 label">
                                        Front-Desk Number
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $frontdesk_number; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
<?php require_once './includes/footer.php'; ?>