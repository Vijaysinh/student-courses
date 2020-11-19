<?php
require_once 'core/init.php';
$student_id = $_GET['id'];
$student = new Student();
try {
    $student = new Student();
    $student->delete_record('students',['id','=',$student_id]);

    header('Location: students_list.php');
} catch(Exception $e) {
    pr($e);
    echo $e->getTraceAsString(), '<br>';
}
