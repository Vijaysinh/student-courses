<?php
require_once 'core/init.php';




// $student->findAll('students');

require_once 'core/init.php';
$pagination =  new Pagination('students');
$users = $pagination->get_data();
$pages	= $pagination->get_pagination_number();





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
                <h1>Registered Students List with OOPS Pagination Class</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th></th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Phone</th>
                        <th scope="col">ID</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    foreach($users->results() as $v){?>
                        <tr>
                            <td><a href="edit_student.php?id=<?php echo $v->id;?>">Edit</a></td>
                            <td><?php echo $v->fname;?></td>
                            <td><?php echo $v->lname;?></td>
                            <td><?php echo $v->phone;?></td>
                            <td><?php echo $v->id;?></td>
                            <td><a href="delete.php?type=student&id=<?php echo $v->id;?>">Delete</a></td>
                        </tr>
                        
                    <?php $i++;}?>
                    </tbody>
                    </table>


                    <hr>
                    <a href="?page=<?php echo $pagination->prev_page();?>"> << </a>
                    <?php for($i=1; $i<=$pages; $i++){ ?>
                            <a class="<?php echo $pagination->is_active_class($i) ?>" href="?page=<?php echo $i; ?>"><?php echo $i;?></a>
                    <?php } ?>
                    <a href="?page=<?php echo $pagination->next_page();?>"> >> </a>

                    <?php include('actions_view.php');?>

            </div>
        </div>
    </div>
  </body>
</html>
