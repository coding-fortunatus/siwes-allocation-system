<?php 
    require_once 'PhpXlsxGenerator.php';

    // Function to sanitize user inputs from form submission
    function validate_input($data) {
        stripslashes($data);
        htmlspecialchars($data);
        trim($data);
        return $data;
    }

    // Function to get all departments
    function getDepartments() {
        global $conn;
        $sql = "SELECT * FROM departments ORDER BY department_name";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    // Function to get all lecturer data
    function getLecturers(){
        global $conn;
        $sql = "SELECT * FROM lecturers";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    // Function to get all student data
    function getStudents(){
        global $conn;
        $sql = "SELECT * FROM students ORDER BY matric_number";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    // Function to delete an item from the database table
    function deleteData($data_id, $table_name) {
        global $conn;

        $sql = "DELETE FROM $table_name WHERE id = '$data_id'";
        mysqli_query($conn, $sql);
    }

    // Function to the allocation made from the database
    function getAllocations($allocation_table, $lecturer_table){
        global $conn;
        // Fetch the allocation from the database if allocation has been done
        $query = 
                "SELECT $allocation_table.id, $lecturer_table.lecturer_name, $lecturer_table.lecturer_code, $lecturer_table.lec_status, $allocation_table.students
                FROM $allocation_table
                INNER JOIN $lecturer_table ON $allocation_table.lecturer_id = $lecturer_table.id";
        $allocation = mysqli_query($conn, $query);
        return $allocation;
    }

    // Function to download allocation as Excel Document
    function download_Allocation($allocationtable, $lecturertable) {

        // Setting filename
        $filename = 'SIWES-Supervisor-Allocations.xlsx';

        // Define column names 
        $excelData[] = array('LECTURER CODE', 'LECTURER NAME', 'LECTURER STATUS', 'ALLOCATED STUDENTS'); 

        // Fetch All allocations
        $result = getAllocations($allocationtable, $lecturertable);
        if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){  
                $lineData = array($row['lecturer_code'], $row['lecturer_name'], $row['lec_status'], $row['students']);  
                $excelData[] = $lineData; 
            }
        }
        
        // Export data to excel and download as xlsx file 
        $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
        $xlsx->downloadAs($filename);
        exit;
    }

    function getAllocatedStudents($lecturer_id) {
        global $conn;

        $sql = "SELECT students FROM lecturer_allocation WHERE lecturer_id = '$lecturer_id'";
        $student = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        
        $allStudents = explode(" ", $student['students']);
        return $allStudents;
    }

    function getStudentsByMatNumber() {
        global $conn;

        $students = getAllocatedStudents($_SESSION['lecturer_id']);
        $student_data = [];
        foreach($students as $student) {
            $query = "SELECT id, matric_number, fullname, email FROM students WHERE matric_number = '$student'";
            $details = mysqli_query($conn, $query);
            array_push($student_data, $details);
        }
        return $student_data;
    }

    function getSiwesDetails($lecturer_id, $student_id) {
        
        global $conn;

        $sql = "SELECT * FROM students_siwes_details 
                WHERE supervisor_id = '$lecturer_id' AND student_id = '$student_id'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        return $result;
    }

    function getStudentsById($student_id) {
        global $conn;

        $sql = "SELECT * FROM students 
                WHERE id = '$student_id'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        return $result;
    }

    function getPlacementStatus($s_id) {
        
        global $conn;
        
        $sql = "SELECT * FROM students_siwes_details WHERE student_id = '$s_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result) == 1) {
            return "Placed";
        } else {
            return "Not Placed";
        }
        
    }

?>