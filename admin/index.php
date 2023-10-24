<?php 
require_once './includes/header.php'; 
require_once './includes/functions.php';
session_start();

// Check if the user is already logged in
if(!isset($_SESSION["loggin"]) && $_SESSION["loggin"] !== true){
    header("location: login.php");
    exit;
} else {
    
    // Get useful informations
    $department_count = mysqli_num_rows(getDepartments());
    $lecturer_count = mysqli_num_rows(getLecturers());
    $Student_count = mysqli_num_rows(getStudents());
    
    $students = getStudentsByMatNumber();
    
    
    if (isset($_GET['student']) != null) {
        $_SESSION['student_id'] = $_GET['student'];

        header("Location: siwes-details.php");
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

<?php if ($_SESSION['user_role'] == "admin") : ?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-houses"></i><span>Department(s)</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="add_department.php">
                        <i class="bi bi-circle"></i><span>Add department</span>
                    </a>
                </li>
                <li>
                    <a href="view_department.php">
                        <i class="bi bi-circle"></i><span>View Department</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Departments Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Lecturer(s)</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="add_lecturer.php">
                        <i class="bi bi-circle"></i><span>Add Lecturer</span>
                    </a>
                </li>
                <li>
                    <a href="view_lecturer.php">
                        <i class="bi bi-circle"></i><span>View Lecturer</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Lecturer Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Student(s)</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="add_student.php">
                        <i class="bi bi-circle"></i><span>Add Student</span>
                    </a>
                </li>
                <li>
                    <a href="view_student.php">
                        <i class="bi bi-circle"></i><span>View Student</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Student Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="allocate.php">
                <i class="bi bi-journal-text"></i>
                <span>Lecturer Allocation</span>
            </a>
        </li><!-- End Lecturer allocation Page Nav -->
    </ul>
</aside><!-- End Sidebar-->
<?php else: ?>

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
<?php endif ?>
<main id="main" class="main">
    <!-- Checking if user role is admin and show dynamic informationt to the screen -->
    <?php if ($_SESSION['user_role'] == "admin") : ?>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <!-- Dashboard Details -->
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Department Card -->
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Department <span>| Total</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-houses"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $department_count; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Department Card -->

                    <!-- Lecturer Card -->
                    <div class="col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Lecturer <span>| Total</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $lecturer_count; ?></h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Lecturer Card -->

                    <!-- Student Card -->
                    <div class="col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Student <span>| Total</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="text-secondary bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $Student_count; ?></h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Student Card -->
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
    <!-- If User is not admin but user is lecturer, show dynamic for lecturer to see his students -->
    <?php else: ?>
    <div class="pagetitle">
        <h1>Supervisor Area</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Allocations</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="card shadow py-3">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>Student Name</th>
                                    <th>Matric Number</th>
                                    <th>Email</th>
                                    <th>SIWES Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                            
                            if (count($students) > 0) {
                                foreach ($students as $student) {    
                                    foreach ($student as $data) {
                                        echo ' <tr>
                                        <td>'.$data['id'].'</td>
                                        <td>'.$data['fullname'].'</td>
                                        <td>'.$data['matric_number'].'</td>
                                        <td>'.$data['email'].'</td>
                                        <td>';
                                        echo getPlacementStatus($data['id']);
                                echo '</td>
                                <td>
                                    <a href="?student='.$data['id'].'" class="btn btn-outline-primary">View
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                </tr>';
                                }
                                }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Left side columns -->
        </div>
    </section>
    <?php endif ?>
    <!-- Modal -->
</main><!-- End #main -->
<script>
$(document).ready(function() {
    $('#example')
        .DataTable({
            //disable sorting on last column      
            "columnDefs": [{
                "orderable": false,
                "targets": 5
            }],
            language: {
                //customize pagination prev and next buttons: use arrows instead of words        
                'paginate': {
                    'previous': '<span class="fa fa-chevron-left"></span>',
                    'next': '<span class="fa fa-chevron-right"></span>'
                },
                //customize number of elements to be displayed        
                "lengthMenu": 'Display <select class="form-control input-sm">' +
                    '<option value="10">10</option>' + '<option value="20">20</option>' +
                    '<option value="30">30</option>' + '<option value="40">40</option>' +
                    '<option value="50">50</option>' + '<option value="-1">All</option>' +
                    '</select> results'
            }
        })
});
</script>
<?php require_once './includes/footer.php'; ?>