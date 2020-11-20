<?php
require_once 'core/init.php';
$id = $_GET['id'];
$type = $_GET['type'];

try {

    if($type == 'student'){
        $student = new Student();
        $student->delete_record('students',['id','=',$id]);
        header('Location: students_list.php');
    }else{
        $course = new Course();
        $course->delete_record(['id','=',$id]);
        header('Location: course_list.php');
    }
    

    
} catch(Exception $e) {
    pr($e);
    echo $e->getTraceAsString(), '<br>';
}
