<?php 
session_start();
require_once './includes/dbh.php'; 
require_once './includes/functions.php'; 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggin"]) && $_SESSION["loggin"] !== true){
    header("location: login.php");
    exit;
} else {
    // Start data processing if user is loggedin
    // Define all variables
    $company_name = $company_address = $office_city_state = $fdesk_number = $unit_section = $unit_head = "";
    $cname_error = $caddress_error = $office_city_state_error = $fdesk_number_error = $unit_head_error = $unit_section_error = $failmsg = $success = "";
    $cname = $caddress = $coff_state = $cfdesk = $cunit_section = $cunit_head = "";

    // Students matric number and student data
    $matric_number = $_SESSION['matric_number'];
    $student_id = $_SESSION['id'];
    $student_data = getStudentDetails($matric_number);

    // Getting lecturer details
    $lecturer_datas = getSupervisor($matric_number);
    $lecturer_name = $lecturer_datas['lecturer_name'];
    $lecturer_id = $lecturer_datas['id'];

    // Getting student siwes details
    $siwes_details = getSiwesDetails($lecturer_id, $student_id);
    if ($siwes_details != null) {
        $cname = $siwes_details['company_name'];
        $caddress = $siwes_details['company_address'];
        $coff_state = $siwes_details['office_state_city'];
        $cfdesk = $siwes_details['frontdesk_number'];
        $cunit_section = $siwes_details['unit_section'];
        $cunit_head = $siwes_details['unit_headname'];
    }
    
    

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['siwes_details'])) {

        // Process user inputs here
        if(empty(trim($_POST["company_name"]))){
            $cname_error = "Please enter company.";
        } else{
            $company_name = trim($_POST["company_name"]);
        }
        
        if(empty(trim($_POST["company_address"]))){
            $caddress_error = "Please enter address.";
        } else{
            $company_address = trim($_POST["company_address"]);
        }
        
        if(empty(trim($_POST["state_city"]))){
            $office_city_state_error = "Please enter state/city.";
        } else{
            $office_city_state = trim($_POST["state_city"]);
        }
        
        if(empty(trim($_POST["frontdesk_number"]))){
            $fdesk_number_error = "Please enter company contact number.";
        } else{
            $fdesk_number = trim($_POST["frontdesk_number"]);
        }
        
        if(empty(trim($_POST["unit_section"]))){
            $unit_section_error = "Please enter your siwes unit/section.";
        } else{
            $unit_section = trim($_POST["unit_section"]);
        }

        if(empty(trim($_POST["unit_head"]))){
            $unit_head_error = "Please enter your siwes unit/section.";
        } else{
            $unit_head = trim($_POST["unit_head"]);
        }

        if (empty($cname_error) && empty($caddress_error) && empty($office_city_state_error) && empty($fdesk_number_error) && empty($unit_head_error) && empty($unit_section_error)) {
            
            // Perform data insertion into the student details
            $message = insertStudentData($lecturer_id, $student_id, $company_name, $company_address, $office_city_state, $fdesk_number, $unit_head, $unit_section);

            if ($message == "Updated") {
                $success = "<span class='text-success'>SIWES details updated successfully</span>";
            } elseif ($message == "Inserted") {
                $success = "<span class='text-success'>SIWES details added successfully</span>";
            } elseif ($message == "Not Inserted") {
                $failmsg = "<span class='text-danger'>Oops, an error occured while adding SIWES details</span>";
            } elseif ($message == "Not Updated") {
                $failmsg = "<span class='text-danger'>Oops, an error occured while updating SIWES details</span>";
            } 
        }

    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Student Area - SIWES ALLOCATION SYSTEM</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script><!-- Data Table JS -->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="bg-white p-3 pb-2 mb-3 col-md-10">
                <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fw-bold">Student</li>
                        <li class="breadcrumb-item active" aria-current="page">Student Information</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-2">
                <a href="./includes/logout.php" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="./assets/img/profile-img.png" alt="Student Picture"
                                    class="rounded-circle p-1 bg-primary" width="200rem">
                                <div class="mt-3">
                                    <?php
                                    foreach($student_data as $data) {
                                        echo '
                                        <h4>'.$data['fullname'].'</h4>
                                        <p class="text-secondary mb-3">'.$data['matric_number'].'</p>
                                        ';
                                    }
                                ?>
                                    <p class="text-secondary mb-1">School of Pure and Applied Sciences</p>
                                    <p class="text-secondary mb-3">Computer Science Department</p>
                                    <hr>
                                    <p class="text-muted h5"><?php echo $lecturer_name; ?></p>
                                    <div class="text-secondary">Supervisor</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                                <div class="row mb-3">
                                    <div class="card-header mb-3">
                                        SIWES Information <br>
                                        <?php echo $success; ?>
                                        <?php echo $failmsg; ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Company Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="company_name" class="form-control"
                                            value="<?php echo $cname; ?>">
                                        <span class="text-danger"><?php echo $cname_error; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Company Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="company_address" class="form-control"
                                            value="<?php echo $caddress; ?>">
                                        <span class="text-danger"><?php echo $caddress_error; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Office State & City</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="state_city" class="form-control"
                                            value="<?php echo $coff_state; ?>">
                                        <span class="text-danger"><?php echo $office_city_state_error; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Front-Desk Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="tel" name="frontdesk_number" class="form-control"
                                            value="<?php echo $cfdesk; ?>">
                                        <span class="text-danger"><?php echo $fdesk_number_error; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Unit / Section</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="unit_section" class="form-control"
                                            value="<?php echo $cunit_section; ?>">
                                        <span class="text-danger"><?php echo $unit_section_error; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Unit Head Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="unit_head" class="form-control"
                                            value="<?php echo $cunit_head; ?>">
                                        <span class="text-danger"><?php echo $unit_head_error; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" name="siwes_details" class="btn btn-primary px-4"
                                            value="Save Details">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>