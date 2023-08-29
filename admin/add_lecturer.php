<?php
require_once "./includes/dbh.php";
require_once "./includes/functions.php";
$password = "12346789";
$password = password_hash($password, PASSWORD_DEFAULT);

$lecturer_name = $lecturer_code = $status = $single_success = $file_success = "";
$lecturer_name_error = $lecturer_code_error = $status_error = $file_error = $single_lect_error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['single_lecturer'])) {
    if (empty($_POST['lecturer_name'])) {
        $lecturer_name_error = "Lecturer name is required";
    } else {
        $lecturer_name = validate_input($_POST['lecturer_name']);
    }

    if (empty($_POST['lecturer_code'])) {
        $lecturer_code_error = "Lecturer code is required";
    } else {
        $lecturer_code = validate_input($_POST['lecturer_code']);
    }

    if (empty($_POST['status'])) {
        $status_error = "This field is required";
    } else {
        $status = validate_input($_POST['status']);
    }
    if (empty($lecturer_name_error) && empty($lecturer_code_error) && empty($status_error)) {
        $sql = "SELECT * FROM lecturers WHERE lecturer_name = '$lecturer_name'";
        $query_string = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query_string) > 0) {
            $single_lect_error = "Lecturer already exists";
        } else {
            $query = "INSERT INTO lecturers(lecturer_name, lecturer_code, lec_status, passwords)VALUES('$lecturer_name', '$lecturer_code', '$status', '$password')";
            if (mysqli_query($conn, $query)) {
                $single_success = "Lecturer successfully added";
            } else {
                $single_lect_error = "An erorr occur while adding lecturer";
            }
        }
    } else {
        $single_lect_error = "Oops, some errors occur";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['upload_lecturer'])) {
        // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['lecturers']['name']) && in_array($_FILES['lecturers']['type'], $fileMimes)) {
        // Open uploaded CSV file with read-only mode
        $LecturerCsv = fopen($_FILES['lecturers']['tmp_name'], 'r');
        // Skip the first line
        fgetcsv($LecturerCsv);
        // Parse data from CSV file line by line
        while (($lecturerData = fgetcsv($LecturerCsv, 10000, ",")) !== FALSE) {
            // Get row data
            $lecturer_code = $lecturerData[0];
            $lecturer_name = $lecturerData[1];
            $status = $lecturerData[2];

            // If lecturer already exists in the database with the same name
            $query = "SELECT * FROM lecturers WHERE lecturer_name = '$lecturer_name'";
            $check = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($check);
            if (mysqli_num_rows($check) > 0) {
                $sql = "UPDATE lecturers SET lecturer_code = '$lecturer_code', lec_status = '$status', passwords = '$password' WHERE lecturer_name = '$lecturer_name'";
                if (mysqli_query($conn, $sql)) {
                    $file_success = "Lecturers successfully updated";
                }
            } else {
                $sql = "INSERT INTO lecturers(lecturer_name, lecturer_code, lec_status, passwords)VALUES('$lecturer_name', '$lecturer_code', '$status', '$password')";
                if (mysqli_query($conn, $sql)) {
                    $file_success = "Lecturers successfully uploaded";
                } else {
                    $file_error = "Oops, an error occured";
                }
            }
        }
        // Close opened CSV file
        fclose($LecturerCsv);
    }
    else
    {
        $file_error = "Please select valid file";
    }
}
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
    </nav>
    <!-- End Icons Navigation -->
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
            <a class="nav-link collapsed" style="background-color: #f6f9ff; color: #4154f1;" data-bs-target="#forms-nav"
                data-bs-toggle="collapse" href="#">
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
        <h1>Lecturer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Add Lecturer</li>
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
                                        <h5 class="card-title text-center pb-0 fs-4">Add Single Lecturer</h5>
                                        <p class="text-warning text-center small">Supply all information
                                            correctly</p>
                                    </div>
                                    <span class="text-success"><?php echo $single_success; ?></span>
                                    <span class="text-danger"><?php echo $single_lect_error; ?></span>
                                    <div class="form-group mb-3">
                                        <label for="deptsname" class="form-label">Lecturer Name</label>
                                        <input type="text" class="form-control" name="lecturer_name" id="deptsname">
                                        <span class="text-danger"><?php echo $lecturer_name_error; ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="deptscode" class="form-label">Lecturer Code</label>
                                        <input type="text" class="form-control" name="lecturer_code" id="deptscode">
                                        <span class="text-danger"><?php echo $lecturer_code_error; ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Lecturer Status</label>
                                        <input type="text" class="form-control" name="status" id="status">
                                        <span class="text-danger"><?php echo $status_error; ?></span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input class="btn btn-outline-primary w-100" type="submit"
                                            name="single_lecturer" value="Add Lecturer">
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
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Upload all Lecturers</h5>
                                        <p class="text-warning text-center small">Allowed filetype is CSV</p>
                                    </div>
                                    <span class="text-success"><?php echo $file_success; ?></span>
                                    <span class="text-danger"><?php echo $file_error; ?></span>
                                    <div class="form-group mb-3">
                                        <label for="dptfile" class="form-label">Add Lecturer File</label>
                                        <input type="file" class="form-control" name="lecturers" id="dptfile">
                                        <span class="text-danger"><?php echo $file_error; ?></span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input class="btn btn-outline-primary w-100" type="submit"
                                            name="upload_lecturer" value="Upload Lecturer">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Left side columns -->
            </div>
        </div>
    </section>
</main><!-- End #main -->
<?php require_once './includes/footer.php'; ?>