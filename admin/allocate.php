<?php 
require_once './includes/header.php'; 
global $conn;
// Query to retrieve the content of the specified column
$query = "SELECT matric_number FROM students";
$result = mysqli_query($conn, $query);

$lec_query = "SELECT lecturer_name FROM lecturers";
$lec_result = mysqli_query($conn, $lec_query);

// Initialize an array to store the column values
$studentsArray = array();
$lecturerArray = array();

// Check if the query was successful
if ($result) {
    // Fetch each row and store the column value in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $studentsArray[] = $row['matric_number'];
    }
    // Free the result set
    $result->free();
}

if ($lec_result) {
    while ($row = mysqli_fetch_assoc($lec_result)) {
        $lecturerArray[] = $row['lecturer_name'];
    }
    $lec_result->free();
}

// Close the database connection
mysqli_close($conn);
$number_of_students = count($studentsArray);
$number_of_lecturers = count($lecturerArray);

$studentsPerLecturer = floor(count($studentsArray) / count($lecturerArray));
$remainingStudents = (count($studentsArray) % count($lecturerArray));

shuffle($studentsArray);
$lecturerAllocationArray = array();
foreach($lecturerArray as $lecturer) {
    $allocatedStudents = array_splice($studentsArray, 0, $studentsPerLecturer);
    
    $allocationSubArray = array(
        "Lecturer" => $lecturer,
        "Students" => $allocatedStudents
    );

    $lecturerAllocationArray[] = $allocationSubArray;
    // $additionalStudents = array_splice($studentsArray, 0, 1);
    // $allocatedStudents = array_merge($allocatedStudents, $additionalStudents);
} 
for ($i=0; $i <$remainingStudents; $i++) { 
    array_push($lecturerAllocationArray[$i]['Students'], $studentsArray[$i]);
}




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
                            foreach($lecturerAllocationArray as $lecturerAllocation) {
                                echo ' <tr>
                                <td>1</td>
                                <td>'.$lecturerAllocation['Lecturer'].'</td>
                                <td>Coming Soon . . .</td>';
                                foreach ($lecturerAllocation['Students'] as $student) { 
                                    echo '<td>'.$student.'</td>';
                                }
                                echo '
                            </tr>';
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