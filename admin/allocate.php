<?php 
require_once './includes/header.php'; 
global $conn;

$lecturerArray = $studentsArray = $msg = $failmsg ="";
// extract matric_number from student data 
$query = "SELECT matric_number FROM students";
$result = mysqli_query($conn, $query);
// Extract necessary datas from the lecturer data
$lec_query = "SELECT * FROM lecturers";
$lec_result = mysqli_query($conn, $lec_query);
// Initialize an array to store the column values
$studentsArray = array();
$lecturerArray = array();
// Create allocation array for the student lecturer allocation
$lecturerAllocationArray = array();
$lecturerAllocation = array();
// Check if the query to fetch matric number was successful
if ($result) {
    // Fetch each row and store the column value in an array
    while ($row = mysqli_fetch_assoc($result)) {
        $studentsArray[] = $row['matric_number'];
    }
    // Free the result set
    $result->free();
}
// Check if the query to fetch matric number was sucssessful
if ($lec_result) {
    // fetch each row and store the column value in an array
    while ($row = mysqli_fetch_assoc($lec_result)) {
        $lecturerArray[] = $row['id'];
    }
    // free the result set
    $lec_result->free();
}
// Start the allocation procedures by checking for button clicked action
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['generate'])) {
    // Create the allocation techniques
    $number_of_students = count($studentsArray);
    $number_of_lecturers = count($lecturerArray);
    $studentsPerLecturer = floor(count($studentsArray) / count($lecturerArray));
    $remainingStudents = (count($studentsArray) % count($lecturerArray));
    shuffle($studentsArray);
    $lecturerAllocationArray = array();
    foreach($lecturerArray as $lecturer) {
        $allocatedStudents = array_splice($studentsArray, 0, $studentsPerLecturer);
        // Store the allocation as associative array
        $allocationSubArray = array(
            "Lecturer" => $lecturer,
            "Students" => $allocatedStudents
        );
        // Store all the data into another array
        $lecturerAllocationArray[] = $allocationSubArray;
        // $additionalStudents = array_splice($studentsArray, 0, 1);
        // $allocatedStudents = array_merge($allocatedStudents, $additionalStudents);
    }
    // allocate the remaining students from the student array after the general allocation
    for ($i=0; $i < $remainingStudents; $i++) { 
        array_push($lecturerAllocationArray[$i]['Students'], $studentsArray[$i]);
    }
    // To insert the lecturer allocation into database table
    foreach ($lecturerAllocationArray as $lecturerAllocation) {
        $lec = $lecturerAllocation['Lecturer'];
        $students = implode(" ", $lecturerAllocation['Students']);
        // Check if the user data already exists in the database
        $query = "SELECT * FROM lecturer_allocation WHERE lecturer_id = '$lec'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $updateQuery = "UPDATE lecturer_allocation SET students = '$students' WHERE lecturer_id = '$lec'";
            if (mysqli_query($conn, $updateQuery)) {
                $msg = "Student allocation updated successfully";
            } else {
                $failmsg = "Oops, an error occur while updating student allocation";
            }
        } else {
            // Insert data into the database if not exists
            $sql = "INSERT INTO lecturer_allocation(lecturer_id, students)VALUES($lec, '$students')";
            if (mysqli_query($conn, $sql)) {
                $msg = "Student allocation successfully generated!";
            } else {
                $failmsg = "Oops, an error occured while generating allocation";
            }
        }
    }
    
}
// Fetch the allocation from the database if allocation has been done
$query = 
        "SELECT lecturer_allocation.id, lecturers.lecturer_name, lecturers.lecturer_code, lecturer_allocation.students
        FROM lecturer_allocation
        INNER JOIN lecturers ON lecturer_allocation.lecturer_id = lecturers.id";
$results = mysqli_query($conn, $query);
?>
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
            <a class="nav-link collapsed" style="background-color: #f6f9ff; color: #4154f1;" href="allocate.php">
                <i class="bi bi-journal-text"></i>
                <span>Lecturer Allocation</span>
            </a>
        </li><!-- End Lecturer allocation Page Nav -->
    </ul>
</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Allocation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Lecturer & Student Allocation</li>
            </ol>
        </nav>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="button-group">
                <input type="submit" value="Generate Allocation" name="generate" class="btn btn-outline-primary">
                <span class="text-success"><?php echo $msg; ?></span>
                <span class="text-danger"><?php echo $failmsg; ?></span>
            </div>
        </form>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 60px;">Code</th>
                                <th>Lecturer Name</th>
                                <th>Lecturer Status</th>
                                <th>Allocated Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            if (mysqli_num_rows($results) > 0) {
                                while ($row = mysqli_fetch_assoc($results)) {
                                    
                                    echo ' <tr>
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['lecturer_name'].'</td>
                                    <td>'.$row['lecturer_code'].'</td>';
                                    echo '<td>'.$row['students'].'</td>
                                    </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Left side columns -->
        </div>
    </section>
</main><!-- End #main -->
<?php require_once './includes/footer.php'; ?>