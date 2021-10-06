<?php
$filePath = $_SERVER['PHP_SELF'];
$split_path = explode('/',$filePath);

$file_name = end($split_path);
?>
<nav id="sidebar">
    <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(bootstrap-sidebar/images/logo.jpg);"></a>

        <ul class="list-unstyled components mb-5">
            <!-- <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li><a href="#">Home 1</a></li>
                </ul>
            </li> -->
            <li><a href="#">Home</a></li>
            <li><a href="student_register.php">Add new student</a></li>
            <li><a href="#">Student List</a></li>
            <li><a href="#">Add new Course</a></li>
            <li><a href="#">Course List</a></li>
            <li><a href="#">Student Subscribe</a></li>
            <li><a href="#">Student Report</a></li>
            <!-- <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
            </ul>
            </li> -->
            <!-- <li><a href="#">Portfolio</a></li>
            <li><a href="#">Contact</a></li> -->
        </ul>


        <div class="footer"><p></p></div>
    </div>
</nav>