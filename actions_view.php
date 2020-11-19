
<?php
$filePath = $_SERVER['PHP_SELF'];
$split_path = explode('/',$filePath);

$file_name = end($split_path);
?>
<div class="mb-3 mt-3">
    <a class="btn btn-primary" href="index.php">Home</a>
</div>

<?php if($file_name != 'student_register.php'){ ?>
<div class="mb-3 mt-3">
    <a class="btn btn-primary" href="student_register.php">Add New Student</a>
</div>
<?php }?>

<div class="mb-3 mt-3">
    <a class="btn btn-primary" href="students_list.php">Students List</a>
</div>

<div class="mb-3 mt-3">
    <a class="btn btn-primary" href="course.php">Add New Course</a>
</div>
<div class="mb-3 mt-3">
    <a class="btn btn-primary" href="course_list.php">Courses List</a>
</div>


<div class="mb-3 mt-3">
    <a class="btn btn-primary" href="student_subscribe.php">Student Subscribe</a>
</div>

<div class="mb-3 mt-3">
    <a class="btn btn-primary" href="student_report.php">Student Report</a>
</div>



