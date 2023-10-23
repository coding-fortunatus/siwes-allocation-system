<?php

function getStudentDetails($matricnumber) {
    global $conn;
    
    $sql = "SELECT * FROM students WHERE matric_number = '$matricnumber'";
    $student_details = mysqli_query($conn, $sql);
    return $student_details;
}

function getSupervisor($matricnumber) {
    global $conn;

    $sql = "SELECT lecturer_id FROM lecturer_allocation WHERE students LIKE '%$matricnumber%'";
    $lec_data = mysqli_query($conn, $sql);

    if (mysqli_num_rows($lec_data) > 0) {
        $row = mysqli_fetch_assoc($lec_data);
        $lecturer_id = $row['lecturer_id'];

        $query = "SELECT * FROM lecturers WHERE id = '$lecturer_id'";
        $lecture_data = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($lecture_data);
    } else {
        return "No matching record found!";
    }
}

function insertStudentData($lec_id, $student_id, $cname, $caddress, $city_state, $fdesk_number, $unit_head, $unit_section) {
    global $conn;

    $sql = "SELECT * FROM students_siwes_details WHERE student_id = '$student_id' AND supervisor_id = '$lec_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $update = "UPDATE students_siwes_details 
                    SET company_name = '$cname', company_address = '$caddress', office_state_city = '$city_state', 
                        frontdesk_number = '$fdesk_number', unit_section = '$unit_section', unit_headname = '$unit_head'
                    WHERE student_id = '$student_id' AND supervisor_id = '$lec_id'";
        if (mysqli_query($conn, $update)) {
            return "Updated";
        } else {
            return "Not Updated";
        }
    } else {
        $insert = "INSERT INTO students_siwes_details(supervisor_id, student_id, company_name, company_address,             office_state_city, frontdesk_number, unit_section, unit_headname) VALUES('$lec_id', '$student_id', '$cname', '$caddress', '$city_state', '$fdesk_number', '$unit_section', '$unit_head')";
        if (mysqli_query($conn, $insert)) {
            return "Inserted";
        } else {
            return "Not Inserted";
        }
    }
}

function getSiwesDetails($lecturer_id, $student_id) {
    global $conn;

    $query = "SELECT * FROM students_siwes_details WHERE supervisor_id = '$lecturer_id' AND student_id = '$student_id'";
    return mysqli_fetch_array(mysqli_query($conn, $query));
}