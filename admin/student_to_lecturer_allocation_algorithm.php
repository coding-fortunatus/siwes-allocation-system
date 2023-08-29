<?php
// Obtaining numbers of students and lecturers
$studentCount = 94;
$lecturerCount = 10;
// Performing a floor division without remainder to have a conceptual view of how many students to allocate generally
$studentsPerLecturer = floor($studentCount / $lecturerCount);
echo $studentsPerLecturer." students per lecturer <br>";
// Knowing the number of remaining students, so as to put them into consideration when doing allocation
$remainingStudents = $studentCount % $lecturerCount;
echo $remainingStudents." Remaining students <br>";
// Allocating the normal numbers of students to each lecturer.
$lecturerAllocations = array_fill(0, $lecturerCount, $studentsPerLecturer);
// Allocating the remaining numbers of students to lecturers
for ($i = 0; $i < $remainingStudents; $i++) {
    $lecturerAllocations[$i]++;
}
// Printing the overview of the allocations/distribution
for ($i = 0; $i < $lecturerCount; $i++) {
    echo "Lecturer " . ($i + 1) . " is assigned " . $lecturerAllocations[$i] . " students." . PHP_EOL;
    echo "<br>";
}

?>