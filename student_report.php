<?php
require_once 'core/init.php';

$report = new Report();

$report_data = $report->findAllStudentEnrolledCourses();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">

    <title>Students List</title>
  </head>
  <body class="bg-light">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-8 order-md-1">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th></th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Course Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    foreach($report_data as $v){?>
                        <tr>
                            <th scope="row"><?php echo $i;?></th>
                            <td><?php echo $v->fname;?></td>
                            <td><?php echo $v->lname;?></td>
                            <td><?php echo $v->course_name;?></td>
                        </tr>
                    <?php $i++;}?>
                    </tbody>
                    </table>
                    
                    <?php if(empty($report_data)){?>
                            <div>No data found</div>
                    <?php }?>

                    <?php include('actions_view.php');?>
            </div>
        </div>
    </div>
  </body>
</html>
