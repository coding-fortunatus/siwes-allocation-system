<?php

$departments = $department_code = $success = "";
$department_error = $department_code_error = $dept_error = $file_error = "";
?>

<?php require_once './includes/header.php'; ?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.jpg" alt="">
            <span class="d-none d-lg-block">SIWES</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
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
                        <h6>Administrator</h6>
                        <span>SIWES Manager</span>
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
            <a class="nav-link" style="color: #012970;" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" style="background-color: #f6f9ff; color: #4154f1;"
                data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
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

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Department</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Add Department</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Add Single Department</h5>
                                        <p class="text-warning text-center small">Supply all information
                                            correctly</p>
                                    </div>
                                    <span class="text-success"><?php echo $success; ?></span>
                                    <div class="form-group">
                                        <label for="deptsname" class="form-label">Department Name</label>
                                        <input type="text" class="form-control mb-3" name="department_name"
                                            id="deptsname">
                                        <span class="text-danger"><?php echo $department_error; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="deptscode" class="form-label">Department Code</label>
                                        <input type="text" class="form-control mb-3" name="department_code"
                                            id="deptscode">
                                        <span class="text-danger"><?php echo $department_code_error; ?></span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input class="btn btn-primary w-100" type="submit" name="single_department"
                                            value="Add Department">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <h3 class="h3 ">OR</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Upload all Departments</h5>
                                        <p class="text-warning text-center small">Allowed filetype is CSV</p>
                                    </div>
                                    <span class="text-success"><?php echo $success; ?></span>
                                    <div class="form-group">
                                        <label for="dptfile" class="form-label">Add Department File</label>
                                        <input type="file" class="form-control mb-3" name="departments" id="dptfile">
                                        <span class="text-danger"><?php echo $file_error; ?></span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input class="btn btn-primary w-100" type="submit" name="upload_department"
                                            value="Upload Departments">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->
            </div>
    </section>
</main><!-- End #main -->
<?php require_once './includes/footer.php'; ?>